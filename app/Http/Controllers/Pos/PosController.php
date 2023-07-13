<?php

namespace App\Http\Controllers\Pos;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;


use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;



class PosController extends Controller
{
    
    public function Pos(){
        // $product = Product::latest()->get();
$today=Carbon::now();
        // $product = Product::where('expire_date','>',$today)
        // ->whereNotNull('stock')
        // ->latest()->get();

        $product = Product::
        whereNotNull('stock')
        ->latest()->get();
        $customer = Customer::all();
        $category = Category::latest()->get();
        $brand = Brand::latest()->get();

       // return view('pos.pos_page',compact('product','customer','category','brand'));

                            //  pos_page1        
       return view('pos.pos_page1',compact('product','customer','category','brand'));


    }

    public function AddCart(Request $request)
{
    $itemDetails = [
        'id' => $request->id, 
        'name' => $request->name, 
        'qty' => $request->qty, 
        'price' => $request->price, 
        'weight' => 20, 
        'options' => ['size' => 'large']
    ];

    Cart::add($itemDetails);

    toast()->success('Product added to cart successfully');

    return redirect()->back();
}

public function AllItem(){

    $product_item = Cart::content();

    return view('pos.testcart',compact('product_item'));

}

public function CartUpdate(Request $request,$rowId){

    $qty = $request->qty;
    $discount=$request->discount;
    // dd($discount);
   
    $update = Cart::update($rowId,$qty);
    Cart::setDiscount($rowId,$discount );
  
    return redirect()->back();

}


    





public function CartRemove($rowId){

    Cart::remove($rowId);

    toast()->success('Product Removed from cart successfully');
    
    return redirect()->back();

} 
public function CreateInvoice(Request $request){

    $validator = Validator::make($request->all(), [

'customer'=>'required',
       ]);
       if (Cart::count() === 0) {
        $validator->after(function ($validator) {
            $validator->errors()->add('cart', 'The cart is empty select at least one Product.');
        });
    }
       if ($validator->fails()) {
           toast()->error('Wait.. something is missing...');

           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
             
       }


    $contents = Cart::content();
    $cust_id = $request->customer;
    $customer = Customer::where('id',$cust_id)->first();

        $invoiceView = View::make('invoice.thermal', compact('customer', 'contents'))->render();
        session(['invoiceView' => $invoiceView]);

    return view('invoice.product_invoice1',compact('contents','customer'));

}

public function invoiceprint()
{
    $invoiceView = session('invoiceView');

    return $invoiceView;
}

                //pos_page1 code

public function getProductDetails($productId)
{
    $product = Product::find($productId);

    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }

    // Prepare the product data to be sent in the response
    $productData = [
        'name' => $product->product_name,
        'price' => $product->selling_price,
        'qty' => 1, // Assuming a default quantity of 1 for simplicity
        'discount' => 0, // Assuming a default discount of 0 for simplicity
        'rowId' => $product->id, // Assuming the row ID is the product ID for simplicity
        'total' => $product->selling_price, // Assuming the total is the selling price for simplicity
    ];

    return response()->json($productData);
}




}
