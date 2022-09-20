@if (Route::has('login'))

@auth
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arope Vacations</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/design.css') }}" rel="stylesheet">


    <style>
        /*button css*/
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
        /*page css*/
        html, body {
            margin: 0;
            padding: 0;
            background: #00002E url("/svg/1.png")   ;
            background-repeat:repeat ;
            font-family: "Nunito", sans-ser;
        }

        /*button btn10 border css*/
        .btn10{
            padding: 15px 100px;
            margin:10px 4px;
            color: #fff;
            font-family: sans-serif;
            text-transform: uppercase;
            text-align: center;
            position: relative;
            text-decoration: none;
            display:inline-block;

        }
        /*button btn10  css*/
        .btn10{
            top: 40px;
            font-family: "proxima-nova", sans-serif;
            font-weight: 500;
            font-size: 20px;
            text-transform: uppercase!important;
            letter-spacing: 2px;
            color: #fff;
            cursor: hand;
            text-align: center;
            text-transform: capitalize;
            border: 1px solid #fff;
            border-radius:50px;
            position: relative;
            overflow: hidden!important;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out;
            background: transparent!important;
            z-index:10;

        }

        /*button btn10 after mouving css*/
        .btn10:hover{
            border: 1px solid #071982;
            color: #80ffd3!important;
        }  /*button btn10 before css*/
        .btn10::before {
            content: '';
            width: 0%;
            height: 100%;
            display: block;
            background: #071982;
            position: absolute;
            -ms-transform: skewX(-20deg);
            -webkit-transform: skewX(-20deg);
            transform: skewX(-20deg);
            left: -10%;
            opacity: 1;
            top: 0;
            z-index: -12;
            -moz-transition: all 1s cubic-bezier(0.77, 0, 0.175, 1);
            -o-transition: all 1s cubic-bezier(0.77, 0, 0.175, 1);
            -webkit-transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
            transition: all 1s cubic-bezier(0.77, 0, 0.175, 1);
            box-shadow:2px 0px 14px rgba(0,0,0,.6);
        }

        .btn10::after {
            content: '';
            width: 0%;
            height: 100%;
            display: block;
            background: #80ffd3;
            position: absolute;
            -ms-transform: skewX(-20deg);
            -webkit-transform: skewX(-20deg);
            transform: skewX(-20deg);
            left: -10%;
            opacity: 0;
            top: 0;
            z-index: -15;
            -webkit-transition: all .94s cubic-bezier(.2,.95,.57,.99);
            -moz-transition: all .4s cubic-bezier(.2,.95,.57,.99);
            -o-transition: all .4s cubic-bezier(.2,.95,.57,.99);
            transition: all .4s cubic-bezier(.2,.95,.57,.99);
            box-shadow: 2px 0px 14px rgba(0,0,0,.6);
        }
        .btn10:hover::before, .btn1O:hover::before{
            opacity:1;
            width: 116%;
        }
        .btn10:hover::after, .btn1O:hover::after{
            opacity:1;
            width: 120%;
        }

    </style>
</head>
<!-- extend app.css -->
    @extends('layouts.app')


    <br>
    <br>
    <br>

    @section('content')
        <html>
        <br>


        <!-- navbar show which  page shown to user based on his level -->
        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 20%;border: darkred 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn-primary" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>
        @endif






        <div>




            <!-- Button for rigester any new user in system and only shown for admin-->

            <center>
                <?php
                if (Auth::user()->level == 'Admin') {
                ?>

                    <a type="button" style="text-decoration: none; color:#1d2124;font-weight: bold" class=" btn10 " id="but" href="{{route('register')}}" >Register!</a>
                    <br> <br>
                    <a type="button" style="text-decoration: none ;color:#1d2124;font-weight: bold" class=" btn10 " id="but" href="{{route('PublicVacations')}}" >Public Vacations</a>
                    <br> <br>
                    <a type="button" style="text-decoration: none; color:#1d2124;font-weight: bold"  class="btn10  " id="but" href="{{route('UsersPassword')}}" >Create users password!</a>
                <?php
                }
                ?>

                    <?php
                    if (Auth::user()->level == 'Employee') {
                    ?>

                    <a type="button" style="text-decoration: none;color: #1d2124;font-weight: bold" class="btn10 " id="but"  href="{{route('TakePermision')}}" >Take a Permision</a>


                    <?php
                    }
                    ?>
                    <br>
                    <br>
                    <a type="button" style="text-decoration: none;color: #1d2124;font-weight: bold" class="btn10 " id="but" href="{{route('TakeVacation')}}" >Take a vacation</a>
                    <br>
                    <br>
                    <a type="button" style="text-decoration: none;color: #1d2124;font-weight: bold" class="btn10 " id="but" href="{{route('Request')}}" >Request To HR Department</a>

                    <?php
                    if (Auth::user()->level == 'HR') {
                    ?>
                    <br>
                    <br>
                    <form method="post" action="/HR/DawonloadExecl" >
                        @csrf
                        <button  class="btn10 " id="but" type="submit" style="color: #1d2124;font-weight: bold"  >Download Users Excel Sheet</button>
                    </form>

                    <?php
                    }
                    ?>



                    <!-- Button for Create users password any  user in system only shown for admin  -->



            </center>
        </div>


        </html>




@endsection

@else
    <script>
       // alert("You are not logged in or Sign-in expired,\n Please login");
        window.location = './welcome';
    </script>

@endauth


@endif