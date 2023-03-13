<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->load->view('include/single_project_menu'); ?>
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
                                                <li><a href="<?= base_url('Project/changePriority/' . $task['task_id'] . '/' . 'High' . '/' . $task['project_id']); ?>">High</a></li>
                                                <li><a href="<?= base_url('Project/changePriority/' . $task['task_id'] . '/' . 'Medium' . '/' . $task['project_id']); ?>">Medium</a></li>
                                                <li><a href="<?= base_url('Project/changePriority/' . $task['task_id'] . '/' . 'Low' . '/' . $task['project_id']); ?>">Low</a></li>
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
                                                <li><a href="<?= base_url('Project/changeTaskType/' . $task['task_id'] . '/' . 'Task' . '/' . $task['project_id']); ?>">Task</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskType/' . $task['task_id'] . '/' . 'Bug' . '/' . $task['project_id']); ?>">Bug</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskType/' . $task['task_id'] . '/' . 'Improvement' . '/' . $task['project_id']); ?>">Improvement</a></li>
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
                                                <li><a href="<?= base_url('Project/changeTaskStatus/' . $task['task_id'] . '/' . 'New' . '/' . $task['project_id']); ?>">New</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskStatus/' . $task['task_id'] . '/' . 'Progress' . '/' . $task['project_id']); ?>">In progress</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskStatus/' . $task['task_id'] . '/' . 'Done' . '/' . $task['project_id']); ?>">Done</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskStatus/' . $task['task_id'] . '/' . 'Testing' . '/' . $task['project_id']); ?>">Testing</a></li>
                                                <li><a href="<?= base_url('Project/changeTaskStatus/' . $task['task_id'] . '/' . 'Lock' . '/' . $task['project_id']); ?>">Lock</a></li>
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
                                    <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteTask/' . $task['task_id'] . '/' . $task['project_id']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a></td>
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
            language: {search: "TASKS", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW TASK</a>');

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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Assign To</label>
                            <select class="form-control" multiple="multiple" name="task_res_person[]" required>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Task type</label>
                            <select class="form-control" name="task_type" required>
                                <option value="Task">Task</option>
                                <option value="Bug">Bug</option>
                                <option value="Improvement">Improvement</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>DeadLine</label>
                            <input type="text" class="form-control pull-right" name="task_deadline" id="datepicker">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control" name="priority">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
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