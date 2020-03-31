<?php
    ////////////////////////////////////////////////////////////
    //POSTデータ
    $username=$_POST['username'];
    $taskName=$_POST['taskName'];
    $subTaskName=$_POST['subTaskName'];
    $phour=(int) $_POST['phour'];
    $pminute=(int) $_POST['pminute'];
    $nowmonth=(int) $_POST['nowmonth'];
    $nowday=(int) $_POST['nowday'];
    ////////////////////////////////////////////////////////////
    //DB接続情報
    $server = "localhost:3309";
    $userName = "root";
    $password = "root";
    $dbName = "todo";
    ////////////////////////////////////////////////////////////
    //var_dump($username);
    //var_dump($taskName);
    //var_dump($subTaskName);
    //var_dump($phour);
    //var_dump($pminute);
    //var_dump($nowmonth);
    //var_dump($nowday);
    $mysqli = new mysqli($server, $userName, $password,$dbName);
    $sql="INSERT INTO task (username,taskname,per,phour,pminute,nowmonth,nowday,tf) 
    VALUES('".$username."','".$taskName."',0,'".$phour."','".$pminute."','".$nowmonth."','".$nowday."',0)";
    //$sql="INSERT INTO subtask (username,taskname,subtaskname,tf) VALUES('".$username."','".$taskName."','".$subTaskName."',0)";
    $check = $mysqli -> query($sql);

    if(!$check) {
        echo $mysqli->error;
        exit();
    }

    foreach($subTaskName as $subtask){
    $sql="INSERT INTO subtask (username,taskname,subtaskname,tf,nowmonth,nowday) 
    VALUES('".$username."','".$taskName."','".$subtask."',0,'".$nowmonth."','".$nowday."')";
    $work = $mysqli -> query($sql);
    }

    if(!$work) {
        echo $mysqli->error;
        exit();
    }
    header('Content-type: application/json');
    echo json_encode($work); 
?>