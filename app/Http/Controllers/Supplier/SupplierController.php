<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function AllSupplier(){

        $supplier = Supplier::latest()->get();
        return view('supplier.all_supplier',compact('supplier'));

    } // End Method 



    public function AddSupplier(){
        return view('supplier.add_supplier');
   }



   public function StoreSupplier(Request $request)
   {
      

       $validator = Validator::make($request->all(), [


        'name' => 'required|max:200',
        'email' => 'required|unique:suppliers|max:200',
        'phone' => 'required|max:200',
        'address' => 'required|max:400',
        'shopname' => 'required|max:200',
        'type' => 'required',
        // 'account_holder' => 'required|max:200', 
        // 'account_number' => 'required', 
        'image' => 'required',  
           'city' => 'required',
         
           'cnic' => [
               'required',
               'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
               Rule::unique('suppliers', 'cnic') // Optional: Add unique rule if CNIC should be unique
           ],
       ]);
       
       if ($validator->fails()) {
           toast()->error('Oops,Someting wrong in form');

           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
             
       }

       if ($request->file('image')) {
           $file = $request->file('image');
           // @unlink(public_path('upload/admin_image/'.$data->photo));
           // $filename = date('YmdHi').$file->getClientOriginalName();
           $filename =  time().'.'.$file->getClientOriginalName();
           $file->move(public_path('upload/supplier/'),$filename);
           $data['image'] = $filename;
        }
       // $image = $request->file('image');
       // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       // Image::make($image)->resize(300,300)->save('upload/employee/'.$name_gen);
       // $save_url = 'upload/employee/'.$name_gen;
       $supplier = new Supplier;
       $supplier->name = $request->input('name');
       $supplier->cnic = $request->input('cnic');
       $supplier->email = $request->input('email');
       $supplier->phone = $request->input('phone'); 
       $supplier->address = $request->input('address');
       $supplier->city = $request->input('city');
       $supplier->shopname = $request->input('shopname');
       $supplier->type = $request->input('type');

       $supplier->account_holder = $request->input('account_holder');
       $supplier->account_number = $request->input('account_number');
       $supplier->bank_name = $request->input('bank_name');
       $supplier->bank_branch = $request->input('bank_branch');
       
       $supplier->image = $filename;
       
       $supplier->save();
       
       
           toast()->success('Cool.. supplier added Successfully');
           // Redirect back with success message
           return redirect()->route('all.supplier');
   
   }
   public function EditSupplier($id){

    $supplier = Supplier::findOrFail($id);
    return view('supplier.edit_supplier',compact('supplier'));

}


public function UpdateSupplier(Request $request){

    $supplier_id = $request->id;


    $validator = Validator::make($request->all(), [


        'name' => 'required|max:200',
        'email' => 'required|email|unique:suppliers,email,'.$supplier_id,
        'phone' => 'required|max:200',
        'address' => 'required|max:400',
        'shopname' => 'required|max:200',
        // 'account_holder' => 'required|max:200', 
        // 'account_number' => 'required', 
       'type'=>'required',
           'city' => 'required',
         
           'cnic' => [
               'required',
               'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
               Rule::unique('suppliers', 'cnic')->ignore($supplier_id),
           ],
       ]);
       
       if ($validator->fails()) {
           toast()->warning('Wait.. Something wrong in form plz check again');

           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
             
       }


    
    if ($request->file('image')) {

        $file = $request->file('image');
        // @unlink(public_path('upload/admin_image/'.$employee->image));
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/supplier/'),$filename);
    Supplier::findOrFail($supplier_id)->update([

        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city,
        'cnic'=>$request->cnic,
        'image' => $filename,
        'type'=>$request->type,
      

    ]);

     
    toast()->info('Cool.. Supplier Updated Successfully');

    return redirect()->route('all.supplier'); 

    } else{

        Supplier::findOrFail($supplier_id)->update([

        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'shopname' => $request->shopname,
        'account_holder' => $request->account_holder,
        'account_number' => $request->account_number,
        'bank_name' => $request->bank_name,
        'bank_branch' => $request->bank_branch,
        'city' => $request->city, 
        'cnic'=>$request->cnic,
        'type'=>$request->type,
    ]);

    toast()->success('Cool.. Supplier Updated Successfully');
     

    return redirect()->route('all.supplier'); 

    } // End else Condition  

    
} // End Method 

public function DeleteSupplier($id){

    // $customer_img = Customer::findOrFail($id);
    // $img = $customer_img->image;
    // unlink($img);

    Supplier::findOrFail($id)->delete();
    toast()->warning('Cool.. Supplier Deleted Successfully');

    

    return redirect()->back(); 

}
public function DetailsSupplier($id){
    $allspurchases = PurchaseOrder::where('supplier_id',$id)->orderBy('id','DESC')->get();

    $supplier = Supplier::findOrFail($id);
    return view('supplier.details_supplier',compact('supplier','allspurchases'));

}




}
