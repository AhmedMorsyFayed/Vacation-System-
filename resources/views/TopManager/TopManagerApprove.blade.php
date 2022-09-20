
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Vacation System</title>
    <style>

        /*button submit css*/
        .btno{

            padding:   16px 44px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }

        /* The container */
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

            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .checkmark {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: white;
            position: absolute;
            left: 0;
            top: 0;
            bottom: 2px;
            border: 1px solid black;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {

        }

        /* When the radio button is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #1390e5;
            border: 1px solid #1390e5;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            height: 6px;
            width: 11px;
            border-left: 2px solid white;
            border-bottom: 2px solid white;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
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
    </style>
    <!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')

        <html>
        <!-- navbar show which  page shown to user based on his level -->


<body>



<center><!-- form for top manager to approve or reject -->
    <form action = "/edittopper/<?php echo $users[0]->id; ?>" method = "post">
        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
        <table >


            </tr>
            <tr></tr>

            <tr>
                <!-- container for approve -->
                <td> <label class="container">
                        <input  type="radio" id="HR" name="status"  value="Approve">Approve
                        <span class="checkmark"></span>
                    </label><!-- container for Reject -->
                    <label class="container">
                        <input  type="radio" id="HR" name="status" value="Reject">Reject
                        <span class="checkmark"></span>
                    </label>
            </tr>

            <tr></tr>
            <tr></tr>
            <tr>
                <td colspan = '5'><!-- button for submit-->
                    <input type = 'submit' class="btno btn-danger  " value = " OK" />
                </td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>

@endsection