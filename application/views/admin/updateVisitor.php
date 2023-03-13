<?php
// print_r($visitor);
// exit();
?>
<body class="hold-transition skin-blue sidebar-mini">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Visitor 
        <small>Buraq</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-circle-o"></i> Home</a></li>
        <li class="active">Visitor </li>
      </ol>
    </section>
   <!-- Main content -->
    <section class="content">
      <form action="<?php echo  base_url('Admin/update_visitorList/'.$this->uri->segment(3)); ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="visitor_id" value="<?= $visitor->visitor_id; ?>">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">New Visitor Data Insertion form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <h5>Visitor Name</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" value="<?= $visitor->visitor_name; ?>" name="visitor_name" placeholder=" Your Name" required>
              </div>
            </div>
            <div class="col-md-4">
              <h5>Contact</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control" value="<?= $visitor->visitor_contact; ?>" name="visitor_contact" placeholder="Contact Number" required>
              </div>
            </div>
          </div>
            <div class="row">
              <div class="col-md-6">
                <h5>Visit Purpose</h5>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                  <textarea class="form-control" name="visitor_purpose" required> <?= $visitor->visitor_purpose; ?></textarea>
                </div>
              </div>
            </div>   
          </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit"  class="btn btn-info">update Info</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
