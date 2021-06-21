<?php

namespace App\Http\Controllers\ctv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ctv\ChangePassRequest;

class CtvController extends Controller
{
    public function show(){
        return Auth::user();
    }
    public function createChangePassword(){
        return view('ctv.changePassword');
    }

    public function updatePassword(ChangePassRequest $request){
        $password=$request->password_old;
        if (!Hash::check($password, Auth::user()->password)) {
            Session::flash('notifi', 'password nhập sai!');
            return redirect()->back();
        }   
        else {
            Auth::user()->password=bcrypt($request->password);
            Auth::user()->save();
            Session::flash('notifi', 'update password thành công!');
            return redirect()->back();
        }
    }


    public function logOut(){
        Auth::logout();
        return redirect('/login');
    }
    
}
