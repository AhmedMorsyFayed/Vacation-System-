<?php


namespace App\Http\Controllers;
use App\Exports\CustomersFromView;
use App\Exports\permissinmanger;
use App\Exports\permissionquery;
use App\Exports\PostsQueryExport;
use App\Exports\Topmanager;
use App\Permissions;
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


class permision
{
    public function CancelUserPermission( Request $request)

    {
        $id = $request->input('id');
        Permissions::where('id', $id)->update(["status" => "Cancel"]);
        return redirect()->back()->with('Sucess', 'The Permission has been Canceled Successfully');

    }
    public function BokePermissionFunction(Request $request)
    {

        $Username = Auth::user()->name;
        $idpermision = 0;    /* intlize id holiday */
        $maximum =Permissions::max('idpermision');
        $iduserHoliday=Permissions::where('name',$Username)->get();
        foreach ($iduserHoliday as $user) {
            $idpermision = $user->idpermision;
        }
        $daytime = $request->input('day');
        $start = $request->input('start');
        $end = date('g:i A',strtotime('+2 hour ',strtotime($start)));
        $Hours =2;
        if($start == "03:00 PM" ){
            $end = date('g:i A',strtotime('+1 hour ',strtotime($start)));$Hours =1;
        }
        $Department = Auth::user()->Department;
        if ($idpermision == NULL) {
            $newidpermision = $maximum + 1;
        } else {
            $newidpermision = $idpermision;
        }

        $PublicDays=PublicVacation::all();
        $PublicDaysArray=array();
        foreach ($PublicDays as $day){
            $PublicDaysArray [] =$day->Date;
        }

        $DaysArray = array();
        $TimeArray = array();

        $checkDay = Permissions::select("day","start")->where('name',$Username)->get();
        foreach ($checkDay as $q) {
            $DaysArray[]=$q->day;
            $TimeArray []=$q->start;
        }

        $items = array();
        $sqll = DB::select('select DATE_FORMAT(day, \'%Y-%m\') as my from permmision where name=?', [$Username]);
        foreach ($sqll as $user) {
            $from=$user->my;
            $items[] = $from;
        }

        $from = array();
        $ym = DB::select("SELECT DATE_FORMAT('$daytime', '%Y-%m') AS 'my'");
        foreach ($ym as $user) {
            $from[]=$user->my;
        }
        $array_count = array_count_values($items);

        $creation = date(" y-m-d h:m:s",strtotime('+2 hour '));
        $datavaladtion=date("y-m-d");

        $valadtion=strtotime($datavaladtion)+(60*60*24*15);
        $dayvalad=strtotime($daytime);

        $unvaladtion=date("y-m-d",$valadtion);

        if (in_array($daytime,$PublicDaysArray)) {
            return redirect()->back()->with('alert', "You can't Take a permission in this day $daytime because This day is a public Holiday ,you can choose another day  ");
        }elseif ((in_array($daytime,$DaysArray)) and (in_array($start,$TimeArray) )) {
            return redirect()->back()->with('alert', 'You have already taken this permission in that day  .Please choose another day .');}
        elseif (array_key_exists($from[0], $array_count) && ($array_count["$from[0]"] >= 2)) {
            return redirect()->back()->with('alert', ' You are have two permission in month and You have already taken two permissions .Please Wait next month .');}
        else {
            $to_email = Auth::user()->Manageremail;
            $name=Auth::user()->name;
            $subject = "Permission  Request  ";
            $body = "$name request a Permission from $start to $end  and waiting your approval \n
               this email sent automatically from Vacation system
               \n  URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome " ;
            $sender=Auth::user()->email;
            $man=Auth::user()->Manager;
            $headers = "From: followup@arope.com.eg";
            if($sender != null){
                if ( mail($to_email, $subject, $body, $headers))  {
                    $data = array('name' => $Username, 'Department' => $Department, "day" => $daytime,
                        "start" => $start, "end" => $end, "idpermision" => $newidpermision, "permisionshours" => $Hours, "creation" => $creation);
                    Permissions::create($data);
                    return redirect()->back()->with('alert', " 'The Permission has been successfully booked and Email successfully sent to MR $man '");

                } else {
                    return redirect()->back()->with('alert', " Email Failed sent TO MR $man... and  vacation Was Canceled Please call It '");}

            }else{
                $data = array('name' => $Username, 'Department' => $Department, "day" => $daytime,
                    "start" => $start, "end" => $end, "idpermision" => $newidpermision, "permisionshours" => $Hours, "creation" => $creation);
                Permissions::create($data);
                return redirect()->back()->with('alert', " The permission has been successfully booked '");

            }

        }

        }
















}
