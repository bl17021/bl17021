<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    //
    public function adduser(Request $request){
        $param=[
        'name'=>$request->username,
        'pw'=>$request->pass,
        ];
        DB::table('people')->insert($param);
        return view('result',['items'=>$items]);
    }

    
}
