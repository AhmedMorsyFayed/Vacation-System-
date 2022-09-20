
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Holiday</title>
    <script>
        /*datapicker for from input */
        jQuery(function($) {
            var today = new Date();
            var dw=today.getDate();
            var mon= today.getMonth();
            var ye= today.getFullYear();


            $( "#start" ).datepicker({



                minDate: -365,
                maxDate: 270,
                dateFormat :  'yy-mm-dd',
                onSelect: function(dateStr)
                {
                    $("#end").val(dateStr);
                    $("#end").datepicker("option",{ minDate: new Date(dateStr)})
                    $("#end" ).datepicker( "option", "maxDate", dateStr + "+4m" );
                },
                beforeShowDay: function(d) {
                    var s="2019-10-06";
                    if (d.getDay()==5) {
                        return [false];
                    } else if (d.getDay()==6){
                        return [false];
                    }else if (d.getDate()==6 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }
                    else if (d.getDate()==1 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }
                    else if (d.getDate()==27 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==24 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==25 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==1 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==2 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==30 && d.getMonth()==5 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==10 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==11 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==12 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==13 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==14 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==21 && d.getMonth()==9 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate() == dw && d.getMonth()== mon && d.getFullYear()== ye){
                        return [true, 'todayyy', '']
                    } else{
                        return [true];
                    }

                }
            });
        });
        /*datapicker for to input */
        jQuery(function($) {
            var today = new Date();
            var lastDate = new Date(2022 , 11, 31);
            var dw=today.getDate();
            var mon= today.getMonth();
            var ye= today.getFullYear();
            $( "#end" ).datepicker({



                dateFormat :  'yy-mm-dd',
                onSelect: function(dateStr) {
                    toDate = new Date(dateStr);

                    // Converts date objects to appropriate strings
                    fromDate = ConvertDateToShortDateString(fromDate);
                    toDate = ConvertDateToShortDateString(toDate);
                },
                beforeShowDay: function(d) {
                    if (d.getDay()==5) {
                        return [false];
                    } else if (d.getDay()==6){
                        return [false];
                    }else if (d.getDate()==1 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==6 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }
                    else if (d.getDate()==27 && d.getMonth()==0 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==24 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==25 && d.getMonth()==3 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==1 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==2 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==3 && d.getMonth()==4 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==30 && d.getMonth()==5 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==10 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==11 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==12 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==13 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==14 && d.getMonth()==6 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==21 && d.getMonth()==9 && d.getFullYear()==2022){
                        return [true, 'dateHighlight', '']
                    }else if (d.getDate()==dw && d.getMonth()==mon && d.getFullYear()==ye){
                        return [true, 'todayyy', '']
                    } else{
                        return [true];
                    }
                }
            });
        });
    </script>

    <style>
        .dateHighlight a { background: #d0211c !important; color: #c8cbcf !important}
        .todayyy a { background: #4aa0e6 !important;color: #c8cbcf !important}
        .bad a.ui-datepicker  { background: red; color: white; }
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

        }

    </style>


    <style>

        /* class css for input*/
        .h33 {
            font-size: 25px;
            color: #e3342f;
            text-transform: capitalize;

        }
        /* class bttn css for button*/
        .bttn{
            color: #d6e9f9;
            background-color: #1d68a7;
            padding:   16px 54px;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            border-radius: 30px;
        }
        /*h1 title css */
        .title h1 {
            font-size: 50px;
            text-transform: uppercase;
        }
        /*h4 title css */
        .title h4 {
            font-size: 20px;
            font-weight: inherit ;
            margin-top: 100px;

            color: #FFFFFF;
            text-transform: uppercase;
        }
        /*input css */
        input[type=text]:focus {
            border: 3px solid #555;
        }
        /*alert css */
        .alert {

            padding: 20px;
            background-color: #c0ddf6;
            color: red;
        }
/*class for div  */
        .closebtn {
            position: relative;
            margin-left: 15px;
            color: red;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
/*what will doing after put mouse on it */
        .closebtn:hover {
            color: black;
        }
       /*datepicker css */
        .ui-datepicker .ui-datepicker-title {
            margin: 0 2.3em;
            line-height: 1.8em;
            text-align: center;
            color:#FFFFFF;
            background:#1d68a7;
        }
        .ui-datepicker table {
            width: 100%;
            font-size: .7em;
            border-collapse: collapse;
            font-family: verdana, serif;
            margin: 0 0 .4em;
            color:#761b18;
            background:#1d68a7;
        }
        .ui-datepicker td {

            border: 0;
            padding: 1px;


        }
        .ui-datepicker td span,
        .ui-datepicker td a {
            display: block;
            padding: .8em;
            text-align: right;
            text-decoration: none;
        }
        .datepicker {
            direction: rtl;
        }
        .datepicker.dropdown-menu {
            right: initial;
        }
        .ui-datepicker {
            width: 17em;
            padding: .2em .2em 0;
            display: none;
            background:#1d68a7;
        }
        /*border for tabel */
        table, th, td {
            border: 3px solid black;
        }




    </style>
<!-- extend app.css -->
    @extends('layouts.Navbar')
    @extends('layouts.app')
    <br>
    <br>
    <br>

    @section('content')

        <html>
        <br><!-- navbar show which  page shown to user based on his level -->


@if(session()->has('alert'))
    <center>
        <div class="alert alert-danger " style="width: 20%;border: darkred 1px solid;">
            <h5 style="text-align: center;font-size: 1vw">  {{ session()->get('alert') }}</h5>
            <button type="button" class="btn btn-danger" onclick="this.parentElement.style.display='none'" id="Close" >OK</button>
        </div></center>
@endif

<!-- form for hr to edit holiday for any employee -->
<form action = "../ActionEditVacationForUser/<?php echo $user["id"]; ?>" method = "post">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <table  class="table table-bordered table-striped table-hover table-list-search">
        <tr><!-- name of employee -->
            <td><h3 class="h33"> Name  : </h3>   </td>
            <td class="btn-primary">
                <input required  class="form-control" type = 'text' id="name" name = "name"  value = '<?php echo$user["name"]; ?>'>
            </td>

        </tr>
        <tr><!-- name of Department -->
            <td><h3 class="h33">Department : </h3>  </td>
            <td class="btn-primary">
                <input required class="form-control" type = 'text' name = "Department" id="Department"  value = '<?php echo$user["Department"]; ?>'>
            </td>
        </tr>
        <tr><!-- name of Vacations Balance  -->
            <td><h3 class="h33">Vacations Balance  :</h3> </td>
            <td class="btn-primary">
                <input required class="form-control" type = 'text' name = "vacationsbalance" id="vacationsbalance"  value = '<?php echo$user["vacationsbalance"]; ?>'>
            </td>
        </tr>
        <tr><!-- name of start -->
            <td><h3 class="h33"> Start  :</h3></td>
            <td class="btn-primary">
                <input type="text" placeholder="Enter date Start" autofocus autocomplete="off" required  id="start" name="start" class="form-control">
            </td>
        </tr>
        <tr><!-- name of End -->
            <td><h3 class="h33"> End  :</h3></td>
            <td class="btn-primary">
                <input type="text" placeholder="Enter date End" autocomplete="off" required id="end" name="end" class="form-control">
            </td>
        </tr>

        <tr><!-- name of Vacations Type -->
            <td><h3 class="h33">Vacations Type  :</h3></td>
            <td class="btn-primary">

            <select required class="form-control" id="VAcationstype " name="VAcationstype"   >

                <option  value="Casual">casual</option>
                <option  value="Annual">Annual</option>
                <option  value="Sick">Sick</option>


            </select>
            </td>

        </tr>


        <tr>
            <td colspan = '5'>
                <input type = 'submit' class="bttn btn-primary btn-info " value = " OK" />
            </td>
        </tr>
    </table>
</form>
<!-- alert function -->


</html>

@endsection
