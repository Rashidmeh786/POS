<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function AllCustomer(){

        $customer = Customer::latest()->get();
        return view('customer.all_customer',compact('customer'));
    } 

    public function AddCustomer(){
        return view('customer.add_customer');
   }

   public function StoreCustomer(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name' => 'required|max:200',
           'email' => 'required|unique:customers|max:200',
           'phone' => 'required|max:200',
           'address' => 'required|max:400',
           'shopname' => 'required|max:200',
           'city' => 'required',
           'cnic' => [
               'required',
               'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
               Rule::unique('customers', 'cnic') // Optional: Add unique rule if CNIC should be unique
           ],
       ]);
   
       if ($validator->fails()) {
           toast()->error('Wait.. Fill all mandatory fields heaving *');
           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
       }
   
       $filename = null; // Initialize $filename with a default value
   
       if ($request->file('image')) {
           $file = $request->file('image');
           $filename = time().'.'.$file->getClientOriginalName();
           $file->move(public_path('upload/customer/'), $filename);
       }
   
       $customer = new Customer;
       $customer->name = $request->input('name');
       $customer->cnic = $request->input('cnic');
       $customer->email = $request->input('email');
       $customer->phone = $request->input('phone');
       $customer->address = $request->input('address');
       $customer->city = $request->input('city');
       $customer->shopname = $request->input('shopname');
       $customer->account_holder = $request->input('account_holder');
       $customer->account_number = $request->input('account_number');
       $customer->bank_name = $request->input('bank_name');
       $customer->bank_branch = $request->input('bank_branch');
       $customer->image = $filename;
       $customer->save();
   
       toast()->success('Cool.. Customer added Successfully');
       return redirect()->route('all.customer');
   }
   
 

   public function StoreNewCustomer(Request $request)
   {
       // Validate the form data
       $validatedData = $request->validate([
           'name' => 'required',
           'phone' => 'required',
           'address' => 'required'
           // Add validation rules for other fields
       ]);
   
       $customer = new Customer;
       $customer->name = $validatedData['name'];
       $customer->phone = $validatedData['phone'];
       $customer->address = $validatedData['address'];
       $customer->save();
   
       // Alert success message
    //    toast()->success('Cool.. Customer added Successfully');
       
       return response()->json(['message' => 'Customer created successfully', 'customers' => $customer]);
   }
   






   public function EditCustomer($id){

    $customer = Customer::findOrFail($id);
    return view('customer.edit_customer',compact('customer'));

} 

public function UpdateCustomer(Request $request){

    $customer_id = $request->id;


    $validator = Validator::make($request->all(), [


        'name' => 'required|max:200',
        'email' => 'required|email|unique:customers,email,'.$customer_id,
        'phone' => 'required|max:200',
        'address' => 'required|max:400',
        'shopname' => 'required|max:200',
        // 'account_holder' => 'required|max:200', 
        // 'account_number' => 'required', 
       
           'city' => 'required',
         
           'cnic' => [
               'required',
               'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
               Rule::unique('customers', 'cnic')->ignore($customer_id),
           ],
       ]);
       
       if ($validator->fails()) {
           toast()->error('Wait.. Fill all mandatory fields heaving *');

           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
             
       }


    
    if ($request->file('image')) {

        $file = $request->file('image');
        // @unlink(public_path('upload/admin_image/'.$employee->image));
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/employee/'),$filename);
    Customer::findOrFail($customer_id)->update([

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
      

    ]);

     
    toast()->success('Cool.. Customer Updated Successfully');

    return redirect()->route('all.customer'); 

    } else{

        Customer::findOrFail($customer_id)->update([

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

    ]);

    toast()->success('Cool.. Customer Updated Successfully');
     

    return redirect()->route('all.customer'); 

    } // End else Condition  

    
} // End Method 

public function DeleteCustomer($id){

    // $customer_img = Customer::findOrFail($id);
    // $img = $customer_img->image;
    // unlink($img);

    Customer::findOrFail($id)->delete();
    toast()->error('Cool.. Customer Deleted Successfully');

    

    return redirect()->back(); 

}

public function DetailsCustomer($id){

    $customer = Customer::findOrFail($id);
    $allsale = Order::where('customer_id',$id)->orderBy('id','DESC')->get();
    return view('customer.details_customer',compact('customer','allsale'));

}






}
