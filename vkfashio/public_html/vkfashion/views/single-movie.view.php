<?php 
//require('../config.php');
$link = mysqli_connect("localhost", "bcstour_ott", "7792803988deepak", "bcstour_ott");
 $parent_id =  echoOutput($userInfo['user_id']);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$package_id =  echoOutput($userInfo['package']);

 $sql_pay = "SELECT * FROM  payment where user_id='".$parent_id."' AND movies='movies'";
 $sql_pay_data = $link->query($sql_pay);


if($sql_pay_data->num_rows < 1) {

$sql = "SELECT * FROM member_package where id='".$package_id."'";
 $result = $link->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //print_r($row);
       $movie_number = $row['movies'];
  }
}

 $movie_id = $itemDetails['id'];

$watch = $_GET['watch'];

$sql_get_in = "SELECT * FROM movies_view where user_id='".$parent_id."'";
$result_get_in = $link->query($sql_get_in);


 $sql_get = "SELECT * FROM movies_view where user_id='".$parent_id."' AND movie_id='".$movie_id."'";
 $result_get = $link->query($sql_get);
 if ($result_get->num_rows > 0) {
  while($result_get_row = $result_get->fetch_assoc()) {
    //print_r($row);
        $update_id = $result_get_row['id'];
        $update_movie_id = $result_get_row['movie_id'];
  }
}


if(!empty($watch))
{ 

 if ($result_get->num_rows > 0) {

    $sql_update = "UPDATE movies_view SET user_id='$parent_id',movie_id='$movie_id',movie_number='$movie_number' WHERE id=$update_id"; 
    mysqli_query($link, $sql_update);
    
 }
 else
 {  
   if ($result_get_in->num_rows < $movie_number) {
    $insert = "INSERT INTO movies_view (id,user_id,movie_id,movie_number) VALUES ('','$parent_id','$movie_id','$movie_number')";
     mysqli_query($link, $insert);
   }

} 


}
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function(){
jQuery(".payment_view").click(function(e){ 
    
var r = confirm("Please Make Payment");
if (r == true) {
   window.location.href = 'http://www.vkfashion.co.in/payumoney?user_id=<?php echo $parent_id; ?>&type=<?php echo 'movies'?>';
} else {
  //txt = "You pressed Cancel!";
}
 });
});
</script>


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
                                <img src="<?php echo $urlPath->image($itemDetails['movie_image']); ?>" alt="Image" class="uk-scrollspy-inview uk-animation-fade">
                            </div>

                            <?php if(isLogged()): ?>
                <?php if (($result_get_in->num_rows < $movie_number) || ($update_movie_id == $movie_id))  {?>
                            <a class="check_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="<?php echo gotToWatch();?>"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>
                           <?php } elseif ($sql_pay_data->num_rows > 0) {  ?>

                             <a class="check_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="<?php echo gotToWatch();?>"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>

                           <?php } else { ?>

                            <a class="payment_view uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="#"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>
                           <?php } ?>
                            <?php endif; ?>

                            <?php if(!isLogged()): ?>
                            <a class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="<?php echo $urlPath->signin(); ?>"><i class="uk-icon-television uk-margin-small-right"></i> <?php echo _WATCHNOW ?>
                            </a>
                            <?php endif; ?>

                            <?php if(isLogged() && $isInFavorites == 0): ?>

                                <a class="unfavmovie uk-hidden uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-close uk-margin-small-right"></i> <?php echo _REMOVEFAVORITE ?></a>

                                <a class="favmovie uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>


                            <?php if(isLogged() && $isInFavorites == 1): ?>

                                <a class="unfavmovie uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-close uk-margin-small-right"></i> <?php echo _REMOVEFAVORITE ?></a>

                                <a class="favmovie uk-hidden uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom" data-item="<?php echo $itemDetails['id']; ?>"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>

                            <?php if(!isLogged()): ?>

                                <a href="<?php echo $urlPath->signin(); ?>" class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top uk-margin-bottom"><i class="uk-icon-heart uk-margin-small-right"></i> <?php echo _ADDTOFAVORITES ?></a>

                            <?php endif; ?>

                        </div>

                        <div class="uk-width-medium-7-10 uk-margin-large-bottom">

                            <h2 class="uk-text-contrast uk-text-bold"><?php echo echoOutput($itemDetails['movie_title']); ?></h2>
                            <ul class="uk-subnav uk-subnav-line">
                                <li class="single-rating">
                                    <i class="ion-ios-star"></i>
                                    <?php echo showRating($itemDetails['movie_rate']); ?>
                                </li>
                                <li><?php echo echoOutput($itemDetails['movie_duration']); ?></li>
                                <li><?php echo echoOutput($itemDetails['movie_year']); ?></li>
                            </ul>
                            <hr>
                            <p class="uk-text-muted uk-h4"><?php echo echoOutput($itemDetails['movie_description']); ?></p>
                            <dl class="uk-description-list-horizontal uk-margin-top">
                                <dt>Starring</dt>
                                <dd><ul class="uk-subnav">
                                    <?php foreach($movieStars as $item): ?>
                                        <li><?php echo $item; ?></li>
                                    <?php endforeach; ?>
                                </ul></dd>
                                <dt>Genres</dt>
                                <dd><ul class="uk-subnav">
                                    <?php foreach($movieGenres as $item): ?>
                                        <li><?php echo $item; ?></li>
                                    <?php endforeach; ?>
                                </ul></dd>
                            </dl>

                        </div>

                        <?php endif; ?>


                        <div class="uk-width-1-1">

                            <div class="uk-margin-large-top">

                                <?php require './views/trailer.view.php'; ?>

                                <?php require './views/share.view.php'; ?>


                                    <div class="uk-margin-large-top">
                                        <h4 class="sectiontitle"><?php echo _RATETITLE ?></h4>

                                        <?php if (isLogged() && !$isReviewed): ?>
                                            <form class="uk-form uk-margin-bottom" method="post" id="formRateMovie">
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