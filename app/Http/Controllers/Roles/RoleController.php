<?php

namespace App\Http\Controllers\Roles;

use App\Models\User;
// use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
// use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('RolesAndPerms.permission.all_permission',compact('permissions'));

    }

    public function AddPermission(){

        return view('RolesAndPerms.permission.add_permission');

    }
    public function StorePermission(Request $request){
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
        ]);
        $role = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        toast()->success('Cool.. New Permission Created Successfully');
       

        return redirect()->route('all.permission');

    }

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view('RolesAndPerms.permission.edit_permission',compact('permission'));

    }// End Method 


    public function UpdatePermission(Request $request){

        $per_id = $request->id;
        $request->validate([
            'name' => 'required',
            'group_name' => 'required',
        ]);

        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        toast()->success('Cool.. Permission Updated Successfully');
       

        return redirect()->route('all.permission');
    }// End Method 


    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        toast()->warning('Permission Deleted  Successfully');


        return redirect()->back();

    }// End Method 


    public function AllRoles(){

        $roles = Role::all();
       return view('RolesAndPerms.role.all_role',compact('roles'));

   }

//    public function AddRoles(){

//     return view('backend.pages.roles.add_roles');

// }// End Method 


 public function StoreRoles(Request $request){

    $request->validate([
        'name' => 'required',
        
    ]);
    $role = Role::create([
        'name' => $request->name, 

    ]);

    
    toast()->success('Cool.. New Role Created Successfully');
       

    return redirect()->route('all.roles');

}// End Method 

public function EditRoles($id){

    $role = Role::findOrFail($id);
$roles=Role::latest()->get();
    return view('RolesAndPerms.role.update_roles',compact('role','roles'));

}// End Method 

 public function UpdateRoles(Request $request){

    $role_id = $request->id;

    Role::findOrFail($role_id)->update([
        'name' => $request->name, 

    ]);

    toast()->info('Role Updated Successfully');

    return redirect()->back();

}// End Method 


 public function DeleteRoles($id){

    Role::findOrFail($id)->delete();

    toast()->info('Role Deleted Successfully');

    return redirect()->back();

}// End Method 


public function AddRolesPermission(){

    $roles = Role::all();
    $permissions = Permission::all();
    $permission_groups = User::getpermissionGroups();
    return view('RolesAndPerms.role.add_roles_permission',compact('roles','permissions','permission_groups'));

}

public function StoreRolesPermission(Request $request){


    $validator = Validator::make($request->all(), [
        'permission' => 'required|array',
        'role_id' => 'required',
    ]);
    
    if ($validator->fails()) {
        toast()->error('No Permissions assigned to Any Role ');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
          
    }


    $data = array();
    $permissions = $request->permission;

    foreach($permissions as $key => $item){
       $data['role_id'] = $request->role_id;
       $data['permission_id'] = $item;

       DB::table('role_has_permissions')->insert($data);

    }

    toast()->info('Permission assigned to Role  Successfully');
    return redirect()->route('all.roles.permission');


}// End Method 
public function AllRolesPermission(){

    // $roles = Role::all();
    // return view('RolesAndPerms.role.all_roles_permission',compact('roles'));

    $roles = Role::paginate(7); // Assuming 10 roles per page, you can adjust this value as per your requirement
return view('RolesAndPerms.role.all_roles_permission', compact('roles'));


}

public function AdminEditRoles($id){

    $role = Role::findOrFail($id);
    $permissions = Permission::all();
    $permission_groups = User::getpermissionGroups();
    return view('RolesAndPerms.role.edit_roles_permission',compact('role','permissions','permission_groups')); 

} // End Method 



public function RolePermissionUpdate(Request $request,$id){

    $role = Role::findOrFail($id);
    $permissions = $request->permission;

    if (!empty($permissions)) {
        $role->syncPermissions($permissions);
    }

    toast()->info('Permission assigned to Role  Successfully');
    return redirect()->route('all.roles.permission');


}// End Method 


public function AdminDeleteRoles($id){

    $role = Role::findOrFail($id);
    if (!is_null($role)) {
        $role->delete();
    }

    toast()->info('Role Permission Deleted Successfully');
    return redirect()->route('all.roles.permission');



}// End Method 



public function AllAdmin(){

    $alladminuser = User::latest()->get();
    return view('admin.all_users',compact('alladminuser'));
}//


}
