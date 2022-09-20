
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
    <title>Vacation System</title>

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

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
        /* class css for input*/
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

            /* class css for input*/
        }
        .h33 {
            font-size: 25px;
            color: #761b18;
            text-transform: capitalize;

        }
        /* class css for input*/
        input[type=text]:focus {
            border: 3px solid #555;
        }

    </style>

    <!-- extend app.css -->


    @extends('layouts.Navbar')
    @extends('layouts.app')
    <br>
    <br>
    <br>



    @section('content')

        <html >
        <br><!-- navbar show which  page shown to user based on his level -->


        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 20%;border: darkblue 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn btn-success" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>
        @endif

        <?php

            $users=\App\User::all();
        ?>
        <h3 class="h33"> Search  :  </h3>
        <input id="myInput" class="formm-control" type="text" placeholder="Search..">
        <br><br>

        <table id="table_format" class="table table-bordered table-striped table-hover table-list-search">
            <thead>
            <tr><!-- head of table -->
                <th>ID</th>
                <th>Employe NUM</th>
                <th>Name</th>
                <th>company</th>
                <th>Department</th>
                <th>Level</th>
                <th>Vacations Balance</th>

            </tr>
            </thead>
            <tbody  id="myTable">
            @foreach ($users as $user)
                <tr class="content">
                    <!-- body of table -->
                    <td  >{{ $user->id }}</td>
                    <td >{{ $user->employeenumber }}</td>
                    <td >{{ $user->name }}</td>
                    <td >{{ $user->company}}</td>
                    <td >{{ $user->Department }}</td>
                    <td >{{ $user->level}}</td>
                    <td >{{ $user-> vacationsbalance}}</td>
                    <td><a href = 'EditVacationForUser/{{ $user->id }}'>Take Holiday</a></td>
                    <td><a href = 'EditPermissionForUser/{{ $user->id }}'>Take Permission</a></td>




                </tr>
            @endforeach
            </tbody>
        </table>
        <script>
            /*script for search in tabel */
            $(document).ready(function(){
                $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });




        </script>


        </html>
@endsection
