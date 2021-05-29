<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(){
        $users = User::get();
        return view('Admin.user-list')
        ->with('users',$users);
    }

    public function details($id){
        $user = User::findOrFail($id);
        $levels = User::ADMIN_LEVELS;
        return view('Admin.user-details')
        ->with('levels',$levels)
        ->with('user',$user);
    }
    public function edit($id){
        $user = User::findOrFail($id);

        if(request()->has('admin_level')){
            $user->admin_level = request()->input('admin_level',User::LEVEL_CLIENT);
        }
        $user->save();
        return redirect()->back();
    }
}
