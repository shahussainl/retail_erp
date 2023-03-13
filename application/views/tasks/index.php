<style>
    .list-body{
        padding-top: 15px;
    }
    #sortable1{
     background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(0,200,255,1) 100%);   
    }
        #sortable2{
        background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(255,190,0,1) 100%);
    }
        #sortable3{
       background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(181,0,72,1) 100%); 
    }
        #sortable4{
        background: rgb(255,255,255);
background: linear-gradient(0deg, rgba(255,255,255,0) 0%, rgba(0,181,35,1) 100%);
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/pm_menu'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="">
            <div class="col-md-3 pull-left list-body" id="sortable1" style="min-height: 600px;">
                <?php if (!empty($new)) { ?>

                    <?php foreach ($new as $n) { ?>
                        <div class="box box-primary direct-chat direct-chat-primary collapsed-box">
                            <div class="box-header with-border"  id="<?= $n['project']->project_id; ?>">
                                <h3 class="box-title"><?= $n['project']->project_name; ?></h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Total Task <?= sizeof($n['tasks']); ?>"><?= sizeof($n['tasks']); ?></span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"  data-original-title="expend"><i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button"  class="btn btn-box-tool"  data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Task">
                                        <i class="fa fa-comments"></i></button>
                                        <a href="<?= base_url('Project/trashProject/'. $n['project']->project_id); ?>" data-toggle="tooltip" data-original-title="delete" onclick="return window.confirm('are you sure want to remove this?')" class="btn btn-box-tool"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <?php if (!empty($n['notes'])) { ?>
                                        <?php foreach ($n['notes'] as $not) { ?>
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                   <a href="<?= base_url('Project/project_notes/'.$not->project_id); ?>"> <span class="direct-chat-name pull-left"><?= $not->note_description ?></span>
                                                    <span class="direct-chat-timestamp pull-right"><?= $not->user_fname; ?> <?= $not->user_lname; ?></span>
                                                   </a>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <!-- /.direct-chat-img -->
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- /.direct-chat-msg -->
                                </div>
                                <!--/.direct-chat-messages-->
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <?php if (!empty($n['tasks'])) { ?>
                                        <?php foreach ($n['tasks'] as $tas) { ?>
                                            <ul class="contacts-list">
                                                <li>
                                                    <!--<a href="#">-->


                                                        <div class="">
                                                            <a href="<?= base_url('Admin/TasksDetails/'.$tas->task_id); ?>"><span class="contacts-list-name">
                                                                <?= $tas->task_title; ?>
                                                                <!--<small class="contacts-list-date pull-right">2/28/2015</small>-->
                                                            </span>
                                                                <span class="contacts-list-msg"><?= $tas->task_description; ?></span></a>
                                                        </div>
                                                        <!-- /. -->
                                                    <!--</a>-->
                                                </li>
                                                <!-- End Contact Item -->
                                            </ul>
                                            <!-- /.contatcts-list -->
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer">
                                <form action="<?= base_url('Project/addNote'); ?>" method="post">
                                    <input type="hidden" name="project_id" value="<?= $n['project']->project_id ?>" />
                                    <div class="input-group">
                                        <input type="text" name="note" placeholder="Add Note ..." class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary btn-flat">Save</button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <!-- /.box-footer-->
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-3 pull-left list-body" id="sortable2" style="min-height: 600px;">
                <?php if (!empty($enagage)) { ?>
                    <?php foreach ($enagage as $n) { ?>
                        <div class="box box-warning direct-chat direct-chat-warning collapsed-box">
                            <div class="box-header with-border" id="<?= $n['project']->project_id; ?>">
                                <h3 class="box-title"><?= $n['project']->project_name ?></h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="" class="badge bg-orange" data-original-title="Total Task <?= sizeof($n['tasks']); ?>"><?= sizeof($n['tasks']); ?></span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="expend"><i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Task">
                                        <i class="fa fa-comments"></i></button>
                                        <a href="<?= base_url('Project/trashProject/'. $n['project']->project_id); ?>" data-toggle="tooltip" data-original-title="delete" onclick="return window.confirm('are you sure want to remove this?')" class="btn btn-box-tool"><i class="fa fa-times"></i></a>
                               
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <?php if (!empty($n['notes'])) { ?>
                                        <?php foreach ($n['notes'] as $not) { ?>
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                 <a href="<?= base_url('Project/project_notes/'.$not->project_id); ?>">   <span class="direct-chat-name pull-left"><?= $not->note_description ?></span>
                                                    <span class="direct-chat-timestamp pull-right"><?= $not->user_fname; ?> <?= $not->user_lname; ?></span>
                                                 </a>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <!-- /.direct-chat-img -->
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- /.direct-chat-msg -->
                                </div>
                                <!--/.direct-chat-messages-->
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <?php if (!empty($n['tasks'])) { ?>
                                        <?php foreach ($n['tasks'] as $tas) { ?>
                                            <ul class="contacts-list">
                                                <li>
                                                    <!--<a href="#">-->


                                                        <div class="">
                                                            <a href="<?= base_url('Admin/TasksDetails/'.$tas->task_id); ?>"><span class="contacts-list-name">
                                                                <?= $tas->task_title; ?>
                                                                <!--<small class="contacts-list-date pull-right">2/28/2015</small>-->
                                                            </span>
                                                            <span class="contacts-list-msg"><?= $tas->task_description; ?></span>
                                                            </a>
                                                        </div>
                                                        <!-- /. -->
                                                    <!--</a>-->
                                                </li>
                                                <!-- End Contact Item -->
                                            </ul>
                                            <!-- /.contatcts-list -->
                                        <?php } ?> 
                                    <?php } ?> 
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <form action="<?= base_url('Project/addNote'); ?>" method="post">
                                    <input type="hidden" name="project_id" value="<?= $n['project']->project_id ?>" />
                                    <div class="input-group">
                                        <input type="text" name="note" placeholder="Add Note ..." class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-warning btn-flat">Save</button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <!-- /.box-footer-->
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="col-md-3 pull-left list-body" id="sortable3" style="min-height: 600px;">
                <?php if (!empty($lead)) { ?>
                    <?php foreach ($lead as $n) { ?>
                        <div class="box box-danger direct-chat direct-chat-danger collapsed-box">
                       <div class="box-header with-border" id="<?= $n['project']->project_id; ?>">
                                <h3 class="box-title"><?= $n['project']->project_name ?></h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="" class="badge bg-orange" data-original-title="Total Task <?= sizeof($n['tasks']); ?>"><?= sizeof($n['tasks']); ?></span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="expend"><i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Task">
                                        <i class="fa fa-comments"></i></button>
                                        <a href="<?= base_url('Project/trashProject/'. $n['project']->project_id); ?>" data-toggle="tooltip" data-original-title="delete" onclick="return window.confirm('are you sure want to remove this?')" class="btn btn-box-tool"><i class="fa fa-times"></i></a>
                               
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="direct-chat-messages">
                                    <?php if (!empty($n['notes'])) { ?>
                                        <?php foreach ($n['notes'] as $not) { ?>
                                            <!-- Conversations are loaded here -->
                                            <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                <a href="<?= base_url('Project/project_notes/'.$not->project_id); ?>">    <span class="direct-chat-name pull-left"><?= $not->note_description ?></span>
                                                    <span class="direct-chat-timestamp pull-right"><?= $not->user_fname; ?> <?= $not->user_lname; ?></span>
                                                </a>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <!-- /.direct-chat-img -->
                                                <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <!--/.direct-chat-messages-->
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <?php if (!empty($n['tasks'])) { ?>
                                        <?php foreach ($n['tasks'] as $tas) { ?>
                                            <ul class="contacts-list">
                                                <li>
                                                    <!--<a href="#">-->


                                                        <div class="">
                                                            <a href="<?= base_url('Admin/TasksDetails/'.$tas->task_id); ?>"><span class="contacts-list-name">
                                                                <?= $tas->task_title; ?>
                                                                <!--<small class="contacts-list-date pull-right">2/28/2015</small>-->
                                                            </span>
                                                            <span class="contacts-list-msg"><?= $tas->task_description; ?></span>
                                                            </a>
                                                        </div>
                                                        <!-- /. -->
                                                    <!--</a>-->
                                                </li>
                                                <!-- End Contact Item -->
                                            </ul>
                                            <!-- /.contatcts-list -->
                                        <?php } ?> 
                                    <?php } ?> 
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <form action="<?= base_url('Project/addNote'); ?>" method="post">
                                    <input type="hidden" name="project_id" value="<?= $n['project']->project_id ?>" />
                                    <div class="input-group">
                                        <input type="text" name="note" placeholder="Add Note ..." class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-danger btn-flat">Save</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- /.box-footer-->
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="col-md-3 pull-left list-body" id="sortable4" style="min-height: 600px;">
                <?php if (!empty($qualified)) { ?>
                    <?php foreach ($qualified as $n) { ?>

                        <div class="box box-success direct-chat direct-chat-success collapsed-box">
                            <div class="box-header with-border" id="<?= $n['project']->project_id; ?>">
                                <h3 class="box-title"><?= $n['project']->project_name; ?></h3>

                                <div class="box-tools pull-right">
                                    <span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="Total Task <?= sizeof($n['tasks']); ?>"><?= sizeof($n['tasks']); ?></span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" data-original-title="expend"><i class="fa fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Task">
                                        <i class="fa fa-comments"></i></button>
                                      <a href="<?= base_url('Project/trashProject/'. $n['project']->project_id); ?>" data-toggle="tooltip" data-original-title="delete" onclick="return window.confirm('are you sure want to remove this?')" class="btn btn-box-tool"><i class="fa fa-times"></i></a>
                                  </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <!-- Conversations are loaded here -->
                                <div class="direct-chat-messages">
                                    <!-- Message. Default to the left -->
                                    <?php if (!empty($n['notes'])) { ?>
                                        <?php foreach ($n['notes'] as $not) { ?>
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                 <a href="<?= base_url('Project/project_notes/'.$not->project_id); ?>">   <span class="direct-chat-name pull-left"><?= $not->note_description; ?></span>
                                                    <span class="direct-chat-timestamp pull-right"><?= $not->user_fname; ?> <?= $not->user_lname; ?></span>
                                                 </a>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <!-- /.direct-chat-img -->
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- /.direct-chat-msg -->
                                </div>
                                <!--/.direct-chat-messages-->
                                <!-- Contacts are loaded here -->
                                <div class="direct-chat-contacts">
                                    <?php if (!empty($n['tasks'])) { ?>
                                        <?php foreach ($n['tasks'] as $tas) { ?>
                                            <ul class="contacts-list">
                                                <li>
                                                    <!--<a href="#">-->
                                                        <div class="">
                                                         <a href="<?= base_url('Admin/TasksDetails/'.$tas->task_id); ?>">   <span class="contacts-list-name">
                                                                <?= $tas->task_title; ?>
                                                                <!--<small class="contacts-list-date pull-right">2/28/2015</small>-->
                                                            </span>
                                                             <span class="contacts-list-msg"><?= $tas->task_description; ?></span></a>
                                                        </div>
                                                        <!-- /. -->
                                                    <!--</a>-->
                                                </li>
                                                <!-- End Contact Item -->
                                            </ul>
                                            <!-- /.contatcts-list -->
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <!-- /.direct-chat-pane -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <form action="<?= base_url('Project/addNote'); ?>" method="post">
                                    <input type="hidden" name="project_id" value="<?= $n['project']->project_id ?>" />
                                    <div class="input-group">
                                        <input type="text" name="note" placeholder="Add Note ..." class="form-control">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-success btn-flat">Save</button>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <!-- /.box-footer-->
                        </div>
                    <?php } ?> 
                <?php } ?> 
            </div>
        </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="<?= base_url('assets/dist/js/jquery_ui.js'); ?>"></script>


<script>

  $(function() {
      var status = 0;
      var id = 0;
    $("#sortable1, #sortable2, #sortable3,#sortable4")
      .sortable({
        connectWith: ".list-body",
        stop:function(e,ui)
        {
            id = ui.item[0].childNodes[1].id; 
            $.ajax({
                type:'post',
                data:{'status':status,'id':id},
                url:'<?php echo base_url('Tasks/updateProjectStatus') ?>',
            });
        },
        receive:function(e,ui)
        {
            if(ui.item.parent().attr('id') == 'sortable1')
            {
                status = 0 ;
            }
            else if(ui.item.parent().attr('id') == 'sortable2')
            {
               status = 1 ;
            }
            else if(ui.item.parent().attr('id') == 'sortable3')
            {
                status = 2 ;
            }
            else
            {
              status = 3 ; 
            }
        }
      })
      .disableSelection();
  });


</script>
    
