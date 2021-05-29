<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){

        $user = Auth::user();

        return view('account')
        ->with('user',$user);
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'password2' => 'same:password',
        ],[
            'current_password.required' => 'Musisz podać aktualne hasło!',
            'password.required' => 'Musisz podać nowe hasło!',
            'password2.same' => 'Nowe hasła różnią się!'
        ]);

        $user = Auth::user();

        if(!Hash::check(request()->current_password,$user->password)){
            return redirect()->back()->with('danger','Błędne aktualne hasło!');
        }
        $user->password = Hash::make(request()->password);
        $user->save();
        $request->session()->flash('success', 'Pomyślnie zmieniono hasło');

        return redirect()->back();

    }
}
