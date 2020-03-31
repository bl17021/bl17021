<?php
//$loginname="EMOTO";
//(int)$nowHour=15;
//(int)$nowMinute=0;
//(int)$nowMonth=3;
//(int)$nowDay=17;
    ////////////////////////////////////////////////////////////
    $loginname=$_POST['loginname'];
    $nowMonth=(int) $_POST['nowMonth'];
    $nowDay=(int) $_POST['nowDay'];
    ////////////////////////////////////////////////////////////
    $server = "localhost:3309";
    $userName = "root";
    $password = "root";
    $dbName = "todo";

    //var_dump($loginname);
    //var_dump($nowHour);
    //var_dump($nowMinute);
    ////////////////////////////////////////////////////////////

    $mysqli = new mysqli($server, $userName, $password,$dbName);

    //$sql = "SELECT subtaskname FROM task,subtask where task.$taskname

    $sql="SELECT taskname,username FROM helplist where nowmonth='".$nowMonth."' and nowday='".$nowDay."' and ok=0";
    $helptask = $mysqli -> query($sql);

    //$sql="SELECT username FROM helplist where nowmonth='".$nowMonth."' and nowday='".$nowDay."'";
    //$helpuser = $mysqli -> query($sql);

    foreach($helptask as $helpTask){
        foreach($helpTask as $helpResult){
            $helps[]=$helpResult;
        }
    }
    //var_dump($hourPlan);
    
    //var_dump($minutePlan);
    //var_dump($taskResult);

    ////////////////////////////////////////////////////////////////
    //////////////////////helpListからの取得処理////////////////////
    //////////////////////////////////////////////////////////////
//var_dump($helps);
    header('Content-type: application/json');
    echo json_encode($helps);
?>