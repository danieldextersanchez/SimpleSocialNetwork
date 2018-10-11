<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Posts as Post;
class Posts extends Controller
{
    //
    public function store(Request $request){
        $this->validate($request, [
            'user_id' => 'required|max:255',
            'post' => 'string|required|max:140',
        ]);
        date_default_timezone_set('Asia/Manila');



        DB::table('posts')->insert([
            'user_id' => $request['user_id'],
            'status' => $request['post'],
            'created_at' => date('Y-m-d G:i:s')
        ]);
        return response()->json([
            'message' => 'Successfully posted'
        ], 200);
    }

}
