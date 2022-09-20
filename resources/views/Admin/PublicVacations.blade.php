
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Users Passwords</title>

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <style> /*tabel css */
        table tr:not(:first-child){
            cursor: pointer;transition: all .25s ease-in-out;
        }
        table tr:not(:first-child):hover{background-color: #ddd;}
        table, th, td {
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


        }/*word of input css */
        .h33 {
            font-size: 25px;
            color: #761b18;
            text-transform: capitalize;

        }/* input css */
        input[type=text]:focus {
            border: 3px solid #555;
        }

    </style><!-- extend app.css -->
    @extends('layouts.Navbar')
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')

        <html >
        <br>     <!-- navbar show which  page shown to user based on his level -->

        @if(session()->has('Sucess'))
            <center>
                <div class="alert alert-success " style="width: 20%;border: darkblue 1px solid;">
                    <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('Sucess') }}</h5>
                    <button type="button" class="btn btn-success" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
                </div></center>
        @endif


        <!-- select all users from database -->
        <?php
        $Dates = \App\PublicVacation::all();
        ?>

        <table id="table_format" class="table table-bordered table-striped table-hover table-list-search">
            <thead>
            <tr><!-- header -->
                <th>ID</th>
                <th>Data</th>

            </tr>
            </thead>
            <tbody  id="myTable"><!-- body-->
            @foreach ($Dates as $q)

                <tr class="content">
                    <td  ><input class="form-control" name="id" value="{{ $q->id }}" style="border: none;background: none"></td>
                    <td > <form action="UpdatePublicVacations/{{ $q->id }}" method="post">
                            @csrf
                        <div style="display: inline">
                            <input  name="Date" value="{{ $q->Date }}" style="border: none;background: none;width: 50%">
                            <button type="submit"  class="btn-primary btn" >Update</button></div>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr class="content">
                <td  ></td>
                <td > <form action="AddPublicVacations" method="post">
                        @csrf
                        <div style="display: inline">
                            <input  name="Date" type="date" style="border: none;background: none;width: 50%">
                            <button type="submit"  class="btn-primary btn" >Add</button></div>
                    </form>
                </td>
            </tr>


            </tbody>
        </table><!-- search script-->



        </html>
@endsection
