
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>الشكاوى و المقترحات</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: url('/svg/q.png') no-repeat center center fixed;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
            width:100%;

        }
#topp{
    width: 100%;
    height: 70px;
    background: #0c5460;
    position: absolute;
}
#right{
    padding-top: 7%;
    height: 90%;
    width: 40%;
    float: right;


}
#left{
    padding-top:6%;
    height: 90%;
    width: 60%;
    float: left;

}
#back{
    padding:   1% 20px;
    font-size: 19px;
    float: left;
    width: 10%;
    background: #0d3349;
}
td{
    display: inline-block;
}
.tra{
    padding: 3%;
    margin: auto;
    width: 78%;
    height: 30%;
    border: 15px solid #0d3349;

    position: relative;
}
        #confirm {
            display: none;
            background-color: #9fcdff;
            border: 3px solid #0d3349;
            position: fixed;
            width: 25%;
            height: 210px;
            top: 40%;
            left: 40%;
            margin-left: -100px;
            padding: 6px 8px 8px;
            box-sizing: border-box;
            text-align: center;
        }
        #confirm button {
            background-color: #0d3349;
            display: inline-block;
            border-radius: 5px;
            border: 1px solid #aaa;
            color: whitesmoke;
            padding: 5px;
            text-align: center;
            width: 80px;
            cursor: pointer;
        }
        #confirm button:hover{
            background-color: #1d68a7;
        }


        #confirm .message {
            background-color: #0d3349;
            text-align: center;
            font-size: 20px;
            color: whitesmoke;

        }

    </style>
    <script>
        $(document).ready(function() {
            $('#ask').bind('change', function() {
                var elements = $('div.container').children().hide(); // hide all the elements
                var value = $(this).val();

                if (value.length) { // if somethings' selected
                    elements.filter('.' + value).show(); // show the ones we want
                }
            }).trigger('change');

        });
        $(document).ready(function(){

            $(".hiddenInput").hide();
            $(".showHideCheck").on("change", function() {
                $this = $(this);
                $input = $this.parent().find(".hiddenInput");
                if($this.is(":checked")) {
                    $input.hide();
                } else {
                    $input.hide();
                }
            });
        });
        function setFocusToTextBox(){
            document.getElementById("name").focus();
        }
        function functionConfirm(msg, myYes, myNo) {
            var confirmBox = $("#confirm");
            var a=  document.getElementById("check").checked;
            if( a === true){
                confirmBox.find(".message").text(msg);
                confirmBox.find(".yes,.no").unbind().click(function() {
                    confirmBox.hide();
                });
                confirmBox.find(".yes").click(myYes);
                confirmBox.find(".no").click(myNo);
                confirmBox.show();
            }else {
                confirmBox.hide();
            }

        }
        function setcheck() {
            document.getElementById("check").checked = false;
            $(".hiddenInput").hide();
        }
        function setcheckyes() {
            document.getElementById("check").checked = true;
            $(".hiddenInput").show();
        }
        $(document).ready(function() {
            if (!$.cookie("urlCookie")) {
                var url = document.referrer;
                var match = url.indexOf("localhost");
                if (match !== -1) {
                    $.cookie("urlCookie", url);
                    $("#back").html(url);
                }
            } else {
                $("#back").html($.cookie("urlCookie"));
            }
        });



    </script>

</head>


<body>
<div id="topp">
    <button  id="back"
             formaction="<?php
             use Illuminate\Support\Facades\DB;
             $db=DB::select('select * from countin');
             $num=array();
             foreach ($db as $usera) {
                 $count=$usera->count;
                 $num[] = $count;
             }
             $insert =$num[0] +1;
             DB::update('update countin set count=? where id=?', [$insert,1]);

             ?>"

             class="btn btn-primary btn-block" onclick="window.location.href = './welcome';" role="button">back</button>
    <center>
        <h2 style="color: whitesmoke;padding-right: 10%">الشكاوى و المقترحات</h2>
    </center>
</div>
<br><br><br>
@if(session()->has('Sucess'))
    <center>
        <div class="alert alert-success " style="width: 20%;border: darkred 1px solid;">
            <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
            <button type="button" class="btn-primary" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
        </div></center>
@endif

<div id="right">
    <form action="/insertRequest" method="post" id="contact-form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <center>

    <select class="form-control" style="font-size: 25px;color: #000000;border: 2px solid #0d3349; width: 85%;height: 15%;direction: rtl" id="ask" name="ask"  required autofocus>

        <option  value="شكوى" >شكوى</option>
        <option  value="مقترح" >مقترح</option>
    </select>
        <br>
        <div class="container" style="width: 85%">
            <div class="شكوى">
                <br>
                <select class="form-control" style="font-size: 25px;color: #000000;border: 2px solid #0d3349; width: 85%;height: 15%;direction: rtl" name="que"  id="que" >
                    <option value="">نوع الشكوى</option>
                    <option value="شكوى بخصوص الشركة">شكوى خاصة بالشركة</option>
                    <option value="شكوى خاصة">شكوى شخصية</option>
                </select>
            </div>
            <div class="مقترح">

            </div>
        </div>

        <br>
        <h3 style="font-weight: bold;color: #000000;">من فضلك أدخل شكواك أو مقترحك </h3>

        <textarea style="width: 85%;height: 330px;font-size: 25px;text-align: start;unicode-bidi: plaintext;border: 5px solid #0d3349;"
                  id="problem" required class="form-control" name="problem" ></textarea>
        <br>
        <table >
            <tr >
                <td>
                    <div style="direction: rtl ;display: flex ;" class="option">
                       <input class="showHideCheck" style="zoom:2.5;" type="checkbox" id="check" name="check"
                              onclick = 'functionConfirm("مصادقة الكترونية")'
                              value="Bike">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <h3 style=" color: #000000; ">زر التعريف </h3> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <div style="padding: 10px" class="hiddenInput">

                            <input  style="width: 120%;padding: 2px;font-size: 17px;border: 2px solid #0d3349;"
                                    id="name" type="text" autocomplete="off" class="form-control hiddenInput"
                                    name="name" autofocus placeholder="أدخل اسمك هنا" onkeypress="return /[a-z  ء ي أ-ى ]/i.test(event.key)" >
                        </div>
                    </div>
                </td>
            </tr>
        </table><br><br>



        <button type="submit" style="width: 35%;font-size: 18px ;color: whitesmoke;background: #0d3349"
                  class="btn btn-primary btn-block">
            Save
        </button>


    </center>
    </form>
</div>


<div id="left">
    <br><br><br><br><br>
    <center>
        <div class="tra">
        <h1 style="font-size: 30px;color: #000000;text-align: justify;direction: rtl">
            حرصا من ادارة الشركة علي خلق بيئه صحية وتنافسية
            لموظفيي شركة أروب للتامين وسعيا للتميز والتحسين المستمر تم تطوير
            الية تقديم الشكاوي والمقترحات بالشركة وذلك لضمان الارتقاء بمستوي الخدمات
            وعلاج اي قصور قد يؤثرعلي الرضا العام عن الشركة سواء من جانب موظفيها
            او عملائها لذا قامت ادارة تكنولوجيا المعلومات بتطوير برنامج الاجازات الخاص
            بموظفين شركة آروب للتأمين و ذلك باضافة خانة للشكاوي و المقترحات قبل الدخول علي النظام
            وذلك حتي يستطيع المستخدم من تقديم مقترح للتطوير او شكوى تعيق التطوير او شكوى خاصه بحريه تامة
            وبشكل سري تماما مع العلم بانه سوف يتم بحث المقترحات و الشكاوي من قبل لجنة متخصصه تم تكليفها
            من قبل الادارة العليا للبت فيها بكفاءة وفعالية من خلال نظام
            يمتاز بسهولة ويسر وسرية كامله للمعلومات المقدمة مع ضمان إنجاز وحل الشكاوى خلال فترة زمنية محددة
        </h1>
        </div>
    </center>

    <?php

    $db=DB::select('select * from countin');
    ?>
    @foreach ($db as $user)
        <h3 style="color: #0d3349;font-size: 25px;padding-left: 10%;font-weight: bold"> Number Of Visitors  : {{ $user->count }}  </h3>
        <br>
    @endforeach
</div>

<div  id="confirm">
    <div style="font-size: 20px" class="message"></div>
    <h3>سوف يقوم البرنامج بجمع بعض المعلومات الاضافيه للتحقق من هوية المستخدم</h3>
   <br>
    <button class="yes" onclick="setcheckyes()">موافق</button>&nbsp;&nbsp;
    <button class="no" id="NONO" onclick="setcheck()">أرفض</button>
</div>



</body>
</html>

