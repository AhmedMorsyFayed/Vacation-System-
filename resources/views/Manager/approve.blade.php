
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Vacation System</title>
    <style>
        /*genral tabel css */
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
            border: 1px solid black;
        }
        /* button css*/
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
        .h33 {
            font-size: 30px;
            color: #761b18;
            text-transform: capitalize;

        }
    </style>
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')

        <html>
        <!-- navbar show which  page shown to user based on his level -->
        <br>
        <div>
            <!-- tabel hown to user based on his level -->

            @if(session()->has('Sucess'))
                <center>
                    <div class="alert alert-success " style="width: 20%;border: darkblue 1px solid;">
                        <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                        <button type="button" class="btn btn-success" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                    </div></center>
            @endif
                <center> <h3 class="h33"> Vacation Table   </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php
// database select

                    $Department=Auth::user()->Department;
                    $name=Auth::user()->name;
                    $users=\App\Holiday::with(['user' => function($Q){
                        $name=Auth::user()->name;
                        $Q->where('Manager',$name)->get();
                    }])->where('Department',$Department)->where('status',"Approve")
                        ->orderBy('id','DESC')
                      //  ->where('name','!=',$name)
                        ->get();





                    ?>
                        <tr class="bg-info">
                            <td>Id</td>
                            <td> Name</td>
                            <td>Department</td>
                            <td style="width: 90px ; font-size: 26px  ;color: #fff3cd ; background-color: #1b1e21 "  >Start</td>
                            <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >End</td>
                            <td>Vacations Type</td>
                            <td>Days</td>
                            <td >Vacations Balance</td>
                            <td>Status</td>
                            <td>Creation</td>
                            <td>Aproval Data</td>

                    </tr>

                    @foreach ($users as $user)
                        @if($user->name == $user->user["name"])
                        <tr>
                            <td >{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->Department }}</td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $user->start}}</td>
                            <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $user->end }}</td>
                            <td>{{ $user-> VAcationstype}}</td>
                            <td>{{ $user->HloiDays }}</td>
                            <td>{{ $user->user["vacationsbalance"] }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->creation }}</td>
                            <td>{{ $user->AprovaleDate }}</td>
                            <td><a href = 'UpdateApprovalM/{{ $user->id }}'>Update</a></td>
                        </tr>
                            @endif
                    @endforeach
                </table>


        </div>
        <div>

            <br><br><br><br><br>


        </div>
        <div>
            <!-- tabel hown to user based on his level -->
            <?php

            if (Auth::user()->level == 'Manager') {
            ?>
                <center> <h3 class="h33"> Permission Table   </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php
                    // database select
                    $Permissions = DB::table('permmision')
                        ->join('users', 'users.name', '=','permmision.name' )
                        ->where('permmision.Department', $Department)
                        ->where('permmision.status', 'Approve')
                        ->where('users.Manager',$name)
                        ->select('users.vacationsbalance', 'permmision.*')
                        ->orderBy('id','DESC')
                        ->get();


                    ?>
                        <tr class="bg-info"><!-- Header  -->
                            <td>Id</td>
                            <td>Emplyee Name</td>
                            <td>Employee Department</td>
                            <td style="width: 90px ; font-size: 26px  ;color: #fff3cd ; background-color: #1b1e21 "  >Day</td>
                            <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >Start</td>
                            <td style="width: 90px ; font-size: 26px ;color: #fff3cd ; background-color: #1b1e21 " >End</td>
                            <td>Hours</td>

                            <td> Manager</td>
                            <td>Status</td>
                            <td> Creation</td>
                            <td>Aproval Data</td>

                        </tr>

                    @foreach ($Permissions as $Permission)
                            <tr>
                                <td >{{ $Permission->id }}</td><!-- Body  -->
                                <td>{{ $Permission->name }}</td>
                                <td>{{ $Permission->Department }}</td>
                                <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->day }}</td>
                                <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->start}}</td>
                                <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->end }}</td>
                                <td>{{ $Permission->permisionshours }}</td>

                                <td>{{ $Permission->manger }}</td>
                                <td>{{ $Permission->status }}</td>
                                <td>{{ $Permission->creation }}</td>
                                <td>{{ $Permission->AprovaleDate }}</td>
                            <td><a href = 'UpdateApprovalP/{{ $Permission->id }}'>Update</a></td>

                        </tr>
                    @endforeach
                </table>
            <?php

            }
                ?>
        </div>




@endsection
