<?php

namespace App\Http\Controllers;

use App\Models\Admin as ModelsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class AdminController extends Controller
{
   public function admin_register(){
    return view('admin.register');

   }

   public function register(Request $request){
    $request->validate([
        'name'=>'required|string|max:225',
        'email' => 'required|email|unique:admins,email',
        'password'=>'required|confirmed|min:6'

    ]);

    $admin = ModelsAdmin::create([

        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);

    Auth::guard('admin')->login($admin);
    return redirect()->route('admin');


   }

   public function adminLogin(Request $request){

    $data = $request->validate([
        'email'=>'required|email',
        'password'=>'required',

    ]);
    if(Auth::guard('admin')->attempt($data)){

        $request->session()->regenerate();
        return redirect()->route('admin')->with('success','Logged in successfully ');
    }
    return redirect()->back()->withErrors(['email'=>'Incorrect Email or password'])->onlyInput('email');
   }

   public function logout(Request $request)  
   {

    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login')->with('success','Logged out');
    
   }




   public function admin_login(){
    return view('admin.login');
   }


}
