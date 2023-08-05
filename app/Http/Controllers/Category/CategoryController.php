<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    

    public function  AllCategory()
{
$categories = Category::paginate(5);

return view('categories.all_categories', compact('categories'));
}

            
public function Storecategory(Request $request)
{

    // dd($request);
    $validatedData = $request->validate([
        'name' => 'required|unique:categories|max:255',
    ]);

    $Category = Category::create([
        'name' => $validatedData['name'],
    ]);
    toast()->success(' Category added successfully');
     return redirect()->back();


}



public function Editcategory($id)
{
$Category = Category::findOrFail($id);
$Categories = Category::paginate(5);
return view('Categories.update_categories', compact('Category','Categories'));


}


public function Deletecategory($id){


    Category::findOrFail($id)->delete();
    toast()->error('Alert.. Category deleted Successfully');


    return redirect()->route('all.category');


}



public function Updatecategory (Request $request, $id)
{
$category = Category::findOrFail($id);


$validatedData = $request->validate([
    'name' => 'required|unique:categories,name,' . $category->id,
]);


// Update the fields
$category->name = $validatedData['name'];

$category->save();
toast()->success(' category Updated successfully');

// return redirect()->back()->with('success', 'Service updated successfully!');
return redirect()->back();
}

}
