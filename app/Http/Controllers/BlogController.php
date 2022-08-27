<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class BlogController extends Controller
{

    public function index(Request $request){
        $data = Post::select([
            "idpost",
            "title",
            "content",
            "username",
            "date"            
        ])->orderBy('idpost', 'desc')->first();

        $params = [
            "title"=>"Blog",
            "data" => $data
        ];

        return view('blog.index', $params);
    }

}
