<?php require '../controller/sidebar.php'; ?>  
<?php require '../database.php'; ?> 

<?php 
if(isset($_POST['save']))
{
 
  $node_title = $_POST['node_title']; 
  $node_address = $_POST['node_address']; 
  
  //echo $username.'test';
   $insert = "INSERT INTO edge_node(edgeName,address) VALUES ('$node_title','$node_address')";
    if(mysqli_query($link,$insert)){
        header('Location:' . _SITE_URL . '/admin/controller/edgeNode.php');
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
                            <h4>New Edge Node</h4>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="block form-block mb-4">

                            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-row">
                                  
                                  <div class="form-group col-md-12">
                                    
                                    <label>Edge NodeName</label>
                                    <input class="form-control" value="" name="node_title" type="text" required="">

                                   
                                       <label>Address</label>
                                    <input class="form-control" value="" name="node_address" type="text" required="">

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