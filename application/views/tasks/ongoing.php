<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->load->view('include/pm_menu'); ?>
    <!-- Main content -->
    <form method="post" class="taskStatus" action="<?= base_url('Tasks/changeCheckedTaskStatus') ?>">
        <input type="hidden" name="status" class="taskStatutsValue" />
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-striped table-bordered" id="task-table">
                    <thead>
                        <tr>
                            <th><label>
                  <input type="checkbox" class="minimal" onclick="if($(this).is(':checked')){$('.myCustomCheckBox').attr('checked',true)}else{$('.myCustomCheckBox').removeAttr('checked');}">
                </label></th>
                            <th>Issue</th>
                            <th>Priority</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Assigned to</th>
                            <th>Deadline</th>
                            <th>ACTION</th>

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
                                        <label>
                  <input type="checkbox" class="minimal myCustomCheckBox" name="task[<?= $task->task_id ?>]" value="<?= $task->task_id ?>">
                </label>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('Admin/TasksDetails/' . $task->task_id); ?>"><?= $task->task_title; ?></a>
                                    </td>
                                     <td><?= $task->task_res_person; ?></td>
                                    <td><?php
                                        if (!empty($task->task_deadline)) {
                                            $date = DateTime::createFromFormat('m/d/Y', $task->task_deadline);
                                            $formated_date = $date->format("F d Y");
                                            echo $formated_date;
                                        }
                                        ?></td>
                                    <td><div class="btn-group ">
                                            <button type="button" class="btn btn-flat btn-block btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                              <?php
                                                if (!empty($task->priority)) {
                                                    echo $task->priority;
                                                } else {
                                                    echo 'Action';
                                                }
                                                ?>    <span class="caret" style="margin-left:10px;"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url('Tasks/changePriority/' . $task->task_id . '/' . 'High' . '/' . $task->project_id); ?>">High</a></li>
                                                <li><a href="<?= base_url('Tasks/changePriority/' . $task->task_id . '/' . 'Medium' . '/' . $task->project_id); ?>">Medium</a></li>
                                                <li><a href="<?= base_url('Tasks/changePriority/' . $task->task_id . '/' . 'Low' . '/' . $task->project_id); ?>">Low</a></li>
                                            </ul>
                                        </div></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-flat  btn-block btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <?php
                                                if (!empty($task->task_type)) {
                                                    echo $task->task_type;
                                                } else {
                                                    echo 'Action';
                                                }
                                                ?> <span class="caret" style="margin-left:10px;"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?= base_url('Tasks/changeTaskType/' . $task->task_id . '/' . 'Task' . '/' . $task->project_id); ?>">Task</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskType/' . $task->task_id . '/' . 'Bug' . '/' . $task->project_id); ?>">Bug</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskType/' . $task->task_id . '/' . 'Improvement' . '/' . $task->project_id); ?>">Improvement</a></li>
                                            </ul>
                                        </div>
                                    </td>
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
                                                <li><a href="<?= base_url('Tasks/changeTaskStatus/' . $task->task_id . '/' . 'New' . '/' . $task->project_id); ?>">New</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskStatus/' . $task->task_id . '/' . 'Progress' . '/' . $task->project_id); ?>">In progress</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskStatus/' . $task->task_id . '/' . 'Done' . '/' . $task->project_id); ?>">Done</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskStatus/' . $task->task_id . '/' . 'Testing' . '/' . $task->project_id); ?>">Testing</a></li>
                                                <li><a href="<?= base_url('Tasks/changeTaskStatus/' . $task->task_id . '/' . 'Lock' . '/' . $task->project_id); ?>">Lock</a></li>
                                            </ul>
                                        </div></td>
                                    <td>
                                        <a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteTask/' . $task->task_id . '/' . $task->project_id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a>
                                    </td>

                                </tr>
                                <?php
                                $sno++;
                            }
                        } else {
                            echo "No Data Available!";
                        }
                        ?>

                    </tbody>
                      <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear"></i> BULK ACTION    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a onclick="$('.taskStatutsValue').val('New');$('.taskStatus').submit();">New</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val('In progress');$('.taskStatus').submit();">In progress</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val('Done');$('.taskStatus').submit();">Done</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val('Testing');$('.taskStatus').submit();">Testing</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val('Lock');$('.taskStatus').submit();">Lock</a></li>
                                                    <li><a onclick="if(confirm('are you sure want to remove this?') == true){$('.taskStatus').attr('action','<?= base_url('Tasks/deleteCheckedTask') ?>');$('.taskStatus').submit();}">Delete</a></li>
                                                </ul></div>
                                </td>
                            </tr>
                        </tfoot>
                </table>
            </div>
        </div>
    </section>
    </form>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function () {
        $('#task-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "ONGOING", searchPlaceholder: "Filter and Search..."},
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
    <form action="<?= base_url('Admin/AddNewTask/') ?>" method="post">
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
                                foreach ($employee as $emp) {
                                    ?>
                                    <option value="<?= $emp->user_fname . ' ' . $emp->user_lname; ?>"><?= $emp->user_fname . '  ' . $emp->user_lname; ?></option>
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