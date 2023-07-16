<?php

namespace App\Http\Controllers\Pos;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
            'price' => $product->buying_price,
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
        $data['vat'] = $request->tax;
        $data['note'] = $request->note;

        $data['discount'] = $request->discount;
        $data['shipping'] = $request->shipping;
        // $data['ref_no'] =$refcode ;

        $data['invoice_no'] = 'INV'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now(); 

        $order_id = Order::insertGetId($data);
        
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

}
