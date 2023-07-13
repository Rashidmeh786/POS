<?php

namespace App\Http\Controllers\employee;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class EmployeeController extends Controller
{
    public function AllEmployee(){

        $employee = Employee::latest()->get();
        return view('employee.all_employee',compact('employee'));
    } 

    public function AddEmployee(){
       
        
        return view('employee.add_employee');
    }
    public function StoreEmployee(Request $request)
    {
        $empcode = IdGenerator::generate(['table' => 'employees','field' => 'code','length' => 6, 'prefix' => 'EMP' ]);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'fname' => 'required|max:255',
            'dob' => 'required',
            'doj' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'ephone' => 'required',
            'city' => 'required',
            'image' => 'required',
            'address' => '',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'additionall_info' => '',
            'designation' => 'required',
            'department' => 'required',
            'cnic' => [
                'required',
                'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
                Rule::unique('employees', 'cnic') // Optional: Add unique rule if CNIC should be unique
            ],
        ]);
        
        if ($validator->fails()) {
            toast()->error('wait.. fill all mandatory fields');

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
              
        }



        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/admin_image/'.$data->photo));
            // $filename = date('YmdHi').$file->getClientOriginalName();
            $filename =  time().'.'.$file->getClientOriginalName();

           
            $file->move(public_path('upload/employee/'),$filename);
            $data['image'] = $filename;
         }
        // $image = $request->file('image');
        // $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        // Image::make($image)->resize(300,300)->save('upload/employee/'.$name_gen);
        // $save_url = 'upload/employee/'.$name_gen;

            $employee = new Employee;
            $employee->name = $request->input('name');
            $employee->fname = $request->input('fname');
            $employee->dob = $request->input('dob');
            $employee->joiningdate = $request->input('doj');
            $employee->cnic = $request->input('cnic');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone'); 
            $employee->ephone = $request->input('ephone'); 
            $employee->address = $request->input('address');
            $employee->experience = $request->input('experience');
            $employee->salary = $request->input('salary');
            $employee->additionall_info = $request->input('additionall_info');
            $employee->gender = $request->input('gender');
            $employee->city = $request->input('city');
            $employee->designation_id  = $request->input('designation');
            $employee->department_id  = $request->input('department');
            $employee->code=$empcode;


            $employee->image=$filename;
            // Save uploaded image file
         
            $employee->save();
        
            toast()->success('Cool.. Employee added Successfully');
            // Redirect back with success message
            return redirect()->route('all.employee');
    
    }

    public function EditEmployee($id){

        $employee = Employee::findOrFail($id);
        return view('employee.edit_employee',compact('employee'));

    } 


    public function UpdateEmployee(Request $request){

        $employee_id = $request->id;
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'fname' => 'required|max:255',
            'dob' => 'required',
            'doj' => 'required',
            'email' => 'required|email|unique:employees,email,'.$employee_id,
            'phone' => 'required',
            'ephone' => 'required',
            'city' => 'required',
            'address' => '',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'additionall_info' => '',
            'designation' => 'required',
            'department'=>'required',
            'cnic' => [
                'required',
                'regex:/^(\d{5})-(\d{7})-(\d{1})$/',
                Rule::unique('employees', 'cnic')->ignore($employee_id),
            ],
        ], [
            'cnic.regex' => 'The CNIC format is invalid. It should follow the pattern: XXXXX-XXXXXXX-X.',
        ]);
        
        
        
        

        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/admin_image/'.$employee->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee/'),$filename);
           
      

       Employee::findOrFail($employee_id)->update([

            'name' => $request->name,
            'fname' => $request->fname,
            'joiningdate' => $request->doj,
            'dob' => $request->dob,
            'cnic'=>$request->cnic,
            'email' => $request->email,
            'phone' => $request->phone,
            'ephone' => $request->ephone,

            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            // 'vacation' => $request->vacation,
            'city' => $request->city,
            'image' => $filename,
            'gender'=>$request->gender,
            'designation_id'=>$request->designation,
            'department_id'=>$request->department,
            'additionall_info'=>$request->aadditionall_info
           

        ]);

        toast()->success('Cool.. Employee Updated Successfully');
        
        return redirect()->route('all.employee');

        } else{

            Employee::findOrFail($employee_id)->update([


                
            'name' => $request->name,
            'fname' => $request->fname,
            'joiningdate' => $request->doj,
            'dob' => $request->dob,
            'cnic'=>$request->cnic,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            // 'vacation' => $request->vacation,
            'city' => $request->city,
            'gender'=>$request->gender,
            'designation_id'=>$request->designation,
            'department_id'=>$request->department,

            'additionall_info'=>$request->aadditionall_info
  

        ]);

        
        toast()->success('Cool.. Employee updated Successfully');

        return redirect()->route('all.employee'); 

        } // End else Condition  


    } // End Method 

    public function DeleteEmployee($id){

        // $employee_img = Employee::findOrFail($id);
        // $img = $employee_img->image;
        // unlink($img);

        Employee::findOrFail($id)->delete();
        toast()->error('Cool.. Employee deleted Successfully');

    
        return redirect()->back(); 

    }




    public function  AllDesignations()
{
$designations = Designation::paginate(5);

return view('employee.designations.all_designations', compact('designations'));
}

            
public function StoreDesignations(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|unique:designations|max:255',
    ]);

    $designation = Designation::create([
        'name' => $validatedData['name'],
    ]);
    toast()->success(' Designation added successfully');
     return redirect()->route('all.designation');


}




public function EditDesignation($id)
{
$designation = Designation::findOrFail($id);
$designations = Designation::paginate(5);
return view('employee.designations.update_designations', compact('designation','designations'));


}


public function DeleteDesignation($id){

    // $employee_img = Employee::findOrFail($id);
    // $img = $employee_img->image;
    // unlink($img);

    Designation::findOrFail($id)->delete();
    toast()->error('Alert.. Designation deleted Successfully');


    return redirect()->route('all.designation'); 

}


public function UpdateDesignation (Request $request, $id)
{
$designation = Designation::findOrFail($id);


$validatedData = $request->validate([
    'name' => 'required|unique:designations,name,' . $designation->id,
]);


// Update the fields
$designation->name = $validatedData['name'];

$designation->save();
toast()->success(' Designation Updated successfully');

// return redirect()->back()->with('success', 'Service updated successfully!');
return redirect()->back();
}


        // --departments--

public function  AllDepartments()
{
$departments = Department::paginate(5);

return view('employee.departments.all_departments', compact('departments'));
}

            
public function StoreDepartments(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|unique:departments|max:255',
    ]);

    $designation = Department::create([
        'name' => $validatedData['name'],
    ]);
    toast()->success(' Department added successfully');
     return redirect()->route('all.department');


}




public function EditDepartment($id)
{
$department = Department::findOrFail($id);
$departments = Department::paginate(5);
return view('employee.departments.update_departments', compact('department','departments'));


}


public function DeleteDepartment($id){

    // $employee_img = Employee::findOrFail($id);
    // $img = $employee_img->image;
    // unlink($img);

    Department::findOrFail($id)->delete();
    toast()->error('Alert.. Department deleted Successfully');


    return redirect()->route('all.department');

}


public function UpdateDepartment (Request $request, $id)
{
$department = Department::findOrFail($id);


$validatedData = $request->validate([
    'name' => 'required|unique:departments,name,' . $department->id,
]);


// Update the fields
$department->name = $validatedData['name'];

$department->save();
toast()->success(' Department Updated successfully');

// return redirect()->back()->with('success', 'Service updated successfully!');
return redirect()->back();
}

}

