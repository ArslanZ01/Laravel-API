<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppHelper
{
    public static function instance(): AppHelper
    {
        return new AppHelper();
    }

    function session(Request $request, $type=0){
        if ($type == 1122)
            print_me($request->session()->all());
        else
            return view('error');
    }

    function activity_logs(Request $request, $type=0){
        if ($type == 1122) {
            $logs = DB::table('tbl_activity_logs')->get();
            foreach ($logs as $log)
                $log->activity_description = json_decode($log->activity_description);
            print_me($logs->toArray());
        }
        else
            return view('error');
    }

    function send_mail($request, $user=[]): bool
    {
        $code = rand(1000,9999);
        $request->session()->put('verification_code', $code);

        if (!empty($user)) {
            $request->session()->put('first_name', $user->first_name);
            $request->session()->put('user_type', $user->user_type);
            $request->session()->put('email', $user->email);
            $request->session()->put('user_verified', $user->user_verified);
        }
        else {
            $request->session()->put('verification_email', $request->input('email'));
            $password = encryptData($code);
            $salted_password = encryptData($password['salt']);
            $request->session()->put('verification_password', $password['salt']);
            DB::table('tbl_users')->where('email', '=', $request->input('email'))->update(['simple_password'=>$salted_password['enc_text'], 'salt_password'=>$salted_password['salt']]);
        }

        try {
            $detail = array('mail_title'=>$request->input('email'), 'verification_code'=>$code, 'created_time'=>date('m/d/Y h:i:s a', time()));
            $to = $request->input('email');
            $subject = 'Verification';
            $message = view('account.account_email')->with($detail);
            $headers = 'MIME-Version: 1.0' . "\r\n" . 'Content-type:text/html;charset=UTF-8' . "\r\n" . 'From: <website@eaze.com>' . "\r\n";

            if (strpos($request->url(), 'localhost') === false)
                mail($to,$subject,$message,$headers);
            return true;
        }
        catch (\Exception | \Throwable |\Error $e) {
            return false;
        }
    }


}
