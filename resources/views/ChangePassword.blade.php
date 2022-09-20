
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Arope Vacations</title>
    <style> /* button submit css */
        .btno{

            padding:   16px 44px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }/* button css */
        .btn{
            color: #d6e9f9;
            padding:   32px 20px;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }/* word of input css */
        .h33 {
            font-size: 25px;
            color: #761b18;
            text-transform: capitalize;

        }/* input css */
        input[type=text]:focus {
            border: 3px solid #555;
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

    </style>
    <!-- extend app.css -->
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')
        <html>
        <br> <!-- navbar show which  page shown to user based on his level -->




        @if(session()->has('error'))
            <center>
                <div class="alert alert-danger " style="width: 40%;border: darkred 1px solid;">
                    <h5 style="text-align: center;font-size: .9vw">  {{ session()->get('error') }}</h5>
                    <button type="button" class="btn-danger" onclick="this.parentElement.style.display='none'" id="Close" >Close</button>
                </div></center>

        @endif


        <center> <!-- form for change password -->
            <form  id="contact-form "  action="/ChangePasswordUser" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <br>

                <br><!-- user password -->
                  <h3 class="h33"> Enter your Current Password</h3>
                <br>
                <input type="password" onfocus="on" autocomplete="off" class="formm-control" id="current-password" name="current-password" placeholder="Old Password" required>
                <br>
                <br><!-- new password -->
                <h3 class="h33"> Enter your New Password</h3>
                <br>
                <input type="password" class="formm-control" autocomplete="off" id="password" name="password" placeholder="New Password" required>
                <br>
                <br><!--Confirmation  password -->
                <h3 class="h33"> Enter your Confirmation Password</h3>
                <br>
                <input type="password" class="formm-control" autocomplete="off" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" required>
                <br>
                <br>
                <br><!--submit button -->
                <input class="btno btn-primary f" type="submit" value="Submit" /><br>

            </form>
        </center>



@endsection
