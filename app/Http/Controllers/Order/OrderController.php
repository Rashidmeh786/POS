<?php

namespace App\Http\Controllers\Order;

use Carbon\Carbon; 
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Orderdetails;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function FinalInvoice(Request $request){


        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

            // dd($request->due);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        // $data['vat'] = $request->vat;

        $data['invoice_no'] = 'POS'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now(); 

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach($contents as $content){
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['quantity'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;

            $insert = Orderdetails::insert($pdata); 

        } // end foreach

        toast()->success('Invoice Generated Successfully ');

        
        $product = Orderdetails::where('order_id',$order_id)->get();
        foreach($product as $item){
           Product::where('id',$item->product_id)
                ->update(['stock' => DB::raw('stock-'.$item->quantity) ]);
        }


        $cust_id = $request->customer_id;
        $customer = Customer::where('id',$cust_id)->first();
       
        $order_id = Order::where('id',$order_id)->first();
        $totaldiscountv=$request->totaldiscountv;

        $invoiceView = View::make('invoice.thermal', compact('customer', 'contents','order_id','totaldiscountv'))->render();
        session(['invoiceView' => $invoiceView]);


        Cart::destroy();
 
        // $invoiceView = View::make('invoice.thermal', compact('order_id', 'contents'))->render();
        return redirect()->route('pos');
// return $this->invoiceprint();
        // return redirect()->route('dashboard');

    } 

    public function invoiceprint()
    {
        $invoiceView = session('invoiceView');
    
        return $invoiceView;
    }

    public function PendingOrder(){

        $orders = Order::where('order_status','pending')->get();
        return view('order.pending_order',compact('orders'));

    }

    public function OrderDetails($order_id){

        $order = Order::where('id',$order_id)->first();

        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('order.order_details',compact('order','orderItem'));

    }


    public function OrderStatusUpdate(Request $request){

        $order_id = $request->id;
        // $product = Orderdetails::where('order_id',$order_id)->get();
        // foreach($product as $item){
        //    Product::where('id',$item->product_id)
        //         ->update(['stock' => DB::raw('stock-'.$item->quantity) ]);
        // }

     Order::findOrFail($order_id)->update(['order_status' => 'complete']);

     toast()->success('Order Completed Successfully ');
        

        return redirect()->route('pending.order');


    }// End Method 

    public function CompleteOrder(){

        $orders = Order::where('order_status','complete')->get();
        return view('order.complete_order',compact('orders'));

    }


    public function OrderInvoice($order_id){

        $order = Order::where('id',$order_id)->first();

       $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

       $pdf = Pdf::loadView('order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
               'tempDir' => public_path(),
               'chroot' => public_path(),

       ]);
       $date = Carbon::now()->format('Y-m-d'); // Get the current date in the desired format
       $fileName = 'invoice_' . $date . '.pdf';
   
       return $pdf->download($fileName);
   }

    public function StockManage(){

        $product = Product::latest()->get();
        return view('stock.all_stock',compact('product'));
    
        }



        public function PendingDue(){

            $alldue = Order::where('due','>','0')->orderBy('id','DESC')->get();
            return view('order.pending_due',compact('alldue'));
        }

        public function AllSales(){

            $allsale = Order::orderBy('id','DESC')->get();
            return view('order.all_sale',compact('allsale'));
        }


        public function OrderDueAjax($id){

            $order = Order::findOrFail($id);
            return response()->json($order);
    
        }


        public function UpdateDue(Request $request){

            $order_id = $request->id;
            $due_amount = $request->due;
            $pay_amount = $request->pay;
    
            $allorder = Order::findOrFail($order_id);
            $maindue = $allorder->due;
            $maindpay = $allorder->pay;
    
            $paid_due = $maindue - $due_amount;
            $paid_pay = $maindpay + $due_amount;
    
            Order::findOrFail($order_id)->update([
                'due' => $paid_due,
                'pay' => $paid_pay, 
            ]);
    
          
            toast()->success('Due Added Successfully ');
    
            // return redirect()->route('pending.due');
            return redirect()->back();

    
    
        }// End Method 


}
