<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php 
//require('../config.php');
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
 $user_name =  echoOutput($userInfo['user_name']);
 $user_email =  echoOutput($userInfo['user_email']);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

 $movie_id = $itemDetails['id'];

 $sql_pay = "SELECT * FROM  payment where user_id='".$parent_id."' AND series='series' AND series_id='".$movie_id."'";
 $sql_pay_data = $link->query($sql_pay);

/*  $series_array = array();
 if ($sql_pay_data->num_rows > 0) {
  while($sql_pay_data_row = $sql_pay_data->fetch_assoc()) {
    //print_r($row);
       $series_array[] = $sql_pay_data_row['series_id'];
  }
}*/



$package_id =  echoOutput($userInfo['package']);

//if($sql_pay_data->num_rows < 1) {
$sql = "SELECT * FROM member_package where id='".$package_id."'";
 $result = $link->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //print_r($row);
       $movie_number = $row['series'];
  }
//}



$watch = $_GET['watch'];

$sql_get_in = "SELECT * FROM  series_view where user_id='".$parent_id."'";
$result_get_in = $link->query($sql_get_in);


 $sql_get = "SELECT * FROM  series_view where user_id='".$parent_id."' AND series_id='".$movie_id."'";
 $result_get = $link->query($sql_get);
 
 if ($result_get->num_rows > 0) {
  while($result_get_row = $result_get->fetch_assoc()) {
    //print_r($row);
        $update_id = $result_get_row['id'];
        $update_movie_id = $result_get_row['series_id'];
  }
}


if(!empty($watch))
{ 

 if ($result_get->num_rows > 0) {

    $sql_update = "UPDATE  series_view SET user_id='$parent_id',series_id='$movie_id',series_number='$movie_number' WHERE id=$update_id"; 
    mysqli_query($link, $sql_update);
    
 }
 else
 {  
   if ($result_get_in->num_rows < $movie_number) {
    $insert = "INSERT INTO  series_view (id,user_id,series_id,series_number) VALUES ('','$parent_id','$movie_id','$movie_number')";
     mysqli_query($link, $insert);
   }

} 

}
}

?>

<script>
jQuery(document).ready(function(){
jQuery(".payment_view").click(function(e){ 
    
var r = confirm("Please Make Payment For Series");
if (r == true) {
  window.location.href = 'http://www.vkfashion.co.in/payumoney?user_id=<?php echo $parent_id; ?>&type=<?php echo 'series'?>&series_id=<?php echo $movie_id ?>'; 

} else {
  //txt = "You pressed Cancel!";
}
 });
});
</script>

<?php //include('payment.php');?>


<div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
    <div class="uk-grid">

        <div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
            
            <?php require 'sidebar.php'; ?>

        </div>

        <div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10" data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">

            <div id="tm-media-section" class="">

                <div class="uk-container uk-container-center uk-width-10-10">
                    <div class="media-container uk-container-center">
                        
                        <?php require 'player.php'; ?>

                    </div>

                    <div class="uk-grid">

                        <?php if(!isWatch()): ?>

                        <div class="uk-width-medium-3-10"> 

                            <div  class="media-cover uk-text-center">
                                <img src="<?php echo $urlPath->image($itemDetails['serie_image']); ?>" alt="Image" class="uk-scrollspy-inview uk-animation-fade">
                            </div>
                            <?php if ($sql_pay_data->num_rows) {  ?>
                            <a class="check_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="<?php echo gotToWatch();?>"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>
                            <?php } elseif (($result_get_in->num_rows < $movie_number) || ($update_movie_id == $movie_id)) { ?>
                                <a class="check_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="<?php echo gotToWatch();?>"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                                </a>
                           <?php } else { ?>
                            <a class="payment_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="#"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>
                           <?php } ?> 
                           


                            <?php if(isLogged() && $isInFavorites == 0): ?>

                                <a class="unfavserie uk-hidden uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-close uk-margin-small-right"></i> <?php echo _REMOVEFAVORITE ?></a>

                                <a class="favserie uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>


                            <?php if(isLogged() && $isInFavorites == 1): ?>

                                <a class="unfavserie uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-close uk-margin-small-right"></i> <?php echo _REMOVEFAVORITE ?></a>

                                <a class="favserie uk-hidden uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>

                            <?php if(!isLogged()): ?>

                                <a href="<?php echo $urlPath->signin(); ?>" class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>

                        </div>
                        

                        <div class="uk-width-medium-7-10 uk-margin-large-bottom">

                            <h2 class="uk-text-contrast uk-text-bold"><?php echo echoOutput($itemDetails['serie_title']); ?></h2>
                            <ul class="uk-subnav uk-subnav-line">
                                <li class="single-rating">
                                    <i class="ion-ios-star"></i>
                                    <?php echo showRating($itemDetails['serie_rate']); ?>
                                </li>
                                <li><?php echo echoOutput($itemDetails['serie_year']); ?></li>
                            </ul>
                            <hr>
                            <p class="uk-text-muted uk-h4"><?php echo echoOutput($itemDetails['serie_description']); ?></p>
                            <dl class="uk-description-list-horizontal uk-margin-top">
                                <dt>Starring</dt>
                                <dd><ul class="uk-subnav">
                                    <?php foreach($serieStars as $item): ?>
                                        <li><?php echo $item; ?></li>
                                    <?php endforeach; ?>
                                </ul></dd>
                                <dt>Genres</dt>
                                <dd><ul class="uk-subnav">
                                    <?php foreach($serieGenres as $item): ?>
                                        <li><?php echo $item; ?></li>
                                    <?php endforeach; ?>
                                </ul></dd>
                            </dl>

                        </div>

                        <?php endif; ?>


                        <div class="uk-width-1-1">

                            <div class="uk-margin-large-top">

                                <?php require './views/trailer.view.php'; ?>

                                <?php require './views/episodes.view.php'; ?>

                                <?php require './views/share.view.php'; ?>


                                    <div class="uk-margin-large-top">
                                        <h4 class="sectiontitle"><?php echo _RATETITLE ?></h4>

                                        <?php if (isLogged() && !$isReviewed): ?>
                                            <form class="uk-form uk-margin-bottom" method="post" id="formRateSerie">
                                                <?php require 'review-form.php'; ?>
                                            </form>
                                        <?php endif; ?>
                                        
                                        <?php require './views/reviews.view.php'; ?>


                                    </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>