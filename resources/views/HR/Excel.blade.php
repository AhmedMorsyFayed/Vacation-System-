
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Vacation System</title>

    <style>
        /*tabel css */
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
            border: 1px solid black;
        }

        input[type=text]:focus {
            border: 3px solid #555;
        }

        table, th, td {
            border: 1px solid black;
        }
        /*word of input css */
        .h33 {
            font-size: 25px;
            color: #1d68a7;
            text-transform: capitalize;
        }/*button submit css*/
        .btno{
            padding:   16px 54px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
            color: #c0ddf6;
            background-color: #1d68a7;

        }/*button css*/
        .btn{
            padding:   16px 54px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
            color: #c0ddf6;
            background-color: #1d68a7;

        }

/*div of search css */
        div.searchable {
            width: 300px;
            float: left;
            margin: 0 15px;
        }

        /*input of search css */
        .searchable input {
            width: 100%;
            height: 50px;
            font-size: 18px;
            padding: 10px;
            -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
            -moz-box-sizing: border-box; /* Firefox, other Gecko */
            box-sizing: border-box; /* Opera/IE 8+ */
            display: block;
            font-weight: 400;
            line-height: 1.6;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center/8px 10px;
        }


        .searchable ul {
            display: none;
            list-style-type: none;
            background-color: #fff;
            border-radius: 0 0 5px 5px;
            border: 1px solid #add8e6;
            border-top: none;
            max-height: 180px;
            margin: 0;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: 0;
        }

        .searchable ul li {
            padding: 7px 9px;
            border-bottom: 1px solid #e1e1e1;
            cursor: pointer;
            color: #6e6e6e;
        }

        .searchable ul li.selected {
            background-color: #e8e8e8;
            color: #333;
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


</head><!-- navbar show which  page shown to user based on his level -->

<!-- extend app.css -->
@extends('layouts.app')
<br>
<br>
<br>

@section('content')
    <!-- *scripts for search in dropdown */ -->

    <body>
    <br>
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
    <br><br>
    <div id="Holiday" class="tabcontent">
        <form method="post" action="GetVacationExcel">
@csrf
            <table  class="table table-bordered table-striped table-hover table-list-search">
                <tr><td ><h3 class="h33"> Name:</h3> </td>
                    <td class="btn-primary">

                        <select id="name" name="name" class="form-control  selectpicker"   data-live-search="true">
                            <option  value="pick"></option>
                            <?php
                            $users=\App\User::all();
                            foreach ($users as $user){
                                echo "<option value='". $user->name ."'>" .$user->name ."</option>" ;
                            }
                            ?>
                        </select>
                <tr><td ><h3 class="h33"> Year:</h3> </td>
                    <td class="btn-primary">

                        <select id='year' name="year"  class="form-control   selectpicker"   data-live-search="true">
                            <option  ></option>
                            <option  value="2019">2019</option>
                            <option  value="2020">2020</option>
                            <option  value="2021">2021</option>
                            <option  value="2022">2022</option>
                            <option  value="2023">2023</option>
                            <option  value="2024">2024</option>
                        </select>

                    </td>
                <tr><td ><h3 class="h33"> Vacations type:</h3> </td>
                    <td class="btn-primary">

                        <select id='VAcationstype' name="VAcationstype" class="form-control  selectpicker"   data-live-search="true">
                            <option  value="pick"></option>
                            <option  value="Annual" >Annual</option>
                            <option  value="Casual" >Casual</option>
                            <option  value="Sick" >Sick</option>
                            <option  value="All" >All</option>
                        </select>


                    </td>
                <tr></tr>
                <tr>
                    <td colspan=2>
                        <!--Download Excel Sheet button -->
                        <input type="submit" class="btno" value="Download Excel Sheet">
                    </td></tr>
            </table>

        </form>
    </div>

    <div id="Permission" class="tabcontent">
        <form method="post" action="GetPermissionExcel">
@csrf
            <table  class="table table-bordered table-striped table-hover table-list-search">
                <tr><td ><h3 class="h33"> Name:</h3> </td>
                    <td class="btn-primary">

                        <select id="name" name="name" class="form-control  selectpicker"   data-live-search="true">
                            <option  value="pick"></option>
                            <?php
                            $users=\App\User::all();
                            foreach ($users as $user){
                                echo "<option value='". $user->name ."'>" .$user->name ."</option>" ;
                            }
                            ?>
                        </select>
                <tr><td ><h3 class="h33"> Year:</h3> </td>
                    <td class="btn-primary">

                            <select id='year' name="year"  class="form-control   selectpicker"   data-live-search="true">
                                <option  ></option>
                                <option  value="2019">2019</option>
                                <option  value="2020">2020</option>
                                <option  value="2021">2021</option>
                                <option  value="2022">2022</option>
                                <option  value="2023">2023</option>
                                <option  value="2024">2024</option>
                            </select>

                    </td>

                <tr></tr>
                <tr>
                    <td colspan=2>
                        <!--Download Excel Sheet button -->
                        <input type="submit" class="btno" value="Download Excel Sheet">
                    </td></tr>
            </table>

        </form>
    </div>




    <script>  /*script for search in dropdown */
        $(function() {
            $('.selectpicker').selectpicker();
        });

    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />












    </body>
    </html>


@endsection
