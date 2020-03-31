<?php
    ////////////////////////////////////////////////////////////
    //$id=(int) $_POST['id'];
    $taskname=$_POST['temp'];
    $perResult=(int) $_POST['perResult'];
    //$per=(int) $_POST['per'];
    $username=$_POST['loginname'];
    $server = "localhost:3309";
    $userName = "root";
    $password = "root";
    $dbName = "todo";

    //var_dump($loginname);
    //var_dump($taskname);

     ///////////////////////////////////////////////////////////

    $mysqli = new mysqli($server, $userName, $password,$dbName);

    //$sql = "SELECT subtaskname FROM task,subtask where task.$taskname

    $sql="UPDATE task SET per='".$perResult."' where taskname='".$taskname."' and username='".$username."'";

    $work = $mysqli -> query($sql);



    //var_dump($username);
    //var_dump($perResult);
    //var_dump($taskname);    

    //$sub=array();
    //$json=array();
    
    /*foreach($work as $result){
        foreach($result as $name){
            $sub[]=$name;
       // $sub[]=array(
        //    'subtaskname'=>$name['subtaskname']
        //);
        //var_dump($sub);
        //$json = json_encode($sub,JSON_UNESCAPED_UNICODE);
        
        //var_dump($json);
        }
    }*/
    
    //var_dump($sub);

    if(!$work) {
        echo $mysqli->error;
        exit();
    }
    //var_dump($sub);
    
    
    //$json = json_encode($sub,JSON_UNESCAPED_UNICODE);
    header('Content-type: application/json');
    echo json_encode($work);
    //print($json);
    
    //echo $json;

   /* try {
        $dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser, $dbpass);
    // PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
    } catch (PDOException $e) {
        // 接続できなかったらvar_dumpの後に処理を終了する
        var_dump($e->getMessage());
        exit;
    }*/
    
    // データ取得用SQL
    // 値はバインドさせる
    //$sql = "SELECT subtaskname FROM subtask WHERE username=".$loginnane."";
    // SQLをセット
//$stmt = $dbh->prepare($sql);
    // SQLを実行
    //$stmt->execute(array($id));
    
    // あらかじめ配列$productListを作成する
    // 受け取ったデータを配列に代入する
    // 最終的にhtmlへ渡される
   // $productList = array();
    
    // fetchメソッドでSQLの結果を取得
    // 定数をPDO::FETCH_ASSOC:に指定すると連想配列で結果を取得できる
    // 取得したデータを$productListへ代入する
    /*while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $productList[] = array(
            'id'    => $row['id'],
            'name'  => $row['name'],
            'price' => $row['price']
        );
    }*/
    
    // ヘッダーを指定することによりjsonの動作を安定させる
    //header('Content-type: application/json');
    // htmlへ渡す配列$productListをjsonに変換する
   // echo json_encode($productList);


    
?>