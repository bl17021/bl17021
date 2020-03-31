<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
    <title>新規登録フォーム</title>
</head>
<body>
    <div id="inner">
    <form action="adduser" method="post">
    <div class="title">新規登録フォーム</div>
    @csrf
        <input type="text" name="username" id="username" placeholder=" ユーザ名">
        <input type="password" name="pass" id="pass" placeholder=" パスワード">
        <div id="adduser">
            <input type="submit" value="新規登録" id="submit">
        </div>
    </form>
</div>
    
</body>
</html>