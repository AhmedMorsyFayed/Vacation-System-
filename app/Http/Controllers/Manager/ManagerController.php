<?php

namespace App\Http\Controllers\Manager;

use App\Exports\CustomersFromView;
use App\Exports\Topmanager;
use App\Exports\TopManPer;
use App\Exports\UsersExport;
use App\Holiday;
use App\Permissions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ManagerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth' );
        $this->middleware('Manager');
    }

    public function pendingManagerView()
    {
        return view('Manager.pending');
    }

    public function ApproveManagerView()
    {
        return view('Manager.approve');
    }

    public function RejectManagerView()
    {
        return view('Manager.Reject');
    }

    public function ApproveView()
    {
        return view('Manager.ApproveManager');
    }

    public function ManagerPermissionApproveView()
    {
        return view('Manager.ManagerPermissionApprove');
    }

    public function UpdateApproveManagerView()
    {
        return view('Manager.UpdateApproveManager');
    }

    public function UpdateManagerPermissionView()
    {
        return view('Manager.UpdateManagerPermissionApprove');
    }

    public function HistoryView()
    {
        return view('Manager.History');
    }

    public function UpdateApproveManagerTopView()
    {
        return view('Manager.UpdateApproveTopManager');
    }

    public function VacationsView()
    {
        return view('TopManager.EmployeeVacations');
    }

    public function ExcelTopManagerView()
    {
        return view('TopManager.ExcelTopManager');
    }

    public function ExcelManagerView()
    {
        return view('Manager.ExcelManager');
    }

######################################################################################################################################

    public function UserVacationFunction($id)
    {
        $user = Holiday::find($id)->toArray();
        return view('Manager.ApproveManager', ['user' => $user]);
    }

    public function DoneApproveVacation(Request $request,$id)
    {
        $Manager = Auth::user()->name;//hr name
        $status = $request->input('status');//hr status
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
                    return redirect(route('PendingView'))->with('Sucess',
                        "The vacation has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('PendingView'))->with('Sucess',
                        "The vacation has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('PendingView'))->with('Sucess',
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
                    return redirect(route('PendingView'))->with('Sucess',
                        "The vacation has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('PendingView'))->with('Sucess',
                        "The vacation has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('PendingView'))->with('Sucess',
                    "The vacation has been Rejected");
            }
        }

    }

    public function UpdateApproval($id)
    {
        $user = Holiday::find($id)->toArray();
        return view('Manager.UpdateApproveManager', ['user' => $user]);
    }

    public function DoneUpdateApproval (Request $request,$id){

        $Manager = Auth::user()->name;//hr name
        $status = $request->input('status');//hr status
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
                    return redirect(route('ApproveView'))->with('Sucess',
                        "The vacation has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('ApproveView'))->with('Sucess',
                        "The vacation has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('ApproveView'))->with('Sucess',
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
                    return redirect(route('RejectView'))->with('Sucess',
                        "The vacation has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('RejectView'))->with('Sucess',
                        "The vacation has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('RejectView'))->with('Sucess',
                    "The vacation has been Rejected");
            }
        }



    }


    public function ExcelManagerReport(Request $request){
        $Department =Auth::user()->Department;
        $Name =Auth::user()->name;

        if ($Department =="Management")
        {
            return Excel::download(new UsersExport($Name), "Vacation-$Name.xlsx");
        }
        else
        {
            return Excel::download(new CustomersFromView($Department,$Name), "Vacation-$Department-$Name.xlsx");
        }

    }


#####################################################################################################################################

    public function UserPermissionFunction($id)
    {
        $Permission = Permissions::find($id)->toArray();
        return view('Manager.ManagerPermissionApprove', ['Permission' => $Permission]);
    }

    public function DoneApprovePermission(Request $request, $id)
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
                    return redirect(route('PendingView'))->with('Sucess',
                        "The Permission has been Approved and Email successfully sent to \n $EmployeeName");
                }else{
                    return redirect(route('PendingView'))->with('Sucess',
                        "The Permission has been Approved But Email not successfully sent to \n $EmployeeName ");
                }
            }else{
                return redirect(route('PendingView'))->with('Sucess',
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
                    return redirect(route('PendingView'))->with('Sucess',
                        "The Permission has been Rejected and Email successfully sent to $EmployeeName ");
                }else{
                    return redirect(route('PendingView'))->with('Sucess',
                        "The Permission has been Rejected But Email not successfully sent to $EmployeeName ");
                }
            }
            else{
                return redirect(route('PendingView'))->with('Sucess',
                    "The Permission has been Rejected");
            }
        }

    }

    public function UpdateApprovalPermission($id)
    {
        $Permission = Permissions::find($id)->toArray();
        return view('Manager.UpdateManagerPermissionApprove', ['Permission' => $Permission]);
    }

    public function DoneUpdateApprovalPermission(Request $request, $id)
    {

        $status = $request->input('status');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date


        if($status == null){
            return redirect()->back()->with('red',
                "Please Update The Permission");
        }
        if($status =="Approve"){
            Permissions::where('id',$id)->update(['status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            return redirect(route('ApproveView'))->with('Sucess',
                "The Permission has been Approved");
        }
        else
        {
            Permissions::where('id',$id)->update(['status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            return redirect(route('RejectView'))->with('Sucess',
                "The Permission has been Rejected");
        }

    }


######################################TopManager#######################################################################################

    public function UpdateApprovalTop($id)
    {
        $user = Holiday::find($id)->toArray();
        return view('TopManager.UpdateApproveTopManager', ['user' => $user]);
    }

    public function DoneUpdateApprovalTop (Request $request,$id){

        $Manager = Auth::user()->name;//hr name
        $status = $request->input('status');//hr status
        $AprovaleDate = date(" Y-m-d");//hr approve date
        $user = Holiday::find($id)->toArray();
        $EmployeeName=$user["name"];
        $PastStatus=$user["status"];
        $VacationsDays=$user["HloiDays"];
        $VacationsBalance=User::where('name',$EmployeeName)->get()->toArray();
        $Balance=$VacationsBalance[0]["vacationsbalance"];


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
            return redirect(route('ApproveVacations'))->with('Sucess',"The vacation has been Approved");

        } else
        {
            $Add = $Balance + $VacationsDays;
            User::where('name',$EmployeeName)->update(['vacationsbalance'=>$Add]);
            Holiday::where('id',$id)->update(['manger'=>$Manager,'status'=>$status,'AprovaleDate'=>$AprovaleDate]);
            return redirect(route('RejectVacations'))->with('Sucess', "The vacation has been Rejected");

        }


    }


    /* function for top manager  to export excel for any user of the company */
    public function ExportTopManager(Request $request)
    {
        /* employee name*/
        $name = $request->input('name');
        /* employee year*/
        $year = $request->input('year');
        $system = $request->input('System');
        if($system =='Vacations'){
            return Excel::download(new Topmanager($name, $year), "Vacation-$name-$year.xlsx");

        }else{

            return Excel::download(new TopManPer($name, $year), "Permission-$name-$year.xlsx");
        }



    }

}
