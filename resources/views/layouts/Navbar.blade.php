
@if (Route::has('login'))

@auth

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<style >
    .navbar{
        position: absolute;
    }

</style>


<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <a class="navbar-brand fa fa-home" href="{{route('home')}}">Home</a>

    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">My Vacations</button>
        <div class="dropdown-menu">
            <a href="{{route('ApproveVacations')}}" class="dropdown-item">Approve</a>
            <a href="{{route('RejectVacations')}}" class="dropdown-item">Reject</a>
            <?php

            if (Auth::user()->level != 'TopManager') {            ?>
            <a href="{{route('PendingVacations')}}" class="dropdown-item">Pending</a>
            <?php
            }
            ?>
            <div class="dropdown-divider"></div>
        </div>
    </div>

    <?php

    if (Auth::user()->level == 'Admin') {            ?>

    <a class="navbar-brand nav-link" style="font-size: .85vw" href="{{route('AllVacation')}}">Users Vacations <span class="sr-only">(current)</span></a>
    <a class="navbar-brand nav-link" style="font-size: .85vw" href="{{route('PublicVacations')}}">Public Vacations <span class="sr-only">(current)</span></a>

    <?php
    }
    ?>


    <?php
    if ((Auth::user()->level == 'Manager')or (Auth::user()->level == 'TopManager')) {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('ApproveView')}}">Approve <span class="sr-only">(current)</span></a>
        </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('RejectView')}}">Reject <span class="sr-only">(current)</span></a>
        </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('PendingView')}}">Pending <span class="sr-only">(current)</span></a>
        </ul>
    </div>
    <?php
    }
    ?>


    <?php

    if (Auth::user()->level == 'HR') {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link navbar-brand" style="font-size: .85vw" href="{{route('pendingHrView')}}">Pending <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link navbar-brand" style="font-size: .85vw" href="{{route('ApproveHrView')}}">Approve <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link navbar-brand" style="font-size: .85vw" href="{{route('RejectHRView')}}">Reject <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link navbar-brand" style="font-size: .85vw" href="{{route('AllUsersView')}}">Edit vacation <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link" href="{{route('ExcelView')}}">Excel Report <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link" href="{{route('pendingcancelView')}}">Cancel vacation Or Permission <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
        <a class="nav-link" href="{{route('vacationchangeView')}}">Change Vacation Balance <span class="sr-only">(current)</span></a>
            </li></ul>
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('HRHistory')}}">History <span class="sr-only">(current)</span></a>
        </li></ul>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('UsersRequests')}}">User Requests <span class="sr-only">(current)</span></a>
            </li></ul>

    <?php
    }
    ?>

    <?php

    if ( Auth::user()->level == 'Manager') {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('History')}}" >History <span class="sr-only">(current)</span></a>
        </ul>


    </div>
    <?php
    }
    ?>
    <?php

    if ( Auth::user()->level == 'Admin') {
    ?>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('UsersPassword')}}">Create users Password <span class="sr-only">(current)</span></a>
        </ul>

    </div>
    <?php
    }
    ?>
    <?php

    if (Auth::user()->level == 'TopManager' ) {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('Vacations')}}">Employee Vacations<span class="sr-only">(current)</span></a>


        </ul>

    </div>
    <?php
    }
    ?>
    <?php

    if (Auth::user()->level == 'TopManager' ) {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('ExcelTopManager')}}">Excel Report<span class="sr-only">(current)</span></a>

        </ul>

    </div>
    <?php
    }
    ?>

    <?php

    if( (Auth::user()->level == 'TopManager' ) or (Auth::user()->level == 'Manager' )) {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('ExcelManager')}}"> Employees Vacation Balance  <span class="sr-only">(current)</span></a>
        </ul>

    </div>
    <?php
    }
    ?>


    <?php
        $UserNames = \App\Showsuggestion::all();
        foreach ($UserNames as $name){
            $User []=$name->UserName;
        }
        $UserName=Auth::user()->username;

        if (in_array($UserName,$User))

    {
    ?>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('ShowSuggestions') }}">Suggestions<span class="sr-only">(current)</span></a>
            </li>
        </ul>

    </div>
    <?php
    }
    ?>

</nav>

</html>
@endauth
@else
    <script>
        alert("Please login")

    </script>



@endif
