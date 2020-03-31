<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Person;
use Illuminate\Support\Facades\DB;


class GetdbController extends Controller
{
    //タスクデータの取得
    public function getdb(Request $request){
        $loginname=$request->temp2;
        $userlevel=$request->userlevel;
        $tuki=$request->month;
        $hi=$request->day;
        $nowmonth=['tuki'=>$request->month];
        $nowday=['hi'=>$request->day];
        $username=['name'=>$request->temp2];
        ////////////////////////////////////////////////////////////
        $server = "localhost:3309";
        $userName = "root";
        $password = "root";
        $dbName = "todo";
        ////////////////////////////////////////////////////////////
        $sql=DB::select("SELECT * FROM task where username='".$loginname."' and nowmonth='".$tuki."' and nowday='".$hi."'");
        foreach($sql as $key ){
                $taskname[]=$key->taskname;
                $per[]=$key->per;
                $phour[]=$key->phour;
                $pminute[]=$key->pminute;
            }
      return view('grid',compact('taskname','per','loginname','phour','pminute','userlevel'));
    }
}
