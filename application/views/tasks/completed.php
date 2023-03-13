  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php $this->load->view('include/pm_menu'); ?>
   <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                                    <table class="table table-condensed table-striped table-bordered" id="task-table">
                      <thead>
                        <tr>
                           <th>Issue</th>
                           <th>Priority</th>
                           <th>Type</th>
                           <th>Status</th>
                           <th>Assigned to</th>
                           <th>Deadline</th>
                          
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
                              <td>
                                  <a href="<?= base_url('Admin/TasksDetails/'.$task->task_id);?>"><?= $task->task_title; ?></a>
                              </td>
                               <td><?php if(!empty($task->priority)){ echo $task->priority; } ?></td>
                               <td><?php if(!empty($task->task_type)){ echo $task->task_type; }else{ echo 'Task'; } ?></td>
                               <td><?php if(!empty($task->task_status)){ echo $task->task_status; }else{ echo 'New'; } ?></td>
                           
                           <td><?= $task->task_res_person;   ?></td>
                          <td><?php if(!empty($task->task_deadline)){ 
                              $date = DateTime::createFromFormat('m/d/Y', $task->task_deadline);
                                    $formated_date = $date->format("F d Y");
                              echo $formated_date ; } 
                              ?></td>
                           
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $('#task-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "COMPLETED", searchPlaceholder: "Filter and Search..."},
        });
//        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW TASK</a>');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });
    });
</script>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        ADD NEW TASK
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form action="<?= base_url('Admin/AddNewTask/')?>" method="post">
         <input type="hidden" name="project_id" value="<?= $this->uri->segment(3); ?>">
        <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Task</label>
                            <input type="text" name="task_title" class="form-control" id="inputName" placeholder="" required="">
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="task_description" id="inputExperience"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Assign To</label>
                              <select class="form-control select2" multiple="multiple" name="task_res_person[]" required>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>DeadLine</label>
                         <input type="text" class="form-control pull-right" name="task_deadline" id="datepicker">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control">
                                <option></option>
                                <option value="1">Low</option>
                                <option selected="" value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">CREATE TASK</button>
                        <input type="reset" value="RESET" class="btn btn-warning">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>