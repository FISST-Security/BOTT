<?php
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
	<h1 class="uk-heading-small pagetitle"><?php echo _EDITPROFILE ?></h1>
    <div class="manage-profile height-fixed">
        <table align="center">
            <tr>
           <?php  $sql = "SELECT * FROM sub_users where parent_uid = '$parent_id'";
            $result = $link->query($sql);
            //print_r($result);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {?>
                 <td>
                    <a href="http://www.vkfashion.co.in/edit-user.php?sub_id='<?php echo $row['id']?>'"
                        class="profile_switcher">
                        <img src="https://creativeitem.com/demo/neoflex/assets/global/thumb1.png" class="profile_switcher_img" />
                        <br>
                        <span class="uk-icon-stack uk-icon-sm profile_switcher_edit">
                        <i class="uk-icon-square-o uk-icon-stack-2x"></i>
                        <i class="uk-icon-pencil uk-icon-stack-1x"></i>
                        </span>
                       
                        <span class="user-name">  
                            <?php echo $row["username"];?>                     
                        </span>
                        </a>
                    <a href="http://www.vkfashion.co.in/delete-user.php?sub_id='<?php echo $row['id']?>'"
                    class="profile_switcher"> <i class="fa fa-remove" style="font-size:24px"></i></a>
                </td>
                
           <?php   } }?>
            
               </tr>
        </table>
        <br><br><br>
        <a href="http://www.vkfashion.co.in/manage-user.php" class="btn_block">Done</a>
         <?php  $sql = "SELECT * FROM sub_users where parent_uid = '$parent_id'";
            $result = $link->query($sql);
            //print_r($result);
            if ($result->num_rows == 5) {?>
        
        <?php } else {?>
            <a href="http://www.vkfashion.co.in/add-user.php" class="btn_blank">Add User</a>
       <?php  } ?>
    </div>
    

</div>