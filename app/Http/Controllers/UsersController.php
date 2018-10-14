<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Input;
class UsersController extends Controller
{
    public function index(){
        $user = DB::table('users')->select('firstname','lastname','image_url')->where('id',Auth::id())->get();
        return view('profile',['userinfo'=>$user]);
    }
    public function updateprofile(Request $request){
        $this->validate($request, [
            'file' => 'image|max:1999'
        ]);

        if($request->hasFile('file')){
            $file = $request->file('file')->getClientOriginalName();
            $filename = pathinfo($file,PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $filetostore = $filename."_".uniqid().".".$extension;
            $path = $request->file('file')->storeAs('public/profile_pictures',$filetostore);
            DB::table('users')
            ->where('id', Auth::id())
            ->update(['image_url' => $filetostore]);
        }
        return redirect()->back();

    }
}
