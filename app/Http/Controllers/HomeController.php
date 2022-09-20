<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

//controller for define pages on web

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function HomeView()
    {
        return view('home');
    }
    public function ForcePasswordFirstLogin()
    {
        return view('ForcePassword');
    }
    public function ApproveVacationsView()
    {
        return view('ApproveVacations');
    }
    public function PendingVacationsView()
    {
        return view('PendingVacations');
    }
    public function RejectVacationsView()
    {
        return view('RejectVacations');
    }
    public function TakeVacationView()
    {
        return view('TakeVacation');
    }
    public function TakePermisionView()
    {
        return view('TakePermision');
    }

    public function RequestView()
    {
        return view('request');
    }

    public function ShowSuggestionsView()
    {
        return view('ShowSuggestions');
    }

    public function printingSuggetionsView()
    {
        return view('printingSuggetions');
    }

    public function ChangePasswordView()
    {
        return view('ChangePassword');
    }






}
