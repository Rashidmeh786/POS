<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ExpenseController extends Controller
{

    public function  AllCategory()
    {
    $categories = ExpenseCategory::paginate(5);
    
    return view('expensecategories.all_categories', compact('categories'));
    }
    
                
    public function Storecategory(Request $request)
    {
    
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|unique:expense_categories|max:255',
        ]);
    
        $Category = ExpenseCategory::create([
            'name' => $validatedData['name'],
        ]);
        toast()->success(' Category added successfully');
         return redirect()->back();
    
    
    }
    
    
    
    public function Editcategory($id)
    {
    $Category = ExpenseCategory::findOrFail($id);
    $Categories = ExpenseCategory::paginate(5);
    return view('expensecategories.update_categories', compact('Category','Categories'));
    
    
    }
    
    
    public function Deletecategory($id){
    
    
        ExpenseCategory::findOrFail($id)->delete();
        toast()->error('Alert.. Category deleted Successfully');
    
    
        return redirect()->route('all.category');
    
    
    }
    
    
    
    public function Updatecategory (Request $request, $id)
    {
    $category = ExpenseCategory::findOrFail($id);
    
    
    $validatedData = $request->validate([
        'name' => 'required|unique:expense_categories,name,' . $category->id,
    ]);
    
    
    // Update the fields
    $category->name = $validatedData['name'];
    
    $category->save();
    toast()->success(' category Updated successfully');
    
    // return redirect()->back()->with('success', 'Service updated successfully!');
    return redirect()->back();
    }
    



    public function AllExpenses(){

        $Expenses = Expense::latest()->get();
        return view('expense.all_expense',compact('Expenses'));
    
       } 
       public function AddExpense(){

        $category = ExpenseCategory::latest()->get();
        
        return view('expense.add_expense',compact('category'));
       }

       public function StoreExpense(Request $request){ 


        // dd($request->all());

        $pcode = IdGenerator::generate(['table' => 'expenses','field' => 'ref_no','length' => 5, 'prefix' => 'ex' ]);
        $validator = Validator::make($request->all(), [
           
            'category_id' => 'required',
            'amount' => 'required',
            // 'product_code' => 'required|unique:products',
            'title'=>'required',
            'details'=>'required'
       
        ]);

        
       if ($validator->fails()) {
        toast()->error('Wait.. the form have some errors');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
          
    }
 

    $Expense = new Expense;
    $Expense->date=$request->date;
    $Expense->title = $request->title;
    $Expense->category_id = $request->category_id;
    $Expense->amount = $request->amount;
    $Expense->details = $request->details;
    $Expense->user_id = Auth::id();
    $Expense->ref_no=$pcode;
       
    $Expense->save();
    
    
        toast()->success('Cool.. Expense added Successfully');
        // Redirect back with success message
        return redirect()->route('all.expenses');
   

}
public function ShowExpense($id){
 $Expense = Expense::findOrFail($id);
 $category = ExpenseCategory::latest()->get();
 
 return view('expense.show_expense',compact('category','Expense'));

}



public function EditExpense($id){
 $Expense = Expense::findOrFail($id);
 $category = ExpenseCategory::latest()->get();
 
 return view('expense.edit_expense',compact('category','Expense'));

}


public function UdateExpense(Request $request){

    $expense = $request->id;
 
 $validator = Validator::make($request->all(), [
    'category_id' => 'required',
    'amount' => 'required',
    // 'product_code' => 'required|unique:products',
    'title'=>'required',
    'details'=>'required'
    
 ]);
 
 
if ($validator->fails()) {
 toast()->error('Wait.. the form have some errors');

 return redirect()->back()
     ->withErrors($validator)
     ->withInput();
   
}




 Expense::findOrFail($expense)->update([
    
    'title' =>$request->title,
    'category_id' =>$request->category_id,
    'amount' =>$request->amount,
    'details' => $request->details,
   'user_id' => Auth::id(),
 

 ]);

    

 toast()->info('Cool.. Expense Updated Successfully');

 return redirect()->route('all.expenses');

 } 





                public function DeleteExpense($id){

                    // $product_img = Product::findOrFail($id);
                    // $img = $product_img->product_image;
                    // unlink($img);
            
                    Expense::findOrFail($id)->delete();
                    toast()->info('Cool.. Product Updated Successfully');
            
            
                    return redirect()->back();
            
                } // End Method 
            
}