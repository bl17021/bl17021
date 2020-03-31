<?php
    ////////////////////////////////////////////////////////////
    //$id=(int) $_POST['id'];
    $loginname=$_POST['username'];
    $taskname=$_POST['taskname'];
    $nowMonth=(int) $_POST['nowMonth'];
    $nowDay=(int) $_POST['nowDay'];
    //$username="EMOTO";
    $server = "localhost:3309";
    $userName = "root";
    $password = "root";
    $dbName = "todo";

    //var_dump($loginname);
    //var_dump($taskname);

     ///////////////////////////////////////////////////////////

    $mysqli = new mysqli($server, $userName, $password,$dbName);

    //$sql = "SELECT subtaskname FROM task,subtask where task.$taskname

    $sql="SELECT subtaskname FROM subtask where username='".$loginname."' and taskname='".$taskname."' and nowmonth='".$nowMonth."' and nowday='".$nowDay."'";

    $work = $mysqli -> query($sql);

    

    $sub=array();
    //$json=array();
    
    foreach($work as $result){
        foreach($result as $name){
            $sub[]=$name;
        
        }
    }
    
    //var_dump($sub);

    if(!$result) {
        echo $mysqli->error;
        exit();
    }
    //$json = json_encode($sub,JSON_UNESCAPED_UNICODE);
    header('Content-type: application/json');
    echo json_encode($sub);
?>