<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PaymentPercentage;
use App\Http\Controllers\Controller;

class PercentageController extends Controller
{
    public function index()
    {
        $data = PaymentPercentage::all();
        return view('admin.percentage.index', compact('data'));
    }
    public function edit_percentage($id){
       $data=PaymentPercentage::find($id);
       return view('admin.percentage.edit', compact('data'));
    }
    public function update_percentage(Request $request,$id){
    //   dd('usman');
      $data=PaymentPercentage::find($id);
      $data->type=$request->type;
      $data->percentage=$request->percentage;
      $data->save();
      return redirect('admin/percentage')->with($this->data("Percentage record updated successfyully", 'success'));
    }
}
