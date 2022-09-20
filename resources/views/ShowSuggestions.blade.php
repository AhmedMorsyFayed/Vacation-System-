
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
        }   /*word of input css */
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


        }


        /* Style the buttons inside the tab */
        #holi{

        }

        /* Change background color of buttons on hover */
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
        #print{
            float: right;
            padding : 10px 30px;
            right: 20px;
            border: 2px solid #0d3349;
            font-size: 17px;
            font-weight: bold;
            border-radius: 20px;
            background-color: #0d3349;
            color: whitesmoke;
        }
        #print:hover{
           background-color: #9fcdff;
            color: #00002E;
        }
        @media print {
            #print {
                display: none;
            }
            #myInput {
                display: none;
            }
            .h33 {
                display: none;
            }
        }

    </style>
    <script>  /*search script */
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>

</head><!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <!-- navbar show which  page shown to user based on his level -->
        <br>
        <div>
                <div >
                    <h3 class="h33"> Search  :  </h3>

                    <input id="myInput" autocomplete="off" type="text" class="formm-control fa fa-search"  onkeyup="myFunction()" placeholder="Search..">

                    <a id="print" style="text-decoration: none" href="{{route('printingSuggetions')}}" > Print</a>
                    <br>

                    <?php
                    $db=DB::select('select * from countin');
                    ?>
                    @foreach ($db as $user)
                    <h3 class="h33"> Number Of Visitors  : {{ $user->count }}  </h3>
                    <br>
                     @endforeach
                    <!-- select all old vacation from database for admin -->
                    <table id="table_format" class="table table-bordered table-striped table-hover table-list-search">

                        <?php
                        $Suggests = \App\Suggest::all()->sortByDesc('id');
                        ?>
                        <thead>
                        <tr class="bg-info " ><!-- header -->
                            <td>Id</td>
                            <td>Type</td>
                            <td>Complaint </td>
                            <td>Name</td>
                            <?php

                            if( Auth::user()->username == 'Yasser.Hammad') {
                                ?>
                            <td>IP</td>
                            <?php
                            }
                            ?>
                            <td s>Description</td>
                            <td >Creation</td>

                        </tr>
                        </thead>
                        <tbody  id="myTable">
                        <!-- body -->
                        @foreach ($Suggests as $Suggest)
                            <tr>
                                <td>{{ $Suggest->id }}</td>
                                <td>{{ $Suggest->Type }}</td>
                                <td>{{ $Suggest->reqtype }}</td>
                                <td>{{ $Suggest->name }}</td>
                                <?php

                                if( Auth::user()->username == 'Yasser.Hammad') {
                                    ?>
                                <td>{{ $Suggest->ip }}</td>
                                <?php
                                }
                                ?>
                                <td  >{{ $Suggest->description }}</td>
                                <td>{{ $Suggest->Creation }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

        </div>

        </html>



@endsection
