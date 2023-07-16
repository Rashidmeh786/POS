<?php

namespace App\Http\Controllers\adjustment;

use App\Models\Product;
use App\Models\adjustment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AdjustmentController extends Controller
{




    
    public function alladjustment()
    {
        $referenceData = adjustment::select('reference_number', DB::raw('COUNT(*) as count'))
            ->groupBy('reference_number')
            ->get();
    
        $alladjustments = adjustment::whereIn('reference_number', $referenceData->pluck('reference_number'))
            ->orderBy('id', 'DESC')
            ->get();
    
        $totalAdjustmentsCount = adjustment::count();
    
        return view('adjustment.all_adjustment', compact('referenceData', 'alladjustments', 'totalAdjustmentsCount'));
    }
    
    
    
    
    public function addadjustment()
    {
            return view ('adjustment.add_adjustment');
    }
    public function createadjustment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'reason' => 'required',
            'adjustment_type' => 'required|array', // Update validation rule to accept an array
            'qty' => 'required|array', // Update validation rule to accept an array
            'qty.*' => 'required|numeric|min:1', // Validation rule for each quantity value
        ], [
            'qty.required' => 'At least one product is required.',
        ]);
    
        if ($validator->fails()) {
            toast()->error('Wait.. Something Mandatory is Missing');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $refcode = IdGenerator::generate(['table' => 'adjustments', 'field' => 'reference_number', 'length' => 10, 'prefix' => 'Ref-']);
    
        // Retrieve and store the adjustment details for each product
        foreach ($request->product_id as $index => $productId) {
            $adjustment = new adjustment();
            $adjustment->product_id = $productId;
            $adjustment->date_of_adjustment = $request->date;
            $adjustment->reason = $request->reason;
            $adjustment->adjustment_type = $request->adjustment_type[$index];
            $adjustment->quantity = $request->qty[$index];
            $adjustment->reference_number = $refcode;
            $adjustment->user_id = Auth::id();
            $product = Product::findOrFail($productId);
    
            // Perform stock adjustment based on the adjustment type
            if ($adjustment->adjustment_type == 'positive') {
                Product::where('id', $productId)
                    ->update(['stock' => DB::raw('IFNULL(stock, 0) + ' . $adjustment->quantity)]);
            } else {
                Product::where('id', $productId)
                    ->update(['stock' => DB::raw('IFNULL(stock, 0) - ' . $adjustment->quantity)]);
            }
            $adjustment->save();
        }
    
        toast()->success('Adjustment Created Successfully ..');
        return redirect()->route('all.adjustment');


    }
    
            public function DetailsAdjustment($refno)
            {
                $adjustments = adjustment::where('reference_number', $refno)->get();

                // Process the retrieved records as needed
            
                return view('adjustment.adjustmentdetails',compact('adjustments'));


            }


            public function AdjustmentResonAjax($id){

        //     $reason = adjustment::findOrFail($id);
                $reason = adjustment::where('reference_number', $id)->get();

              //  dd($reason);
               return response()->json($reason);
        
            }


            public function PrintInvoice($id){

              
        
               $adjustedItem = Adjustment::where('reference_number',$id)->orderBy('id','DESC')->get();
               $referenceNumbers = $adjustedItem->pluck('reference_number')->unique();
               $referenceNumbersString = implode(', ', $referenceNumbers->all());

               $date = $adjustedItem->pluck('date_of_adjustment')->unique();
               $dateString = implode(', ', $date->all());
               $reason = $adjustedItem->pluck('reason')->unique();
               $reasonString = implode(', ', $reason->all());


               
               $pdf = Pdf::loadView('adjustment.printreport', compact('adjustedItem','referenceNumbersString','dateString','reasonString'))->setPaper('a4')->setOption([
                       'tempDir' => public_path(),
                       'chroot' => public_path(),
        
               ]);
             

               $date = Carbon::now()->format('Y-m-d'); // Get the current date in the desired format
               $fileName = 'adjustmentreport_' . $date . '.pdf';
           
               return $pdf->download($fileName);
        
           }



}
