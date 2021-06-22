<?php 
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
//echo $parent_id =  echoOutput($userInfo['user_id']);
//echo 'testsss';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 $user_sub_id = $_GET['sub_id'];
$sql = "DELETE FROM sub_users WHERE id=$user_sub_id";


if ($link->query($sql) === TRUE) {
	header("Location: http://www.vkfashion.co.in/manage-user.php");
  //echo "Record deleted successfully";
}
?>