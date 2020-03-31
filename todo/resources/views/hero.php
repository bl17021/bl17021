<?php
    ////////////////////////////////////////////////////////////
    //POSTデータ
    $username=$_POST['username'];
    //var_dump($username);
    //$taskName=$_POST['taskName'];
    //$subTaskName=$_POST['subTaskName'];
    $helptask=$_POST['helptask'];
    $helpuser=$_POST['helpuser'];
    $nowmonth=(int) $_POST['nowMonth'];
    $nowday=(int) $_POST['nowDay'];
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
    $sql="UPDATE helplist SET ok = '1' WHERE taskname='".$helptask."' and username='".$helpuser."' and nowmonth='".$nowmonth."' and nowday='".$nowday."'";
    //$sql="INSERT INTO subtask (username,taskname,subtaskname,tf) VALUES('".$username."','".$taskName."','".$subTaskName."',0)";
    $check = $mysqli -> query($sql);

    $sql="SELECT lv FROM people WHERE username='".$username."'";
    $lv = $mysqli -> query($sql);

    foreach($lv as $result){
        foreach($result as $lvResult){
            $level[]=$lvResult;
        }
    }
    //var_dump($level);
    (int)$levelwork=$level[0];
    $levelwork=$levelwork+1;
    //var_dump($levelwork);
    $sql="UPDATE people SET lv='".$levelwork."' WHERE username='".$username."'";
    $lvWork = $mysqli -> query($sql);
    if(!$check) {
        echo $mysqli->error;
        exit();
    }

    header('Content-type: application/json');
    echo json_encode($levelwork);
?>