<?php require '../controller/sidebar.php'; ?>  
<?php require '../database.php'; ?> 

<?php 

$id = $_GET['id'];
if(isset($_POST['save']))
{
  
  $package_title = $_POST['package_title']; 
  $price = $_POST['price'];
  $series = $_POST['series'];
  $movies = $_POST['movies'];
  //echo $username.'test';
   $sql = "UPDATE member_package SET package_title='$package_title',price='$price',series='$series',movies='$movies' WHERE id=$id"; 
   
    if(mysqli_query($link, $sql)){
        header ('Location: ' . _SITE_URL . '/admin/controller/packages.php');

}
}
  $sql = "SELECT * FROM member_package where id=$id"; 
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $package_title_up =  $row['package_title'];
                $price_up =  $row['price'];
                 $movies_up =  $row['movies'];
                  $series_up =  $row['series'];
            }
          }
          
?>
<!--Page Container-->
<section class="page-container">
    <div class="page-content-wrapper"> 

        

        <!--Main Content-->

        <div class="content sm-gutter">
            <div class="container-fluid padding-25 sm-padding-10">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h4>Edit Membership Package</h4>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="block form-block mb-4">

                            <form enctype="multipart/form-data" action="#" method="post">
                                <div class="form-row">
                                  
                                  <div class="form-group col-md-12">
                                    <label>Package Title</label>
                              <input class="form-control" value="<?php echo $package_title_up;?>" name="package_title" type="text" required="">

                                   
                                     <label>Price</label>
                                    <input class="form-control" value="<?php echo $price_up;?>" name="price" type="number" required="">

                                   <label>Movies</label>
                              <input class="form-control" value="<?php echo $movies_up;?>" name="movies" type="number" required="" placeholder="Enter No. Of Movies">

                                   <label>Series</label>
                                    <input class="form-control" value="<?php echo $series_up;?>" name="series" type="number" required="" placeholder="Enter No. Of Series">

                               </div>

                               <div class="form-group col-md-12">
                                  <hr>
                                  <button class="btn btn-primary" type="submit" name="save">Save</button>
                              </div>


                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</section>