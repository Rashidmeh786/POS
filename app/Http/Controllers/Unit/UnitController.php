<?php

namespace App\Http\Controllers\Unit;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class UnitController extends Controller
{
    
    public function  Allunit()
{
$units = Unit::paginate(5);

return view('units.all_units', compact('units'));
}

            
public function Storeunit(Request $request)
{

    // dd($request);
    $validatedData = $request->validate([
        'name' => 'required|unique:units|max:255',
    ]);

    $unit = Unit::create([
        'name' => $validatedData['name'],
    ]);
    toast()->success(' Unit added successfully');
     return redirect()->back();


}


public function Editunit($id)
{
$unit = Unit::findOrFail($id);
$units = Unit::paginate(5);
return view('units.update_units', compact('unit','units'));


}


public function Deleteunit($id){


    Unit::findOrFail($id)->delete();
    toast()->error('Alert.. Unit deleted Successfully');


    return redirect()->route('all.unit');


}



public function Updateunit (Request $request, $id)
{
$unit = Unit::findOrFail($id);


$validatedData = $request->validate([
    'name' => 'required|unique:units,name,' . $unit->id,
]);


// Update the fields
$unit->name = $validatedData['name'];

$unit->save();
toast()->success(' Unit Updated successfully');

// return redirect()->back()->with('success', 'Service updated successfully!');
return redirect()->back();
}

}
