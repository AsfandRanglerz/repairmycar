<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class editprofileController extends Controller
{
    public  function edit()
    {
        return view('vendor.edit_profile');
    }
}
