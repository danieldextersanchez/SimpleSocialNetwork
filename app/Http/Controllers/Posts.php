<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Posts as Post;
use Illuminate\Support\Facades\Auth;
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

    /*
SELECT users.firstname,users.lastname,users.username,users.image_url, posts.*, NULL as message
FROM `users` INNER JOIN `posts` ON users.id = posts.user_id 
UNION ALL
SELECT users.firstname,users.lastname,users.username,users.image_url, posts.*, share.message
FROM `share` INNER JOIN `posts` ON share.user_id = posts.user_id 
INNER JOIN `users` ON users.id = share.user_id 
    */

    public function posts(Request $request){
        $users = DB::table('users')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->select(DB::raw('users.firstname,users.lastname,users.username,users.image_url,posts.*')  )
        ->orderBy('posts.created_at', 'desc')->get();
        return view('layouts.posts')->with('posts',$users);
    }

    public function delete(Request $request){
        $userid =  DB::table('posts')->select('user_id')->where('id',$request->postid)->get()[0]->user_id;
        if(Auth::id() !=  $userid){
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }else{
            DB::table('posts')->where('id',$request->postid)->delete();
            return $request->postid;
        }
    }
    public function retweet(Request $request){
        DB::table('share')->insert([
            'user_id' => Auth::id(),
            'posts_user_id' => $request->user_id,
            'post_id' => $request->post_id ,
            'message' => $request->message,
            'created_at' => date('Y-m-d G:i:s')
        ]);
        return response()->json([
            'message' => 'Successfully reshared'
        ], 200);    
    }

}
