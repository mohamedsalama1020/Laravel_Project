<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function adults(){
        return view('auth.adults');
    }

    public function site(){
        return view('site');
    }

    public function admin(){
        return view('admin');
    }
}
