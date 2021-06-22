<?php
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error()); 
}

?>
<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
	<h1 class="uk-heading-small pagetitle"><?php echo _EDITPROFILE ?></h1>
    
    <div class="manage-profile height-fixed select-user">
        <table align="center">

            <tr>
        <?php  $sql = "SELECT * FROM sub_users where parent_uid = '$parent_id'";  
            $result = $link->query($sql);
            //print_r($result);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {?>
                 <td>
                     <td>
                    <a href="http://www.vkfashion.co.in/"
                        class="profile_switcher">
                        <img src="https://creativeitem.com/demo/neoflex/assets/global/thumb1.png" class="profile_switcher_img" />
                        <br>
                        <span class="user-name">
                            <?php echo $row["username"];?>                      
                        </span>
                    </a>
                </td>
           <?php } }?>
            </tr>

        </table>
        <br>
        <br>
        <br>
        <a href="http://www.vkfashion.co.in/manage-profile.php" class="btn_blank">Manage Profile</a>
    </div>

</div>