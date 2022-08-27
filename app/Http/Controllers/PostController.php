<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $r = Session::get('r');  
            
            if(is_null($r)){
                return redirect()->route('login');
            }

            return $next($request);
        });
        
    }

    public function index(Request $request){

        $data = Post::select([
            "idpost",
            "title",
            "content",
            "username",
            "date"            
        ])->get();

        $params = [
            "title"=>"Post",
            "data" => $data
        ];
        return view('post.index', $params);
    }

    public function add(Request $request)
    {
        $id = $request->id;

        if(is_null($id)){
            $data = new Post();
        } else {
            $data = Post::find($id);
        }

        $params = [
            "title"=>"Post",
            "data" => $data
        ];

        return view('post.form', $params);
    }

    public function save(Request $request)
    {
        $id = $request->id;

        if(is_null($id)){
            $data = new Post();
        } else {
            $data = Post::find($id);
        }
        
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data->title = $request->title;
        $data->content = $request->content;
        $data->date = date('Y-m-d H:i:s');
        $data->username = Session::get('u');
        $data->save();
        
        return redirect()->route('post.add', ['id' => $data->id])
                ->with('status', 'Berhasil menambahkan data !');
    }


    public function delete(Request $request)
    {
        try {
            $id = $request->id;

            $data = Post::find($id);

            $data->delete();

            return redirect()->route('post.index')
                ->with('status', 'Berhasil menghapus data !');

        } catch(\Exception $e)
        {
            return redirect()->route('post.index')
                ->with('status', 'Gagal menghapus data !');
        }
    }
}
