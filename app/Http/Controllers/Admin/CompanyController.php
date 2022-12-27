<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $company = Company::all();
        $page_title = 'Company Name';
        return view('admin.company.index', compact('company', 'page_title'));
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
            'company' => 'required',
        ]);
        $company = Company::create($request->all());
        return $this->message($company, 'admin.company.index', 'Company Create Successfully', 'Company Create Error');
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
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Company $company)
    {

        $request->validate([
            'company' => 'required',
        ]);
        $company = $company->update($request->all());
        return $this->message($company, 'admin.company.index', 'Company Update Successfully', 'Company Update Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Company $company)
    // {
    //     $company->delete();
    //     return $this->message($company, 'admin.company.index', 'Company Delete Successfully', 'Company Delete Error');
    // }
    public function delete($id)
    {
        Company::destroy($id);
        // dd('done');
        return redirect()->route('admin.company.index')->with($this->data("Company deleted successfyully", 'success'));
    }
}
