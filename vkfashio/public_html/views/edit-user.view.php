 <?php
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error()); 
}
$sub_id = $_GET['sub_id'];
if(isset($_POST['save']))
{
	$username = $_POST['username']; 
	//echo $username.'test';
	 $sql = "UPDATE sub_users SET username='$username' WHERE id=$sub_id"; 
    if(mysqli_query($link, $sql)){
        header("Location: http://www.vkfashion.co.in/manage-user.php");

}
}

?>

  <?php  
  
  $sql = "SELECT * FROM sub_users where id = $sub_id"; 

            $result = $link->query($sql);
             ?>
   <div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
	<h1 class="uk-heading-small pagetitle"><?php echo _EDITPROFILE ?></h1>
    <div class="edit-user-profile height-fixed">
        <form method="post" action="" enctype="multipart/form-data">
			<div class="user-edit-box">
				<div class="img-box">
					<img src="https://creativeitem.com/demo/neoflex/assets/global/thumb1.png">
				</div>
				<div class="input-box">
					<?php 
					     if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {?>
					<input type="text" class="input_black" placeholder="Name" value="<?php echo $row["username"];?>" name="username"> 
				<?php } } ?>
					<hr style="border-top:1px solid #333;">
					<br>
					<input type="submit" value="save" name="save" class="btn_block">
					<!-- <a href="http://www.vkfashion.co.in/manage-profile.php" class="btn_block" onclick="submit_form()">Save</a> -->
					<a href="http://www.vkfashion.co.in/manage-profile.php" class="btn_blank">Cancel</a>
				</div>
			</div>
		</form>
    </div>


</div>