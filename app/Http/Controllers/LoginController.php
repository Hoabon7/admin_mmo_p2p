<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function checkLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status'=> 1])) {
            return redirect()->route('member.customer.all');
            
        } else {
            Session::flash('danger', 'Sai thông tin đăng nhập');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function login()
    {
        return view('login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
