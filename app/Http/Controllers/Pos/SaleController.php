<?php

namespace App\Http\Controllers\Pos;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\OrderReturn;
use App\Models\OrderDetails;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\OrderReturnDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class SaleController extends Controller
{
    


    public function searchproduct(Request $request)
    {
        $searchTerm = $request->input('term');
    
        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')
            ->where('stock', '>', 0)
            ->whereNotNull('stock')
            ->latest()
            ->get();
    
        return response()->json($products);
    }
    
    public function productDetails($productId)
    {

     //   dd($productId);
        $product = Product::findOrFail($productId);

        // You can modify the product details based on your requirements
        $productDetails = [
            'name' => $product->product_name,
            'price' => $product->selling_price,
            'stock' => $product->stock ?? 0,
            'id'=>$product->id,
            'product_code'=>$product->product_code
        ];

        return response()->json($productDetails);
    }

    public function addsale()
    {
        $customers=Customer::all();
        return view('order.add_sale',compact('customers'));
    }



    public function createinvoice(Request $request){

        
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'customer_id' => 'required',
            'del_status' => 'required',
            'qty' => 'required',
        ], [
            'qty.required' => 'At least one product is required.',
            'customer_id.required' => 'Customer field is required.',
        ]);
        
        if ($validator->fails()) {
            toast()->error('Wait.. Something Mandatory is Missing');
        
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
    $invoice_no = 'inv'.mt_rand(10000000,99999999);

    $customer_id=$request->customer_id;
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

    session()->put('itemsaleDetails', $itemDetails);
    //dd($itemDetails);
        return view('order.sale_invoice', compact('itemDetails','customer_id','invoice_no','totalamountv','taxv','discountv','shhippingv','note','del_status'));

    } 


    public function FinalInvoice(Request $request ){

      
        // $refcode = IdGenerator::generate(['table' => 'purchase_orders','field' => 'ref_no','length' => 6, 'prefix' => 'ref' ]);

        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

            // dd($request->due);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->delivery_date;
        $data['order_status'] = $request->del_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        // $data['vat'] = $request->tax;
        $data['vat'] = $request->tax ?? 0;

        $data['note'] = $request->note;

        $data['discount'] = $request->discount ?? 0;
        $data['shipping'] = $request->shipping ?? 0;
        // $data['ref_no'] =$refcode ;
        $data['user_id']= Auth::id();
        $data['invoice_no'] = 'INV'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now(); 

        $order_id = Order::insertGetId($data);


        // for payment table 


        $paydata = array();
        $paydata['order_id'] = $order_id;
        $paydata['total'] = $request->total;
        $paydata['total_paid'] = $request->pay;
        $paydata['remaining_due']=$mtotal;

        $paydata['user_id']= Auth::id();
        $paydata['created_at'] = Carbon::now(); 
        
         OrderPayment::insert($paydata); 
        




        
        $itemDetails = session()->get('itemsaleDetails');

      //  dd($itemDetails);
      foreach ($itemDetails['id'] as $index => $productId) {
        $saleDetail = new OrderDetails();
        $saleDetail->order_id = $order_id; // Assuming you have the order ID available
        $saleDetail->product_id = $productId;
        $saleDetail->quantity = $itemDetails['qty'][$index];
        $saleDetail->unitcost = $itemDetails['price'][$index];
        $saleDetail->total = $itemDetails['qty'][$index] * $itemDetails['price'][$index];
        $saleDetail->save();
        session()->forget('itemsaleDetails');
    }
    
    $product = Orderdetails::where('order_id',$order_id)->get();
    foreach($product as $item){
       Product::where('id',$item->product_id)
            ->update(['stock' => DB::raw('stock-'.$item->quantity) ]);
    }

        toast()->success('Sale  completed Successfully ..');
        return redirect()->route('all.sales');

        // return redirect()->route('dashboard');

    } 




    public function Orderreceipt($order_id)
    {
 

     $order = Order::where('id',$order_id)->first();
     $customer_id= $order->customer_id;
     $customer = Customer::findOrFail($customer_id);
        $productdetails=Orderdetails::where('order_id',$order_id)->get();
  //   dd( $productdetails);

     return view('invoice.thermalreceipt', compact('order', 'customer', 'productdetails'));
    }



    public function saleReturn($id)

    {
        // dd($id);
        $order = Order::where('id',$id)->first();
 
        $orderItem = Orderdetails::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();

        return view('order.return_sale',compact('order','orderItem'));
    }  

    public function searchsaleproduct(Request $request)
    {
     //  $product_id=[];
        $searchTerm = $request->input('term');
       $invoice_id=$request->input('invoice_id');
      $order_id=Order::where('invoice_no',$invoice_id)->pluck('id');
      $product_id=Orderdetails::where('order_id',$order_id)->pluck('product_id');

        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')
            ->where('stock', '>', 0)
           // ->where('id','=',$product_id)
           ->wherein('id',$product_id)

            // ->whereNotNull('stock')
            ->latest()
            ->get();

    
     return response()->json($products);
      //  return response()->json($product_id);

    }

    public function productreturnDetails( $productId,$invoice_id)
    {

      //  dd($productId);
        $product = Product::findOrFail($productId);
        
        $order_id=Order::where('invoice_no',$invoice_id)->pluck('id');
        $order=Order::where('invoice_no',$invoice_id)->first();

    
$qty = Orderdetails::with('product')
->where('order_id',$order_id)
->where('product_id',$productId)
->orderBy('id','DESC')->pluck('quantity');

        $productDetails = [
            'name' => $product->product_name,
            'price' => $product->selling_price,
            'stock' => $product->stock ?? 0,
            'id'=>$product->id,
            'product_code'=>$product->product_code
        ];

      // return response()->json(['productDetails'=>$productDetails]);
       return response()->json(['productDetails'=>$productDetails,'qty'=>$qty,'order'=>$order]);
     
    }

    public function createreturn(Request $request){

        
        $validator = Validator::make($request->all(), [
        
            'qty' => 'required',
        ], [
            'qty.required' => 'At least one product is required.',
        
        ]);
        
        if ($validator->fails()) {
            toast()->error('Wait.. Something Mandatory is Missing');
        
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $itemDetails = [
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'totalqty'=>$request->totalqty
        ];
        $qtyCount = count($itemDetails['qty']);
        
  
    $data = array();
    $data['customer_id'] = $request->customer_id;
    $data['order_id'] = $request->order_id;
    
    $data['order_date'] = $request->date;
    // $data['order_status'] = 'pending';
     $data['total_products'] = $qtyCount;
    $data['sub_total'] = $request->totalamountv;
    $data['vat'] = $request->tax;
    $data['note'] = $request->note;

    $data['discount'] = $request->discount;
    $data['shipping'] = $request->shipping;
    // $data['ref_no'] =$refcode ;
    $data['user_id']= Auth::id();
    $data['invoice_no'] = 'INVR'.mt_rand(10000000,99999999);
    $data['total'] = $request->gtotal;
    // $data['payment_status'] = $request->payment_status;
    // $data['pay'] = $request->pay;
    // $data['due'] = $mtotal;
    $data['created_at'] = Carbon::now(); 
   
    $order_id = OrderReturn::insertGetId($data);
 
    
       
        // Loop through each product and save it to OrderReturnDetails
        foreach ($itemDetails['id'] as $index => $product_id) {
            $saleReturn = new OrderReturnDetails();
            $saleReturn->return_id = $order_id;
            $saleReturn->product_id = $product_id;
            $saleReturn->quantity = $itemDetails['totalqty'][$index];

            $saleReturn->quantity_return = $itemDetails['qty'][$index];
            $saleReturn->unitcost = $itemDetails['price'][$index];
            $saleReturn->total = $itemDetails['qty'][$index] * $itemDetails['price'][$index];
            $saleReturn->save();
        }
    
      
      
    $product = OrderReturnDetails::where('return_id',$order_id)->get();
    foreach($product as $item){
       Product::where('id',$item->product_id)
            ->update(['stock' => DB::raw('stock+'.$item->quantity_return) ]);
    }

  
    toast()->success('Sale  Returned Successfully ..');
    return redirect()->route('all.sales');

    
    } 


    public function UpdatesaleReturn($order_id)
    {
        $OrderReturn=OrderReturn::where('order_id',$order_id)->first();

        $OrderReturnDetails = OrderReturnDetails::with('product')->where('return_id',$OrderReturn->id)->orderBy('id','DESC')->get();
            $order=order::findorfail($order_id);

       // dd($OrderReturnDetails);
        return view('order.update_return_sale',compact('OrderReturn','OrderReturnDetails','order'));
    }


    public function UpdateSearchSaleProduct(Request $request)
    {
     //  $product_id=[];
        $searchTerm = $request->input('term');
       //$invoice_id=$request->input('invoice_id');
       $saleorder_id=$request->input('order_id');
    //   $order_id=Order::where('id',$saleorder_id)->pluck('id');
      $product_id=Orderdetails::where('order_id',$saleorder_id)->pluck('product_id');




        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')
            ->where('stock', '>', 0)
           // ->where('id','=',$product_id)
           ->wherein('id',$product_id)

            // ->whereNotNull('stock')
            ->latest()
            ->get();

    
     return response()->json($products);
      // return response()->json($product_id);

    }
    public function updateproductreturnDetails( $productId,$saleorder_id)
    {

      //  dd($productId);
        $product = Product::findOrFail($productId);
        
        $order_id=OrderReturn::where('order_id',$saleorder_id)->pluck('id');
        
        // $order=Order::where('id',$saleorder_id)->pluck('invoice_no');

    
$qty = Orderdetails::with('product')
->where('order_id',$saleorder_id)
->where('product_id',$productId)
->orderBy('id','DESC')->pluck('quantity');

$returnedqty = OrderReturnDetails::with('product')
->where('return_id',$order_id)
->where('product_id',$productId)
->orderBy('id','DESC')->pluck('quantity_return');


        $productDetails = [
            'name' => $product->product_name,
            'price' => $product->selling_price,
            'stock' => $product->stock ?? 0,
            'id'=>$product->id,
            'product_code'=>$product->product_code
        ];

      // return response()->json(['productDetails'=>$productDetails]);
       return response()->json(['productDetails'=>$productDetails,'qty'=>$qty,'returnedqty'=>$returnedqty]);
     
    }


    public function getproductreturnDetails($order_id)
{
    $return_id = OrderReturn::where('order_id', $order_id)->pluck('id');
    $product_ids = OrderReturnDetails::where('return_id', $return_id)->pluck('product_id');

    $products = Product::whereIn('id', $product_ids)->get();

    $productDetails = [];
    foreach ($products as $product) {
        $productDetails[] = [
            'name' => $product->product_name,
            'price' => $product->selling_price,
            'stock' => $product->stock ?? 0,
            'id' => $product->id,
            'product_code' => $product->product_code
        ];
    }

    $qty = OrderReturndetails::with('product')
        ->where('return_id', $return_id)
        ->whereIn('product_id', $product_ids)
        ->orderBy('id', 'DESC')
        ->pluck('quantity');

    $returnedqty = OrderReturnDetails::with('product')
        ->where('return_id', $return_id)
        ->whereIn('product_id', $product_ids)
        ->orderBy('id', 'DESC')
        ->pluck('quantity_return');

    return response()->json(['productDetails' => $productDetails, 'qty' => $qty, 'returnedqty' => $returnedqty]);
}







        
    public function updatereturn(Request $request){

        


        $validator = Validator::make($request->all(), [
        
            'qty' => 'required',
        ], [
            'qty.required' => 'At least one product is required.',
        
        ]);
        
        if ($validator->fails()) {
            toast()->error('Wait.. Something Mandatory is Missing');
        
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


$return_id=OrderReturn::where('order_id',$request->order_id)->pluck('id');
        $product = OrderReturnDetails::where('return_id',$return_id)->get();
        foreach($product as $item){
           Product::where('id',$item->product_id)
                ->update(['stock' => DB::raw('stock-'.$item->quantity_return) ]);
        }

        OrderReturn::where('order_id',$request->order_id)->delete();


        $itemDetails = [
            'id' => $request->product_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'totalqty'=>$request->totalqty
        ];
        $qtyCount = count($itemDetails['qty']);
        
  
    $data = array();
    $data['customer_id'] = $request->customer_id;
    $data['order_id'] = $request->order_id;
    
    $data['order_date'] = $request->date;
    // $data['order_status'] = 'pending';
     $data['total_products'] = $qtyCount;
    $data['sub_total'] = $request->totalamountv;
    $data['vat'] = $request->tax;
    $data['note'] = $request->note;

    $data['discount'] = $request->discount;
    $data['shipping'] = $request->shipping;
    // $data['ref_no'] =$refcode ;
    $data['user_id']= Auth::id();
    $data['invoice_no'] = 'INVR'.mt_rand(10000000,99999999);
    $data['total'] = $request->gtotal;
    // $data['payment_status'] = $request->payment_status;
    // $data['pay'] = $request->pay;
    // $data['due'] = $mtotal;
    $data['created_at'] = Carbon::now(); 
   
    $order_id = OrderReturn::insertGetId($data);
 
    
       
        // Loop through each product and save it to OrderReturnDetails
        foreach ($itemDetails['id'] as $index => $product_id) {
            $saleReturn = new OrderReturnDetails();
            $saleReturn->return_id = $order_id;
            $saleReturn->product_id = $product_id;
            $saleReturn->quantity = $itemDetails['totalqty'][$index];

            $saleReturn->quantity_return = $itemDetails['qty'][$index];
            $saleReturn->unitcost = $itemDetails['price'][$index];
            $saleReturn->total = $itemDetails['qty'][$index] * $itemDetails['price'][$index];
            $saleReturn->save();
        }
    
      
      
    $product = OrderReturnDetails::where('return_id',$order_id)->get();
    foreach($product as $item){
       Product::where('id',$item->product_id)
            ->update(['stock' => DB::raw('stock+'.$item->quantity_return) ]);
    }

  
    toast()->success('Sale  Returned Successfully ..');
    return redirect()->route('all.sales');

    
    } 




}
