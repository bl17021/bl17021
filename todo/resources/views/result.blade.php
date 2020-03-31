<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Refresh" content="3,http://localhost/todo/public/">
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
    <title>Result</title>
</head>
<?php
$username=$_POST['username'];
?>
<body>
    <div id="inner" class="result-inner">
        <p class="result huti3"><span id="welcome" class="huti4">登録が完了しました！</span><br><span id="ok">ようこそ{{$username}}さん！</span></p>
        <p class="result huti3" id="back">３秒後にトップページに戻ります。</p>
    </div>
 
</body>
</html>