<?php
//$loginname="EMOTO";
//(int)$nowHour=11;
//(int)$nowMinute=0;
//(int)$nowMonth=3;
//(int)$nowDay=17;
    ////////////////////////////////////////////////////////////
    $loginname=$_POST['loginname'];
    $nowHour=(int) $_POST['nowHour'];
    $nowMinute=(int) $_POST['nowMinute'];
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

    $sql="SELECT phour FROM task where username='".$loginname."' and nowmonth='".$nowMonth."' and nowday='".$nowDay."'";
    $phour = $mysqli -> query($sql);

    $sql="SELECT pminute FROM task where username='".$loginname."' and nowmonth='".$nowMonth."' and nowday='".$nowDay."'";
    $pminute = $mysqli -> query($sql);

    $sql="SELECT per FROM task where username='".$loginname."' and nowmonth='".$nowMonth."' and nowday='".$nowDay."'";
    $per = $mysqli -> query($sql);

    $sql="SELECT taskname FROM task where username='".$loginname."' and nowmonth='".$nowMonth."' and nowday='".$nowDay."'";
    $taskname = $mysqli -> query($sql);

    foreach($phour as $pHour){
        foreach($pHour as $hourResult){
            $hourPlan[]=$hourResult;
        }
    }
    //var_dump($hourPlan);
    foreach($pminute as $pMinute){
        foreach($pMinute as $minuteResult){
            $minutePlan[]=$minuteResult;
        }
    }
    //var_dump($minutePlan);
    foreach($per as $Per){
        foreach($Per as $PerResult){
            $perResult[]=$PerResult;
        }
    }

    foreach($taskname as $Taskname){
        foreach($Taskname as $TaskResult){
            $taskResult[]=$TaskResult;
        }
    }
    //var_dump($taskResult);

    ////////////////////////////////////////////////////////////////
    //////////////////////helpListへの追加処理//////////////////////
    //////////////////////////////////////////////////////////////
    $work=0;
    foreach($pminute as $Result){
        //$hourPlanwork=$hourPlan[$work];
        $nowHourwork=$nowHour;
        //var_dump($hourPlanwork);
        ////////////////////////////////////////////////////////
        ///////////////////1桁分の時////////////////////////////
        //////////////////////////////////////////////////////
        if(preg_match('/^([0-9]{1})$/',$minutePlan[$work])){
            $minutePlan[$work]=$minutePlan[$work]+60;
            $nowHourwork=$nowHour+1;
        }
        /*
        if(preg_match('/^([0-9]{1})$/',$nowMinute)){
            (int)$minutePlan[$work]=(int)$minutePlan[$work]-40;
            $hourPlanwork=$hourPlan[$work]+1;
            //var_dump($minutePlan[$work]);
            //var_dump($hourPlanwork);
        }
        //var_dump($taskResult[$work]);*/
        $minuteWork=$minutePlan[$work]-$nowMinute;
        //var_dump($minuteWork);
        ///////////////////////////////////////////////////////
        //var_dump($minuteWork);
        if($perResult[$work]!=100 && $nowHourwork==$hourPlan[$work] && $minuteWork==10){
            $temp=$taskResult[$work];
            $sql="INSERT INTO helplist (username,taskname,nowmonth,nowday,ok) VALUES('".$loginname."','".$temp."','".$nowMonth."','".$nowDay."',0)";
            $task = $mysqli -> query($sql);
        }
    
        $work++;
        $nowHourwork=$nowHour;
    }
    foreach($task as $result){
        foreach($result as $Task){
            $helpTask[]=$Task;
        }
    }
    header('Content-type: application/json');
    echo json_encode($helpTask);
?>