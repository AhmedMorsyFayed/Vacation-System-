
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Holiday</title>
    <style>
        /*button submit css*/
        .btno{

            padding:   16px 74px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        } /* The container */
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
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size:25px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default radio button */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .container .checkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        .h33 {
            font-size: 25px;
            color: #1d68a7;
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
        <br>   <!-- navbar show which  page shown to user based on his level -->

<body>
@if(session()->has('red'))
    <center>
        <div class="alert alert-danger " style="width: 20%;border: darkred 1px solid;">
            <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('red') }}</h5>
            <button type="button" class="btn btn-danger" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
        </div></center>
@endif

<!-- form for hr to update vacation -->


<center>
<form action = "../DoingUpdateApprovePermission/<?php echo $Permission["id"]; ?>" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <table  class="table table-bordered table-striped table-hover table-list-search">



        <tr></tr>


        <tr><!-- user start -->
            <td  ><h3 class="h33"> Start : </h3></td>
            <td class="bg-primary">
                <input required class="form-control" readonly type = 'text' id="start" name = "start"  value = '<?php echo$Permission["start"]; ?>'>
            </td>

        </tr><!-- user end -->
        <tr>
            <td  ><h3 class="h33">End  :</h3></td>
            <td class="bg-primary">
                <input required class="form-control" readonly type = 'text' name = "end" id="end"  value = '<?php echo$Permission["end"]; ?>'>

            </td>
        </tr><!--user Vacations Type -->

        <tr><!-- user status -->
            <td  ><h3 class="h33">Status  :</h3></td>
            <td class="bg-primary">
                <select  id="status" name="status" class="form-control @error('status') is-invalid @enderror"  required autofocus>
                    <option  > </option>
                    <option  value="Approve">Approve</option>
                    <option  value="Reject">Reject</option>
                </select>
            </td>
        </tr>



        <tr></tr>
        <tr></tr><!-- submit button -->
        <tr>
            <td colspan = '5'>
                <input type = 'submit' class="btno btn-primary" value = " OK" />
            </td>
        </tr>
    </table>
</form>
</center>


@if(isset($UpdatePermission))
    <center>
        <form action = "../doingHRUpdatePermission/<?php echo $UpdatePermission["id"]; ?>" method = "post">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
            <table  class="table table-bordered table-striped table-hover table-list-search">



                <tr></tr>
                <tr>
                    <td  ><h3 class="h33">Name  :</h3></td>
                    <td class="bg-primary">
                        <input required class="form-control" type = 'text' name = "name" id="name"  value = '<?php echo$Permission["Name"]; ?>'>

                    </td>
                </tr>
                <tr><!-- user start -->
                    <td  ><h3 class="h33"> Day : </h3></td>
                    <td class="bg-primary">
                        <input required class="form-control" type = 'date' id="day" name = "day"  value = '<?php echo$UpdatePermission["day"]; ?>'>
                    </td>

                </tr>

                <tr><!-- user start -->
                    <td  ><h3 class="h33"> Start : </h3></td>
                    <td class="bg-primary">
                        <input required class="form-control" type = 'text' id="start" name = "start"  value = '<?php echo$UpdatePermission["start"]; ?>'>
                    </td>

                </tr><!-- user end -->
               <!--user Vacations Type -->

                <tr><!-- user status -->
                    <td  ><h3 class="h33">Status  :</h3></td>
                    <td class="bg-primary">
                        <select  id="status" name="status" class="form-control @error('status') is-invalid @enderror"  required autofocus>
                            <option  > </option>
                            <option  value="Approve">Approve</option>
                            <option  value="Reject">Reject</option>
                        </select>
                    </td>
                </tr>



                <tr></tr>
                <tr></tr><!-- submit button -->
                <tr>
                    <td colspan = '5'>
                        <input type = 'submit' class="btno btn-primary" value = " OK" />
                    </td>
                </tr>
            </table>
        </form>
    </center>
@endif
</body>
</html><!-- alert function -->

@endsection
