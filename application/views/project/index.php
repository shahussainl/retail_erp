<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .form-group{
        width:100%;
        margin-bottom: 15px !important;
    }

    .dataTables_filter{
        display: none !important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/pm_menu'); ?>
    <!--    <div class="col-md-12">-->
    <div class="clearfix"></div>
   
    <section class="content">
        <div class="">
                   <div class="card-body">
                    <div class="row">
                        <!--Name-->
                        <div class="col-md-2 pl-1">
                            <label>TEAM LEAD</label>
                            <div class="form-group input-group" id="filter_col4" data-column="4">

                                <div class="input-group-addon"><i class="fa fa-table"></i></div>
                                <input type="text" name="Name" class="form-control column_filter" id="col4_filter" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2 pl-1">
                            <label>FETCH DAY</label>
                            <div class="form-group input-group" id="filter_col3" data-column="3">

                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="From" class="form-control column_filter currentdatepicker" id="col3_filter" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>DATE RANGE</label>
                            <div class="form-group input-group input-daterange">
                                <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>
                                <input type="text" id="min-date" class="form-control date-range-filter datepicker"  placeholder="">

                                <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>

                                <input type="text" id="max-date" class="form-control date-range-filter datepicker"  placeholder="">

                            </div>
                        </div>
                    </div>

                </div>
              <form method="post" class="allProjects" action="<?= base_url('Project/changeCheckProjectStatus') ?>">
         <input type="hidden" name="status" class="taskStatutsValue" />
            <!-- /.box-header -->
            <div class="row">
                <div class="">
                    <table id="products-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <label>
                  <input type="checkbox" class="minimal" onclick="if($(this).is(':checked')){$('.myCustomCheckBox').attr('checked',true)}else{$('.myCustomCheckBox').removeAttr('checked');}">
                </label>
                                </th>
                                <th>Project</th>
                                <th>Assigned Email</th>
                                <th>Starting From</th>
                                <th>Team Lead</th>
                                <th>Deal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)) { ?>
                                <?php
                                
                                $count = 1;
                                foreach ($data as $prj) {
                                    ?>
                                    <tr>
                                        <td>
                                    <label>
                  <input type="checkbox" class="minimal myCustomCheckBox" name="proj_id[<?= $prj->project_id ?>]" value="<?= $prj->project_id ?>">
                </label>
                                
                                        </td>
                                        <td>
                                            <a href="<?= base_url('Project/project_tasks/' . $prj->project_id); ?>"><?= $prj->project_name; ?></a>
                                        </td>
                                        <td><?= $prj->project_email_add; ?></td>
                                        <td><?= $prj->project_start_date; ?></td>
                                        <td><?= $prj->user_fname; ?> <?= $prj->user_lname; ?></td>
                                        <td><?= $prj->deal; ?></td>
                                        <td><div class="btn-group"><button type="button" class="btn btn-default btn-disabled"><?php
                                                    if ($prj->project_status == 0) {
                                                        echo 'NEW';
                                                    } elseif ($prj->project_status == 1) {
                                                        echo 'ENGAGE';
                                                    } elseif ($prj->project_status == 2) {
                                                        echo 'LEAD';
                                                    } else {
                                                        echo 'QUALIFIED';
                                                    }
                                                    ?></button>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="<?= base_url('Project/changeProjectStatus/0/' . $prj->project_id); ?>">NEW</a></li>
                                                    <li><a href="<?= base_url('Project/changeProjectStatus/1/' . $prj->project_id); ?>">ENGAGE</a></li>
                                                    <li><a href="<?= base_url('Project/changeProjectStatus/2/' . $prj->project_id); ?>">LEAD</a></li>
                                                    <li><a href="<?= base_url('Project/changeProjectStatus/3/' . $prj->project_id); ?>">QUALIFIED</a></li>
                                                </ul></div></td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                            <?php } ?>
                        </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear"></i> BULK ACTION    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a onclick="$('.taskStatutsValue').val(0);$('.allProjects').submit();">New</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val(1);$('.allProjects').submit();">Engage</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val(2);$('.allProjects').submit();">Lead</a></li>
                                                    <li><a onclick="$('.taskStatutsValue').val(3);$('.allProjects').submit();">Qualified</a></li>
                                                    <li><a onclick="if(confirm('are you sure want to delete this ?') == true){ $('.allProjects').attr('action','<?= base_url('Project/deleteProject'); ?>');$('.allProjects').submit(); }">Delete</a></li>
                                                </ul></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            </form>
        </div>
    </section>
     
</div>

<script>
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
             scrollY:        '57vh',
             scrollCollapse: true,
            "paging": false,
        });
        $("div.toolbar").html('');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });

    });
</script>
 <form action="<?php echo base_url('Admin/AddNewProject'); ?>" method="post" enctype="multipart/form-data">
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        ADD NEW PROJECT
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->

        <div class="box box-control-sidebar">
            <div class="box-body">
  
    <div class="box box-control-sidebar">

        <div class="box-body">

                <div class="row">
                    <div class="col-md-8">
                     <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Project</label>
                            <input type="text" class="form-control" name="project_name" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Project Email</label>
                            <input type="email" class="form-control" name="project_email_add" placeholder="" required="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="text" class="form-control pull-right" name="project_start_date" id="datepicker">
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form-group">
                            <label>Team Lead</label>

                            <select class="form-control"  name="project_team_lead" style="width: 100%;" required>
                                <option>-Select-</option>

                                <?php
                                foreach ($employee as $emp) {
                                    ?>
                                    <option value="<?= $emp->user_id; ?>"><?= $emp->user_fname . ' ' . $emp->user_lname; ?></option>
                                    <?php
                                }
                                ?>

                            </select>

                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Additional Note</label>
                            <textarea type="text" name="project_desc" class="form-control" placeholder="" ></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Deal</label>
                            <input type="deal" class="form-control" name="deal" placeholder="">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" id="preview-area">
                        <img class="img-responsive" src="" id="blah" />
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Image</label>
                            <input type="file" id="user_img"  name="file" class="form-control" />
                        </div>
                    </div>   
                </div>   
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label>Invite Members <br><span class="text-danger">*Press command key to select multiple members</span></label>

                            <select class="form-control" multiple="multiple" name="project_invite_emp[]" style="width: 100%;height: 200px;">
                                <?php
                                foreach ($employee as $emp) {
                                    ?>
                                    <option value="<?= $emp->user_id; ?>"><?= $emp->user_fname . ' ' . $emp->user_lname; ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                </div>
                


            
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">SAVE PROJECT</button>
                            <input type="reset" value="RESET" class="btn btn-warning">

                        </div>
                    </div>

                </div>
        </div>


    </div>

            </div>
        </div>
</aside>
     </form> 





