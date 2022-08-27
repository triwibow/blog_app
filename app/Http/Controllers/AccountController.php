<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $r = Session::get('r');  
            if(is_null($r)){
                return redirect()->route('login');
            }

            if($r == "author"){
                return redirect()->route('post.index');
            }

            return $next($request);
        });
        
    }

    public function index(Request $request){
        $data = Account::select([
            "username",
            "password",
            "name",
            "role"            
        ])->get();
        $params = [
            "title"=>"Account",
            "data" => $data
        ];

        return view('account.index', $params);
    }

    public function add(Request $request)
    {
        $id = $request->id;

        if(is_null($id)){
            $data = new Account();
        } else {
            $data = Account::where("username", $id)->first();
        }

        $params = [
            "title"=>"Account",
            "data" => $data
        ];

        return view('account.form', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;

        if(is_null($id)){
            $data = new Account();
            $request->validate([
                'username' => 'required',
                'password' => 'required',
                'name' => 'required'
            ]);
        } else {
            $data = Account::where("username", $id)->first();
            $request->validate([
                'username' => 'required',
                'name' => 'required'
            ]);
        }

        if($request->username == "admin"){
            return redirect()->route('account.add', ['id' => $data->username])
                ->with('status', 'username sudah digunakan !');
        }

        $data->username = $request->username;
        
        if(!is_null($request->password)){
            $data->password = Hash::make($request->password);
        }

        $data->name = $request->name;
        $data->role = $request->role;
        $data->save();
        
        return redirect()->route('account.add', ['id' => $data->username])
                ->with('status', 'Berhasil menambahkan data !');
    }
}
