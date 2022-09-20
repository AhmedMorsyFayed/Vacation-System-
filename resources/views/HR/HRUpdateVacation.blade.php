
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


        /* Hide the browser's default radio button */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }


        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
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


<!-- form for hr to update vacation -->
<center>
<form action = "../doingHRUpdateVacation/<?php echo $user["id"]; ?>" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <table  class="table table-bordered table-striped table-hover table-list-search">


        </tr>
        <tr></tr>


        <tr><!-- user start -->
            <td  ><h3 class="h33"> Start : </h3></td>
            <td class="bg-primary">
                <input required class="form-control" type = 'date' id="start" name = "start"  value = '<?php echo$user["start"]; ?>'>
            </td>

        </tr><!-- user end -->
        <tr>
            <td  ><h3 class="h33">End  :</h3></td>
            <td class="bg-primary">
                <input required class="form-control" type = 'date' name = "end" id="end"  value = '<?php echo$user["end"]; ?>'>

            </td>
        </tr>
        <tr>
            <td ><h3 class="h33">Vacations Type  :</h3></td>
            <td class="bg-primary">
                <select  id="VAcationstype"  name="VAcationstype"  class="form-control @error('status') is-invalid @enderror"  required autofocus>
                    <option  > </option>
                    <option  value="Annual">Annual</option>
                    <option  value="Casual">Casual</option>
                    <option  value="Sick">Sick</option>
                </select>

            </td>
        </tr>
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
</body>
</html><!-- alert function -->

@endsection
