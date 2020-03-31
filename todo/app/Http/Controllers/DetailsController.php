<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Person;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    //詳細タスクの登録
    public function details(Request $request){
        $result=$request->taskname;
        var_dump($result);
    }
}
