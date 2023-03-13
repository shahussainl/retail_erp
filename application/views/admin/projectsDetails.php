<?php
// echo "<pre>";
// print_r($files);

// foreach($files as $file)
// {
//     $temp=explode('.',$file['upload_file']);
  // $temparray;
  // print_r($temp[1]);
  // echo implode('/',$temparray); 

// }

// exit();

?>
<body class="hold-transition skin-blue sidebar-mini">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Projects
        <small>Buraq</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-circle-o"></i> Home</a></li>
        <li class="active">Projects</li>
      </ol>
    </section>
   <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php if(!empty($tasks[0]['project_name'])){ echo $tasks[0]['project_name']; }else{ echo 'Name not Specified!';} ?>  </h3>
          <p class="pull-right"><a href="<?php echo base_url('Admin/Projects/'); ?>" class="btn btn-info">Back</a> </p>
        </div>
        <div class="box-body">
          <div class="row">            
            <div class="col-md-12">
               <!-- custom tabs start -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tasks" data-toggle="tab">Tasks</a></li>
              <li><a href="#general" data-toggle="tab">General</a></li>
              <li><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#files" data-toggle="tab">Files</a></li>
              <li><a href="#conversation" data-toggle="tab">Conversations</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="tasks">
                <!-- create new task -->
                <div class="row" id="new_task">


                   <div class="row">
                     <div class="col-md-4"> <h3>Create New Task</h3></div>
                     <div class="col-md-4"></div>
                     <div class="col-md-2"><p><button id="btn_show_task" class="btn btn-info">Show Tasks</button> </p></div>
                    </div><br>
                    <div class="row">
                    <div class="col-md-10">
                      <form class="form-horizontal" action="<?= base_url('Admin/AddNewTask/')?>" method="post">
                        <input type="hidden" name="project_id" value="<?= $this->uri->segment(3); ?>">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Task Title</label>

                        <div class="col-sm-6">
                          <input type="text" name="task_title" class="form-control" id="inputName" placeholder="Enter Task Title" required>
                        </div>
                         <div class="col-sm-4">
                           <div class="checkbox">
                            <label>
                              <input type="checkbox" name="priority" value="high"> High Priority (<span class="text-danger">if low than leave  as uncheck</span>)
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" name="task_description" id="inputExperience" placeholder="Description" required></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Responsible Person</label>

                        <div class="col-sm-10">
                         <select class="form-control select2" multiple="multiple" name="task_res_person[]" data-placeholder="Select a State" style="width: 100%;" required>
                             <?php
                                foreach($employee as $emp)
                                {
                              ?>
                              <option value="<?= $emp->user_fname.' '.$emp->user_lname; ?>"><?= $emp->user_fname.'  '.$emp->user_lname; ?></option>
                              <?php
                                }
                              ?>
                           
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Deadline</label>
                        <div class="col-sm-6">
                         <input type="text" class="form-control pull-right" name="task_deadline" id="datepicker">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- ./col-md-10 -->
                 </div>
                </div>
              <!-- /.create new task  end-->
              <!-- task view start -->
             
                <div class="row" id="show_task">
                   <div class="row">
                    <div class="col-md-4"> <h3>Task View</h3></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><p><button id="btn_new_task" class="btn btn-info">New Task</button> </p></div>
                  </div>
                  <div class="row">
                  <div class="col-md-10">
                    <table class="table table-condensed table-striped table-bordered" id="example1">
                      <thead>
                        <tr>
                          <th>Serial#</th>
                          <th>Name</th>
                          <th>Deadline</th>
                          <th>Responsible Person</th>
                          <th>Priority</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($tasks))
                          {
                            $sno=1;
                            foreach($tasks as $task)
                            {
                        ?>
                          <tr>
                           <td><?= $sno;                       ?></td>
                           <td><a href="<?= base_url('Admin/TasksDetails/'.$task['task_id']);?>"><?= $task['task_title']; ?></a></td>
                           <td><?php if(!empty($task['task_deadline'])){ echo $task['task_deadline']; }else{ echo 'Not Specified!'; } ?></td>
                           <td><?= $task['task_res_person'];   ?></td>
                           <td><?php if(!empty($task['priority'])){ echo $task['priority']; }else{ echo 'Not Specified!'; } ?></td>
                           <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteTask/'.$task['task_id'].'/'.$task['project_id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a></td>
                          </tr>
                        <?php   
                            $sno++;
                            }
                          }
                          else
                          {
                            echo "No Data Available!";
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
                </div>
              <!-- /.task view end -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="general">
                 <!-- create new Note -->
               
                <div class="row" id="new_note">
                   <div class="row">
                     <div class="col-md-4"> <h3>Create New Note</h3></div>
                     <div class="col-md-4"></div>
                     <div class="col-md-2"><p><button id="btn_show_note" class="btn btn-info">Show Notes</button> </p></div>
                    </div><br>
                    <div class="row">
                    <div class="col-md-10">
                      <form class="form-horizontal" action="<?= base_url('Admin/AddNewNote/')?>" method="post">
                        <input type="hidden" name="project_id" value="<?= $this->uri->segment(3); ?>">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Note Title</label>

                        <div class="col-sm-6">
                          <input type="text" name="note_title" class="form-control" id="inputName" placeholder="Enter note Title" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" name="note_description" id="inputExperience" placeholder="Description about Note" required></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                      </div>
                    </form>
                    </div>
                 </div>
                </div>
              <!-- /.create new Note  end-->
              <!-- Note view start -->
             
                <div class="row" id="show_note">
                   <div class="row">
                    <div class="col-md-4"> <h3>Note View</h3></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><p><button id="btn_new_note" class="btn btn-info">New note</button> </p></div>
                  </div>
                  <div class="row">
                  <div class="col-md-10">
                    <table class="table table-condensed table-striped table-bordered" id="example2">
                      <thead>
                        <tr>
                          <th>Serial#</th>
                          <th>Name</th>
                          <th>Decription</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($notes))
                          {
                            $sno=1;
                            foreach($notes as $note)
                            {
                        ?>
                          <tr>
                           <td><?= $sno;                       ?></td>
                           <td><?= $note['note_title'];        ?></td>
                           <td><?= $note['note_description'];   ?></td>
                           <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteNote/'.$note['note_id'].'/'.$note['project_id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a></td>
                          </tr>
                        <?php   
                            $sno++;
                            }
                          }
                          else
                          {
                            echo "No Data Available!";
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
                </div>
              <!-- /.Note view end -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="activity">
                 <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <!-- <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-black">
              <div class="row">
                <div class="col-sm-6">
                  <!-- Progress bars -->
                  <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                  </div>

                  <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                  </div>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
                <div class="tab-pane" id="files">
                  
                     <!-- create new Note -->
               
                <div class="row" id="new_file">
                   <div class="row">
                     <div class="col-md-4"> <h3>Upload New File</h3></div>
                     <div class="col-md-4"></div>
                     <div class="col-md-2"><p><button id="btn_show_file" class="btn btn-info">Show Files</button> </p></div>
                    </div><br>
                    <div class="row">
                    <div class="col-md-10">
                      <form class="form-horizontal" action="<?= base_url('Admin/AddNewFile/'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="project_id" value="<?= $this->uri->segment(3); ?>">
                        <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">File Title</label>

                        <div class="col-sm-4">
                          <input type="text" name="file_title" class="form-control" id="inputName" placeholder="Enter File Title" required>
                        </div>
                        <label for="inputName" class="col-sm-2 control-label">Upload Date</label>
                         <div class="col-sm-3">
                           <div class="checkbox">
                              <input type="date" class="form-control" name="file_upload_date" id="datepicker">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">File/Image</label>

                        <div class="col-sm-10">
                          <img class="img-rounded" id="blah" src="" style="width:100px;">
                          <input type="file" id="user_img"  name="file" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                      </div>
                    </form>
                    </div>
                 </div>
                </div>
              <!-- /.create new Note  end-->
              <!-- Note view start -->
             
                <div class="row" id="show_file">
                   <div class="row">
                    <div class="col-md-4"> <h3>File View</h3></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2"><p><button id="btn_new_file" class="btn btn-info">New File</button> </p></div>
                  </div>
                  <div class="row">
                  <div class="col-md-10">
                    <table class="table table-condensed table-striped table-bordered" id="example3">
                      <thead>
                        <tr>
                          <th>Serial#</th>
                          <th>Name</th>
                          <th>Decription</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          if(!empty($files))
                          {
                            $sno=1;
                            foreach($files as $file)
                            {

                              $temp=explode('.',$file['upload_file']);
                              // $temparray;
                              // print_r($temp[1]);
                        ?>
                          <tr>
                           <td><?= $sno;                       ?></td>
                           <td><?= $file['file_title'];        ?></td>
                            <?php
                              if($temp[1]=='jpg' || $temp[1]=='png' || $temp[1]=='jpeg' || $temp[1]=='gif')
                              {
                            ?>
                           <td><img src="<?php echo base_url('assets/images/files/').$file['upload_file']; ?>" style="width: 85px;">
                           </td>
                           <?php
                            }else{
                           ?>
                           <td><i class="fa fa-file-pdf-o" style="font-size:48px;color:red"></i></td>
                           <?php
                            }
                           ?>
                           <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteFile/'.$file['file_id'].'/'.$file['project_id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a></td>
                          </tr>
                        <?php   
                            $sno++;
                            }
                          }
                          else
                          {
                            echo "No Data Available!";
                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                 </div>
                </div>
              <!-- /.Files view end -->

              </div>
              <!-- /.tab-pane -->
                <div class="tab-pane" id="conversation">
                <p>This is Conversations Tab Area</p>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Project Record
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 
  
<script type="text/javascript">
  function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#user_img").change(function () {
        readURL(this);
    });
    
</script> 