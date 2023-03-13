<?php
date_default_timezone_set('Asia/Karachi');

// print_r($last_status['task_status']);
// $newDate = strtotime($single_task->task_deadline) - 60*60*24;
// echo date('Y-m-d',$newDate);
// exit();
// $currentDate = new DateTime("2019-06-18");
// $deadline    = new DateTime("2019-06-22");
// $difference = $currentDate->diff($deadline);
// echo 'Difference: '.$difference->y.' years, ' 
//                    .$difference->m.' months, ' 
//                    .$difference->d.' days';
// echo "<pre>";
// print_r($difference);
// exit();

function timeAgo($time_ago) {
    $cur_time = time();
    $time_elapsed = $cur_time - $time_ago;
    $seconds = $time_elapsed;
    $minutes = round($time_elapsed / 60);
    $hours = round($time_elapsed / 3600);
    $days = round($time_elapsed / 86400);
    $weeks = round($time_elapsed / 604800);
    $months = round($time_elapsed / 2600640);
    $years = round($time_elapsed / 31207680);
// Seconds
    if ($seconds <= 60) {
        echo "$seconds seconds ago";
    }
//Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            echo "1 minute ago";
        } else {
            echo "$minutes minutes ago";
        }
    }
//Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            echo "an hour ago";
        } else {
            echo "$hours hours ago";
        }
    }
//Days
    else if ($days <= 7) {
        if ($days == 1) {
            echo "yesterday";
        } else {
            echo "$days days ago";
        }
    }
//Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            echo "a week ago";
        } else {
            echo "$weeks weeks ago";
        }
    }
//Months
    else if ($months <= 12) {
        if ($months == 1) {
            echo "a month ago";
        } else {
            echo "$months months ago";
        }
    }
//Years
    else {
        if ($years == 1) {
            echo "1 year ago";
        } else {
            echo "$years years ago";
        }
    }
}

// $curenttime="2019-05-15";
if (!empty($last_status['task_rec_date'])) {
    $curenttime = $last_status['task_rec_date'];
    $time_ago = strtotime($curenttime);
    echo timeAgo($time_ago);
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->load->view('include/single_project_menu'); ?>
    <section class="content-header">
        <h1>
            <span class="ti" onblur="saveNewData(this, 'task_title')"><?= $single_task->task_title; ?></span> <i class="fa fa-pencil btn" onclick="editTask(this);"></i>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="single-page-wrapper">
            <div class="row single-page-innerwrapper">
                <div class="col-md-9">
                    <div class="">
                        <ul class="nav nav-tabs pull-right">

                            <li class="header abc">
                                <button class="btn <?php
                                if (!empty($single_task)) {
                                    ?>
                                    <?php if ($single_task->task_status == 'New' || $single_task->task_status == '') {
                                        ?> btn-success <?php } else { ?> btn-default <?php
                                            }
                                        }
                                        ?>  btn-flat" onclick="changeStatus('New');"> <i class="fa fa-flag"></i> New</button>
                                <button class="btn <?php
                                if (!empty($single_task)) {
                                    if ($single_task->task_status == 'Progress') {
                                        ?> btn-success <?php } else { ?> btn-default <?php
                                            }
                                        }
                                        ?> btn-flat" onclick="changeStatus('Progress');"><i class="fa fa-hand-pointer-o"></i> In Progress</button>
                                <button class="btn <?php
                                if (!empty($single_task)) {
                                    if ($single_task->task_status == 'Done') {
                                        ?> btn-success <?php } else { ?> btn-default <?php
                                            }
                                        }
                                        ?>  btn-flat" onclick="changeStatus('Done');"><i class="fa fa-thumbs-o-up"></i> Done</button>
                                <button class="btn <?php
                                if (!empty($single_task)) {
                                    if ($single_task->task_status == 'Testing') {
                                        ?> btn-success <?php } else { ?> btn-default <?php
                                            }
                                        }
                                        ?>  btn-flat" onclick="changeStatus('Testing');"><i class="fa fa-gears"></i> Testing</button>
                                <button class="btn  <?php
                                if (!empty($single_task)) {
                                    if ($single_task->task_status == 'Lock') {
                                        ?> btn-success <?php } else { ?> btn-default <?php
                                            }
                                        }
                                        ?>  btn-flat" onclick="changeStatus('Lock');"><i class="fa fa-lock"></i> Lock</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1-1">
                                <div class="row margin-bottom margin-top">
                                    <div class="col-md-12">
                                        <label><b>DESCRIPTION</b></label>
                                        <p><span class="desc" onblur="saveNewData(this, 'task_description')"><?= $single_task->task_description; ?></span> <i class="fa fa-pencil btn" onclick="editTask(this);"></i> </p>
                                    </div>
                                </div>
                                <input type="hidden" id="task_id" value="<?= $single_task->task_id; ?>" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group input-group">
                                            <input type="text" name="message" placeholder="Type Comments ..." class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Add</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-header">
                            <b class="box-title">Pending Since: </b>
                        </div>

                        <div class="box-body box-profile">

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    Project:   <a class="pull-right taskStatus"><?php
                                        if (!empty($single_task->project_name)) {
                                            echo $single_task->project_name;
                                        } else {
                                            echo ' -- ';
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    Created on:   <a class="pull-right taskStatus"><?php
                                        if (!empty($single_task)) {
                                            $ls_date = $single_task->created_date;

                                            $date = DateTime::createFromFormat('Y-m-d', $ls_date);
                                            $newdate = $date->format("F d Y");
                                            echo $newdate;
                                        } else {
                                            echo ' -- ';
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    Deadline:   <a class="pull-right taskStatus"><?php
                                        if (!empty($single_task)) {
                                            $ls_date = $single_task->task_deadline;

                                            $date = DateTime::createFromFormat('m/d/Y', $ls_date);
                                            $newdate = $date->format("F d Y");
                                            echo $newdate;
                                        } else {
                                            echo ' -- ';
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    Type:   <a class="pull-right taskStatusDate">
                                        <?php
                                        if (!empty($single_task)) {
                                            echo $single_task->task_type;
                                        }
                                        ?></a>
                                </li>
                                <li class="list-group-item">
                                    Priority:      <a class="pull-right"><b>
                                            <?php
                                            if (!empty($single_task)) {
                                                echo $single_task->priority;
                                            }
                                            ?></b></a>
                                </li>
                                <li class="list-group-item">
                                    Created by: <a class="pull-right taskreload"><?= $single_task->user_fname; ?><?= $single_task->user_lname; ?></a>
                                </li>
                                <li class="list-group-item">
                                    Assignee:   <a class="pull-right"><?= $single_task->task_res_person; ?></a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.box-body -->

                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>    
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>
    var title = $('.ti').html();
    var desc = $('.desc').html();
    function editTask(obj) {
        $(obj).parent().find('span').attr('contenteditable', true);
        $(obj).parent().find('span').focus();
    }

    function saveNewData(obj, dbColName) {

        var newTitle = $(obj).html();
        if (newTitle.trim() !== '') {
            var task_id = $('#task_id').val();
            $.ajax({
                url: "<?php echo base_url('Admin/UpdateTask'); ?>",
                method: "POST",
                data: {task_id: task_id, title: newTitle, dbColName: dbColName},
                success: function (data)
                {

//                    $('.taskStatus').load(location.href + ' .taskStatus');
//                    $('.taskStatusDate').load(location.href + ' .taskStatusDate');

                }

            });
        } else {
            if (dbColName == 'task_title') {
                $(obj).html(title);
            } else {
                $(obj).html(desc);
            }
        }
        $(obj).attr('contenteditable', false);
    }
    function changeStatus(status) {
        var task_id = $('#task_id').val();
        var dbColName = 'task_status';
        var newTitle = status;
        $.ajax({
            url: "<?php echo base_url('Admin/UpdateTaskStatus'); ?>",
            method: "POST",
            data: {task_id: task_id, title: newTitle, dbColName: dbColName},
            success: function (data)
            {

                    $('.abc').load(location.href + ' .abc');


            }

        });
    }
    $(document).ready(function () {



        var CheckStartStatus = $('.CheckStartStatus').val();
        // alert(CheckStartStatus);
        if (CheckStartStatus == 'Not Started')
        {
            $('.pause').hide();
        } else
        {
            $('.pause').show();

        }

        //     var status    = $(this).val();
        //     var task_id   = $('#task_id').val();

        // $.ajax({
        //     url:"<?php // echo base_url('Admin/CheckStartStatus/');                                     ?>",
        //     method:"POST",
        //     data:{task_id:task_id,status:status},
        //     success:function(data)
        //     {
        //       $('.taskStatus').load(location.href+ ' .taskStatus');
        //       $('.taskStatusDate').load(location.href+ ' .taskStatusDate');

        //       // if(data=='1')
        //       // {
        //       //  $('.pause').show();
        //       // }
        //       // else
        //       // {
        //       // 
        //       // }
        //     }

        //   });

        // alert('button testing!!');
        // $('#pause').hide();
        $('#start').click(function () {
            var status = $(this).val();
            var task_id = $('#task_id').val();



            $.ajax({
                url: "<?php echo base_url('Admin/AddTaskStatus/'); ?>",
                method: "POST",
                data: {task_id: task_id, status: status},
                success: function (data)
                {
                    $('.taskStatus').load(location.href + ' .taskStatus');
                    $('.taskStatusDate').load(location.href + ' .taskStatusDate');
                    // $('.refreshButtons').load(location.href+ ' .refreshButtons');
                    $('.pause').show();


                    // if(data=='1')
                    // {
                    //  $('.pause').show();
                    // }
                    // else
                    // {
                    //  $('.pause').hide();
                    // }
                }

            });

            // alert('start button clicked!');
        });

        $('#stop').click(function () {

            var status = $(this).val();
            var task_id = $('#task_id').val();


            $.ajax({
                url: "<?php echo base_url('Admin/AddTaskStatus/'); ?>",
                method: "POST",
                data: {task_id: task_id, status: status},
                success: function (data)
                {
                    $('.taskStatus').load(location.href + ' .taskStatus');
                    $('.taskStatusDate').load(location.href + ' .taskStatusDate');
                    // alert(data);

                }

            });

            // alert('stop button clicked!');
        });
        $('#pause').click(function () {

            var status = $(this).val();
            var task_id = $('#task_id').val();


            $.ajax({
                url: "<?php echo base_url('Admin/AddTaskStatus/'); ?>",
                method: "POST",
                data: {task_id: task_id, status: status},
                success: function (data)
                {
                    $('.taskStatus').load(location.href + ' .taskStatus');
                    $('.taskStatusDate').load(location.href + ' .taskStatusDate');
                    // alert(data);

                }

            });

            // alert('pause button clicked!');
        });
        $('#dispute').click(function () {

            var status = $(this).val();
            var task_id = $('#task_id').val();


            $.ajax({
                url: "<?php echo base_url('Admin/AddTaskStatus/'); ?>",
                method: "POST",
                data: {task_id: task_id, status: status},
                success: function (data)
                {
                    $('.taskStatus').load(location.href + ' .taskStatus');
                    $('.taskStatusDate').load(location.href + ' .taskStatusDate');
                    // alert(data);
                }

            });

            // alert('dispute button clicked!');
        });

// js code for radio button high, low statuses

        $('.priority').click(function () {

            var priority = $(this).val();
            var task_id = $('#task_id').val();


            $.ajax({
                url: "<?php echo base_url('Admin/PriorityUpdation/'); ?>",
                method: "POST",
                data: {task_id: task_id, priority: priority},
                success: function (data)
                {
                    // alert(data);
                    $('.taskreload').load(location.href + ' .taskreload');
                    // $(".timeRefresh").load(location.href + " .timeRefresh");

                }

            });

            // alert('dispute button clicked!');
        });

        // $("#taskDetails").load( "tasksDetails.php", function() {
        //  alert( "Load was performed." );
        //  });

    });
</script>
