<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Person;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    //ユーザの新規登録
    public function adduser(Request $request){
        
       $username=$request->username;
       $pass=$request->pass;
        //DB::table('people')->insert($param);
        DB::insert('insert into people (username, pw) values (?, ?)', [$username, $pass]);
        return view('result',compact('username','pass'));
    }

    public function login(Request $request){
        
        $username=['name'=>$request->username];
        $pass=['pass'=>$request->pass];
        $items=DB::select('select * from people where username = :name',$username);
        $user=DB::select('select username from people where username = :name',$username);
        $level=DB::select('select lv from people where username = :name',$username);
        ////////////////////////////////////////////////////////////////////////////////
        $loginWork=DB::table('people')->where('username','=',$username)->where('pw','=',$pass)->get();
        $nameWork=DB::table('people')->where('username','=',$username)->get();
        $passWork=DB::table('people')->where('pw','=',$pass)->get();
        foreach($nameWork as $nwork){
            $nresult=$nwork;
        }
        foreach($passWork as $pwork){
            $presult=$pwork;
        }
        //var_dump($passWork);
        if(isset($presult) && isset($nresult)){
            foreach($loginWork as $login){
            }
            $name=$login->username;
        ////////////////////////////////////////////////////////////////////////////////
            $i=0;
            $work=0;
        foreach($items as $key ){   
        foreach($key as $result){
           // $first=array_shift($result);
           //var_dump($result);
            if($i==0){
                $work=$result;
            break;
            }
        }
        }
        foreach($user as $temp1 ){
            
            foreach($temp1 as $temp2){
            }
        }
        foreach($level as $lv){
            foreach($lv as $userlevel){
            }
        }
        return view('success',compact('temp2','userlevel'));
     }
     else{
        return view('faild');
      }
    }
}

