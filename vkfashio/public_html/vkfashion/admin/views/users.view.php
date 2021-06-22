<?php require '../controller/sidebar.php'; ?>  
<?php require '../database.php'; ?>


<!--Page Container-->

<section class="page-container">

    <div class="page-content-wrapper">



        



        <!--Main Content-->



        <div class="content sm-gutter">

            <div class="container-fluid padding-25 sm-padding-10">

                <div class="row">

                    <div class="col-12">

                        <div class="section-title">

                            <h4>Users</h4>

                        </div>

                    </div>



                    <div class="col-12" style="text-align: right;padding-right: 20px;">

                        <a class="btn btn-dark" href="<?php echo _SITE_URL ?>/admin/controller/new_user.php">

                            <i class="fa fa-plus add-new-i"></i> Add New

                        </a>

                    </div>



                    <div class="col-12">

                        <div class="block table-block mb-4" style="margin-top: 20px">



                            <div class="row">

                                <div class="table-responsive">

                                    <table id="dataTable1" class="display table table-striped" data-table="data-table">

                                        <thead>

                                            <tr>

                                                <th>Id</th>

                                                <th>Name</th>

                                                <th>Email</th>
                                                <th>Sub Users</th>
                                                <th>Package</th>
                                                 <th>Edge</th>
                                                <th>Role</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>

                                        <tfoot>

                                            <tr>

                                                <th>Id</th>

                                                <th>Name</th>

                                                <th>Email</th>
                                                <th>Sub Users</th>
                                                <th>Package</th>
                                                <th>Edge</th>
                                                <th>Role</th>

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </tfoot>



                                        <tbody>

                                            <?php foreach($users as $user): ?>

                                                <tr>

                                                    <td><?php echo echoOutput($user['user_id']); ?></td>

                                                    <td><b><?php echo echoOutput($user['user_name']); ?></b></td>

                                              <td><?php echo echoOutput($user['user_email']); ?></td>
                                               <td> 
                                              <?php
                                               $parent_id  =echoOutput($user['user_id']);   
                                             $sql = "SELECT * FROM sub_users where parent_uid = '$parent_id'";
                                                $result = $link->query($sql);
                                                //print_r($result);
                                                $user_array= array();
                                                if ($result->num_rows > 0) {
                                                  while($row = $result->fetch_assoc()) {
                                                 $user_array[] = $row["username"];
                                          
                                                   } } ?>

                                                   <?php if(!empty($user_array)){
                                                    echo '(';
                                                   echo implode(',',$user_array);
                                                   echo ')';
                                                    } 
                                                    ?>
                                                   

                                                 </td> 
                                                    <td> 
                                                 <?php
                                                $package_id  =echoOutput($user['package']); 
                                              if(!empty($package_id) && $package_id > 0) { 
                                             $sql_p = "SELECT * FROM member_package where id = '$package_id'";
                                                $result_p = $link->query($sql_p);
                                                //print_r($result);
                                               
                                                if ($result_p->num_rows > 0) {
                                                  while($row_p = $result_p->fetch_assoc()) {
                                                 echo $pack_title =  $row_p["package_title"];
                                                 
                                                   } } }?> 
                                                  </td> 
                                                      <td> 
                                                 <?php
                                                $node_id  =echoOutput($user['edgeNode']); 
                                              if(!empty($node_id) && $node_id > 0) { 
                                             $sql_p = "SELECT * FROM edge_node where id = '$node_id'";
                                                $result_p = $link->query($sql_p);
                                                //print_r($result);
                                               
                                                if ($result_p->num_rows > 0) {
                                                  while($row_p = $result_p->fetch_assoc()) {
                                                 echo $edgeName_title =  $row_p["edgeName"];
                                                 
                                                   } } }?> 
                                                  </td> 

                                                    <td>

                                                        <?php

                                                        $status = $user['user_role'];

                                                        if ($status == 1) {

                                                            echo 'Administrator';

                                                        }else{

                                                            echo 'Subscriber';

                                                        }

                                                        ?>

                                                    </td>
                                                    
                                                    <td class="status">

                                                        <?php

                                                        $status = $user['user_status'];

                                                        if ($status == 1) {

                                                            echo '<span class="badge badge-pill bg-success">Active</span>';

                                                        }else{

                                                            echo '<span class="badge badge-pill bg-warning">Inactive</span>';

                                                        }

                                                        ?>

                                                    </td>

                                                    <td class="name"><a href="<?php echo _SITE_URL ?>/admin/controller/edit_user.php?id=<?php echo $user['user_id']; ?>"><i class="fa fa-cog a-i-color"></i></a> <a onclick="alertdelete_<?php echo $user['user_id']; ?>();" style="cursor: pointer;"><i class="fa fa-trash-o a-i-color"></i></a></td>



                                                </tr>



                                                <script type="text/javascript">

                                                  function alertdelete_<?php echo $user['user_id']; ?>() {

                                                      swal({ title: "Are you sure?", text: "You will not be able to recover this item!", type: "warning",cancelButtonClass: "btn-default btn-sm", showCancelButton: true, confirmButtonClass: "btn-danger btn-sm", confirmButtonText: "Yes, delete it!", closeOnConfirm: false }, function(){window.location.href = "<?php echo _SITE_URL ?>/admin/controller/delete_user.php?id=<?php echo $user['user_id']; ?>" });}

                                                  </script>

                                                  

                                              <?php endforeach; ?>



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