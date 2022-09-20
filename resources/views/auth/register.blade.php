
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Holiday</title>
<style>
    /*button css */
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
    <script>
        // select picker javascript
        $(function() {
            $('.selectpicker').selectpicker();
        });

    </script>

</head>

    @extends('layouts.app')


    @section('content')

<div class="container">
    <!-- library of select picker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />


    <!-- register card-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Select Manager -->
                        <div class="form-group row">
                            <label for="Manager" class="col-md-4 col-form-label text-md-right">{{ __('Manager') }}</label>

                            <div class="col-md-6">
                                <?php
                                include ('C:\Windows\System32\blog\config\connect.php');
                                ?>
                                <select id="Manager" name="Manager" class="form-control  @error('Manager') is-invalid @enderror selectpicker"   data-live-search="true">
                                    <option  value="pick"></option>
                                    <?php

                                    $Managers=\App\User::where('level',"Manager")->orwhere('level',"TopManager")->get();
                                     foreach ($Managers as $Manager ){
                                        echo "<option value='". $Manager->name ."'>" .$Manager->name ."</option>" ;
                                    }
                                    ?>
                                </select>
                                @error('Manager')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- Select Manager email -->
                        <div class="form-group row">
                            <label for="Manageremail" class="col-md-4 col-form-label text-md-right">{{ __(' Manager Email') }}</label>
                            <div class="col-md-6">
                                <select id="Manageremail" name="Manageremail" class="form-control  @error('Manageremail') is-invalid @enderror selectpicker"   data-live-search="true">
                                    <option  value="pick"></option>
                                    <?php
                                    foreach ($Managers as $Manager ){
                                        echo "<option value='". $Manager->email ."'>" .$Manager->email ."</option>" ;
                                    }
                                    ?>
                                </select>
                                @error('Manageremail')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee Number -->
                        <div class="form-group row">
                            <label for="employeenumber" class="col-md-4 col-form-label text-md-right">{{ __('Employee Number') }}</label>

                            <div class="col-md-6">
                                <input id="employeenumber" type="text" class="form-control @error('employeenumber') is-invalid @enderror" name="employeenumber" value="{{ old('employeenumber') }}" required autocomplete="off" autofocus>

                                @error('employeenumber')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __(' User Name') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="off" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __(' Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="off" >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <!-- put Employee company -->
                        <div class="form-group row">
                            <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                            <div class="col-md-6">
                                <select id="company"  name="company" class="form-control @error('company') is-invalid @enderror"  required autofocus>
                                    <option  value="pick"></option>
                                    <option  value="Life">Life</option>
                                    <option  value="Non Life">Non Life</option>
                                </select>

                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                            <!-- put Employee Department-->
                            <div class="col-md-6">
                                <select id="Department" name="Department" class="form-control @error('Department') is-invalid @enderror"  required autofocus>
                                    <option  ></option>
                                    <option  value="Operation non life">Operation non life</option>
                                    <option  value="IT">IT</option>
                                    <option  value="HR">HR</option>
                                    <option  value="Claims">Claims </option>
                                    <option  value="Room">Room </option>
                                    <option  value="Finance" >Finance</option>
                                    <option  value="Motor Department" >Motor Department</option>
                                    <option  value="Business Development" >Business Development</option>
                                    <option  value="Administration" >Administration</option>
                                    <option  value="Medical" >Medical</option>
                                    <option  value="Internal Audit" >Internal Audit</option>
                                    <option  value="Management" >Management</option>
                                    <option  value="Arope Life" >Arope Life</option>
                                    <option  value="Operations Life" >Operations Life</option>
                                    <option  value="Compliance" >Compliance</option>
									<option  value="Bancassurance" >Bancassurance</option>
									<option  value="legal">Legal</option>
                                </select>
                                @error('Department')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                            <!-- put Employee level -->
                            <div class="col-md-6">
                                <select id="level" name="level" class="form-control @error('level') is-invalid @enderror"  required autofocus>
                                    <option  value="pick"></option>
                                    <option  value="Employee">Employee</option>
                                    <option  value="Manager">Manager</option>
                                    <option  value="HR">HR</option>
                                    <option  value="Admin">Admin</option>
                                    <option  value="TopManager">Top Manager</option>

                                </select>

                                @error('level')
                            <!-- span about feedback -->
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <!-- put Employee vacation balance -->
                            <label for="vacationsbalance" class="col-md-4 col-form-label text-md-right">{{ __('Vacations Balance') }}</label>

                            <div class="col-md-6">
                                <input id="vacationsbalance" type="text" class="form-control @error('vacationsbalance') is-invalid @enderror" name="vacationsbalance" value="{{ old('vacationsbalance') }}"  autocomplete="off">

                                @error('vacationsbalance')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee password-->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <!-- put Employee password confirmation -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" >
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('layouts.Navbar')
@endsection

