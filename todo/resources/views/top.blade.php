<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
    <title>task管理</title>
</head>
<body>
    <div id="inner">
        <div class="title">タスク管理<div id="pike">made by パイク</div></div>
        
        <div class="top-form">
            <form action="public/register" method="post">
                @csrf
                <input type="submit" value="新規登録" id="register">
            </form>

            <form action="public/loginform" method="post">
                @csrf
                <input type="submit" value="ログイン" id="login">
            </form>
            
        </div>
        <!--<input type="button" value="English">-->
    </div>
</body>
</html>