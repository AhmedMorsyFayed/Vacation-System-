
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Pending Vacations</title>
    <style>/*tabel css */
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
            border: 1px solid black;
        }/*button css */
        .btn{
            color:whitesmoke;
            background-color: #0d3349;
            padding:   60px 20px;
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
    <!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <html>
        <br><!-- navbar show which  page shown to user based on his level -->


        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 30%;border: darkred 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn-primary" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>
        @endif

        <div>

            <form action="/CancelUserVacation" method="POST">
                @csrf
                <center> <h3 class="h33"> Vacation Table    </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php
                    $name=Auth::user()->name;
                    $Vacations=\App\Holiday::whereNull('status')
                        ->where('name',$name)
                        ->orderBy('creation','DESC')
                        ->get();

                    ?>
                    <tr class="bg-info"><!--header -->
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning">ID</td>
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                        <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>
                        <td>Days</td>
                        <td>Creation</td>

                        <td>Status</td>
                        <td>Vacation Type</td>
                        <td>Aproval Date</td>
                        <td>HR Name</td>
                        <td>Creation Hr Date</td>


                    </tr>

                    @foreach ($Vacations as $Vacation)
                        <tr>
                            <!--body  -->
                            <td><input style="width: 90px ; font-size: 18px  "  class="bg-warning" type="text" id="fname" name="id" value="{{ $Vacation->id}}" readonly></td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Vacation->start}}</td>
                            <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Vacation->end }}</td>
                            <td>{{ $Vacation->HloiDays }}</td>
                            <td>{{ $Vacation->creation }}</td>

                            <td>{{ $Vacation->status }}</td>
                            <td>{{ $Vacation->VAcationstype }}</td>
                            <td>{{ $Vacation->AprovaleDate }}</td>
                            <td>{{ $Vacation->HRname }}</td>
                            <td>{{ $Vacation->AprovaleHRDate}}</td>
                            <td><button class="badge-primary" id="delet" name="delet" type="submit">Cancel</button></td>





                        </tr>
                    @endforeach
                </table>
            </form>




        </div>
<!--select vacation from database for  Manager that not approve or reject   -->



        <br><br><br><br><br><br><br>

        <div><!--select vacation from database for employee that not approve or reject   -->
            <?php

            if (Auth::user()->level == 'Employee') {
            ?>

            <form action="/CancelUserPermission" method="POST">
                @csrf
                <center> <h3 class="h33"> Permission Table   </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php

                    $Permissions=\App\Permissions::whereNull('status')
                        ->where('name',$name)
                        ->orderBy('creation','DESC')
                        ->get();

                    ?>
                    <tr class="bg-info"><!--header  -->
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning">ID</td>
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Day</td>
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                        <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>
                        <td>Hours</td>
                        <td>Creation</td>

                        <td>Status</td>
                        <td>Aproval Date</td>
                        <td>HR Name</td>
                        <td>Creation Hr Date </td>
                    </tr>
                    <!--body-->
                    @foreach ($Permissions as $Permission)
                        <tr>
                            <td><input style="width: 90px ; font-size: 18px  "  class="bg-warning" type="text" id="fname" name="id" value="{{ $Permission->id}}" readonly></td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->day}}</td>
                            <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->start}}</td>
                            <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->end }}</td>
                            <td>{{ $Permission->permisionshours }}</td>
                            <td>{{ $Permission->creation }}</td>
                            <td>{{ $Permission->status }}</td>
                            <td>{{ $Permission->AprovaleDate }}</td>
                            <td>{{ $Permission->HRname }}</td>
                            <td>{{ $Permission->AprovaleHRDate}}</td>

                            <td><button class="badge-primary" id="delet" name="delet" type="submit">Cancel</button></td>




                        </tr>
                    @endforeach
                </table>
            </form>



            <?php
            }
            ?>

        </div>







        <!--select vacation from database for Admin that not approve or reject   -->





@endsection


