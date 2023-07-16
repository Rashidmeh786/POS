<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       
        return redirect('/login');
    }


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
            return view ('admin.AdminProfileView',compact('adminData'));
    }

   
    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/admin_image/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_image'),$filename);
           $data['photo'] = $filename;
        }

        $data->save();
        toast()->success('Record Updated successfully');
        // return redirect()->back();
        // $notification = array(
        //     'message' => 'Admin Profile Updated Successfully',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);
        return redirect()->back();


    }// End Method 


  public function changePassword()  {

    $id = Auth::user()->id;
    $adminData = User::find($id);
      

    return view('admin.ChangePassword',compact('adminData'));
  }

  public function UpdatePassword(Request $request){


    // dd($request);
    /// Validation 
    $request->validate([
        'old_password' => 'required',
        'new_password' => 'required|confirmed',

    ]);

    /// Match The Old Password 
    if (!Hash::check($request->old_password, auth::user()->password)) {

        toast()->success('old pasword is wrong');
        
        return  redirect()->back();

    }

    //// Update The New Password 

    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);

    toast()->success('Password Changed Successfully');
        
    return  redirect()->back();

}// End Method 


public function Allusers(){

    
    $alladminuser = User::latest()->get();
    return view('admin.all_users',compact('alladminuser'));
}// End Method 

public function AddUser(){

    $roles = Role::all();
    return view('admin.add_user',compact('roles'));
}// End Method 



public function StoreUser(Request $request){

    $validator = Validator::make($request->all(), [
        'name' => 'required|max:200',
        'email' => 'required|unique:users|max:200',
        'phone' => 'required|max:200',
        'password' => 'required|max:400',
        
    ]);

    if ($validator->fails()) {
        toast()->error('Wait.. Fill all mandatory fields heaving *');
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }




    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->password = Hash::make($request->password);
    $user->save();

    if ($request->roles) {
        $user->assignRole($request->roles);
    }

    toast()->success('User Added Successfully');
    return redirect()->route('all.users');



}// End Method 


public function Edituser($id){

    $roles = Role::all();
    $adminuser = User::findOrFail($id);
    return view('admin.edit_user',compact('roles','adminuser'));

}// End Method 


public function UpdateUser(Request $request){

    $admin_id = $request->id;

    $validator = Validator::make($request->all(), [


        'name' => 'required|max:200',
        'email' => 'required|email|unique:users,email,'.$admin_id,
        'phone' => 'required|max:200',
        
       ]);
       
       if ($validator->fails()) {
           toast()->error('Wait.. Fill all mandatory fields heaving *');

           return redirect()->back()
               ->withErrors($validator)
               ->withInput();
             
       }


    $user = User::findOrFail($admin_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone; 
    $user->save();

    $user->roles()->detach();
    if ($request->roles) {
        $user->assignRole($request->roles);
    }
    toast()->success('User Updated Successfully');
    return redirect()->route('all.users');


}// End Method 

public function Deleteuser($id){

    $user = User::findOrFail($id);
    if (!is_null($user)) {
        $user->delete();
    }

    toast()->success('User Deleted Successfully');
    return redirect()->back();
   
}// End Method 



}


