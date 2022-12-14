
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js" rel = "stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Holiday</title>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <title>Holiday</title>

    <style>
        /*tabel css */
        td {
            text-align: left;
        }
        table {
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
        }

        table, th, td,tr {
            border: 1px solid black;
        }


                        table tr:not(:first-child){
                            cursor: pointer;transition: all .25s ease-in-out;
                        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
            border: 1px solid black;
        }
        /*word of input css */
        .h33 {
            font-size: 25px;
            color: #761b18;
            text-transform: capitalize;

        }/* input css */
        .formm-control{
            display: block;
            width: 50%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;


        }/*button css*/
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
        .tab button:hover {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tablinks {
            transition-duration: 0.4s;

        }

        .tablinks:hover {
            background-color: #4CAF50; /* Green */
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }

        .tab button:hover {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tablinks {
            transition-duration: 0.4s;

        }

        .tablinks:hover {
            background-color: #4CAF50; /* Green */
            color: white;
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }

    </style>
    <script>
        /*search script */

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function myFunctio() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInpute");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTablee");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

    </script>
</head><!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <!-- navbar show which  page shown to user based on his level -->
        <br>

        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 20%;border: darkblue 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn btn-success" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>

        @endif

        <div>

                <center class="tab">
                    <button style=" background-color: #4dc0b5;
                    border-radius: 20%;
                     border: none;
                     outline: none;
                     cursor: pointer;
                     padding: 14px 30px;
                     transition: 0.3s;

                     font-size: 30px;"

                            class="tablinks" onclick="openCity(event, 'Holiday')">Vacations</button>
                    <button style=" background-color: #4dc0b5;
                    border-radius: 20%;
                     border: none;
                     outline: none;
                     cursor: pointer;
                     padding: 14px 16px;
                     transition: 0.3s;

                     font-size: 30px;"
                            class="tablinks" onclick="openCity(event, 'Permission')">Permissions</button>

                </center>
                <div id="Holiday" class="tabcontent">
                    <h3 class="h33"> Search  :  </h3>

                    <input id="myInput" autocomplete="off" type="text" class="formm-control fa fa-search"  onkeyup="myFunction()" placeholder="Search..">
                    <br>
                    <!-- select all old vacation from database for admin -->
                    <table id="table_format" class="table table-sm table-primary">

                        <!-- select all old vacation from database for hr -->
                        <?php
                        $as='Approve';
                        $users = DB::select('select u.employeenumber, h.id,h.name,h.UpdateHRDate,h.Department,h.idHoliday,
                        DATE_FORMAT(h.start,"%d-%m-%Y") as start, DATE_FORMAT(h.end,"%d-%m-%Y") as end,
h.VAcationstype,h.HloiDays,h.manger,h.status,
DATE_FORMAT(h.creation,"%d-%m-%Y  %h:%m:%s") as creation ,
DATE_FORMAT(h.AprovaleDate,"%d-%m-%Y  %h:%m:%s") as AprovaleDate,
DATE_FORMAT(h.AprovaleHRDate,"%d-%m-%Y  %h:%m:%s") as AprovaleHRDate
,h.HR,
h.HRname,u.vacationsbalance
                              from holidays h,users u where h.name= u.name   ORDER BY h.creation DESC');//  ?????? ???????????????? ?????????? ????\?? ?????? ??????
                        ?>
                        <thead >
                        <tr class="bg-info" ><!-- header-->
                            <td>Id</td>
                            <td style="background-color: #761b18;color: #fff3cd">Employee Number</td>
                            <td>Employee Name</td>
                            <td>Department</td>
                            <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                            <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>

                            <td>Vacations Type</td>
                            <td>Days</td>

                            <td >Vacations Balance</td>
                            <td>Manager</td>
                            <td>Status</td>
                            <td>Creation</td>
                            <td>Aproval Data</td>
                            <td> HR Name</td>
                            <td> HR Status</td>
                            <td>Aproval HR Data</td>
                            <td>Update HR Date</td>

                        </tr>
                        </thead>
                        <tbody  id="myTable" ><!-- body-->

                        @foreach ($users as $user)
                            <tr>
                                <td >{{ $user->id }}</td>
                                <td style="background-color: #1b1e21;color: #fff3cd" >{{ $user->employeenumber }}</td>
                                <td >{{ $user->name }}</td>
                                <td >{{ $user->Department }}</td>
                                <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $user->start}}</td>
                                <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $user->end }}</td>
                                <td >{{ $user-> VAcationstype}}</td>
                                <td >{{ $user->HloiDays }}</td>

                                <td >{{ $user->vacationsbalance }}</td>
                                <td >{{ $user->manger }}</td>
                                <td >{{ $user->status }}</td>
                                <td >{{ $user->creation }}</td>
                                <td >{{ $user->AprovaleDate }}</td>
                                <td >{{ $user->HRname }}</td>
                                <td >{{ $user->HR }}</td>
                                <td >{{ $user->AprovaleHRDate}}</td>
                                <td >{{ $user->UpdateHRDate}}</td>

                                <td><a href = 'HRUpdateVacation/{{ $user->id }}'>Update </a></td>



                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="Permission" class="tabcontent">
                    <h3 class="h33"> Search  :  </h3>

                    <input id="myInpute" autocomplete="off" type="text" class="formm-control fa fa-search"  onkeyup="myFunctio()" placeholder="Search..">
                    <br>
                    <!-- select all old vacation from database for admin -->
                    <table id="table_format" class="table table-sm table-primary">

                        <!-- select all old vacation from database for hr -->
                        <?php
                        $as='Approve';
                        $users = DB::select('select  u.employeenumber,h.id,h.UpdateHRDate,h.HRname,h.name,h.Department,h.idpermision,
                                   DATE_FORMAT(h.day,"%d-%m-%Y") as day,h.end,h.start,
h.permisionshours,h.manger,h.status,
DATE_FORMAT(h.creation,"%d-%m-%Y  %h:%m:%s") as creation ,
DATE_FORMAT(h.AprovaleDate,"%d-%m-%Y  %h:%m:%s") as AprovaleDate,
DATE_FORMAT(h.AprovaleHRDate,"%d-%m-%Y  %h:%m:%s") as AprovaleHRDate
,h.HR,u.permissionshours
                              from permmision h,users u where h.name= u.name and h.status=?  ORDER BY h.creation DESC',[$as]);//  ?????? ???????????????? ?????????? ????\?? ?????? ??????
                        ?>
                        <thead >
                        <tr class="bg-info" ><!-- header-->
                            <td>Id</td>
                            <td style="background-color: #761b18;color: #fff3cd">Employee Number</td>
                            <td>Employee Name</td>
                            <td>Department</td>
                            <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Day</td>
                            <td style="width: 90px ; font-size: 26px  "  class="bg-warning" >Start</td>
                            <td style="width: 90px ; font-size: 26px  " class="bg-warning" >End</td>
                            <td>Hours</td>
                            <td>Manager</td>
                            <td>Status</td>
                            <td>Creation</td>
                            <td>Aproval Data</td>
                            <td> HR Name</td>
                            <td> HR Status</td>
                            <td>Aproval HR Data</td>
                            <td>Update HR Date</td>

                        </tr>
                        </thead>
                        <tbody  id="myTable" ><!-- body-->

                        @foreach ($users as $user)
                            <tr>
                                <td >{{ $user->id }}</td>
                                <td style="background-color: #1b1e21;color: #fff3cd" >{{ $user->employeenumber }}</td>
                                <td >{{ $user->name }}</td>
                                <td >{{ $user->Department }}</td>
                                <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $user->day}}</td>
                                <td style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 " >{{ $user->start}}</td>
                                <td  style="width: 90px ; font-size: 14px  ;color: #fff3cd ; background-color: #1b1e21 ">{{ $user->end }}</td>
                                <td >{{ $user->permisionshours }}</td>
                                <td >{{ $user->manger }}</td>
                                <td >{{ $user->status }}</td>
                                <td >{{ $user->creation }}</td>
                                <td >{{ $user->AprovaleDate }}</td>
                                <td >{{ $user->HRname }}</td>
                                <td >{{ $user->HR }}</td>
                                <td >{{ $user->AprovaleHRDate}}</td>
                                <td >{{ $user->UpdateHRDate}}</td>
                                <?php

                                if (Auth::user()->level == 'HR') {
                                ?>
                                <td><a href = 'HRUpdatePermission/{{ $user->id }}'>Update HR</a></td>
                                <?php
                                }
                                ?>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>









        </div>









        </html>




@endsection
