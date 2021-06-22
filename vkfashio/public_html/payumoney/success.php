<?php
  $status      =$_POST["status"];
  $firstname   =$_POST["firstname"];
  $amount      =$_POST["amount"];
  $txnid       =$_POST["txnid"];
  $posted_hash =$_POST["hash"];
  $key         =$_POST["key"];
  $productinfo =$_POST["productinfo"];
  $email       =$_POST["email"];
  $salt        ="eCwWELxi";

  $pro = explode(' ',$productinfo);
  $user_id = $pro[0];
  $type = $pro[1];
  $series_id = $pro[2];
 
  

  If (isset($_POST["additionalCharges"])) {
    $additionalCharges =$_POST["additionalCharges"];
    $retHashSeq        = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
          
  } else {
    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key; 
  }

  $hash = hash("sha512", $retHashSeq);
  if ($hash != $posted_hash) {
    echo "Invalid Transaction. Please try again";

  } else {
    echo "<h3>Thank You. Your order status is ". $status .".</h3>";
    echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
    echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
  }

$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if($type == "series"){
  //echo 'Hello';

$insert = "INSERT INTO payment (id,user_id,series,movies,movie_id,series_id) VALUES ('','$user_id','$type','','','$series_id')";
     mysqli_query($link, $insert);
    
     //die;
//
/*$sql = "DELETE FROM series_view";

if ($link->query($sql) === TRUE) {
  //header("Location: http://www.vkfashion.co.in");
}*/
}

if($type == "movies"){

  $inserts = "INSERT INTO payment (id,user_id,series,movies,movie_id,series_id) VALUES ('','$user_id','','$type','$series_id','')";
     mysqli_query($link, $inserts);
//$sqlm = "DELETE FROM movies_view";

}

?>	