<?php


namespace App\Http\Controllers;


use App\Suggest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoMiddelWare extends Controller
{

    public function SuggestView()
    {
        return view('Suggest');
    }


    public function InsertRequest(Request $request){

        $maxid =Suggest::max('id') +1;

        $ask=$request->input('ask');
        $problem=$request->input('problem');
        $reqtype=$request->input('que');
        $name=$request->input('name');
        $ip = "";

        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
        {
            // Check for IP address from shared Internet
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            // Check for the proxy user
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else
        {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        $to_email = "yasser.hammad@arope.com.eg";
       // $to_email = "ahmed.fayed@arope.com.eg";
        $subject = "Complaints and suggestions system";
        $headers = "From: followup@arope.com.eg";


      if($name != null){
            $data = array('Type' => $ask,'description' => $problem,'reqtype' => $reqtype,'name' => $name,'ip' => $ip);
            Suggest::create($data);
            if ($ask == "شكوى"){
                $body = "$name قام بتسجيل شكوى وهى $reqtype وهى بالتفصيل كالتالى \n\n $problem" ;
                mail("$to_email", $subject, $body, $headers);
            }else{
                $body = "$name قام بتسجيل مقترح و هى بالتفصيل كالتالى \n\n $problem" ;
                mail("$to_email", $subject, $body, $headers);
            }
            return redirect()->back()->with('Sucess',"  لقد تم تسجيل شكواك أو مقترحك بنجاح ورقم $ask الخاص بك هو $maxid ");
        }else{
            $data = array('Type' => $ask,'description' => $problem,'reqtype' => $reqtype,);
            DB::table('suggestions')->insert($data);
            if ($ask == "شكوى"){
                $body = " تم تسجيل شكوى وهى $reqtype وهى بالتفصيل كالتالى  \n\n $problem" ;
                mail("$to_email", $subject, $body, $headers);
            }else{
                $body = "تم تسجيل مقترح وهى بالتفصيل كالتالى  \n\n $problem" ;
                mail("$to_email", $subject, $body, $headers);
            }
          return redirect()->back()->with('Sucess',"  لقد تم تسجيل شكواك أو مقترحك بنجاح ورقم $ask الخاص بك هو $maxid ");
      }

    }

}
