<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelYear;
use Illuminate\Http\Request;

class ModelYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $model_year = ModelYear::all();
        $page_title = 'Model Year';
        return view('admin.model_year.index', compact('model_year', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'model_year' => 'required',
        ]);
        $model = ModelYear::create($request->all());
        return $this->message($model, 'admin.model_year.index', 'Model year Create Successfully', 'Model year Create Error');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ModelYear $modelYear
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(ModelYear $modelYear)
    {
        return view('admin.model_year.edit', compact('modelYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ModelYear $modelYear
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {

        $request->validate([
            'model_year' => 'required',
        ]);
        $modelYear=ModelYear::find($id);
        $modelYear->model_year=$request->model_year;
        $modelYear->save();
        return $this->message($modelYear, 'admin.model_year.index', 'Model year Update Successfully', 'Model year Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ModelYear $modelYear
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        ModelYear::destroy($id);
        return redirect()->route('admin.model_year.index')->with($this->data("Model Year deleted successfyully", 'success'));
    }
}
