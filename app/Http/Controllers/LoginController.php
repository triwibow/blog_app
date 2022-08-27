<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{

    public function index(Request $request){
        $params =  ["title" => "Login"];
        return view('login.index', $params);
    }

    public function loginValidate(Request $request){
        
        try {
            $username = $request->username;
            $password = $request->password;
            
            $data = Account::where('username', $username)->first();
            if(!is_null($data)){
                if(!Hash::check($request->password,$data->password)){
                    return redirect()->route('login')
                        ->with('status', 'username atau password salah !');
                }

                Session::put('u', $data->username);
                Session::put('r', $data->role);

                if($data->role == "admin"){
                    return redirect()->route('account.index');
                }

                if($data->role == "author"){
                    return redirect()->route('post.index');
                }
            }

            return redirect()->route('login')
                        ->with('status', 'username atau password salah !');
        } catch(\Exception $e)
        {
            return redirect()->route('login')
                        ->with('status', 'username atau password salah !');
        }
    }

    public function logout(Request $request){
        Session::forget('u');
        Session::forget('r');
        return redirect('/login');
    }

}
