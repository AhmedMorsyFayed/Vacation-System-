
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vacation</title>


        <style type="text/css">

            .box .text{
                position: absolute;
                z-index: 999;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: 40%; /* Adjust this value to move the positioned div up and down */
                text-align: center;
                width: 60%; /* Set the width of the positioned div */
            }
            body, html {
                height: 100%;
                margin: 0;
                background: url('/svg/4.jpeg') no-repeat center center fixed;
                -webkit-background-size: 100% 100%;
                -moz-background-size: 100% 100%;
                -o-background-size: 100% 100%;
                background-size: 100% 100%;
                width:100%;

            }

            a:link, a:visited {
                background-color: #1d68a7;
                color: white;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
            }
#loginForm{

    width: 35%;
    height: 1%;
}

            .h33 {
                font-size: 1vw;

                color: #fff3cd;
                text-transform: capitalize;

            }
            .formm-control{
                display: block;
                width: 100%;
                height: 25px;
                padding: 0.375rem 0.75rem;
                font-size: .8vw;
                font-weight: 400;
                line-height: 1.6;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;


            }
            td
            {
                padding:0 25px;
            }
            .btno{
                padding:   15% 20%;
                font-size: .7vw;
                font-weight: 800;
                letter-spacing: .1rem;
                text-decoration: none;
                cursor: pointer;
                border-radius: 10px;
                color: #c0ddf6;
                background-color: #1d68a7;}
            .btno:hover {
                background-color: #0b2e13;
                color: white;
            }

            .invalid-feedbackk{
                font-size: 18px;
                font-weight: 800;
                color: #fff3cd;

            }


            a:link, a:visited {
                background-color: #00002E;
                color: white;
                padding: 14px 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                border-radius: 30px;

            }

            a:hover, a:active {
                background-color: red;
            }


            @-moz-keyframes fa {
                0%   { -moz-transform: translateX(70%); }
                100% { -moz-transform: translateX(0%); }
            }
            @-webkit-keyframes fa{
                0%   { -webkit-transform: translateX(70%); }
                100% { -webkit-transform: translateX(0%); }
            }
            @keyframes fa {
                0%   {
                    -moz-transform: translateX(70%); /* Firefox bug fix */
                    -webkit-transform: translateX(70%); /* Firefox bug fix */
                    transform: translateX(70%);
                }
                100% {
                    -moz-transform: translateX(0%); /* Firefox bug fix */
                    -webkit-transform: translateX(0%); /* Firefox bug fix */
                    transform: translateX(0%);
                }
            }
            #foot{
                position: fixed;
                padding: 20px;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: #0d3349;
                color: white;
                text-align: center;
            }
            .btnn{
                padding:  12px 25px;
                font-size: 20px;
                font-weight: 800;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                cursor: pointer;
                border-radius: 30px;
                color: #c0ddf6;
                background-color: #4c110f;}
            .btnn:hover {
                background-color: #123c24;
                color: white;
            }
            #ntb{
                padding-left: 20px;
                padding-top: 40px;
            }

            .roww input{
                float:left;

            }
            .Center {
                position: absolute;
                background: #1b4b72;
                left: 50%;
                top: 40%;
                width: 30%;
                height: 22%;
                transform: translate(-50%, -50%);
                border: 4px solid #0d3349;
                padding: 10px;
            }


        </style>
        <script>

                var cnt=0;
                function CountFun(){

                cnt=parseInt(cnt)+parseInt(1);
                var divData=document.getElementById("showCount");
                divData.innerHTML="Number of Downloads: ("+cnt +")";//this part has been edited

            }

        </script>



    </head>
    <body>

    <div id="showCount"></div>
        <div id="ntb" >
    <a type="button" id="ask"
            class="btnn  bg-primary " href="{{route('SuggestView')}}" >  الشكاوى و المقترحات</a>
        </div>

<center>
    <div  class="Center"  ><!--  <marquee behavior="slide" direction="left">-->

        <table>
            @if (Route::has('login'))

                @auth
                    <a href="{{ url('/home') }}">Home</a>

                @else
                    <form method="POST"  action="{{ route('login') }}">
                        @csrf
                        <tr>
                            <td>
                                <h3 class="h33"> UserName </h3>

                            </td>
                            <td>
                                <input id="username" type="text" class="formm-control  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                <span class="invalid-feedbackk " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="h33"> Password </h3>
                            </td>
                            <td>

                                <input id="password" type="password" class="formm-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedbackk " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </td>
                            <td>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btno  bg-primary ">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </td>

                        </tr>

                    </form>


                @endauth

            @endif
            <br>
            <br>




            <!-- </marquee> -->
        </table>
    </div>
</center>




        <p id="foot" class="footer" style="font-size: 20px">&copy; 2019 Arope IT Department Group<p>






    </body>
</html>

