<?php 
//require('../config.php');
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['sub']))
{
	$username = $_POST['username']; 
	//echo $username.'test';
	 $insert = "INSERT INTO sub_users (id,username,parent_uid) VALUES ('','$username','$parent_id')";
    if(mysqli_query($link, $insert)){
        header("Location: http://www.vkfashion.co.in/manage-user.php");

}
}

?>
<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
	<h1 class="uk-heading-small pagetitle"><?php echo _EDITPROFILE ?></h1>
    <div class="edit-user-profile height-fixed">
        <form method="post" action="" enctype="multipart/form-data">
			<div class="user-edit-box">
				<div class="img-box">
					<img src="https://creativeitem.com/demo/neoflex/assets/global/thumb1.png">
				</div>
				<form action="">
				<div class="input-box">
					<input type="text" class="input_black" name="username" required="" placeholder="Enter User name">
					<hr style="border-top:1px solid #333;">
					<br>
					<input type="submit" value="save" name="sub" class="btn_block">
					<!-- <a href="http://www.vkfashion.co.in/manage-user.php" class="btn_block" onclick="submit_form()">Save</a> -->
					<a href="http://www.vkfashion.co.in/manage-profile.php" class="btn_blank">Cancel</a>
				</div>
			</form>
			</div>
		</form>
    </div>
   
</div>