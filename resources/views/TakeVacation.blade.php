
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
    <script>

       var str=0;

       var array = ["2019-11-10", "2019-11-26", "2019-12-23"];
   function test()
       {
           str =$( "#VAcationstype" ).val();
           if(str === "Annual"){
       //        alert(str)
               return str;
           }else{
        //       alert(str)
               return str;
           }
      }


         jQuery(function($) {


             var x =0;
            var minn;
            var maxx;
            var today = new Date();
            var lastDate = new Date(2022 , 11, 31);
            var min= today.getDay();
            var dw=today.getDate();
            var mon= today.getMonth();
            var ye= today.getFullYear();
            var days= '+15d';


             $('select').on('change', function()
              {
                  x = this.value;

                  if ((x === "Annual")&&(min === 4)) {
                      minn =4;
                  }else if ((x === "Annual")&&(min === 0)) {
                      minn = 2;
                  }else if (x === "Annual" ) {
                      minn = 2;
                  }else if ((x === "Casual")&&(min === 0)) {
                      minn = -3;
                  }else{
                      minn =-1;
                  }
                  $("#start").datepicker("destroy");
                      $( "#start" ).datepicker({

                      todayBtn: "linked",
                      language: "de",
                      minDate: minn,
                      maxDate:lastDate,
                      dateFormat :  'yy-mm-dd',
                      onSelect: function(dateStr)
                      {
                          $("#end").val(dateStr );
                          var date = new Date(dateStr);
                          days = date.getDate() +15;
                          var m=date.getMonth();
                          var y =    date.getFullYear();

                          $("#end").datepicker("option",{ minDate: new Date(dateStr)})
                          $("#end" ).datepicker( "option", "maxDate",new Date(y,m,days) );
                          //  $("#end").datepicker("option",{ maxDate: new Date(dateStr)})
                      },
                      beforeShowDay: function(d) {
                          var s="2019-10-06";
                          if (d.getDay()==5) {
                             return [false];
                          } else if (d.getDay()==6){
                              return [false];
                          }else if (d.getDate()==6 && d.getMonth()==0 && d.getFullYear()==2022){
                              return [true, 'dateHighlight', '']
                          }
                          else if (d.getDate()==27 && d.getMonth()==0 && d.getFullYear()==2022){
                              return [true, 'dateHighlight', '']
                          }
                          else if (d.getDate()==28 && d.getMonth()==0 && d.getFullYear()==2022){
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
                          }else if (d.getDate() == dw && d.getMonth()== mon && d.getFullYear()== ye){
                              return [true, 'todayyy', '']
                          } else{
                              return [true];
                          }

                      }

                  });

                  });


         });


        jQuery(function($) {
            var today = new Date();
            var lastDate = new Date(2022 , 11, 31);
            var dw=today.getDate();
            var mon= today.getMonth();
            var ye= today.getFullYear();
            $( "#end" ).datepicker({
                todayBtn: "linked",
                language: "de",
                maxDate:lastDate,
                minDate:-1,
                dateFormat :  'yy-mm-dd',

                onSelect: function(dateStr) {
                    toDate = new Date(dateStr);

                    // Converts date objects to appropriate strings
                    fromDate = ConvertDateToShortDateString(fromDate);
                    toDate = ConvertDateToShortDateString(toDate);
                },
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
                    }else if (d.getDate()==21 && d.getMonth()==9 && d.getFullYear()==2021){
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
    <script>

        function CustomAlert(){
            this.render = function(dialog){
                var winW = window.innerWidth;
                var winH = window.innerHeight;
                var dialogoverlay = document.getElementById('dialogoverlay');
                var dialogbox = document.getElementById('dialogbox');
                dialogoverlay.style.display = "block";
                dialogoverlay.style.height = winH+"px";
                dialogbox.style.left = (winW/2) - (550 * .5)+"px";
                dialogbox.style.top = "100px";
                dialogbox.style.display = "block";
                document.getElementById('dialogboxhead').innerHTML = "Acknowledge This Vacation";
                document.getElementById('dialogboxbody').innerHTML = dialog;
            }
            this.ok = function(){
          //      var a = document.forms["myform"]["start"].value;
          //      var b = document.forms["myform"]["end"].value;
           //     var c = document.forms["myform"]["VAcationstype"].value;
           //     if (a == null || a === "" && b == null || b === "" && c == null || c === "") {
           //         alert("Please Fill All Required Field");
        //            document.getElementById('dialogbox').style.display = "none";
        //            document.getElementById('dialogoverlay').style.display = "none";
      //          }else if(a == null || a === "" && b == null || b === ""){
       //             alert("Please Fill your Vacation Date");
       //             document.getElementById('dialogbox').style.display = "none";
        //            document.getElementById('dialogoverlay').style.display = "none";
        //        } else{
        //    <span style="text-align:right;color: whitesmoke;font-size: 20px" onclick="this.parentElement.style.display='none';">X</span>
                    //document.forms["contact-form"].submit();
                    document.getElementById('dialogbox').style.display = "none";
                    document.getElementById('dialogoverlay').style.display = "none";
         //       }
            }
            this.cancel = function(){
                document.getElementById('dialogbox').style.display = "none";
                document.getElementById('dialogoverlay').style.display = "none";
            }
        }
        var Alert = new CustomAlert();





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
        <!--  <! –– <marquee behavior="slide" >––> -->

        <img src="/svg/a.png" width="100%" height="100%"  >

        <!-- </marquee> -->

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


    <div class="">
        <div class="pull-left">
            <div style="text-align: center  ">


                <form  id="contact-form" name="myform"  action="/BokeVacation" method="post" >
                    @csrf

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table class="table table-bordered table-striped table-hover table-list-search">
                        <tr >
                            <td  ><h2 style="color: #761b18">Vacations Balance</h2></td>
                        </tr>
                 <tr>
                     <td ><h2 style="color: #9561e2">{{ Auth::user()->vacationsbalance }}</h2></td>
                 </tr>

                    </table>


                    <h1 class="title" style="color: #c51f1a">  Enter your vacation details :<br></h1>
                    <br>
                    <select class="form-control" id="VAcationstype" name="VAcationstype"  onchange="test()" required autofocus>

                        <option  value="">Vacations Type???</option>
                        <option  value="Annual">Annual</option>
                        <option  value="Casual">Casual</option>


                    </select>
                    <br>

                    <h2 style="color: #000">From:</h2> <input type="text" placeholder="Enter date Start" required autofocus autocomplete="off" id="start" name="start" readonly class="form-control">

                    <h2 style="color: #000"> To:</h2>  <input type="text" placeholder="Enter date End"  required id="end" autocomplete="off" name="end" readonly class="form-control">
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
