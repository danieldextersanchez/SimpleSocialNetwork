<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    public function index(){
        $user = DB::table('users')->select('firstname','lastname','image_url')->where('id',Auth::id())->get();
        return view('profile',['userinfo'=>$user]);
    }
}
