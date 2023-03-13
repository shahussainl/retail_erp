<?php
// echo "<pre>";
// print_r($sal_vouchers);
// exit();

defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .form-group{
        width:100%;
        margin-bottom: 15px !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php if($user->users_img != ''){ echo base_url('img_uploads/user_images/' . $user->users_img);}else{ echo base_url('assets/dist/img/placeholder.gif');} ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $user->user_fname.' '.$user->user_lname ?></h3>

              <p class="text-muted text-center">
              <?php if ($user->user_role == 1) { ?> Admin <?php } ?>
              <?php if ($user->user_role == 2) { ?> Vendor <?php } ?>
              <?php if ($user->user_role == 3) { ?> Customer <?php } ?>
              <?php if ($user->user_role == 4) { ?> Employee <?php } ?>

              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $user->user_email ?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact</b> <a class="pull-right"><?= $user->user_contact ?></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b> <a class="pull-right"><?= $user->user_address ?></a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block" data-toggle="control-sidebar"><b>update</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

<!--           About Me Box 
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
             /.box-header 
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
             /.box-body 
          </div>-->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#PolishedInvoices" data-toggle="tab">Polished Invoices</a></li>
              <?php if ($user->user_role != 3) { ?> <li><a href="#sales" data-toggle="tab">Sales</a></li> <?php } ?>
              <li><a href="#purchase" data-toggle="tab">Purchase</a></li>
             <!--  <li><a href="#tasks" data-toggle="tab">Set By Me</a></li>
              <li><a href="#tasks_assign" data-toggle="tab">Task Assigned</a></li>
              <li><a href="#timeline" data-toggle="tab">Work Flow</a></li> -->
              
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="PolishedInvoices">
              
                
                  <table id="sales-table" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>Invoice #</th>
                              <th>Invoice Date</th>
                              <th>Customer</th>
                              <th>Created On</th>
                              <th>Invoiced Amount</th>
                              <!--<th>is ref?</th>-->
                              <!--<th>Assign To</th>-->
                              <!--<th></th>-->
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($sal_published)) { ?>
                              <?php
                              foreach ($sal_published as $prd) {
                                  $pur_date = $prd->sales_date;
                                  $pur_date2 = $prd->sales_created_date;
                                  $is_ref = $prd->is_ref;
                                  $purchase_date = date('F d Y',strtotime($pur_date));
                                  $create_date = date('F d Y',strtotime($pur_date2));

                                  if ($is_ref == 1) {
                                      $status = 'Yes';
                                  } else {
                                      $status = 'NO';
                                  }
                                  ?>
                                  <tr>
                                      <td><a href="<?= base_url('Sales/singleSaleVoucher/' . $prd->sales_id); ?>"><?= $prefix ?><?= $prd->sales_id; ?></a></td>
                                      <td><?= $purchase_date; ?></td>
                                      <td><?= $prd->user_fname.' '.$prd->user_lname; ?></td>
                                      <td><?= $create_date; ?></td>
                                      <td><?= $prd->sales_bill_total; ?></td>
                                  
                                  

                                  </tr>
                              <?php } ?>
                          <?php } ?>
                      </tbody>
                  </table>
                  
              </div>  
                <!-- end of the sales -->
                 <div class="tab-pane" id="sales">
              
                
                  <table id="sales-table" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th>Invoice #</th>
                              <th>Invoice Date</th>
                              <th>Status</th>
                              <th>Created On</th>
                              <th>Invoiced Amount</th>
                              <!--<th>is ref?</th>-->
                              <!--<th>Assign To</th>-->
                              <!--<th></th>-->
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($sal_vouchers)) { ?>
                              <?php
                              foreach ($sal_vouchers as $prd) {
                                  $pur_date = $prd->pos_date;
                                  $pur_date2 = $prd->pos_date;
                                  // $is_ref = $prd->is_ref;
                                  $purchase_date = date('F d Y',strtotime($pur_date));
                                  $create_date = date('F d Y',strtotime($pur_date2));

                                  // if ($is_ref == 1) {
                                  //     $status = 'Yes';
                                  // } else {
                                  //     $status = 'NO';
                                  // }
                                  ?>
                                  <tr>
                                      <td> <a href="<?= base_url('PointOfSale/SingleView/' . $prd->pos_id); ?>"><?= $prefix ?><?= $prd->pos_id; ?></a></td>
                                      <td><?= $purchase_date; ?></td>
                                      <td><?php 
                                          if($prd->pos_status==1)
                                          {
                                            echo "Completed";
                                          }
                                          elseif($prd->pos_status==0)
                                          {
                                            echo "Hold";
                                          }
                                          else
                                          {
                                            echo "Cancel";
                                          }
                                       $prd->user_fname.' '.$prd->user_lname; 
                                       ?></td>
                                      <td><?= $create_date; ?></td>
                                      <td><?= $prd->pos_bill_total; ?></td>
                                  
                                    

                                  </tr>
                              <?php } ?>
                          <?php } ?>
                      </tbody>
                  </table>
                  
              </div>
                
                <div class="tab-pane" id="purchase">
                    
                     <table id="purchase-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Purchase no</th>
                                <th>Purchase Date</th>
                                <th>Vendor</th>
                                <th>Created Date</th>
                                <!--<th>Note</th>-->
                                <!--<th>is-ref?</th>-->
                                <!--<th></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pur_vouchers)) { ?>
                                <?php
                                foreach ($pur_vouchers as $prd) {
                                    $pur_date = $prd->purchase_date;
                                    $pur_date2 = $prd->purchase_created_date;
                                    $is_ref = $prd->is_ref;
                                    $purchase_date = date('F d Y', strtotime($pur_date) );
                                    $create_date = date('F d Y', strtotime($pur_date2) );
                               
                                    if ($is_ref == 1) {
                                        $status = 'Yes';
                                    } else {
                                        $status = 'NO';
                                    }
                                    ?>
                                    <tr>
                                        <td><a href="<?= base_url('Purchase/singlePurchaseVoucher/' . $prd->purchase_id); ?>"><?= $prefix; ?><?= $prd->purchase_number; ?></a></td>
                                        <td><?= $purchase_date; ?></td>
                                        <td><?= $prd->user_fname.' '.$prd->user_lname; ?></td>
                                        <td><?= $create_date; ?></td>
                                        <!--<td><?= $prd->purchase_additional_note; ?></td>-->
                                        <!--<td><? $status; ?></td>-->
                                     
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              
              
              
              
              
              <div class="tab-pane" id="tasks">
            
         <table class="table table-condensed table-striped table-bordered" id="task-table">
                    <thead>
                        <tr>
                            <th>Issue</th>
                            <th>Priority</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Assigned to</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($tasks)) {
                            $sno = 1;
                            foreach ($tasks as $task) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="<?= base_url('Admin/TasksDetails/' . $task['task_id']); ?>"><?= $task['task_title']; ?></a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-disabled"><?php
                                                if (!empty($task['priority'])) {
                                                    echo $task['priority'];
                                                } else {
                                                    echo 'Action';
                                                }
                                                ?></button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url('Admin/changePriority/' . $task['task_id'] . '/' . 'High' . '/'.$this->uri->segment(3)); ?>">High</a></li>
                                                <li><a href="<?= base_url('Admin/changePriority/' . $task['task_id'] . '/' . 'Medium' . '/' .$this->uri->segment(3)); ?>">Medium</a></li>
                                                <li><a href="<?= base_url('Admin/changePriority/' . $task['task_id'] . '/' . 'Low' . '/' .$this->uri->segment(3)); ?>">Low</a></li>
                                            </ul>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-disabled"><?php
                                                if (!empty($task['task_type'])) {
                                                    echo $task['task_type'];
                                                } else {
                                                    echo 'Action';
                                                }
                                                ?></button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url('Admin/changeTaskType/' . $task['task_id'] . '/' . 'Task' . '/'.$this->uri->segment(3)); ?>">Task</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskType/' . $task['task_id'] . '/' . 'Bug' .'/'.$this->uri->segment(3)); ?>">Bug</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskType/' . $task['task_id'] . '/' . 'Improvement' .'/'.$this->uri->segment(3)); ?>">Improvement</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-disabled"><?php
                                                if (!empty($task['task_status'])) {
                                                    echo $task['task_status'];
                                                } else {
                                                    echo 'New';
                                                }
                                                ?></button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task['task_id'] . '/' . 'New' . '/' .$this->uri->segment(3)); ?>">New</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task['task_id'] . '/' . 'Progress' . '/' .$this->uri->segment(3)); ?>">In progress</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task['task_id'] . '/' . 'Done' . '/' .$this->uri->segment(3)); ?>">Done</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task['task_id'] . '/' . 'Testing' . '/' .$this->uri->segment(3)); ?>">Testing</a></li>
                                                <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task['task_id'] . '/' . 'Lock' . '/' .$this->uri->segment(3)); ?>">Lock</a></li>
                                            </ul>
                                        </div>
                                    </td>

                                    <td><?= $task['task_res_person']; ?></td>
                                    <td><?php
                                        if (!empty($task['task_deadline'])) {
                                            $date = DateTime::createFromFormat('m/d/Y', $task['task_deadline']);
                                            $formated_date = $date->format("F d Y");
                                            echo $formated_date;
                                        }
                                        ?></td>
                                    <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteUserCreatedTask/' . $task['task_id'] . '/' .$this->uri->segment(3)); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a></td>
                                </tr>
                                <?php
                                $sno++;
                            }
                        } else {
                            echo "No Data Available!";
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              
              
              <div class="tab-pane" id="tasks_assign">
            
                  
                  <table class="table table-condensed table-striped table-bordered" id="task-table">
                      <thead>
                          <tr>
                              <th>Title</th>
                              <th>Issue</th>
                              <th>Priority</th>
                              <th>Type</th>
                              <th>Deadline</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          if (!empty($assign_to_me)) {
                              $sno = 1;
                              foreach ($assign_to_me as $task) {
                                  ?>
                                  <tr>
                                      <td>
                                          <a href="<?= base_url('Admin/TasksDetails/' . $task->task_id); ?>"><?= $task->task_title; ?></a>
                                      </td>
                                     
                                      <td><?php
                                          if (!empty($task->created_date)) {
                                              $mydate = DateTime::createFromFormat('Y-m-d', $task->created_date);
                                              $formated_date = $mydate->format("F d Y");
                                              echo $formated_date;
                                          }
                                          ?></td>
                                      <td><?= $task->priority ?></td>
                                      <td>
                                        <?php  if($task->task_type == 'Task'){ ?>Task<?php } ?>
                                        <?php  if($task->task_type == 'Bug' ){ ?>Bug<?php } ?>
                                        <?php  if($task->task_type == 'Improvement'){ ?>Improvement<?php } ?>
                                            
                                      </td>
                                      <td><?php
                                          if (!empty($task->task_deadline)) {
                                              $date = DateTime::createFromFormat('m/d/Y', $task->task_deadline);
                                              $formated_date = $date->format("F d Y");
                                              echo $formated_date;
                                          }
                                          ?></td>
                                      <td><div class="btn-group">
                                              <button type="button" class="btn btn-flat btn-block btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                  <?php
                                                  if (!empty($task->task_status)) {
                                                      echo $task->task_status;
                                                  } else {
                                                      echo 'New';
                                                  }
                                                  ?>    <span class="caret" style="margin-left:10px;"></span>
                                                  <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                                  <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task->task_id . '/' . 'New' . '/' . $this->uri->segment(3)); ?>">New</a></li>
                                                  <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task->task_id . '/' . 'Progress' . '/' . $this->uri->segment(3)); ?>">In progress</a></li>
                                                  <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task->task_id . '/' . 'Done' . '/' . $this->uri->segment(3)); ?>">Done</a></li>
                                                  <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task->task_id . '/' . 'Testing' . '/' . $this->uri->segment(3)); ?>">Testing</a></li>
                                                  <li><a href="<?= base_url('Admin/changeTaskStatus/' . $task->task_id . '/' . 'Lock' . '/' . $this->uri->segment(3)); ?>">Lock</a></li>
                                              </ul>
                                          </div></td>
                                     

                                  </tr>
                                  <?php
                                  $sno++;
                              }
                          } else {
                              echo "No Data Available!";
                          }
                          ?>

                      </tbody>
                  </table>
       
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light ">
<h1 class="control-sidebar-heading">
        PROFILE
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
      <form method="post" action="<?= base_url('Admin/updateUser'); ?>" enctype='multipart/form-data' >
       <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                <div class="col-md-9">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group input-group">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required value='<?= $user->user_fname ?>' />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group input-group">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required value='<?= $user->user_lname ?>' />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group input-group">
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required value='<?= $user->user_email ?>' />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group input-group">
                            <input type="text" name="contact" class="form-control" placeholder="Contact Number" value='<?= $user->user_contact ?>' />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group input-group">
                            <select name="role" class="form-control" required>
                                <option value="">Select Role</option>
                                <option <?php if ($user->user_role == 1) { ?>selected<?php } ?> value="1">Admin</option>
                                <option <?php if ($user->user_role == 2) { ?>selected<?php } ?> value="2">Vendor</option>
                                <option <?php if ($user->user_role == 3) { ?>selected<?php } ?> value="3">Customer</option>
                                <option <?php if ($user->user_role == 4) { ?>selected<?php } ?> value="4">Employee</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group input-group">
                            <textarea name="address" class="form-control" cols="100" placeholder="Enter full address..."  ><?= $user->user_address; ?></textarea>
                        </div>
                    </div>
                </div>
                </div>
                    <div class="col-md-3">
                    <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" value="<?= $user->user_id; ?>" name="user_id" />
                        <div class="form-group input-group">

                            <img class="img-rounded" id="blah" src="<?php if($user->users_img != ''){ echo base_url('img_uploads/user_images/' . $user->users_img);} ?>" >
                            <span class="userProfileOption">
                            <?php if($user->users_img != ''){ ?>
                                <input type="button" id="user_img" value="delete" data-id="<?= $user->user_id ?>" name="file" class="form-control deleteUserImage" />
                            <?php } else { ?>
                            <input type="file" id="user_img" name="file" class="form-control" />
                            <?php } ?>
                            </span>
                            <input type="hidden" name="old_img_name" value="<?= $user->users_img; ?>" />
                        </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>

<script>
$(document).on('click','.deleteUserImage',function(event){
    event.preventDefault();
    var id = $(this).data('id');
    var obj = $(this);
    obj.removeClass();
    if(confirm('are you sure want to remove this?') == true)
    {
       $.ajax({
           type:'POST',
           data:{'id':id},
           url:'<?= base_url('Admin/deleteUserProfileImage'); ?>',
           success:function()
           {
             obj.attr('type','file');
             $('#blah').attr('src','');
           }    
            
       
       });
    }
});
</script>