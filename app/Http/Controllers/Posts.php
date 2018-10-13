<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Posts as Post;
class Posts extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required|max:255',
            'post' => 'string|required|max:140',
        ]);
        DB::table('posts')->insert([
            'user_id' => $request['user_id'],
            'status' => $request['post'],
            'created_at' => date('Y-m-d G:i:s')
        ]);
        return response()->json([
            'message' => 'Successfully posted'
        ], 200);
    }
    public function index(){
        $users = DB::table('users')->join('posts', 'posts.user_id', '=', 'users.id')
        ->select('users.firstname','users.lastname','users.username','users.image_url','posts.*')->orderBy('posts.created_at', 'desc')->get();
        return view('welcome')->with('posts',$users);
    }

}
