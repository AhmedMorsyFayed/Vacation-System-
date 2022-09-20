
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssnormalize/cssnormalize-min.css">

    <title>Vacation</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>



        jQuery(function($) {

            $('.fromm').timepicker({
                timeFormat: 'hh:00 p ',
                interval: 60,
                minTime: '8',
                maxTime: '15.00',
                startTime: '8:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });

            $('#from').on('changeTime', function() {
                $('#to').timepicker('option', 'minTime', $(this).val());
            });

            $('#to').timepicker({
                timeFormat: 'hh:00 p ',
                interval: 60,
                 minTime:'9:00',
                maxTime: '16.00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
                'showDuration': true
                // $("#to").datepicker("destroy");
            });

        });


        jQuery(function($) {
            var today = new Date();
            var lastDate = new Date(2022 , 11, 31);
            var dw=today.getDate();
            var mon= today.getMonth();
            var ye= today.getFullYear();
            $("#end").datepicker("destroy");
            $( "#end" ).datepicker({
                todayBtn: "linked",
                language: "de",
                maxDate:+15,
                minDate:0,
                dateFormat :  'yy-mm-dd',
                beforeShowDay: function(d) {
                    if (d.getDay()==5) {
                        return [false];
                    } else if (d.getDay()==6){
                        return [false];
                    }else if (d.getDate()==1 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==6 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }
                    else if (d.getDate()==27 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==24 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==25 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==1 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==2 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==4 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==5 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==30 && d.getMonth()==5 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==10 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==11 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==12 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==13 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==14 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==21 && d.getMonth()==9 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==dw && d.getMonth()==mon && d.getFullYear()==ye){
                        return [true, 'todayyy', '']
                    } else{
                        return [true];
                    }
                }


            });

        });




    </script>

    <style>

        .dateHighlight a { background: #d0211c !important; color: #c8cbcf !important}
        .todayyy a { background: #4aa0e6 !important;color: #c8cbcf !important}
        .bad a.ui-datepicker  { background: red; color: white; }

        .alert {

            padding: 20px;
            color: red;
            background:#fff;
            width:450px;
            float:right;
        }

        .closebtn {

            position: relative;
            margin-left: 15px;
            color: red;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
        .closebt {
            position: relative;
            margin-right: 15px;
            color: white;
            font-weight: bold;
            width: 800px;
            height: 500px;


            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebt:hover {
            color: black;
        }
        .title h1 {
            font-size: 50px;
            text-transform: uppercase;
        }
        .title h4 {
            font-size: 20px;
            font-weight: inherit ;
            margin-top: 100px;

            color: #FFFFFF;
            text-transform: uppercase;
        }
        input[type=text]:focus {
            border: 3px solid #555;
        }
        td{



        }

        table, th, td {
            border: 1px solid black;
        }
        .ui-datepicker .ui-datepicker-title {
            margin: 0 2.3em;
            line-height: 1.8em;
            text-align: center;
            color:#1d68a7;
            background:#c0ddf6;
        }
        .ui-datepicker table {
            width: 100%;
            font-size: .7em;
            border-collapse: collapse;
            font-family: verdana, serif;
            margin: 0 0 .4em;
            color:#761b18;
            background:#1d68a7;
        }
        .flex-center{
            width: 800px;
            height: 500px;

        }
        .ui-datepicker td {

            border: 0;
            padding: 1px;


        }
        .title h1 {
            font-size: 84px;

            margin-top: 100px;

            color:#c51f1a;
            text-transform: uppercase;


        }
        .ui-datepicker td span,
        .ui-datepicker td a {
            display: block;
            padding: .8em;
            text-align: right;
            text-decoration: none;
        }
        .datepicker {
            direction: rtl;
        }
        .datepicker.dropdown-menu {
            right: initial;
        }
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -6px;
            margin-left: -1px;
            -webkit-border-radius: 0 6px 6px 6px;
            -moz-border-radius: 0 6px 6px;
            border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
            display: block;
        }

        .dropdown-submenu>a:after {
            display: block;
            content: " ";
            float: right;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
            border-width: 5px 0 5px 5px;
            border-left-color: #ccc;
            margin-top: 5px;
            margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
            border-left-color: #fff;
        }

        .dropdown-submenu.pull-left {
            float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
            left: -100%;
            margin-left: 10px;
            -webkit-border-radius: 6px 0 6px 6px;
            -moz-border-radius: 6px 0 6px 6px;
            border-radius: 6px 0 6px 6px;
        }
        .btn{
            color: #d6e9f9;
            padding:   32px 20px;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }
        .column {
            float: left;
            width: 60%;
            padding: 10px;
            height:100%; /* Should be removed. Only for demonstration */
        }
        #dialogoverlay{
            display: none;
            opacity: .8;
            position: fixed;
            top: 0px;
            left: 0px;
            background: #FFF;
            width: 100%;
            z-index: 10;
        }
        #dialogbox{
            display: none;
            position: fixed;
            background: #000;
            border-radius:7px;
            width:550px;
            z-index: 10;
        }
        #dialogbox > div{ background:#FFF; margin:8px; }
        #dialogbox > div > #dialogboxhead{ background:#4dc0b5 ; font-size:19px; padding:10px; color:#00002E; }
        #dialogbox > div > #dialogboxbody{ background: white; padding:20px; color:black; }
        #dialogbox > div > #dialogboxfoot{  padding:10px; text-align:center; }


        .div2 {
            padding: 20px;
            color: red;
            background:#fff;
            width:450px;
            float:right;
            border: 4px solid black;
        }
        .div3{
            padding: 20px;
            color: white;
            background:black;
            width:450px;
            height: 50px;
            float:right;
            border: 4px solid black;
        }


    </style>
</head>
@extends('layouts.app')
<br>
<br>
<br>

@section('content')



    <body>
    <br>


    <div class="column">

            <img src="/svg/2.png" width="100%" height="100%"  >



    </div>
    <div id="dialogoverlay"></div>
    <div id="dialogbox">
        <div>
            <div id="dialogboxhead"></div>
            <div id="dialogboxbody"></div>


            <div id="dialogboxfoot">

                <button style="width: 17%;height: 30% ;border-radius: 10%;font-size: 18px ;background-color: dodgerblue;color: white"  value="ok" name="ok" onclick="Alert.ok()">Ok</button>
                &ensp;
                &ensp;
                &ensp;
                <button style="width: 20%;height: 30%;border-radius: 10%;font-size: 18px;background-color: red;color: white" value="cancel" name="cancel" onclick="Alert.cancel()">Cancel</button>

            </div>
        </div>
    </div>


    <div class="closebtn">
        <div class="pull-left">
            <div style="text-align: center  ">


                <form  id="contact-form" name="myform"  action="/BokePermission" method="post" >


                    <input type="hidden" name="_token" value="{{ csrf_token() }}">



                    <h1 class="title" style="color: #c51f1a">  Enter Your Permission  Details :<br></h1>
                    <br>

                    <br>

                    <h2 style="color: #000"> Day:</h2>  <input type="text" placeholder="Day   ????" autofocus required id="end" autocomplete="off" name="day" class="form-control">
                    <br><br><br>
                    <br><h2 style="color: #000"> Time From:</h2>
                    <input class="form-control fromm" required autocomplete="off" id="from" name="start" value="" placeholder="From  ?????">
                    <br>

                    <br>


                    <button class="btn btn-primary"  type="submit" >Submit</button><br><br><br>




                </form>


                <br>


            </div>
        </div>
    </div>






    @if(Session::has('alert'))
        <div style="position:absolute;width: 600px;height: 300px;border: gray 1px solid;background: powderblue;color: black;text-align:center;
    top:40%;
    left:40%;
    margin-top:-50px;
    margin-left:-100px;">
            <span style="text-align:right;color: lightgrey;font-size: 20px" onclick="this.parentElement.style.display='none';">X</span>
            <div style="text-align:center; width: auto  " >
                <h1 style="color: red;">Alert Message</h1>
            </div>
            <span style="text-align:right;color: lightgrey;font-size: 20px" onclick="this.parentElement.style.display='none';">X</span>
            <div style="text-align:center; " >
                <h3 style=" font-family: Arial, Helvetica, sans-serif;">{{Session::get('alert')}}</h3>
                <span style="text-align:right;color: lightgrey;font-size: 20px" onclick="this.parentElement.style.display='none';">.</span>
            </div>

            <button  style="width: 20%;  vertical-align: bottom;height: 20%;border-radius: 10%;   position: relative; font-size: 18px;text-align:center;background-color: #298fe2;color: white" value="cancel" name="cancel" onclick="this.parentElement.style.display='none';">Ok</button>
        </div>
    @endif




    </body>

</html>


@endsection
