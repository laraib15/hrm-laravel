<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index(){
        return view('dashboard.user.index');
    }
    function profile(){
        return view('dashboard.user.profile');
    }
}
