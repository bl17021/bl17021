<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/formstyle.css')}}">
    <title>ログインフォーム</title>
</head>
<body>
    <div id="inner">
    <form action="login" method="get">
    <div class="title">ログインフォーム</div>
          @csrf
          <input type="text" name="username" id="username" placeholder=" ユーザ名">
          <input type="password" name="pass" id="pass" placeholder=" パスワード">
          <input type="submit" value="ログイン" id="loginbtn">
    </form>
    </div>
</body>
</html>