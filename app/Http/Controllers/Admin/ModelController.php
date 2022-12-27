<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelRequest;
use App\Models\Models;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $models = Models::all();
        $page_title = 'Models';
        return view('admin.model.index', compact('models', 'page_title'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ModelRequest $request)
    {
        $model = Models::create($request->all());
        return $this->message($model, 'admin.model.index', 'Model Create Successfully', 'Model Create Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Models $model
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Models $model)
    {
        return view('admin.model.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModelRequest $request
     * @param Models $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModelRequest $request, Models $model)
    {
        $model = $model->update($request->all());
        return $this->message($model, 'admin.model.index', 'Model Update Successfully', 'Model Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Models $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Models $model)
    {
        $model->delete();
        return $this->message($model, 'admin.model.index', 'Model Delete Successfully', 'Model Delete Error');
    }
}
