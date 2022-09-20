
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Request</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: url('/svg/q.png') no-repeat center center fixed;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
            width:100%;

        }
#topp{
    width: 100%;
    height: 70px;
    background: #0c5460;
    position: absolute;
}

#back{
    padding:   1% 20px;
    font-size: 19px;
    float: left;
    width: 10%;
    background: #0d3349;
}

.tra{
    padding: 3%;
    margin: auto;
    width: 78%;
    height: 30%;
    border: 15px solid #0d3349;

    position: relative;
}
        .Center {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 40%;
            height: 40%;
            transform: translate(-50%, -50%);
            border: 8px solid #0d3349;
            padding: 10px;
        }

        .UpperCenter{
            width: 40%;
            position: absolute;
            top: 20%;
            left: 52%;
            transform: translate(-50%, -50%);
        }

        .CenterButton {
            position: absolute;
            left: 50%;
            top: 75%;
            width: 13%;
            transform: translate(-50%, -50%);
            border: 1px solid #0d3349;
            padding: 10px;
        }
        #Directed{
            width: 80%;
            border: 1px solid #0d3349;
        }
        #Directed::placeholder{
            color: #00002E;
        }

    </style>

<script>
    $(document).ready(function() {
        $('#ask').bind('change', function() {

            var value = $(this).val();

            if (value == "Others أخرى")
            {
                $('#Request').show();
                $('#Directed').hide();


            }else if (value.length == 0){
                $('#Request').hide();
                $('#Directed').hide();
            }
            else {
                $('#Request').hide();
                $('#Directed').show();
                $('#Directed').attr('required', true)
            }


          /*  if (value.length) { // if somethings' selected
                elements.filter('.' + value).show(); // show the ones we want
            }*/
        }).trigger('change');

    });
</script>
</head>


<body>
<div id="topp">
    <button  id="back" class="btn btn-primary btn-block" onclick="window.location.href = './home';" role="button">back</button>
    <center>
        <h2 style="color: whitesmoke;padding-right: 10%"> Request To HR Department</h2>
    </center>
</div>





<form method="post" action="/InsertRequest">
    @csrf
    <div class="UpperCenter">
        <select class="form-control" style="font-size: 1.2vw;color: #000000;border: 2px solid #0d3349; width: 85%;height: 15%;direction: rtl" id="ask" name="ask"  required autofocus>
            <option  value="" > اختر خدمات  HR ؟؟</option>
            <option  value="طلب مفردات مرتب HR Letter" >طلب مفردات مرتب HR Letter</option>
            <option  value="Print Out برنت تاميني" >Print Out برنت تاميني </option>
            <option  value="Others أخرى" >Others أخرى</option>
        </select>
<br>
        <div class="container" style="width: 85%">
            <div class="طلب مفردات مرتب HR Letter"  >
                <input class="form-control" name="Directed" id="Directed" type="text" placeholder="Directed To ??"/>
            </div>
        </div>
    </div>

    <div class="Center" id="Request">
        <textarea style="font-size: 1vw;color: #000000;text-align: justify;width: 100%;height: 100%"  name="Request" > </textarea>
    </div>
<br>
<center> <button  class="btn btn-primary CenterButton" type="submit" style="font-size: .9vw"  >Submit</button></center>
</form>



<br><br><br>
@if(session()->has('red'))

        <div class="alert alert-danger " style="width: 20%;border: darkred 1px solid;">
            <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('red') }}</h5>
            <button type="button" class="btn btn-danger" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
        </div>
@endif







</body>
</html>

