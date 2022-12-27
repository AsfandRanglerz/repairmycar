<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function index(){

        $data=Slider::all();

        return view("admin/slider/index",compact('data'));

    }

    public function store(Request $request){

        $data=$request->all();


        if(!empty($request->image)){
            $file=$request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move(public_path('uploads/'),$filename);
            $data['image']= 'public/uploads/'.$filename;
        }


        Slider::create($data);

        return redirect("admin/slider");

    }

    public function delete($id){
        Slider::destroy($id);
        return redirect("admin/slider")->with($this->data("Slider  deleted successfyully", 'success'));
    }

    public function edit($id){

        $data=Slider::find($id);
        return view("admin/slider/edit",compact('data'));

    }

    public function update(Request $request, $id){
        $new_data=$request->all();
        $old_data=Slider::find($id);

        if(!empty($request->image)){
            $file=$request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename=time().'.'.$extention;
            $file->move(public_path('uploads/'),$filename);
            $new_data['image']= 'public/uploads/'.$filename;
        }


        $old_data->update($new_data);

        return redirect("admin/slider");
    }
}
