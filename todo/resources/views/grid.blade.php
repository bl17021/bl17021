<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="{{asset('css/gridstyle.css')}}">
    <title>ToDo List</title>
</head>
<body onload="observer();">
<div id="container"> <!-- コンテナ -->
    <div id="itemA">
        <div id="RealtimeClockArea2"></div>
         <script>
            function showClock2() {
                //今日の日付データを変数hidukeに格納
                var hiduke=new Date();
                //時刻データを取得して変数jikanに格納する
                var jikan= new Date();
                //時・分・秒を取得する
                var hour = jikan.getHours();
                var minute = jikan.getMinutes();
                var second = jikan.getSeconds();
                //年・月・日・曜日を取得する
                var year = hiduke.getFullYear();
                var month = hiduke.getMonth()+1;
                var week = hiduke.getDay();
                var day = hiduke.getDate();

                var yobi= new Array("日","月","火","水","木","金","土");
                var msg=month+"月"+day+"日 "+yobi[week]+"曜日"+hour+"時"+minute+"分"+second+"秒";

                document.getElementById("RealtimeClockArea2").innerHTML = msg;
            }
        setInterval('showClock2()',1000);
        </script>
    </div> <!-- アイテムA -->

    <div id="itemB"><!-- アイテムB -->
        <div id="nameplate">
            <span id="level">Lv.{{$userlevel}}</span><!--Lv.-->
            <span class="username">{{$loginname}}</span><!--name-->
        </div>
    </div>

    <div id="itemC"><!-- アイテムC -->
        <h1 class="gridh1">本日の予定</h1>

        <?php
            /////////////////////////////////////////////////
            //初期設定
            $a=0;
            $p=0;
            $k=0;
            $nowid[]=0;

            $taskwork[]=0;
            $taskwork=$taskname;

            $i=0;
            $itemname[]=0;

            $j=0;
            $perwork[]=0;
            $temp[]=0;
            $perwork=$per;

            $btnflame[]=0;

            foreach($perwork as $per){
                $temp[$j]=$per;
                $j=$j+1;
            }
            /////////////////////////////////////////////////
        foreach($taskwork as $taskname){
                $btnflame[]="btn".$k;
                $task[]=$taskname;
                $btnid[]="btn".$k;
            ?><div class="tasks{{$k}}" style="margin-left: 10px;"><input type="button" value="+" class="{{$task[$k]}}{{$k}}" style="margin: 0 3px 0 5px; border-radius: 5px; background-color: #007b43; color: #fff"><input type="button" id="{{$task[$k]}}{{$k}}" value="{{$task[$k]}}" style="display: inline;"></div>
            <div style="text-align: center;"><input type="button" class="finish{{$k}}" style="margin: 0 3px 7px 5px; border-radius: 5px; background-color: #b7282e; color: #fff; font-weight: bold;" value="完了!"></div>
            <script>
                $('.finish{{$k}}').on('click',function(){
                    var nowTime=new Date();
                    var nowMonth = nowTime.getMonth()+1;
                    var nowDay = nowTime.getDate();
                    var text=$('#{{$task[$k]}}{{$k}}').val();
                        $.ajax({
                        type:'POST',
                        url:'http://localhost/todo/resources/views/finish.php',
                        dataType: 'json',
                        data:{
                            "username":"{{$loginname}}",
                            "finishtask":text,
                            "nowMonth":nowMonth,
                            "nowDay":nowDay
                        }
                    })//ajax閉じタグ
                    .then(
                        function(ok){
                            console.log(ok);
                            $('#item{{$k}}').css('width','100%');
                            $('#level').remove();
                            $('.username').before().append('<span>Lv.'+ok+'</span>')
                            alert('時間内に終わりました！\nレベルUp！!');
                        },
                        function(){
                            console.log("読み込み失敗");
                        });
                });
                
            </script>
            <script>
                $('#{{$task[$k]}}{{$k}}').css('text-align','center');
               
                
                $('#{{$task[$k]}}{{$k}}').css({
                                        'display': 'inline-block',
                                        'background-color': '#68be8d',
                                        'color': '#FFF',
                                        'font-weight': 'bold',
                                        'font-size': '12px',
                                        'width': '150px',
                                        'height': '35px',
                                        'padding': '3px',
                                        'text-decoration': 'none',
                                        'border-radius': '5px',
                                        'box-shadow': '0 2px 2px 0 rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.12), 0 3px 1px -2px rgba(0,0,0,0.2)',
                                        '-webkit-tap-highlight-color': 'transparent',
                                        'transition':'.3s ease-out',
                                        'margin': '0 auto 12px 0'       
                });
            </script>
            <script>
            var subtask=document.createElement('div');
            subtask.className='subtask';
            var count=0;     
        /////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////タスクボタンを押した時///////////////////////////////
        //////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////
        $('.{{$task[$k]}}{{$k}}').on('click',function(){
            if(count==0){
                $('.{{$task[$k]}}{{$k}}').val('-');
                var nowTime=new Date();
                var nowMonth = nowTime.getMonth()+1;
                var nowDay = nowTime.getDate();
            $.ajax({
                    //リクエスト方法
                    type:"POST",
                    //送信先ファイル
                    url:"http://localhost/todo/resources/views/getdb.php",
                    //受け取りデータの種類
                    datatype:"json",
                    //送信データ
                    data:{
                        "username":"{{$loginname}}",
                        "taskname":$('#{{$task[$k]}}{{$k}}').val(),
                        "nowMonth":nowMonth,
                        "nowDay":nowDay
                        },
                    //通信成功時
                    success:function(data){
                                        var tf=0;
                                        var id=[];
                                        var count=0;
                                        var val=0;
                                        $.each(data,function(key,value){
                                            $('.tasks{{$k}}').append('<div style="color: #fff; text-top: 5px;">'+data[tf]+'<input type=checkbox value=1 name='+'{{$task[$k]}}'+' id="'+data[tf]+'">'+'</div>');
                                            tf++;
                                        });
                                        $('input[type="checkbox"]').css('width','20px');
                                        $('input[type="checkbox"]').css('height','20px');
                                        //チェックボックスの状態を変化させた時の処理
                                        $('input[name={{$task[$k]}}]').change(data,function(key,value) {
                                            var temp="{{$task[$k]}}";
                                            //チェックされている個数
                                            var cnt= $('input[name={{$task[$k]}}]:checked').length;
                                            //チェックボックスの個数
                                            var all= $('input[name={{$task[$k]}}]').length;
                                            perWork(temp);
                                        function perWork(temp){
                                            //進捗率計算
                                            var per=100/all*cnt;
                                            //小数点以下切り捨て
                                            var perResult=Math.floor(per);
                                            pertemp(temp,perResult);
                                            function pertemp(temp,perResult){
                                                $('.'+temp+' .item').css('width',perResult+'%');
                                                $('.'+temp+' .item:first').text(perResult+'%');

                                                $.ajax({
                                                    type:'POST',
                                                    url:'http://localhost/todo/resources/views/perchange.php',
                                                    dataType: 'json',
                                                    data:{
                                                        "loginname":"{{$loginname}}",
                                                        "temp":temp,
                                                        "perResult":perResult
                                                    }//data:閉じタグ
                                                })//183行目 ajax閉じタグ
                                                .then(
                                                    //通信成功時
                                                    function(res){
                                                        //console.log(res);
                                                    },
                                                    function(){
                                                        console.log("読み込み失敗");
                                                    });
                                            
                                            }
                                        }//end perwork
                                    });//end inputChange
                    }
            
            });
            count=1;
            }//if終わり
            else if(count==1){
                //console.log(count);
                $('.{{$task[$k]}}{{$k}}').val('+');
                $('.tasks{{$k}}').children('div').remove();
                var tes="{{$task[$k]}}";
                count=0;
            }//else if終わり
        });          
            </script>
            <?php
                $k=$k+1;
            }//itemCのforeach終了
            ?>
        </div><!--itemC-->

        <div id="itemD">
            <h1 class="gridh1">進捗率</h1>
        <?php
        foreach($taskwork as $result){
            $itemname="item".$i;
            ?>

            <div class="taskbars {{$task[$i]}}">
                <div class="item" id="{{$itemname}}">
                    <span class="itemlabel">{{$temp[$i]}}%</span>
                </div>
            </div>
            <script>
                $('.taskbars').css({
                                    'background-color':'#a5cfe7',
                                    'height':'25px',
                                    'width':'150px',
                                    'display':'block',
                                    'flex-direction':'column',
                                    'justify-content':'space-evenly',
                                    'margin': '0 auto',
                                    'margin-bottom':'60px'
                                    });

                $('.itemlabel').css('white-space','nowrap');

                $('#{{$itemname}}').css({
                                    'background-color':'rgb(71,160,201)',
                                    'box-sizing':'border-box',
                                    'width':'{{$temp[$i]}}'
                                    });

                                   
            </script>
        <?php
            $i=$i+1;
        }
        ?>
        </div><!--itemD-->  
    <div id="itemE">
        <h1 class="gridh1">目標時刻</h1>
        <div class="timeplan" style="text-align: center;">
            <span class="nowHour" style="text-align: center;"></span><span class="nowMinute" style="text-align: center;"></span>
            <!--<span>現在時刻/</span><span>目標時刻</span>-->
        </div>
        <div class="HourMinute">
            
        </div>
        <?php
            $taskplan=0;
            foreach($phour as $hour){
                $hourPlan[]=$hour;
            }
            foreach($pminute as $minute){
                $minutePlan[]=$minute;
            }
            foreach($phour as $countWork){
            ?>
            <script>
            $('.HourMinute').append('<span class="nowTime" style="text-align: center;"></span>');
            $('.HourMinute').append('<span class="timePlan" style="text-align: center;">{{$hourPlan[$taskplan]}}時{{$minutePlan[$taskplan]}}分</span><div style="width: 30px; height: 60px;"></div>');
            $('.nowTime').ready(function(){
                var nowTime=new Date();
                var nowHour = nowTime.getHours();
                var nowMinute = nowTime.getMinutes();
                $('.nowTime').text(nowHour+"時"+nowMinute+"分/");
            });
            </script>
            <?php
            $taskplan++;
            }
            ?>
    </div>

    <div id="itemF">
        <h1 class="gridh1">Help List</h1>
        <script>
        helpObserver();
        /////////////////////helpList監視///////////////////////////
        function helpObserver(){
        var nowTime=new Date();
        var nowMonth = nowTime.getMonth()+1;
        var nowDay = nowTime.getDate();
        var uc=1;
        var tc=0;

        $.ajax({
            type:'POST',
            url:'http://localhost/todo/resources/views/getHelp.php',
            dataType: 'json',
            data:{
            "loginname":"{{$loginname}}",
            "nowMonth":nowMonth,
            "nowDay":nowDay
            }
        })//ajax閉じタグ
        .then(
        //通信成功時
        function(helps){
            $('.helpwrapper').remove();
            for(var i=0; i<helps.length/2;i++){
            $('#itemF').append('<div class="helpwrapper" style="margin: 0 auto 10px auto; width: 250px; text-align: center;"><div class="help'+i+'" style="text-align: center; border: solid 3px #007b43; border-radius: 6px; margin: 3px; color: #fff; font-weight: bold"><div class="helptask'+i+'">'+helps[tc]+'</div><div class="helpuser'+i+'">'+helps[uc]+'</div></div><input type="button" id="helpbtn'+i+'" class="hbtn" value="ヒーローになる" style="border-radius: 5px; background-color: #b7282e; color: #fff; font-weight: bold; height: 40px;"></div>');
            tc=tc+2;
            uc=uc+2;
            }
            
            $('.hbtn').on('click',function(){
                var id = $(this).attr("id");
                var idEnd=id.slice(-1);
                
                var helptask=$('.helptask'+idEnd).text();
                var helpuser=$('.helpuser'+idEnd).text();

                $.ajax({
                    type:'POST',
                    url:'http://localhost/todo/resources/views/hero.php',
                    dataType: 'json',
                    data:{
                        "username":"{{$loginname}}",
                        "helptask":helptask,
                        "helpuser":helpuser,
                        "nowMonth":nowMonth,
                        "nowDay":nowDay
                    }
                })//ajax閉じタグ
                .then(
                    function(ok){
                        //console.log(ok);
                        $('#level').remove();
                        $('.username').before().append('<span>Lv.'+ok+'</span>')
                        alert('レベルUp！!')
                    },
                    function(){
                        console.log("読み込み失敗");
                    });
                
        });
            
        },
        function(){
            console.log("読み込み失敗");
        });
    }
        setInterval('helpObserver()',10000);
        </script>
    </div>
    </div><!--コンテナ-->
<script>
    function observer(){
        var nowTime=new Date();
        var nowHour = nowTime.getHours();
        var nowMinute = nowTime.getMinutes();
        $('.nowTime').text(nowHour+"時"+nowMinute+"分/");
    }
    setInterval('observer()',1000);
</script>
<script>
    function timeObserver(){
        var nowTime=new Date();
        var nowMonth = nowTime.getMonth()+1;
        var nowDay = nowTime.getDate();
        var nowHour = nowTime.getHours();
        var nowMinute = nowTime.getMinutes();
        $.ajax({
                type:'POST',
                url:'http://localhost/todo/resources/views/timeObserver.php',
                dataType: 'json',
                data:{
                    "loginname":"{{$loginname}}",
                    "nowHour":nowHour,
                    "nowMinute":nowMinute,
                    "nowMonth":nowMonth,
                    "nowDay":nowDay
                }//data:閉じタグ
        })//183行目 ajax閉じタグ
        .then(
            //通信成功時
            function(res){
                //console.log(res);
            },
            function(){
                console.log("helpList行きのタスクはありません");
            });
    }
    setInterval('timeObserver()',60000);
</script>
</body>
</html>