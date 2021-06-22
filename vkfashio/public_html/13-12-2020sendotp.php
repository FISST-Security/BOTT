<?php
require './core.php';
include './vendor/autoload.php';
$sid = "ACb79caf12252945894737552b861dc9ff"; // Your Account SID from www.twilio.com/console
$token = "96b5b232c70733e46ea7954be603b294"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token);

if(isset($_POST['mobile']))
{
  $mobile = $_POST['mobile'];
  $_SESSION['mobile'] = $mobile;
  $otp = rand(1000, 9999);
  $link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
  if($link === false)
  {
        die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM login_with_phone where phone =".$mobile." AND status = 1";
  $result = mysqli_num_rows($link->query($sql));
  if($result == 0)
  {
    $client = new Twilio\Rest\Client($sid, $token);
    $message = $client->messages->create(
      '+91'.$mobile.'', // Text this number
      [
        'from' => '+12563718677', // From a valid Twilio number
        'body' => 'Your MoFlix verification code is :'.$otp
      ]
    );
    
   if($message->sid)
   {
        mysqli_query($link, "DELETE FROM `login_with_phone` WHERE phone=".$mobile."");
        mysqli_query($link, "INSERT INTO `login_with_phone`(`phone`, `otp`,`status`) VALUES ('$mobile','$otp',0)");
        echo 1; die;
   }
   else
   {
       echo 0; die;
   }
    
  }
  else
  {
    $_SESSION['signedin'] = true;
	$_SESSION['user_email'] = $mobile;
	$_SESSION['user_name'] = $mobile;
	echo 2; die;
  }
}

if(isset($_POST['otp']))
{
    $link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
      if($link === false)
      {
            die("ERROR: Could not connect. " . mysqli_connect_error());
      }
    $otp = $_POST['otp'];
    $mobile = isset($_SESSION['mobile'])?$_SESSION['mobile']:'';
    $sql = "SELECT * FROM login_with_phone where phone =".$mobile." AND otp=".$otp." ";
    $result = mysqli_num_rows($link->query($sql));
    //echo $result; die;
    if($result == 1)
    {
        $_SESSION['signedin'] = true;
    	$_SESSION['user_email'] = $mobile;
    	$_SESSION['user_name'] = $mobile;
        mysqli_query($link, "UPDATE `login_with_phone` SET status =1 where phone =".$mobile." AND otp=".$otp." ");
        echo 1; die;
    }
    else
    {
        echo 0; die;
    }
}
/*function smsApi(){
    $otp = rand(1000, 9999);
    if(checkUniqueOTP($otp)) {
        $base_url = "http://alerts.icisms.in/api/v4/?api_key=lz87kv9o80xxxxxxxxxxxxxxxxxxxxxxxxx";
        $message = urlencode("Your OTP is: ".$otp);
        $full_url = $base_url."&method=sms&message=".$message."&to=".$mobile."&sender=LATICE";
        echo $full_url; die;
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$full_url);
        curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        $buffer = curl_exec($curl_handle);
        
        if (!curl_errno($curl_handle)) {
            $info = curl_getinfo($curl_handle);
            echo '<pre>'; print_r($info); die;
        }
        curl_close($curl_handle);
    }
}


function checkUniqueOTP($otp){
    $link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
    
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM users where otp =".$otp;
    $result = mysqli_num_rows($link->query($sql));
    if($result)
        checkUniqueOTP(rand(1000, 9999));
    else
        return true;
}

smsApi();*/

?>