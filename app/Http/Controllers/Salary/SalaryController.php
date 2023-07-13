<?php

namespace App\Http\Controllers\Salary;

use App\Models\Employee;
use App\Models\Paysalary;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function AddAdvanceSalary(){

        $employee = Employee::latest()->get();
        return view('salary.add_advance_salary',compact('employee'));

    }

    
    public function AdvanceSalaryStore(Request $request){

        $validateData = $request->validate([
            'month' => 'required',
            'year' => 'required',
            'advance_salary' => 'required|max:255', 
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;

        $advanced = AdvanceSalary::where('month',$month)->where('employee_id',$employee_id)->first();

        if ($advanced === NULL) {

            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(), 
            ]);
            toast()->Success('Advance salary hasbeen given to employee');

        return redirect()->route('all.advance.salary');


        } else{

            
                toast()->warning('Wait.. advance salary already paid to this user');
        
                
        }

        return redirect()->back(); 

        }
        public function AllAdvanceSalary(){

            $salary = AdvanceSalary::latest()->get();
            return view('salary.all_advance_salary',compact('salary'));
    
        }

        public function EditAdvanceSalary($id){
            $employee = Employee::latest()->get();
            $salary = AdvanceSalary::findOrFail($id);
            return view('salary.edit_advance_salary',compact('salary','employee'));
    
        }// End Method 
    
    
        public function AdvanceSalaryUpdate(Request $request){
    
            $salary_id = $request->id;
    
             AdvanceSalary::findOrFail($salary_id)->update([
                    'employee_id' => $request->employee_id,
                    'month' => $request->month,
                    'year' => $request->year,
                    'advance_salary' => $request->advance_salary,
                    'created_at' => Carbon::now(), 
                ]);
    
             
            toast()->success('Advance Salary Updated Successfully');
    
            return redirect()->route('all.advance.salary');
    
    
        }// End Method 
    
      public function  DeleteadvanceSalary($id)
      {
        AdvanceSalary::findOrFail($id)->delete();
        toast()->error('Alert.. advance Salary deleted Successfully');
    
    
        return redirect()->back(); 
      }

      public function PaySalary()
      {
          $employee = Employee::latest()->get();
          $previousMonth = date('F', strtotime('-1 month'));
      
          return view('salary.pay_salary', compact('employee', 'previousMonth'));
      }
      


    public function PayNowSalary($id){

        $paysalary = Employee::findOrFail($id);
        return view('salary.paid_salary',compact('paysalary'));

    }

     public function EmployeSalaryStore(Request $request){

        $employee_id = $request->id;

        Paysalary::insert([

            'employee_id' => $employee_id,
            'salary_month' => $request->month,
            'salary_year' => $request->year,
            'salary_status'=>$request->salary_status,
            'paid_amount' => $request->paid_amount,
            'advance_salary' => $request->advance_salary,
            'due_salary' => $request->due_salary,
            'created_at' => Carbon::now(),

        ]);
        toast()->Success('Salary Paid Successfully');
        
                
      
        return redirect()->route('pay.salary'); 


    }

    public function unpaid_salaries(){

        $paidsalary = PaySalary::where('salary_status', 'unpaid')->get();

        $availableMonths = PaySalary::distinct('salary_month')->pluck('salary_month')->toArray();
        $availableYears=[2023,2024,2025,2026,2027];

        return view('salary.unpaid_salaries',compact('paidsalary','availableMonths','availableYears'));
        
    }


    public function EmployeunpaidSalaryStore(Request $request){

        $employee_id = $request->employee_id;
        $salary_month = $request->salary_month;
        $salary_year = $request->salary_year;
        
        $currentStatus = Paysalary::where('employee_id', $employee_id)
    ->where('salary_month', $salary_month)
    ->where('salary_year', $salary_year)
    ->value('salary_status');

// Toggle the status
$newStatus = ($currentStatus == 'paid') ? 'unpaid' : 'paid';

// Update the status
Paysalary::where('employee_id', $employee_id)
    ->where('salary_month', $salary_month)
    ->where('salary_year', $salary_year)
    ->update(['salary_status' => $newStatus]);
        
        toast()->Success('Salary Paid Successfully');
        
                
      
        return redirect()->back(); 


    }



    public function MonthSalary(){

        $paidsalary = PaySalary::latest()->get();
        $availableMonths = PaySalary::distinct('salary_month')->pluck('salary_month')->toArray();
        $availableYears=[2023,2024,2025,2026,2027];

        return view('salary.month_salary',compact('paidsalary','availableMonths','availableYears'));
        
    }


    public function EmployeeSalaryHistory($id){
         //return $id;

         $salaryHistory = PaySalary::where('employee_id', $id)->get();
        return view('salary.employee_salary_history',compact('salaryHistory'));
      

    }
    public function printReport($id)
{
    $salaryHistory = PaySalary::where('employee_id', $id)->get();

    return view('salary.print_report', compact('salaryHistory'));
}
    

}
