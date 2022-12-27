<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    public function index()
    {
        $term = TermCondition::find(1);

        return view('admin.term.index', compact('term'));
    }

    public function edit($id)
    {
        $term = TermCondition::find($id);
        return view('admin.term.edit', compact('term'));
    }

    public function update(Request $request, $id){
        $term = TermCondition::where('id', $id)->update([
            'description' => $request->description
        ]);
        return $this->message($term, 'admin.term.index', 'Terms & Condition Create Successfully', 'Terms & Condition Create Error');
    }
}
