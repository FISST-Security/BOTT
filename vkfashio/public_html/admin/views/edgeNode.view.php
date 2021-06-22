<?php require '../controller/sidebar.php'; ?> 
<?php require '../database.php'; ?>
<!--Page Container-->
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>

<section class="page-container">

    <div class="page-content-wrapper">
        <!--Main Content-->

        <div class="content sm-gutter">

            <div class="container-fluid padding-25 sm-padding-10">

                <div class="row">

                    <div class="col-12">

                        <div class="section-title">

                            <h4>Manage Edge Node</h4>

                        </div>

                    </div>



                    <div class="col-12" style="text-align: right;padding-right: 20px;">

                        <a class="btn btn-dark" href="<?php echo _SITE_URL ?>/admin/controller/new_edgeNode.php">

                            <i class="fa fa-plus add-new-i"></i> Add Edge Node

                        </a>

                    </div>



                    <div class="col-12">

                        <div class="block table-block mb-4" style="margin-top: 20px">



                            <div class="row">

                                <div class="table-responsive">

                                    <table id="dataTable1" class="display table table-striped" data-table="data-table">

                                        <thead>

                                            <tr>

                                                <th>No.</th>

                                                <th>Edge Node Name</th>

                                                <th>Address</th>

                                               

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tfoot>

                                            <tr>

                                               <th>No.</th>

                                                <th>Edge Node Name</th>

                                                <th>Address</th>


                                                <th>Action</th>
                                            </tr>

                                        </tfoot>



                                        <tbody>
                                               <?php
                                              
                                             $sql = "SELECT * FROM edge_node";
                                                $result = $link->query($sql);
                                                //print_r($result);
                                               $count = 1;
                                                if ($result->num_rows > 0) {
                                                  while($row = $result->fetch_assoc()) {?>

                                                <tr>

                                                    <td><?php echo $count; ?></td>

                                                    <td><b><?php echo $row["edgeName"]; ?></b></td>

                                                    <td><?php echo $row["address"]; ?></td>

                                                  


                                                    <td class="name">
                                                        <a href="<?php echo _SITE_URL ?>/admin/controller/edit_edgeNode.php?id=<?php echo $row['id']; ?>"><i class="fa fa-cog a-i-color"></i></a> 

                                                        <a href="<?php echo _SITE_URL ?>/admin/controller/delete_EdgeNode.php?id=<?php echo $row['id']; ?>" onclick="return checkDelete()"><i class="fa fa-trash-o a-i-color"></i></a>
                                                    </td>



                                                </tr>
                                            <?php $count++;  }  } ?>

                                          </tbody>

                                      </table>



                                  </div>

                              </div>

                          </div>

                      </div>

                  </div>

              </div>

          </div>

      </div>

  </section>

