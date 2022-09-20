
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
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
        } /*word of input css */
        .h33 {
            font-size: 25px;
            color: #761b18;
            text-transform: capitalize;

        }   /* class css for input*/
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


        }   /* class btno css for button*/
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

        }

    </style>
    <script>
        /*script for search in tabel */
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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



    </script>
</head> <!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <!-- navbar show which  page shown to user based on his level -->
        <br>
        <div>



            <form method="post" action="Excelmanager">
                @csrf
                <h3 class="h33"> Search  :  </h3>
                <input id="myInput" type="text" class="formm-control"  onkeyup="myFunction()" placeholder="Search..">
            <br>

                <input type="submit" class="btno" value="Download Excel Sheet">
                <br><br>


<br>

            <table class="table table-sm table-primary">

                    <?php
                $Name=Auth::user()->name;
                $users=\App\User::where('Manager',$Name)->get();

                    ?>
                        <thead> <!--header -->
                    <tr class="bg-info " >

                        <td>Employee Name</td>
                        <td >Vacations Balance</td>

                    </tr>
                        </thead>
                        <tbody  id="myTable">
                        <!--body -->
                    @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->vacationsbalance }}</td>


                        </tr>
                    @endforeach
                        </tbody>
                </table>

</form>







        </html>



@endsection

