<?php

namespace App\Http\Controllers\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Seshac\Otp\Otp;

class SmsController extends Controller
{

  public function OTP(Request $request)
  {


    $mobile = $request->mobile;
    $mobile = str_replace("+", "", $mobile);
    $randomRef = rand(10000, 99999);


    // dd($mobile);


    $otp =  Otp::setValidity(1500)  // otp validity time in mins
      ->setLength(6)  // Lenght of the generated otp
      ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
      ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
      ->setUseSameToken(false) // if you re-generate OTP, you will get same token
      ->generate($mobile);


    //   dd($otp->token);

    // $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
    //     ->validate($mobile, $otp->token);

    error_reporting(E_ALL);
    date_default_timezone_set('Asia/Colombo');
    $now = date("Y-m-d\TH:i:s");
    $username = "nsb_fundmgt";
    $password = "6101144018a53";
    $digest = md5($password);
    $body = '{
        "messages": [
        {
        "clientRef": "' . $randomRef . '",
        "number": "' . $mobile . '",
        "mask": "NSB FMC",
        "text": " Your OTP for registration is ' . $otp->token . '\n NSB Fund Management Co.Ltd",
        "campaignName":"NSB OTP"
        }
  
        ]
        }';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://richcommunication.dialog.lk/api/sms/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body); //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = [
      'Content-Type: application/json',
      'USER: ' . $username,
      'DIGEST: ' . $digest,
      'CREATED: ' . $now
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($server_output);
    // dd($result);
    // dd($result->messages[0]->resultDesc);

    if ($result->messages[0]->resultDesc == 'SUCCESS' && $result->messages[0]->clientRef == $randomRef) {


      $send['success'] = true;
      return response()->json($send);
    } else {

      $send['success'] = false;
      return response()->json($send);
    }


    // $send['success'] = true;
    // $send['otp'] = $otp;
    // return response()->json($send);

  }
  public function OTPT(Request $request)
  {


    $mobile = $request->mobile;
    $mobile = str_replace("+", "", $mobile);
    $randomRef = rand(10000, 99999);


    //    dd($mobile);


    $otp =  Otp::setValidity(1500)  // otp validity time in mins
      ->setLength(6)  // Lenght of the generated otp
      ->setMaximumOtpsAllowed(10) // Number of times allowed to regenerate otps
      ->setOnlyDigits(true)  // generated otp contains mixed characters ex:ad2312
      ->setUseSameToken(false) // if you re-generate OTP, you will get same token
      ->generate($mobile);


    //   dd($otp->token);
    $OTPCODE = $otp->token;
    //  dd($OTPCODE);
    // $verify = Otp::setAllowedAttempts(10) // number of times they can allow to attempt with wrong token
    //     ->validate($mobile, $otp->token);

    error_reporting(E_ALL);
    date_default_timezone_set('Asia/Colombo');
    $now = date("Y-m-d\TH:i:s");
    $username = "nsb_fundmgt";
    $password = "6101144018a53";
    $digest = md5($password);
    $body = '{
       "messages": [
       {
       "clientRef": "' . $randomRef . '",
       "number": "' . $mobile . '",
       "mask": "NSB FMC",
       "text": " Your OTP for transaction is ' . $OTPCODE . ' \n NSB Fund Management Co.Ltd",
       "campaignName":"NSB OTP"
       }
 
       ]
       }';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://richcommunication.dialog.lk/api/sms/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body); //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $headers = [
      'Content-Type: application/json',
      'USER: ' . $username,
      'DIGEST: ' . $digest,
      'CREATED: ' . $now
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($server_output);
    //  dd($result);
    //dd($result->messages[0]->resultDesc);

    if ($result->messages[0]->resultDesc == 'SUCCESS' && $result->messages[0]->clientRef == $randomRef) {


      $send['success'] = true;
      return response()->json($send);
    } else {

      $send['success'] = false;
      return response()->json($send);
    }


    // $send['success'] = true;
    // $send['otp'] = $otp;
    // return response()->json($send);

  }
  public function checkOTP(Request $request)
  {
    $mobile = $request->mobile;
    $mobile = str_replace("+", "", $mobile);
    $verify = Otp::validate($mobile, $request->otp);
    //  dd($verify);
    if ($verify->status) {
      $send['success'] = true;
      $send['message'] = $verify->message;
    } else {
      $send['success'] = false;
      $send['message'] = $verify->message;
    }

    // $send['otp'] = $otp;
    return response()->json($send);
  }
}