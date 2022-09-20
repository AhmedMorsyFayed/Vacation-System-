<?php

namespace App\Http\Controllers\Admin;

use App\Http\Middleware\Admin;

use App\Http\Controllers\Controller;
use App\PublicVacation;
use App\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('Admin');
    }
#####################################Define Views Of Admin
    public function AllVacationView()
    {
        return view('Admin.AllVacation');
    }

    public function AllUsers()
    {
        return view('Admin.UsersPasswords');
    }
    public function PublicVacationsFunction()
    {
        return view('Admin.PublicVacations');
    }






  ##########################################################


    public function UsersPassword($id)
    {

        User::where('id',$id)->update(['password'=>bcrypt("Egypt@123"),'Loginnum' => 0 ]);

        return redirect()->back()->with('Sucess', 'Password Changed Successfully');

    }

    public function delete($id)
    {
        User::where('id',$id)->delete();
        return redirect()->back()->with('Sucess', 'User Deleted Successfully');
    }

    public function UpdatePublicVacations(Request $request,$id)
    {
        $NewDate=$request->input('Date');
        PublicVacation::where('id',$id)->update(["Date" =>"$NewDate"]);
        return redirect()->back()->with('Sucess', 'Public Vacation Updated Successfully');
    }

    public function AddPublicVacationsFunction(Request $request)
    {
        $NewDate=$request->input('Date');
        $AllDate=PublicVacation::all();
        foreach ($AllDate as $date){
            $arrayOfDate []= $date->Date;
        }
        if(in_array($NewDate,$arrayOfDate)){
            return redirect()->back()->with('Sucess', 'Public Vacation has Already In DataBase');
        }
        else
        {
            PublicVacation::create(["Date" => $NewDate]);
            return redirect()->back()->with('Sucess', 'Public Vacation Added Successfully');
        }

    }





}
