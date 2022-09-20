<?php

namespace App\Http\Controllers;
use App\Exports\All;
use App\Exports\CustomersFromView;
use App\Exports\PostsQueryExport;
use App\Exports\Topmanager;
use App\Exports\TopManPer;
use App\PublicVacation;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Holiday;
use \App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;

class vacation extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function ForceChangeFunction(Request $request)
    {
        if ((Hash::check($request->get('password'), Auth::user()->password))) {
            return redirect()->back()->with('error','New Password is  the same as your current password.  Please try again');
        }elseif (!(strcmp($request->get('password'), $request->get('password_confirmation')) == 0)) {
            return redirect()->back()->with('error','New Password is not the same as your confirmation password. Please Try Again');
        } else {
            $UserName=Auth::user()->username;
            User::where("username",$UserName )->update(["password" => bcrypt($request->get('password')) ,"Loginnum" => 1 ]);
            return redirect('home')->with('Sucess','Password Changed Successfully');
        }
    }

    public function ChangePasswordFunction(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('error','Your current password does not matches with the password you provided. Please try again');
        } elseif ((strcmp($request->get('password'), $request->get('password_confirmation')) == 0) And
            (strcmp($request->get('current-password'), $request->get('password')) == 0)) {
            return redirect()->back()->with('error','New Password is  the same as your current password.  Please try again');
        } elseif (!(strcmp($request->get('password'), $request->get('password_confirmation')) == 0)) {
            return redirect()->back()->with('error','New Password is not the same as your confirmation password. Please choose a different password');
        } else {
            $user = Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return redirect('home')->with('Sucess','Password Changed Successfully');

        }
    }




    public function CancelUserVacation( Request $request)
    {
        $id = $request->input('id');
        Holiday::where('id',$id)->update(["status" => "Cancel"]);
        return redirect()->back()->with('Sucess','The vacation has been Canceled Successfully');

    }

    public function BokeVacationFunction(Request $request)
    {

        $Username = Auth::user()->name;
        $idholiday = 0;    /* intlize id holiday */
        $maximum =Holiday::max('idHoliday');
        $iduserHoliday=Holiday::where('name',$Username)->get();
        foreach ($iduserHoliday as $user) {
            $idholiday = $user->idHoliday;
        }
        $StartDate = $request->input('start');/* user start*/
        $End_Date = $request->input('end');
        $Vacationtype = $request->input('VAcationstype');/* user vacation type*/


        $Start_items = array();
        $typearray =array();
        $endarray = array();
        $Vacations = Holiday::where('name',$Username)->get();
        foreach ($Vacations as $q) {
            $Start_items[]=$q->start;
            $endarray[]=$q->end;
            $typearray[] =$q->VAcationstype;
        }
        $vals = array_count_values($typearray);
        $itemsdays = array();


        $sqlday = Holiday::where('name',$Username)->where('VAcationstype',$Vacationtype)->get();
        foreach ($sqlday as $user) {
            $numdays=$user->HloiDays;
            $itemsdays[] = $numdays;
        }
        $Vacation_Typed_days = array_sum($itemsdays);
        $Department = Auth::user()->Department; /* user Department*/

        $CountVacations = 0;
        /* count working days*/
        for ($i = strtotime($StartDate); $i <= strtotime($End_Date); $i = $i + (60 * 60 * 24)) {
            if ((date("N", $i) == 7) or (date("N", $i) == 1)
                or (date("N", $i) == 2)
                or (date("N", $i) == 3)
                or (date("N", $i) == 4)) $CountVacations = $CountVacations + 1;
        }

        $PublicDays=PublicVacation::all();
        $PublicDaysArray=array();
        foreach ($PublicDays as $day){
            $PublicDaysArray [] =$day->Date;
        }

        for ($i = strtotime($StartDate); $i <= strtotime($End_Date); $i = $i + (60 * 60 * 24)) {
            if (in_array($i,$PublicDaysArray))
                $CountVacations = $CountVacations - 1;
        }

        /* valadition of id of holiday*/
        if ($idholiday == NULL) {
            $newidholiday = $maximum + 1;
        } else {
            $newidholiday = $idholiday;
        }
        $creation = date(" Y-m-d ");
        $Maxnum=6-$Vacation_Typed_days;

        $VacationsBalance=User::where('name',$Username)->get()->toArray();
        $Balance=$VacationsBalance[0]["vacationsbalance"];
        $Level=Auth::user()->level;

        /* check vor insert vacation in table*/
        if($CountVacations > $Balance)
        {
            return redirect()->back()->with('alert', 'The Vacations balance is not enough. Please Refer to HR Department.');
        }
        elseif ($CountVacations > 14) {
            return redirect()->back()->with('alert', 'Your current Holiday does not matches with the limit of Holidays Days. Please try again.');
        } elseif (in_array($StartDate,$Start_items)) {
            return redirect()->back()->with('alert', 'You have already taken this day .Please choose another day .');
        } elseif (in_array($End_Date,$endarray)) {
            return redirect()->back()->with('alert', 'You have already taken this day .Please choose another day .');
        }elseif (($Vacationtype == "Casual") && ($Vacation_Typed_days >= 6) ) {
            return redirect()->back()->with('alert', 'Maximum number to take Casual Holiday is 6 And you reached the
             number of Casual vacations for this number , Please Refer to HR Department. ');
        }elseif (($Vacationtype == "Casual") && (($Vacation_Typed_days+$CountVacations) >= 6) ) {
            return redirect()->back()->with('alert', "Maximum number to take Casual Holiday is 6 So I suggest you take $Maxnum and its available to you now.
             or Please Refer to HR Department. ");
        }elseif (in_array($StartDate,$PublicDaysArray)) {
            return redirect()->back()->with('alert', 'This day is a public Holiday .Please choose another day .');
        } elseif ($CountVacations > Auth::user()->vacationsbalance) {
            return redirect()->back()->with('alert', 'Your Vacations balance is not enough. Please Refer to HR Department.');
        }
        elseif ($Level == "TopManager")
        {
            $NewDays = $Balance -$CountVacations;
            $data = ['name' => $Username, 'Department' => $Department, "idHoliday" => $newidholiday, "start" => $StartDate,
                "end" => $End_Date, "VAcationstype" => $Vacationtype, "HloiDays" => $CountVacations,
                "status" => "Approve", "creation" => $creation ,"manger" => $Username,"AprovaleDate"=>$creation ];
            Holiday::create($data);
            User::where('name',$Username)->update(["vacationsbalance" => $NewDays]);
            return redirect()->back()->with('alert', " 'The vacation has been successfully booked ");
        }
        else {

            $to_email = Auth::user()->Manageremail;
            $name=Auth::user()->name;
            $subject = "Vacation  Request  ";
            $body = "$name request a vacation from $StartDate to $End_Date  and waiting your approval \n
               this email sent automatically from Vacation system
               \n  URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome " ;
            $sender=Auth::user()->email;
            $man=Auth::user()->Manager;
            $headers = "From: followup@arope.com.eg";
            if($sender != null){
                if ( mail("$to_email ,HR@arope.com.eg", $subject, $body, $headers))  {
                    $data = ['name' => $Username, 'Department' => $Department, "idHoliday" => $newidholiday, "start" => $StartDate,
                        "end" => $End_Date, "VAcationstype" => $Vacationtype, "HloiDays" => $CountVacations, "creation" => $creation];
                    Holiday::create($data);
                    return redirect()->back()->with('alert', " 'The vacation has been successfully booked and Email successfully sent to MR $man '");
                } else {
                    return redirect()->back()->with('alert', " Email Failed sent TO MR $man... and  vacation Was Canceled Please call It '");
                }
            }else{
                $data = ['name' => $Username, 'Department' => $Department, "idHoliday" => $newidholiday, "start" => $StartDate,
                    "end" => $End_Date, "VAcationstype" => $Vacationtype, "HloiDays" => $CountVacations, "creation" => $creation];
                Holiday::create($data);
                return redirect()->back()->with('alert', " The vacation has been successfully booked '");

            }
        }
    }

    public function InsertRequestFunction(Request $request)
    {
        $Request=$request->input('Request');
        $Services=$request ->input('ask');
        $Directed=$request->input('Directed');
        $name=Auth::user()->name;
        $Department=Auth::user()->Department;
        $subject = "Request From $name ";
        $creation = date(" Y-m-d ");

        if(($Services =="Others أخرى") and ($Request ==null)){
            return redirect()->back()->with('red', "Your Request Is Empty  \n Please Write Your request");
        }elseif ($Services !="Others أخرى")
        {

            $Request="$Services Directed to $Directed";

            $bodys = "$name has a $Services from You ,which Directed to $Directed
            \n
               this email sent automatically from Vacation system
               \n  URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome " ;
            $headers = "From: followup@arope.com.eg";
            if (mail("HR@arope.com.eg", $subject, $bodys, $headers))
            {
                $data = ['name' => $name, 'Department' => $Department, "Request" => $Request, "Status" => "Pending","creation" => $creation ];
                \App\Request::create($data);

                return redirect(route('home'))->with('Sucess',"The Request has been successfully booked and Email successfully sent to MR Hany ElTounsy");

            }else
            {
                return redirect(route('home'))->with('Sucess',"Email Failed sent TO MR Hany ElTounsy... and  Request Was Canceled, Please call It");

            }

        }
        else{

            $body = "$name has a request from You \n
            and the Request Is $Request
            \n
               this email sent automatically from Vacation system
               \n  URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome " ;
            $headers = "From: followup@arope.com.eg";
            if (mail("HR@arope.com.eg", $subject, $body, $headers))
            {
                $data = ['name' => $name, 'Department' => $Department, "Request" => $Request, "Status" => "Pending","creation" => $creation ];
                \App\Request::create($data);

                return redirect(route('home'))->with('Sucess',"The Request has been successfully booked and Email successfully sent to MR Hany ElTounsy");

            }else
            {
                return redirect(route('home'))->with('Sucess',"Email Failed sent TO MR Hany ElTounsy... and  Request Was Canceled, Please call It");

            }
        }

        }










}
