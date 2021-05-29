<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }
    public function login(){
        request()->validate([
            'email' => 'email:rfc,dns',
            'password' => 'required'
        ],[
            'email.email' => 'Adres e-mail jest wymagany!',
            'password.required' => 'Hasło jest wymagane!']
        );

        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else{
            request()->session()->flash('danger', 'Zły adres e-mail lub hasło!');
            return redirect()->back()->withInput();
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
