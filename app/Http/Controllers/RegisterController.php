<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(){
         request()->validate([
            'email' => 'email:rfc,dns',
            'pass1' => 'required|min:'.User::MIN_PASSWORD_LENGTH,
            'pass2' => 'same:pass1',
            'accept' => 'required',
            'name' => 'required',
        ],[
            'email.email' => 'Adres e-mail jest wymagany!',
            'pass1.required' => 'Hasło jest wymagane!',
            'pass1.min' => 'Hasło jest za krótkie!',
            'accept.required' => 'Musisz zaakceptować regulamin!',
            'name.required' => 'Musisz podać imię!',
            'pass2.same' => 'Hasła różnią się!',
        ]);
        $isExists = User::Where('email',request()->email)->count();
        if($isExists > 0){
            return view('register')
            ->withErrors('Ten login lub adres e-mail jest już używany!');
        }

        $user = new User;
        $user->password = Hash::make(request()->pass1);
        $user->email = request()->email;
        $user->name = request()->name;
        $user->admin_level = 1;
        $user->save();

        request()->session()->flash('success', 'Zarejestrowano pomyślnie!');

        return view('register');
    }
}
