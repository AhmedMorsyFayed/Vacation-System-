<?php

namespace App\Http\Controllers\HR;

use App\Exports\All;
use App\Exports\permissionquery;
use App\Exports\PostsQueryExport;
use App\Holiday;
use App\Permissions;
use App\PublicVacation;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel;
use PHPExcel_IOFactory;

class HRController extends Controller
{
    //
   public function __construct()
   {
       $this->middleware('auth' );
       $this->middleware('HR');
   }

    public function pendingHrView()
    {
        return view('HR.pendinghr');
    }
    public function ApproveHrView()
    {
        return view('HR.approvehr');
    }
    public function RejectHRView()
    {
        return view('HR.Rejecthr');
    }

    public function AllUsersView()
    {
       return view('HR.AllUsers');
    }

    public function EditPermissionView()
    {
        return view('HR.EditPermission');
    }

    public function EditVacationView()
    {
        return view('HR.EditVacation');
    }

    public function ExcelView()
    {
        return view('HR.Excel');
    }

    public function HRHistoryView()
    {
        return view('HR.HRHistory');
    }

    public function HrView()
    {
        return view('HR.Hr');
    }

    public function HRApproveUserView()
    {
        return view('HR.HRApproveUser');
    }

    public function HrcancelView()
    {
        return view('HR.Hrcancel');
    }

    public function HrcancelPerView()
    {
        return view('HR.HrcancelPer');
    }

    public function HrPerView()
    {
        return view('HR.HrPer');
    }

    public function HuView()
    {
        return view('HR.HRUpdateVacation');
    }

    public function HuPerView()
    {
        return view('HR.HuPer');
    }

    public function pendingcancelView()
    {
        return view('HR.pendingcancel');
    }

    public function vacachangeView ()
    {
        return view('HR.vacachange');
    }

    public function vacationchangeView()
    {
        return view('HR.vacationchange');
    }
    public function HRUpdatePermissionView()
    {
        return view('HR.HRUpdatePermission');
    }

    public function UsersRequestsView()
    {
        return view('HR.UsersRequests');
    }



##############################################################################################################################################################

    public function getinformationUser($id)
    {
        $user = Holiday::find($id)->toArray();
        return view('Hr.Hr', ['user' => $user]);
    }

    /* view to show form of approve or reject for HR*/
    public function ActionToHREmplpyee(Request $request,$id){
        $Manager = Auth::user()->name;//hr name
        $status = $request->input('HR');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date
        $user = Holiday::find($id)->toArray();
        $start=$user["start"];
        $end=$user["end"];
        $EmployeeName=$user["name"];
        $VacationsDays=$user["HloiDays"];
        $VacationsBalance=User::where('name',$EmployeeName)->get()->toArray();
        $Balance=$VacationsBalance[0]["vacationsbalance"];
        $EmployeeNameEmail=$VacationsBalance[0]["email"];
        $headers = "From: followup@arope.com.eg";

        if($status == null){
            return redirect()->back()->with('red',
                "Please Approve Or Reject The Vacation");
        }

        if($status =="Approve"){
            $sub = $Balance - $VacationsDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance'=>$sub]);
            Holiday::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Vacation  Approvel";
            $body = "your Vacation From $start To $end has been approved \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The vacation has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The vacation has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('pendingHrView'))->with('Sucess',
                    "The vacation has been Approved");
            }
        }
        else
        {
            Holiday::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Vacation Rejectded";
            $body = "your Vacation From $start To $end has been Rejected \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            $headers = "From: followup@arope.com.eg";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The vacation has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The vacation has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('pendingHrView'))->with('Sucess',
                    "The vacation has been Rejected");
            }
        }



    }

    public function UpdateStatus($id){
        $user = Holiday::find($id)->toArray();
        return view('Hr.Hr', ['userUpdate' => $user]);
    }


    public function UpdateHREmployee (Request $request,$id){

        $Manager = Auth::user()->name;//hr name
        $status = $request->input('HR');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date
        $user = Holiday::find($id)->toArray();
        $start=$user["start"];
        $end=$user["end"];
        $EmployeeName=$user["name"];
        $PastStatus=$user["status"];
        $VacationsDays=$user["HloiDays"];
        $VacationsBalance=User::where('name',$EmployeeName)->get()->toArray();
        $Balance=$VacationsBalance[0]["vacationsbalance"];
        $EmployeeNameEmail=$VacationsBalance[0]["email"];
        $headers = "From: followup@arope.com.eg";


        if($status == null){
            return redirect()->back()->with('red',
                "Please Approve Or Reject The Vacation");
        }

        if(($status =="Approve") and ($PastStatus =="Approve")) {
            return redirect()->back()->with('red',
                "The vacation has already been Approved");
        }
        elseif (($status =="Reject") and ($PastStatus =="Reject")){
            return redirect()->back()->with('red',
                "The vacation has already been Rejected");
        }
        elseif (($VacationsDays > $VacationsBalance)  and ($status == 'Approve') and ($PastStatus == "Reject") ) {
            return redirect()->back()->with('red',
                "The Vacations balance is not enough. Please Refer to HR Department");
        }

        elseif (($status == 'Approve') and ($PastStatus == "Reject")){
            $sub = $Balance - $VacationsDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance'=>$sub]);
            Holiday::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Vacation  Approvel";
            $body = "your Vacation From $start To $end has been approved \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('ApproveHrView'))->with('Sucess',
                        "The vacation has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('ApproveHrView'))->with('Sucess',
                        "The vacation has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('ApproveHrView'))->with('Sucess',
                    "The vacation has been Approved");
            }
        } else
        {
            $Add = $Balance + $VacationsDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance'=>$Add]);
            Holiday::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Vacation Rejectded";
            $body = "your Vacation From $start To $end has been Rejected \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            $headers = "From: followup@arope.com.eg";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('ApproveHrView'))->with('Sucess',
                        "The vacation has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('ApproveHrView'))->with('Sucess',
                        "The vacation has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('ApproveHrView'))->with('Sucess',
                    "The vacation has been Rejected");
            }
        }



    }

    public function EditVacationForUserView($id)
    {
        $user = User::find($id)->toArray();
        return view('HR.EditVacation', ['user' => $user]);
    }


    public function DoingEditVacationForUser(Request $request, $id)
    {
        $Username = $request->input('name');
        $StartDate = $request->input('start');/* user start*/
        $End_Date = $request->input('end');
        $Vacationtype = $request->input('VAcationstype');/* user vacation type*/
        $Balance=$request->input('vacationsbalance');
        $Hrname = Auth::user()->name;//hr name
        $Hrstatus = "Approve ";//hr status
        $Department = $request->input('Department');//user department
        $creation = date(" y-m-d ");// hr creation
        $status = "Approve";// user
        $idholiday = 0;    /* intlize id holiday */
        $maximum =Holiday::max('idHoliday');
        $iduserHoliday=Holiday::where('name',$Username)->get();
        foreach ($iduserHoliday as $user) {
            $idholiday = $user->idHoliday;
        }

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
        $creation = date(" y-m-d h:m:s");
        $Maxnum=6-$Vacation_Typed_days;


        /* check vor insert vacation in table*/
        if(($CountVacations > $Balance) and ((($Vacationtype == 'Casual') || ($Vacationtype == 'Annual'))) )
        {
            return redirect()->back()->with('alert', 'The Vacations balance is not enough .');
        }
        elseif ($CountVacations > 14 and ((($Vacationtype == 'Casual') || ($Vacationtype == 'Annual')))) {
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
        }elseif ($Vacationtype == "Sick"){
            $data = ['name' => $Username, 'Department' => $Department,"start" => $StartDate,"end" => $End_Date,"VAcationstype" => $Vacationtype,
                "HloiDays" => $CountVacations,"idHoliday" => $newidholiday,"status"=>$status,"creation" => $creation,"HRname"=>$Hrname,
                "HR" =>$Hrstatus,"AprovaleHRDate"=>$creation ];
            Holiday::create($data);
            return redirect()->back()->with('Sucess', " The vacation has been successfully booked '");
        }
        else {
            $NewBalance = $Balance - $CountVacations;
            User::where('id',$id)->update(['vacationsbalance' => $NewBalance]);
            $data = ['name' => $Username, 'Department' => $Department,"start" => $StartDate,"end" => $End_Date,"VAcationstype" => $Vacationtype,
                "HloiDays" => $CountVacations,"idHoliday" => $newidholiday,"status"=>$status,"creation" => $creation,"HRname"=>$Hrname,
                "HR" =>$Hrstatus,"AprovaleHRDate"=>$creation ];
            Holiday::create($data);
            return redirect(route('AllUsersView'))->with('Sucess', " The vacation has been successfully booked ");
        }


    }

    public function ExportVacation(Request $request)
    {

        $name = $request->input('name');
        $year = $request->input('year');
        $VAcationstype = $request->input('VAcationstype');
        if($VAcationstype == 'All'){
            return Excel::download(new All($name, $year), "Vacation-$name-$year.xlsx");

        }else{

            return Excel::download(new PostsQueryExport($name, $year, $VAcationstype), "Vacation-$name-$year.xlsx");
        }

    }


    public function DoingCanacelVacation($id)
    {
        Holiday::where('id',$id)->update(['status'=>"Cancel"]);
        return redirect()->back()->with('Sucess','The Vacation has been Canceled');
    }



    public function DoingChangeVacationBalance(Request $request, $id)
    {
        $newbalance = $request->get('balance');
        User::where('id',$id)->update(['vacationsbalance' => $newbalance]);
        return redirect()->back()->with('Sucess','Vacation Balance changed successfully');

    }


    /* view to show form of  upadte for hr*/
    public function HRUpdateVacationFunction($id)
    {
        $user = Holiday::find($id)->toArray();
        return view('HR.HRUpdateVacation', ['user' => $user]);
    }
    /* update fo hr*/
    public function DoneHRUpdateVacation(Request $request, $id)
    {

        $PastVacation = Holiday::find($id)->toArray();
        $PastVacationDays =$PastVacation["HloiDays"];
        $EmployeeName=$PastVacation["name"];
        $PastVacationStatus=$PastVacation["status"];

        $BalanceNumber=User::where('name',$EmployeeName)->get()->toArray();
        $Balance= $BalanceNumber[0]["vacationsbalance"];


        $HRName=Auth::user()->name;
        $StartDate = $request->input('start');/* user start*/
        $End_Date = $request->input('end');
        $Vacationtype = $request->input('VAcationstype');/* user vacation type*/
        $Hrstatus = $request->input('status');
        $creation = date(" y-m-d ");// hr creation

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



        if(($Vacationtype == "Sick") and ($PastVacationStatus == "Approve") ){
            $newBalance=$Balance+$PastVacationDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance' => $newBalance]);
            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);
            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");


        }elseif (($PastVacationStatus == "Approve") and ($Hrstatus == "Reject")){
            $newBalance=$Balance+$PastVacationDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance' => $newBalance]);
            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);

            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");
        }
        elseif ((($PastVacationStatus == "Reject") or ($PastVacationStatus == "Cancel")) and ($Hrstatus == "Approve") and ($Vacationtype != "Sick")){
            $newBalance=$Balance-$CountVacations;
            User::where('name',$EmployeeName)->update(['vacationsbalance' => $newBalance]);
            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);

            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");

        }

        elseif ((($PastVacationStatus == "Reject") or ($PastVacationStatus == "Cancel")) and ($Hrstatus == "Approve") and ($Vacationtype == "Sick")){

            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);

            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");

        }
        elseif (($PastVacationStatus == "Reject") and ($Hrstatus == "Approve") and ($Vacationtype == "Sick")){

            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);

            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");

        }
        else{

            $newBalance=$Balance+$PastVacationDays-$CountVacations;
            User::where('name',$EmployeeName)->update(['vacationsbalance' => $newBalance]);
            Holiday::where('id',$id)->update(['start' => $StartDate, 'end' => $End_Date ,'VAcationstype' => $Vacationtype ,
                "HloiDays" => $CountVacations,"HRname"=>$HRName,"HR" =>$Hrstatus,"UpdateHRDate" => $creation,]);

            return redirect(route('HRHistory'))->with('Sucess', " The vacation has been successfully Updated ");

        }



    }


    public function FinishRequestFunction($id)
    {
        $Array =\App\Request::where('id',$id)->get();
        foreach ($Array as $q){
            $name =$q->name;
            $Request =$q->Request;
        }
        $EmailArray =\App\User::where('name',$name)->get();
        foreach ($EmailArray as $e){
            $email =$e->email;
        }

        $HRname=Auth::user()->name;
        $subject = "Reply request From $HRname ";

        $body = "$HRname responded to your request .$Request. and your request has been Finished
               \n  URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome " ;
        $headers = "From: followup@arope.com.eg";

        if ( mail("$email", $subject, $body, $headers))  {

            \App\Request::where('id',$id)->update(["Status" => "Finish"]);
            return redirect()->back()->with('Sucess',"The Request has been successfully Finished");

        } else {

            \App\Request::where('id',$id)->update(["Status" => "Finish"]);
            return redirect()->back()->with('Sucess',"The Request has been successfully Finished");
        }



    }

    public function PendingRequestFunction($id)
    {
        \App\Request::where('id',$id)->update(["Status" => "Pending"]);
        return redirect()->back()->with('Sucess',"The Request has been successfully Pended");
    }

    ########################################################################################################################################################

    public function ApprovePermissionFunction($id)
    {
        $Permission = Permissions::find($id)->toArray();
        return view('Hr.HrPer', ['Permission' => $Permission]);
    }

    public function DoneApprovePermissionFunction(Request $request, $id)
    {

        $Manager = Auth::user()->name;//hr name
        $status = $request->input('HR');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date
        $user = Permissions::find($id)->toArray();
        $start=$user["start"];
        $end=$user["end"];
        $EmployeeName=$user["name"];
        $VacationsBalance=User::where('name',$EmployeeName)->get()->toArray();
        $EmployeeNameEmail=$VacationsBalance[0]["email"];
        $headers = "From: followup@arope.com.eg";

        if($status == null){
            return redirect()->back()->with('red',
                "Please Approve Or Reject The Permission");
        }

        if($status =="Approve"){

            Permissions::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Permission Approvel";
            $body = "your Permission From $start To $end has been approved \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The Permission has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The Permission has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('pendingHrView'))->with('Sucess',
                    "The Permission has been Approved");
            }
        }
        else
        {
            Permissions::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            $subject = "Permission Rejectded";
            $body = "your Permission From $start To $end has been Rejected \n  this email sent automatically from Vacation system
               \n URL:http://aropevacation:8004 \n\n Preferably open the System on Google Chrome ";
            $headers = "From: followup@arope.com.eg";
            if($EmployeeNameEmail != null){
                if ( mail($EmployeeNameEmail, $subject, $body, $headers)) {
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The Permission has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('pendingHrView'))->with('Sucess',
                        "The Permission has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('pendingHrView'))->with('Sucess',
                    "The Permission has been Rejected");
            }
        }

    }

    public function UpdateApprovePermissionFunction($id)
    {
        $Permission = Permissions::find($id)->toArray();
        return view('Hr.Huper', ['Permission' => $Permission]);
    }

    public function DoneUpdateApprovePermissionFunction(Request $request, $id)
    {

        $status = $request->input('status');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date


        if($status == null){
            return redirect()->back()->with('red',
                "Please Update The Permission");
        }
        if($status =="Approve"){
            Permissions::where('id',$id)->update(['status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            return redirect(route('ApproveHrView'))->with('Sucess',
                "The Permission has been Approved");
        }
        else
        {
            Permissions::where('id',$id)->update(['status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            return redirect(route('ApproveHrView'))->with('Sucess',
                "The Permission has been Rejected");
        }

    }

    public function  EditPermissionForUserView($id)
    {
        $User=User::find($id)->toArray();
        return view('Hr.EditPermission', ['UserInformation' => $User]);
    }

    public function DoingEditPermissionForUser(Request $request,$id)
    {
        $Username = $request->input('name');
        $Department =$request->input('Department');
        $Hrname = Auth::user()->name;//hr name
        $Hrstatus = "Approve ";
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

        $creation = date(" y-m-d",strtotime('+2 hour '));
        $ApproveDate=date("y-m-d");



        if (in_array($daytime,$PublicDaysArray)) {
            return redirect()->back()->with('alert', "You can't Take a permission in this day $daytime because This day is a public Holiday ,you can choose another day  ");
        }elseif ((in_array($daytime,$DaysArray)) and (in_array($start,$TimeArray) )) {
            return redirect()->back()->with('alert', 'You have already taken this permission in that day  .Please choose another day .');}
        elseif (array_key_exists($from[0], $array_count) && ($array_count["$from[0]"] >= 2)) {
            return redirect()->back()->with('alert', ' You are have two permission in month and You have already taken two permissions .Please Wait next month .');}
        else {
            $data = array('name' => $Username, 'Department' => $Department, "day" => $daytime,
                "start" => $start, "end" => $end, "idpermision" => $newidpermision, "permisionshours" => $Hours, "creation" => $creation,
                "HRname" =>$Hrname,"HR" => $Hrstatus,"AprovaleHRDate" => $ApproveDate);
            Permissions::create($data);


            return redirect(route('AllUsersView'))->with('Sucess', '  The Permission has been successfully booked  ');
        }




    }

    public function ExportPermission(Request $request)
    {
        $name = $request->input('name');
        $year = $request->input('year');

        return Excel::download(new permissionquery($name, $year), "Permission-$name-$year.xlsx");

    }

    public function DoingCanacelPermission($id)
    {
        Permissions::where('id',$id)->update(['status'=>"Cancel"]);
        return redirect()->back()->with('Sucess','The Permission has been Canceled');
    }

    public function HRUpdatePermissionFunction($id)
    {
        $UpdatePermission = Permissions::find($id)->toArray();
        return view('HR.HRUpdatePermission', ['UpdatePermission' => $UpdatePermission ]);
    }

    public function DoneHRUpdatePermission(Request $request,$id)
    {
        $HRName = Auth::user()->name;//hr name
        $status = $request->input('status');
        $start=$request->input('start');
        $day = $request->input('day');

        $end = date('g:i A',strtotime('+2 hour ',strtotime($start)));
        $Hours =2;
        if($start == "03:00 PM" ){
            $end = date('g:i A',strtotime('+1 hour ',strtotime($start)));$Hours =1;
        }
        $ApproveDate=date("Y-m-d");

        $PublicDays=PublicVacation::all();
        $PublicDaysArray=array();
        foreach ($PublicDays as $dayin){
            $PublicDaysArray [] =$dayin->Date;
        }

        if (in_array($day,$PublicDaysArray)) {
            return redirect()->back()->with('alert', "You can't Take a permission in this day $day because This day is a public Holiday ,you can choose another day  ");
        }
        else {
            Permissions::where('id',$id)->update([
                "day" => $day,"start" => $start, "end" => $end,
                "HRname" =>$HRName,"HR" => $status,"UpdateHRDate" => $ApproveDate
            ]);
            return redirect(route('HRHistory'))->with('Sucess', '  The Permission has been successfully Updated  ');
        }



    }

public function DawonloadExeclFunction(){

        $FirstDay=date('Y-m-d', strtotime('first day of january this year'));
        $LastDay =date('Y-m-d', strtotime('last day of previous month'));

        $users = DB::select('select * from users');
        foreach ($users as $user){
            $usersName []=$user->name;
            $VacationBalance[]=$user->vacationsbalance;
        }
//echo $usersName[184];die();
        foreach ($usersName as $name){

            $VacationsCasual = DB::select('select sum(HloiDays) from holidays
where VAcationstype ="Casual" and status ="Approve" and name =? and( creation between ? and ? or AprovaleHRDate between ? and ?)'
        ,[$name,$FirstDay,$LastDay ,$FirstDay,$LastDay]);
            $arrayCasual = json_decode(json_encode($VacationsCasual), true);
            foreach ($arrayCasual as $valsCasual) {
                if($valsCasual['sum(HloiDays)']  == null){
                    $CasualDays []= 0;
                }else{
                    $CasualDays []= $valsCasual['sum(HloiDays)'] ;
                }

            }

            $VacationsAnnual = DB::select('select sum(HloiDays) from holidays where VAcationstype ="Annual" and
                                         status ="Approve" and name =? and( creation between ? and ? or AprovaleHRDate between ? and ?)'
                ,[$name,$FirstDay,$LastDay ,$FirstDay,$LastDay]);
            $arrayAnnual = json_decode(json_encode($VacationsAnnual), true);
            foreach ($arrayAnnual as $valsAnnual) {
                if($valsAnnual['sum(HloiDays)']  == null){
                    $AnnualDays []= 0;
                }else{
                    $AnnualDays []= $valsAnnual['sum(HloiDays)'];
                }

            }

            $VacationsSick = DB::select('select sum(HloiDays) from holidays where VAcationstype ="Sick"
                                     and status ="Approve" and name =? and( creation between ? and ? or AprovaleHRDate between ? and ?)'
                ,[$name,$FirstDay,$LastDay ,$FirstDay,$LastDay]);
            $arraySick = json_decode(json_encode($VacationsSick), true);
            foreach ($arraySick as $valsSick) {
                if($valsSick['sum(HloiDays)']  == null){
                    $SickDays []= 0;
                }else{
                    $SickDays []= $valsSick['sum(HloiDays)'] ;
                }

            }
        }


        $header = array("UserName"," Vacation Balance","Annual","Casual","Sick");

        $list = array ($header);

        $Counter=0;
        for ($i = 1; $i < sizeof($usersName);$i=$i+2){
            array_splice($usersName, $i, 0, $VacationBalance[$Counter]);
            $Counter++;
        }
        $Counte=0;
        for ($i = 2; $i < sizeof($usersName);$i=$i+3){
            array_splice($usersName, $i, 0, $AnnualDays[$Counte]);
            $Counte++;
        }
        $Count=0;
        for ($i = 3; $i < sizeof($usersName);$i=$i+4){
            array_splice($usersName, $i, 0, $CasualDays[$Count]);
            $Count++;
        }
        $Coun=0;
        for ($i = 4; $i < sizeof($usersName);$i=$i+5){
            array_splice($usersName, $i, 0, $SickDays[$Coun]);
            $Coun++;
        }

        for ($i = 0; $i < sizeof($usersName);$i=$i+5) {
            $copied_array = array_slice($usersName, $i, 5);
            $list[] = $copied_array;
            $copied_array = array_fill_keys(array_keys($copied_array), "");
        }

       $filename = "General Vacation System Users Report From $FirstDay To $LastDay.xls";

        require_once 'D:\xampp\php\PHPExcel\Classes\PHPExcel.php';

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet()->setTitle('General Monthly Report');
        $sheet->fromArray($list ,null, 'A1', true);

        header('Content-Type: application/vnd.ms-excel');
        //tell browser what's the file name
        header('Content-Disposition: attachment;filename="' . $filename . '"');

        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');


    }

}
