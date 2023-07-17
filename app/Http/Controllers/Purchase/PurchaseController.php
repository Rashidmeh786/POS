<?php

namespace App\Http\Controllers\Purchase;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseDetail;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchaseController extends Controller
{


    public function searchproduct(Request $request)
    {
        $searchTerm = $request->input('term');

        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')->get();

        return response()->json($products);
    }

    public function productDetails($productId)
    {

     //   dd($productId);
        $product = Product::findOrFail($productId);

        // You can modify the product details based on your requirements
        $productDetails = [
            'name' => $product->product_name,
            'price' => $product->buying_price,
            'stock' => $product->stock ?? 0,
            'id'=>$product->id,
            'product_code'=>$product->product_code
        ];

        return response()->json($productDetails);
    }

    public function addpurchase()
    {
        $suppliers=Supplier::all();
        return view('purchase.add_purchase',compact('suppliers'));
    }



    public function createinvoice(Request $request){

        
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'supplier_id'=>'required',
            'del_status'=>'required',
            'qty'=>'required',
          
        ],
        [
            'qty.required' => 'At least one product is required.',
        ]);
    
    if ($validator->fails()) {
        toast()->error('Wait.. Something Mandatory is Missing ');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
          
    }
    $invoice_no = 'inv'.mt_rand(10000000,99999999);

    $supplier_id=$request->supplier_id;
    $totalamountv=$request->totalamountv;
    $taxv=$request->text;
    $discountv=$request->discount;
    $shhippingv=$request->shipping;
    $note=$request->note;
    $del_status=$request->del_status;
         
    $itemDetails = [
        'id' => $request->product_id, 
        'name' => $request->name, 
        'qty' => $request->qty, 
        'price' => $request->price, 
    ];

    session()->put('itemDetails', $itemDetails);
    //dd($itemDetails);
        return view('purchase.purchase_invoice', compact('itemDetails','supplier_id','invoice_no','totalamountv','taxv','discountv','shhippingv','note','del_status'));

    } 


    public function FinalInvoice(Request $request ){

      
        $refcode = IdGenerator::generate(['table' => 'purchase_orders','field' => 'ref_no','length' => 6, 'prefix' => 'ref' ]);

        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

            // dd($request->due);
        $data = array();
        $data['supplier_id'] = $request->supplier_id;
        $data['order_date'] = $request->delivery_date;
        $data['order_status'] = $request->del_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->tax;
        $data['discount'] = $request->discount;
        $data['shipping'] = $request->shipping;
        $data['ref_no'] =$refcode ;
        $data['note'] = $request->note;

        $data['invoice_no'] = 'INV'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now(); 

        $order_id = PurchaseOrder::insertGetId($data);
        // $contents = Cart::content();

        $itemDetails = session()->get('itemDetails');

      //  dd($itemDetails);
      foreach ($itemDetails['id'] as $index => $productId) {
        $purchaseDetail = new PurchaseDetail();
        $purchaseDetail->order_id = $order_id; // Assuming you have the order ID available
        $purchaseDetail->product_id = $productId;
        $purchaseDetail->quantity = $itemDetails['qty'][$index];
        $purchaseDetail->unitcost = $itemDetails['price'][$index];
        $purchaseDetail->total = $itemDetails['qty'][$index] * $itemDetails['price'][$index];
        $purchaseDetail->save();
        session()->forget('itemDetails');
    }
    

        toast()->success('Purchase  completed Successfully ..');
        return redirect()->route('all.purchase');

        // return redirect()->route('dashboard');

    } 

                public function  allpurchases()
                {
                    $allspurchases = PurchaseOrder::orderBy('id','DESC')->get();
                    return view('purchase.all_purchase',compact('allspurchases'));
                

                }
                public function PurchaseOrderDueAjax($id){

                    $order = PurchaseOrder::findOrFail($id);
                    return response()->json($order);
            
                }

                

                public function UpdateDue(Request $request){

                    $order_id = $request->id;
                    $due_amount = $request->due;
                    $pay_amount = $request->pay;
            
                    $allorder = PurchaseOrder::findOrFail($order_id);
                    $maindue = $allorder->due;
                    $maindpay = $allorder->pay;
            
                    $paid_due = $maindue - $due_amount;
                    $paid_pay = $maindpay + $due_amount;
            
                    PurchaseOrder::findOrFail($order_id)->update([
                        'due' => $paid_due,
                        'pay' => $paid_pay, 
                    ]);
            
                  
                    toast()->success('Due Added Successfully ');
            
                    // return redirect()->route('pending.due');
                    return redirect()->back();
            
                }


                public function PurchaseOrderDetails($order_id){

                    $order = PurchaseOrder::where('id',$order_id)->first();
            
                    $orderItem = PurchaseDetail::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
                    return view('purchase.purchaseorder_details',compact('order','orderItem'));
            
                }

                public function PurchaseOrderStatusUpdate(Request $request)
                {
                    $order_id = $request->id;
                    $products = PurchaseDetail::where('order_id', $order_id)->get();
                    
                    foreach ($products as $item) {
                        Product::where('id', $item->product_id)
                            ->update(['stock' => DB::raw('IFNULL(stock, 0) + ' . $item->quantity)]);
                    }
                
                    PurchaseOrder::findOrFail($order_id)->update(['order_status' => 'received']);
                
                    toast()->success('Purchase Completed Successfully');
                
                    return redirect()->route('all.purchase');
                }
                
                public function CompletePurchaseOrder(){

                    $orders = PurchaseOrder::where('order_status','received')->get();
                    return view('purchase.complete_purchase_order',compact('orders'));
            
                }


                public function OrderInvoice($order_id){

                    $order = PurchaseOrder::where('id',$order_id)->first();
            
                   $orderItem = PurchaseDetail::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
            
                   $pdf = Pdf::loadView('purchase.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                           'tempDir' => public_path(),
                           'chroot' => public_path(),
            
                   ]);
                 

                   $date = Carbon::now()->format('Y-m-d'); // Get the current date in the desired format
                   $fileName = 'invoice_' . $date . '.pdf';
               
                   return $pdf->download($fileName);
            
               }


               public function PendingPurchaseOrder(){

                $orders = PurchaseOrder::where('order_status','pending')->get();
                return view('purchase.pending_purchase_order',compact('orders'));
        
            }
               public function PurchaseReturn($id)

               {
                   // dd($id);
                   $order = PurchaseOrder::where('id',$id)->first();
            
                   $orderItem = PurchaseDetail::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();

                   return view('purchase.return_purchase',compact('order','orderItem'));
               }  

              


           


}
