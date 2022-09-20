
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Approved vacation</title>
    <style>/*tabel css */
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
        }
        .h33 {
            font-size: 30px;
            color: #761b18;
            text-transform: capitalize;

        }

    </style> <!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>
<span  style="color:blue; margin-left:15px;font-size:35px;" class="navbar-brand">
			Approved Vacations
			</span><!-- navbar show which  page shown to user based on his level -->
    @section('content')
        <html>
        <br>

        <div><!--select vacation from database for employee that approved  -->



                <center> <h3 class="h33"> Vacation Table  </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php
                    $name=Auth::user()->name;
                    $Vacations=\App\Holiday::where('status',"Approve")
                        ->where('name',$name)
                        ->orderBy('creation','DESC')
                        ->get();

                    ?>
                        <tr class="bg-info"><!--header  -->
                            <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                            <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>
                            <td>Days</td>
                            <td>Creation</td>
                            <td>Manager</td>
                            <td>Status</td>
                            <td>Vacation Type</td>
                            <td>Aproval Date</td>
                            <td>HR Name</td>
                            <td>Creation Hr Date </td>
                            <?php

                            if (Auth::user()->level == 'TopManager') {
                            ?>
                            <td ></td>

                            <?php
                            }
                            ?>


                        </tr>

                        @foreach ($Vacations as $Vacation)<!--body -->
                            <tr>

                                <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Vacation->start}}</td>
                                <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Vacation->end }}</td>
                                <td>{{ $Vacation->HloiDays }}</td>
                                <td>{{ $Vacation->creation }}</td>
                                <td>{{ $Vacation->manger }}</td>
                                <td>{{ $Vacation->status }}</td>
                                <td>{{ $Vacation->VAcationstype }}</td>
                            <td>{{ $Vacation->AprovaleDate }}</td>
                            <td>{{ $Vacation->HRname }}</td>
                            <td>{{ $Vacation->AprovaleHRDate}}</td>

                                <?php

                                if (Auth::user()->level == 'TopManager') {
                                ?>
                                <td class="bg-white"><a href = 'Manager/UpdateApprovalTop/{{ $Vacation->id }}'>Update</a></td>

                            <?php
                                }
                                ?>

                        </tr>
                    @endforeach
                </table>



        </div>


        <div><!--select vacation from database for employee that approved  -->
            <?php

            if (Auth::user()->level == 'Employee') {
            ?>


                <center> <h3 class="h33"> Permission Table   </h3></center><br>
                <table class="table table-sm table-primary">
                    <?php

                    $Permissions=\App\Permissions::where('status',"Approve")
                        ->where('name',$name)
                        ->orderBy('creation','DESC')
                        ->get();

                    ?>
                    <tr class="bg-info"><!--header  -->
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Day</td>
                        <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                        <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>
                        <td>Hours</td>
                        <td>Creation</td>
                        <td>Manager</td>
                        <td>Status</td>
                        <td>Aproval Date</td>
                        <td>HR Name</td>
                        <td>Creation Hr Date </td>
                    </tr>

                    @foreach ($Permissions as $Permission)<!--body -->
                    <tr>
                        <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->day}}</td>
                        <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $Permission->start}}</td>
                        <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $Permission->end }}</td>
                        <td>{{ $Permission->permisionshours }}</td>
                        <td>{{ $Permission->creation }}</td>
                        <td>{{ $Permission->manger }}</td>
                        <td>{{ $Permission->status }}</td>
                        <td>{{ $Permission->AprovaleDate }}</td>
                        <td>{{ $Permission->HRname }}</td>
                        <td>{{ $Permission->AprovaleHRDate}}</td>




                    </tr>
                    @endforeach
                </table>



            <?php
            }
            ?>

        </div>



@endsection


