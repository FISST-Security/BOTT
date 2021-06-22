<?php
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>