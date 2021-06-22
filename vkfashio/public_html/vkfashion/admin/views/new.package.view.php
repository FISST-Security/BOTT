<?php require '../controller/sidebar.php'; ?>  
<?php require '../database.php'; ?> 

<?php 
if(isset($_POST['save']))
{
 
  $package_title = $_POST['package_title']; 
  $price = $_POST['price']; 
  $movies = $_POST['movies']; 
  $series = $_POST['series']; 
  
  //echo $username.'test';
   $insert = "INSERT INTO member_package(id,package_title,price,series,movies) VALUES ('','$package_title','$price','$series','$movies')";
    if(mysqli_query($link,$insert)){
        header('Location:' . _SITE_URL . '/admin/controller/packages.php');
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
                            <h4>New Membership Package</h4>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="block form-block mb-4">

                            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-row">
                                  
                                  <div class="form-group col-md-12">
                                    
                                    <label>Package Title</label>
                                    <input class="form-control" value="" name="package_title" type="text" required="">

                                   
                                     <label>Price</label>
                                    <input class="form-control" value="" name="price" type="number" required="">

                                   <label>Movies</label>
                                    <input class="form-control" value="" name="movies" type="number" required="" placeholder="Enter No. Of Movies">

                                   <label>Series</label>
                                    <input class="form-control" value="" name="series" type="number" required="" placeholder="Enter No. Of Series">

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