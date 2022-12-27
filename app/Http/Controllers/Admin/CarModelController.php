<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarModelController extends Controller
{
    public function CarModel()
    {
        $data = Company::with('model')->orderBy('id','desc')->get();
        $company = Company::all();
        $page_title = 'Company Name';
        return view('admin.companyModel.index', compact('company', 'page_title','data'));
    }
    public function store(Request $request)
    {
        $model = new CarModel();
        $model->car_model = $request->car_model;
        $model->company_id = $request->company_id;
        $model->save();
        return redirect()->route('admin.car-model')->with($this->data("Car Model has been added successfyully", 'success'));
    }

    public function edit($id)
    {
        $model = CarModel::with('company')->find($id);
         return view('admin.companyModel.edit', compact('model'));
    }
    public function update(Request $request, $id)
    {
        $model= CarModel::find($id);
        $model->car_model=$request->car_model;
        $model->save();

        $data = CarModel::with('company')->where('company_id',$model->company_id)->get();
        return view('admin.companyModel.view', compact('data'))->with($this->data("Car Model has been Updated successfyully", 'success'));

        // return redirect('admin/view-model');
    }
    public function view($id)
    {
        $data = CarModel::with('company')->where('company_id',$id)->get();
        return view('admin.companyModel.view', compact('data'));
    }


    public function delete($id)
    {
       $data = CarModel::whereCompany_id($id)->get();
      foreach($data as $data){
        $data->delete();
      }
        return redirect()->route('admin.car-model')->with($this->data("Company Model deleted successfyully", 'success'));
    }

    public function deleteModel($id)
    {
       $model =  CarModel::with('company')->find($id);
       $model->delete();
        $data = CarModel::with('company')->where('company_id',$model->company_id)->get();
        return view('admin.companyModel.view', compact('data'))->with($this->data("Company Model deleted successfyully", 'success'));
    }
}
