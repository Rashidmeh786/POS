<?php

namespace App\Http\Controllers\Attendance;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
// use Carbon\Carbon;

class AttendenceController extends Controller
{
    
        public function EmployeeAttendenceList(){
    

            $allData = Attendance::select('date')->groupBy('date')->orderBy('id','asc')->get();
            return view('attendence.all_employee_attendence',compact('allData'));
        }

        public function AddEmployeeAttendence(){
            $employees = Employee::all();
            return view('attendence.add_employee_attendence',compact('employees'));
        }


    

public function EmployeeAttendenceStore(Request $request)
{
    Attendance::where('date', date('Y-m-d H:i:s', strtotime($request->attendance_datetime)))->delete();
    // Attendance::where('date', $request->attendance_datetime)->delete();
    $countEmployee = count($request->employee_id);

    for ($i = 0; $i < $countEmployee; $i++) {
        $attendStatus = 'attend_status' . $i;
        $checkin_time = 'checkin_time' . $i;
        $attend = new Attendance();
        $attend->date = $request->attendance_datetime;
        $attend->month = Carbon::parse($request->attendance_datetime)->format('F');
        $attend->year = Carbon::parse($request->attendance_datetime)->format('Y');
        // $attend->checkin =$request->checkin_time[$i];
        $attend->employee_id = $request->employee_id[$i];
        $attend->attend_status = $request->$attendStatus;
        $attend->save();
    }

    toast()->success('Employees Attendance added successfully');

    return redirect()->route('employee.attendance.list');
}

        
        

        public function EditEmployeeAttendence($date){
            $employees = Employee::all();
            $editData = Attendance::where('date',$date)->get();

            return view('attendence.edit_employee_attend',compact('employees','editData'));
   
       }

       public function ViewEmployeeAttendence($date){

        $details = Attendance::where('date',$date)->get();
   return view('attendence.details_employee_attend',compact('details'));


   }



   public function ViewEmployeeAttendenceHistory($id){

  //  return $id;
  $availableMonths = Attendance::distinct('month')->pluck('month')->toArray();
        $availableYears=[2023,2024,2025,2026,2027];
    $details = Attendance::where('employee_id',$id)->get();
return view('attendence.details_employee_attend_history',compact('details','availableMonths','availableYears'));

}

public function printReport($id)
{
    $details = Attendance::where('employee_id', $id)->get();

    return view('attendence.print_report', compact('details'));
}


}
