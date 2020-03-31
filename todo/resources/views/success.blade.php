<!DOCTYPE html>
<html lang="ja" style="font-family: 'Arial', sans-serif; height: 100%; width: 100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="{{asset('css/success.css')}}">
    <title>Success</title>
</head>
<body style="background-color: #3eb370; font-family: 'Arial', sans-serif; height: 100%; width: 100%;">
<?php
//var_dump($userlevel);
?>
    <p style="font-size: 40px; color: #fff; text-align: center; -webkit-text-stroke: 1px #007b43; font-weight: bold;">ようこそ{{$temp2}}さん！</p>
    <p style="font-size: 35px; color: #fff; text-align: center; -webkit-text-stroke: 1px #007b43; font-weight: bold;">今日のタスクを確認しましょう！</p>
    <div id="container" style="width: 80%; text-align: center; margin: 0 auto">
        <div id="itemA" style="background-color: #68be8d; border: #007b43 solid 3px; border-radius: 5px;">
            <h1 style="color: #fff; margin: 10px 0 10px 5px; -webkit-text-stroke: 1px #007b43;">タスクの登録</h1>
            <span style="padding-right: 15px;">タスク名</span>
            <input type="text" name="task" id="task"><br>
            <div class="timeWrap" style="margin-left: -56px;">
            <span style="padding-right: 25px;">目標時刻</span>
            <input type="text" id="ji" style="width: 25px; margin-left: -10px; margin-right: 5px;"><span style="margin-right: 5px;">時</span>
            <input type="text" id="hun" style="width: 25px; margin-right: 5px;"><span>分</span><br>
            </div>
            <div id="sub" style="display: inline-block;">
                <span>サブタスク</span>
                <input type="text" id="details0"><br>
            </div>
            <div id="add">
                <input type="button" value="サブタスクを追加" id="plus" style="margin-left: 40px; cursor: pointer;">
                <br>
                <input type="button" value="送信" id="toright" style="cursor: pointer;">
            </div>
            <script>
                $('#plus').on('click',function(){
                    //console.log(count);
                    $('#sub').append('<div id="sub" style="display: inline-block;"><span>サブタスク </span><input type="text" id="details'+count+'"</div>');
                    count++;
                    //
                });            
            </script>
            
        </div>
        <script>
            var count=1;
            var rdetails=new Array();
            $('#toright').on('click',function(){
                var jikan= new Date();
                //年・月・日・曜日を取得する
                var month = jikan.getMonth()+1;
                var week = jikan.getDay();
                var day = jikan.getDate();
                var hour = jikan.getHours();
                var minute = jikan.getMinutes();

                var rtask=$('#task').val();
                var rji=$('#ji').val();
                var rhun=$('#hun').val();
                $('#itemB').append('<div>タスク名:'+rtask+'</div>');
                $('#itemB').append('<div>目標時刻:'+rji+'時'+rhun+'分</div>');
                for(k=0;k<count;k++){
                    rdetails[k]=$('#details'+k).val();
                    $('#itemB').append('<div>サブタスク:'+rdetails[k]+'</div>');
                }
                $.ajax({
                    type:"POST",
                    url:"http://localhost/todo/resources/views/addTask.php",
                    datatype:"json",
                    data:{
                        "username":"{{$temp2}}",
                        "taskName":rtask,
                        "subTaskName":rdetails,
                        "phour":rji,
                        "pminute":rhun,
                        "nowmonth":month,
                        "nowday":day
                    }
                }).then(
                    //通信成功時
                    function(hoge){
                        console.log(hoge);
                    },
                    function(){
                        console.log("読み込み失敗");
                    });
                $('#task').val('');
                $('#ji').val('');
                $('#hun').val('');
                for(var i=0;i<=count;i++){
                $('#details'+i).val('');
                $('#sub').children('div').remove();
                }
                //console.log(count);
                count=1;
            });
        </script>
        <div id="itemB" style="background-color: #68be8d; border: #007b43 solid 3px; border-radius: 5px;">
            <h1 style="color: #fff; margin: 10px 0 10px 5px; -webkit-text-stroke: 1px #007b43;">追加されたタスク</h1>
        </div>
    </div>

    <form action="getdb" method="post" style="text-align: center; margin-top: 20px;">
    @csrf
    <input type="hidden" value="{{$temp2}}" name="temp2">
    <input type="hidden" name="month" id="month" value="">
    <input type="hidden" name="day" id="day" value="">
    <input type="hidden" name="userlevel" id="userlevel" value="{{$userlevel}}">
    <script>
        var md=new Date();
        var tuki=md.getMonth()+1;
        //tuki=perseFloat(tuki);
        var hi=md.getDate();
        //hi=perseFloat(hi);
        $('#month').val(tuki);
        $('#day').val(hi);
        //var work1=$('#month').val();
        //var work2=$('#day').val();
    </script>
    
    <input type="submit" value="登録完了" class="btn" style="cursor: pointer; line-height: 50px; height: 50px; text-align: center; width: 250px; border-radius: 15px; background-color: #68be8d; box-shadow: 4px 4px #007b43; font-weight: bold; color: #fff; font-size: 15px;">
    <script>
        $('.btn').hover(
            function(){
                $('.btn').css('box-shadow','-6px -6px #007b43')
            },
            function(){
                $('.btn').css('box-shadow','4px 4px #007b43')
            }
        );
    </script>
    </form>
</body>
</html>