<?php

namespace App\Http\Controllers\Product;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Haruncpi\LaravelIdGenerator\IdGenerator;
class ProductController extends Controller
{
    public function AllProduct(){

        $product = Product::latest()->get();
        return view('product.all_product',compact('product'));
    
       } 

       public function AddProduct(){

        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        $unit = Unit::latest()->get();
        $brand=Brand::latest()->get();
        return view('product.add_product',compact('category','supplier','unit','brand'));
       }// End Method 
    
       public function StoreProduct(Request $request){ 


        $pcode = IdGenerator::generate(['table' => 'products','field' => 'product_code','length' => 5, 'prefix' => 'Prc' ]);
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'category_id' => 'required|integer',
            'supplier_id' => '',
            // 'product_code' => 'required|unique:products',
         
           
            'product_image' => 'required',
            'brand' => 'nullable',
            'buying_date' => '',
            'expire_date' => '',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'purchase_unit' => '',
            'sale_unit' => '',
            'alertqty' => '',
            // 'sku' => 'required|unique:products',
            'wysiwyg-editor' => '',
       
        ]);

        
       if ($validator->fails()) {
        toast()->error('Wait.. the form have some errors');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
          
    }
    if ($request->file('product_image')) {
        $file = $request->file('product_image');
        // @unlink(public_path('upload/admin_image/'.$data->photo));
        // $filename = date('YmdHi').$file->getClientOriginalName();
        $filename =  time().'.'.$file->getClientOriginalName();
        $file->move(public_path('upload/product/'),$filename);
        // $data['product_image'] = $filename;
     }


    $product = new Product;
    $product->product_name = $request->input('product_name');
    $product->category_id = $request->input('category_id');
    $product->supplier_id = $request->input('supplier_id');
    $product->product_code =  $pcode;
    // $product->product_garage = $request->input('product_garage');
    // $product->product_store = $request->input('product_store');
    
    $product->brand_id = $request->input('brand');
    $product->buying_date = $request->input('buying_date');
    $product->expire_date = $request->input('expire_date');
    $product->buying_price = $request->input('buying_price');
    $product->selling_price = $request->input('selling_price');
    $product->purchase_unit_id = $request->input('purchase_unit');
    $product->sale_unit_id = $request->input('sale_unit');
    // $product->stock = $request->input('stock');
    $product->alertqty = $request->input('alertqty');
    // $product->sku = $request->input('sku');
    $product->description = $request->input('wysiwyg-editor');
    $product->product_image = $filename;
       
    $product->save();
    
    
        toast()->success('Cool.. Product added Successfully');
        // Redirect back with success message
        return redirect()->route('all.product');
   



       }
       public function EditProduct($id){
        $product = Product::findOrFail($id);
        $category = Category::latest()->get();
        $supplier = Supplier::latest()->get();
        $brand = Brand::latest()->get();
        $unit = Unit::latest()->get();
        return view('.product.edit_product',compact('product','category','supplier','unit','brand'));

    }


    public function UdateProduct(Request $request){

        $product_id = $request->id;

        
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'category_id' => 'required|integer',
            'supplier_id' => '',
            // 'product_code' => 'required|unique:products,product_code,'.$product_id,
            'brand' => 'nullable',
            'buying_date' => '',
            'expire_date' => '',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'purchase_unit' => '',
            'sale_unit' => '',
            'alertqty' => '',
            // 'sku' => 'required|unique:products,sku,'.$product_id,
            'wysiwyg-editor' => '',
        ]);
        
        
       if ($validator->fails()) {
        toast()->error('Wait.. the form have some errors');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
          
    }

    if ($request->file('product_image')) {
        $file = $request->file('product_image');
        // @unlink(public_path('upload/admin_image/'.$data->photo));
        // $filename = date('YmdHi').$file->getClientOriginalName();
        $filename =  time().'.'.$file->getClientOriginalName();
        $file->move(public_path('upload/product/'),$filename);
        // $data['product_image'] = $filename;
   

      

       
        Product::findOrFail($product_id)->update([

            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            // 'product_code' => $request->product_code,
            'brand_id' => $request->brand,
            'description' => $request-> description,
            //  'sku'=>$request->sku,
             'alertqty'=>$request->alertqty,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $filename,
            'purchase_unit_id'=>$request->purchase_unit,
            'sale_unit_id'=>$request->sale_unit,
           

        ]);

        toast()->info('Cool.. Product Updated Successfully');
       

        return redirect()->route('all.product'); 

        } else{
           
            Product::findOrFail($product_id)->update([

                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                // 'product_code' => $request->product_code,
                'brand_id' => $request->brand,
                'description' => $request-> description,
          
                //  'sku'=>$request->sku,
                 'alertqty'=>$request->alertqty,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'purchase_unit_id'=>$request->purchase_unit,
                'sale_unit_id'=>$request->sale_unit,           
         
        ]);

        toast()->info('Cool.. Product Updated Successfully');
       
        return redirect()->route('all.product');

        } // End else Condition  


    } // End Method 

 public function DeleteProduct($id){

        // $product_img = Product::findOrFail($id);
        // $img = $product_img->product_image;
        // unlink($img);

        Product::findOrFail($id)->delete();
        toast()->info('Cool.. Product Updated Successfully');


        return redirect()->back();

    } // End Method 


    public function BarcodeProduct($id){

        $product = Product::findOrFail($id);
        return view('product.barcode_product',compact('product'));

    }


    public function Storecategoryajax(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        // Create a new category instance
        $category = new Category;
        $category->name = $validatedData['name'];
        // Add any other necessary properties

        // Save the category
        $category->save();

        // Retrieve all categories (or you can modify this based on your needs)
        $categories = Category::all();

        // Prepare the response data
        $response = [
            'categories' => $categories,
            'selectedCategoryId' => $category->id,
        ];

        // Return the response as JSON
        return response()->json($response);
    }


    public function Storebrandajax(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:255',
        ]);

        // Create a new category instance
        $brand = new brand;
        $brand->name = $validatedData['name'];
        // Add any other necessary properties

        // Save the category
        $brand->save();

        // Retrieve all categories (or you can modify this based on your needs)
        $brands = brand::all();

        // Prepare the response data
        $response = [
            'brands' => $brands,
            'selectedBrandId' => $brand->id,
        ];

        // Return the response as JSON
        return response()->json($response);
    }

    public function Storeunitajax(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|unique:units|max:255',
        ]);

        // Create a new category instance
        $unit = new unit;
        $unit->name = $validatedData['name'];
        // Add any other necessary properties

        // Save the category
        $unit->save();

        // Retrieve all categories (or you can modify this based on your needs)
        $units = unit::all();

        // Prepare the response data
        $response = [
            'units' => $units,
            'selectedUnitId' => $unit->id,
        ];

        // Return the response as JSON
        return response()->json($response);
    }










}
