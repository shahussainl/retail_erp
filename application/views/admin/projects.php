<!--<body class="hold-transition skin-blue sidebar-mini">-->

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
          <h3 class="box-title">Total Projects Records </h3>
          <p class="pull-right"><a href="<?php echo base_url('Admin/AddNewProjects/'); ?>" class="btn btn-info">Add New</a> </p>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-condenced table-bordered" id="example1" width='100%';>
                <thead>
                  <tr>
                    <th>Serial#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Team Lead</th>
                    <th>Start Date</th>
                    <th>Image</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sno=1;
                    foreach($data as $value)
                    {
                  ?>
                    <tr>
                      <td><?= $sno;?></td>
                      <td><a href="<?= base_url('Admin/ProjectDetails/'.$value->project_id); ?>"><?= $value->project_name;                   ?></a></td>
                      <td><?= $value->project_email_add;              ?></td>
                      <td><?= $value->project_team_lead;              ?></td>
                      <td><?= $value->project_start_date;             ?></td>
                      <td><img src="<?= base_url('assets/images/projects/'.$value->project_image); ?>" style="width:70px; height:70px;">     </td>
                      <td><a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteProject/'.$value->project_id); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a>
                      <a href="<?= base_url('Admin/UpdateProjects/'.$value->project_id); ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye fa-lg"></i></a></td>
                      
                    </tr>
                  <?php
                    $sno++;
                    }
                  ?>
                  <?php?>
                
  
                </tbody>
                <tfoot>
                  <tr>
                    <th>Serial#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Owners</th>
                    <th>Start Date</th>
                    <th>Image</th>
                    <th>action</th>
                  </tr>
                </tfoot>
              </table>

            </div>
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Project Records
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  
  

