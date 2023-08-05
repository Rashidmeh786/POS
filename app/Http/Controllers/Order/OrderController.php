<?php

namespace App\Http\Controllers\Order;

use Carbon\Carbon; 
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\HoldOrder;
use App\Models\OrderReturn;
use App\Models\Orderdetails;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\HoldOrderDetails;
use App\Models\OrderReturnDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{

    public function HoldOrder (Request $request){

        $hold_no = IdGenerator::generate(['table' => 'hold_orders','field' => 'hold_no','length' => 7, 'prefix' => 'ref-' ]);

        $rows=$request->all();
       
            $rows = $request->input('rows');
     $customer_id=$request->input('customer_id');


     $data = array();
     $data['customer_id'] = $customer_id;
     $data['hold_date'] = Carbon::now(); 
    $data['discount'] =$request->input('discount-input') ?? 0;
     $data['hold_no'] =  $hold_no;
     $data['created_at'] = Carbon::now(); 
     $data['user_id']= Auth::id();
$data['order_status']='hold';
     $hold_id = HoldOrder::insertGetId($data);

    // dd($customer_id);
            foreach ($rows as $row) {
                HoldOrderDetails::create([
                    'hold_id' => $hold_id,
                    'product_id' => $row['product_id'],
                  
                    'unitcost' => $row['price'],
                    'quantity' => $row['qty'],
                  'total'=> $row['qty']* $row['price']
                ]);

            }
        $ref_no=HoldOrder::where('id',$hold_id)->pluck('hold_no');

    
        //    return response()->json(['message' => 'Order saved successfully!']);
            return response()->json( $ref_no);
        
    }



    public function getHoldOrders()
    {
        $holdOrders = HoldOrder::all();
        $count = $holdOrders->count();
    
        $response = [
            'holdOrders' => $holdOrders,
            'count' => $count
        ];
    
        return response()->json($response);
    }
    public function deleteholdOrder(Request $request)
{
    $orderId = $request->input('id');
    // Perform the deletion of the order with $orderId from the database
    // Your deletion logic goes here
   HoldOrder::find($orderId)->delete();
    // return response()->json(['message' => 'Order deleted successfully']);

     return response()->json($orderId);
}




public function getholdorderDetails($order_id)
{

  
     $holdorder_id = HoldOrder::where('id', $order_id)->pluck('id');
    $product_ids = HoldOrderdetails::where('hold_id', $holdorder_id)->pluck('product_id');

     $products = Product::whereIn('id', $product_ids)->get();
     $holdproduct_details = HoldOrderdetails::with('product')->where('hold_id', $holdorder_id)->get();


    

    // return response()->json(['productDetails' => $productDetails, 'qty' => $qty, 'returnedqty' => $returnedqty]);
     return response()->json($holdproduct_details);

}





public function FinalInvoiceNew(Request $request){
    //   dd($request->all());
$customer_id=$request->customerid;
$totalqty=$request->totalqty;
$totalamount=$request->totalamountv;
$grandtotalamount=$request->grandtotalamountv;
$totaldiscount=$request->totaldiscountv;
$payamount=$request->payamountv;
$itemDetails = [
    'id' => $request->product_id,
    'qty' => $request->qty,
    'price' => $request->price,
];


$qtyCount = count($itemDetails['qty']);
$data = array();
$data['customer_id'] = $customer_id;
$data['order_date'] = date('d-F-Y');
$data['order_status'] = ($payamount==$grandtotalamount)?'completed':'pending';
$data['total_products'] = $qtyCount;
$data['sub_total'] = $totalamount;
$data['vat'] = $request->vat ?? 0;
$data['discount'] = $totaldiscount;

$data['invoice_no'] = 'inv'.mt_rand(10000000,99999999);
$data['total'] = $grandtotalamount;
$data['payment_status'] = ($payamount==$grandtotalamount)?'paid':'pending';
$data['pay'] =$payamount;
$data['due'] = $request->dueamountv;
$data['created_at'] = Carbon::now(); 
$data['user_id']= Auth::id();

$order_id = Order::insertGetId($data);


//for payment table entery
$paydata = array();
$paydata['order_id'] = $order_id;
$paydata['total'] = $request->grandtotalamount;
$paydata['remaining_due']=$request->dueamountv;

$paydata['total_paid'] = $request->payamount;
$paydata['user_id']= Auth::id();
$paydata['created_at'] = Carbon::now(); 

 OrderPayment::insert($paydata); 



foreach ($itemDetails['id'] as $index => $productId) {
    $saleDetail = new OrderDetails();
    $saleDetail->order_id = $order_id; // Assuming you have the order ID available
    $saleDetail->product_id = $productId;
    $saleDetail->quantity = $itemDetails['qty'][$index];
    $saleDetail->unitcost = $itemDetails['price'][$index];
    $saleDetail->total = $itemDetails['qty'][$index] * $itemDetails['price'][$index];
    $saleDetail->save();
   
}


  

$product = Orderdetails::where('order_id',$order_id)->get();
foreach($product as $item){
   Product::where('id',$item->product_id)
        ->update(['stock' => DB::raw('stock-'.$item->quantity) ]);
}
 // toast()->success('Invoice Generated Successfully ');
 
 $cust_id = $customer_id;
 $customer = Customer::where('id',$cust_id)->first();

 $order = Order::where('id',$order_id)->first();
 $contents=Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
 $totaldiscountv=$request->totaldiscountv;

 $invoiceView = View::make('invoice.thermal', compact('customer', 'contents','order','totaldiscountv'))->render();
 session(['invoiceView' => $invoiceView]);


 toast()->success('Invoice Generated Successfully ');

 return redirect()->route('pos');
} 





//     public function FinalInvoice(Request $request){


//         $rtotal = $request->total;
//         $rpay = $request->pay;
//         $mtotal = $rtotal - $rpay;

//             // dd($request->due);
//         $data = array();
//         $data['customer_id'] = $request->customer_id;
//         $data['order_date'] = $request->order_date;
//         $data['order_status'] = $request->order_status;
//         $data['total_products'] = $request->total_products;
//         $data['sub_total'] = $request->sub_total;
//         $data['vat'] = $request->vat;
//         $data['discount'] = $request->totaldiscountv;

//         $data['invoice_no'] = 'INV'.mt_rand(10000000,99999999);
//         $data['total'] = $request->total;
//         $data['payment_status'] = $request->payment_status;
//         $data['pay'] = $request->pay;
//         $data['due'] = $mtotal;
//         $data['created_at'] = Carbon::now(); 
//         $data['user_id']= Auth::id();

//         $order_id = Order::insertGetId($data);

// //for payment table entery
// $paydata = array();
// $paydata['order_id'] = $order_id;
// $paydata['total'] = $request->total;
// $paydata['remaining_due']=$mtotal;

// $paydata['total_paid'] = $request->pay;
// $paydata['user_id']= Auth::id();
// $paydata['created_at'] = Carbon::now(); 

//  OrderPayment::insert($paydata); 



//         $contents = Cart::content();

//         $pdata = array();
//         foreach($contents as $content){
//             $pdata['order_id'] = $order_id;
//             $pdata['product_id'] = $content->id;
//             $pdata['quantity'] = $content->qty;
//             $pdata['unitcost'] = $content->price;
//             $pdata['total'] = $content->total;

//             $insert = Orderdetails::insert($pdata); 

//         } // end foreach

//         // toast()->success('Invoice Generated Successfully ');

        
//         $product = Orderdetails::where('order_id',$order_id)->get();
//         foreach($product as $item){
//            Product::where('id',$item->product_id)
//                 ->update(['stock' => DB::raw('stock-'.$item->quantity) ]);
//         }


//         $cust_id = $request->customer_id;
//         $customer = Customer::where('id',$cust_id)->first();
       
//         $order = Order::where('id',$order_id)->first();
//         $totaldiscountv=$request->totaldiscountv;

//         $invoiceView = View::make('invoice.thermal', compact('customer', 'contents','order','totaldiscountv'))->render();
//         session(['invoiceView' => $invoiceView]);


//         Cart::destroy();
 
//         // $invoiceView = View::make('invoice.thermal', compact('order_id', 'contents'))->render();
//         return redirect()->route('pos');
// // return $this->invoiceprint();
//         // return redirect()->route('dashboard');

//     } 

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




   public function OrderInvoice($order_id)
   {
       $order = Order::where('id', $order_id)->first();
       $orderItem = Orderdetails::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
       $orderreturnids = OrderReturn::where('order_id', $order_id)->pluck('id');
       $orderreturn = OrderReturn::where('order_id',$order_id)->first();
   
       // Check if there are any return ids
       if ($orderreturnids->isNotEmpty()) {
           $orderreturnItem = OrderReturnDetails::with('product')->whereIn('return_id', $orderreturnids)->pluck('quantity_return');
       } else {
           // If there are no return items, assign an empty array to $orderreturnItem
           $orderreturnItem = [];
       }
   
       $pdf = Pdf::loadView('order.order_invoice', compact('order', 'orderItem', 'orderreturnItem','orderreturn'))->setPaper('a4')->setOption([
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


        public function OrderPaymentHistory($id){

            // $order = Order::findOrFail($id);

        $payhistory=OrderPayment::with('user')->where('order_id',$id)->get();
// $user=OrderPayment::wherewhere('order_id',$id)->pluck('user_id');

            return response()->json($payhistory);
    
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

            // for payment table
            $paydata = array();
            $paydata['order_id'] = $request->id;
            $paydata['total'] = $request->total;
            $paydata['total_paid'] = $request->due;
        $paydata['remaining_due']= $request->previousdue-$request->due;

            $paydata['user_id']= Auth::id();
            $paydata['created_at'] = Carbon::now(); 
            
             OrderPayment::insert($paydata); 
            






          
            toast()->success('Due Added Successfully ');
    
            // return redirect()->route('pending.due');
            return redirect()->back();

    
    
        }// End Method 


}
