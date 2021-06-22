<?php require '../controller/sidebar.php'; ?>  
<?php require '../database.php'; ?> 

<?php 

$id = $_GET['id'];
if(isset($_POST['save']))
{
  
  $node_title = $_POST['node_title']; 
  $address = $_POST['address'];

  //echo $username.'test';
   $sql = "UPDATE edge_node SET edgeName='$node_title',address='$address' WHERE id=$id"; 
   
    if(mysqli_query($link, $sql)){
        header ('Location: ' . _SITE_URL . '/admin/controller/edgeNode.php');

}
}
  $sql = "SELECT * FROM edge_node where id=$id"; 
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $package_title_up =  $row['edgeName'];
                $price_up =  $row['address'];
              
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
                            <h4>Edit Edge Node</h4>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="block form-block mb-4">

                            <form enctype="multipart/form-data" action="#" method="post">
                                <div class="form-row">
                                  
                                  <div class="form-group col-md-12">
                                    <label>Edge Node Name</label>
                              <input class="form-control" value="<?php echo $package_title_up;?>" name="node_title" type="text" required="">

                                   
                                     <label>Address</label>
                              <input class="form-control" value="<?php echo $package_title_up;?>" name="address" type="text" required="">

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