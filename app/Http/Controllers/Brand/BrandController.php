<?php

namespace App\Http\Controllers\Brand;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function  Allbrand()
    {
    $brands = Brand::paginate(5);
    
    return view('brands.all_brands', compact('brands'));
    }
    
                
    public function Storebrand(Request $request)
    {
    
        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|unique:brands|max:255',
        ]);
    
        $brand = Brand::create([
            'name' => $validatedData['name'],
        ]);
        toast()->success(' Brand added successfully');
         return redirect()->back();
    
    
    }
    
    
    public function Editbrand($id)
    {
    $brand = Brand::findOrFail($id);
    $brands = Brand::paginate(5);
    return view('brands.update_brands', compact('brand','brands'));
    
    
    }
    
    
    public function Deletebrand($id){
    
    
        Brand::findOrFail($id)->delete();
        toast()->error('Alert.. Brand deleted Successfully');
    
    
        return redirect()->route('all.brand');
    
    
    }
    
    
    
    public function Updatebrand (Request $request, $id)
    {
    $brand = Brand::findOrFail($id);
    
    
    $validatedData = $request->validate([
        'name' => 'required|unique:brands,name,' . $brand->id,
    ]);
    
    
    // Update the fields
    $brand->name = $validatedData['name'];
    
    $brand->save();
    toast()->success(' Brand Updated successfully');
    
    // return redirect()->back()->with('success', 'Service updated successfully!');
    return redirect()->back();
    }
    
}
