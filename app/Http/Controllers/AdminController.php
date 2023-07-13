<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

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





}
