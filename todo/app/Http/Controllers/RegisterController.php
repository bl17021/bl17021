<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //ユーザの新規登録
    public function adduser(Request $request){
        
       $username=$request->username;
       $pass=$request->pass;
        //DB::table('people')->insert($param);
        DB::insert('insert into people (name, pw) values (?, ?)', [$username, $pass]);
        return view('result',compact('username','pass'));
    }
}
