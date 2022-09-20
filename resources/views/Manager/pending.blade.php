
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Vacation System</title>
    <style> /*tabel css */
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
            border: 1px solid black;
        }/*button css */
        .btn{
            color: #d6e9f9;
            padding:   32px 20px;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }/*alert css */
        .alert {

            padding: 20px;
            background-color: #c0ddf6;
            color: red;
        }
        /*class closebtn css */
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
        /*class closebtn after css */
        .closebtn:hover {
            color: black;
        }
        .h33 {
            font-size: 30px;
            color: #761b18;
            text-transform: capitalize;

        }

    </style>
</head><!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <!-- navbar show which  page shown to user based on his level -->
    <body>
        <br>


        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 20%;border: darkblue 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn btn-success" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>
        @endif
        <div>   <!--select vacation from database for manager that not approve or reject   -->

                <center> <h3 class="h33"> Vacation Table   </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php

                    $Department=Auth::user()->Department;
                    $name=Auth::user()->name;
                    $Vacations = DB::table('holidays')
                        ->join('users', 'users.name', '=','holidays.name' )
                        ->where('holidays.Department', $Department)
                        ->whereNull('holidays.status')
                        ->whereNull('holidays.HR')
                        ->where('users.Manager',$name)
                        ->where('holidays.name','!=',$name)
                        ->select('users.vacationsbalance', 'holidays.*')
                        ->get();



                    ?>
                    <tr class="bg-info"><!-- Header  -->
                        <td>Id</td>
                        <td>Name</td>
                        <td>Department</td>
                        <td style="width: 90px ; font-size: 26px  ;color: #fff3cd ; background-color: #1b1e21 "  >Start</td>
                        <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >End</td>
                        <td>Vacations Type</td>
                        <td>Days</td>
                        <td >Vacations Balance</td>
                        <td>Manager</td>
                        <td>Status</td>
                        <td>Creation</td>
                        <td>Aproval Data</td>

                    </tr>

                    @foreach ($Vacations as $Vacation)
                        <tr>
                            <td >{{ $Vacation->id }}</td><!-- Body  -->
                            <td>{{ $Vacation->name }}</td>
                            <td>{{ $Vacation->Department }}</td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Vacation->start}}</td>
                            <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Vacation->end }}</td>
                            <td>{{ $Vacation-> VAcationstype}}</td>
                            <td>{{ $Vacation->HloiDays }}</td>
                            <td>{{ $Vacation->vacationsbalance }}</td>
                            <td>{{ $Vacation->manger }}</td>
                            <td>{{ $Vacation->status }}</td>
                            <td>{{ $Vacation->creation }}</td>
                            <td>{{ $Vacation->AprovaleDate }}</td>


                            <td><a href = 'ApproveVacation/{{ $Vacation->id }}'>Manager</a></td>

                        </tr>
                    @endforeach
                </table>


        </div>

            <br><br><br><br><br>


        <div>   <!--select vacation from database for manager that not approve or reject   -->
            <?php

            if (Auth::user()->level == 'Manager') {
            ?>

                <center> <h3 class="h33"> Permission Table   </h3></center>
                <br>
                <table class="table table-sm table-primary">
                    <?php

                    $Permissions = DB::table('permmision')
                        ->join('users', 'users.name', '=','permmision.name' )
                        ->where('permmision.Department', $Department)
                        ->whereNull('permmision.status')
                        ->whereNull('permmision.HR')
                        ->where('users.Manager',$name)
                        ->select('users.vacationsbalance', 'permmision.*')
                        ->get();




                    ?>
                    <tr class="bg-info"><!-- Header  -->
                        <td>Id</td>
                        <td> Name</td>
                        <td> Department</td>
                        <td style="width: 90px ; font-size: 26px  ;color: #fff3cd ; background-color: #1b1e21 "  >Day</td>
                        <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >Start</td>
                        <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >End</td>
                        <td>Hours</td>
                        <td> Manager</td>
                        <td>Status</td>
                        <td>Creation</td>
                        <td>Aproval Data</td>

                    </tr>

                    @foreach ($Permissions as $Permission)
                        <tr>
                            <td >{{ $Permission->id }}</td><!-- Body  -->
                            <td> {{ $Permission->name }}</td>
                            <td>{{ $Permission->Department }}</td>
                            <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->day }}</td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->start}}</td>
                            <td   style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->end }}</td>
                            <td> {{ $Permission->permisionshours }}</td>
                            <td>{{ $Permission->manger }}</td>
                            <td>{{ $Permission->status }}</td>
                            <td>{{ $Permission->creation }}</td>
                            <td> {{ $Permission->AprovaleDate }}</td>
                            <td><a href = 'ApprovePermission/{{ $Permission->id }}'>Manager</a></td>
                        </tr>
                    @endforeach
                </table>

            <?php

            }
                ?>
        </div>



        <!--alert script  -->
        @if(Session::has('alert'))
            <div class="alert col-md-6 ">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <h3>{{Session::get('alert')}}</h3>
            </div>
        @endif
        </body>


@endsection
