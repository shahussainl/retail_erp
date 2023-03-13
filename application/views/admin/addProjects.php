
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
      <form action="<?php echo  base_url('Admin/AddNewProject/'); ?>" method="post" enctype="multipart/form-data">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">New Project Data Insertion form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <h5>Image</h5>
              <div class="input-group">
                  <img class="img-rounded" id="blah" src="" style="width:100px;">
                  <input type="file" id="user_img"  name="file" class="form-control" />
              </div>
              <br>
              <h5>Project Name</h5>
              <div class="input-group">
                <input type="text" class="form-control" name="project_name" placeholder="Project Name">
              </div>
              <br>
              <h5>Email Address</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" name="project_email_add" placeholder="Project Email">
              </div>
              <br>
               <h5>Project Start Date</h5>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control pull-right" name="project_start_date" id="datepicker">
              </div>
              <br>
              <h5>Project Team Lead</h5>
              <div class="input-group">
                <select class="form-control"  name="project_team_lead" style="width: 100%;" required>
                 <option>-Select-</option>

                  <?php
                    foreach($employee as $emp)
                    {
                  ?>
                  <option value="<?= $emp->user_fname.' '.$emp->user_lname; ?>"><?= $emp->user_fname.' '.$emp->user_lname; ?></option>
                  <?php
                    }
                  ?>
                 
                </select>
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
              </div>
              <br>
              <h5>Invite Project Employees</h5>
              <div class="input-group">
                <select class="form-control select2" multiple="multiple" name="project_invite_emp[]" data-placeholder="Select a State"
                        style="width: 100%;">
                  <?php
                    foreach($employee as $emp)
                    {
                  ?>
                  <option value="<?= $emp->user_fname.' '.$emp->user_lname; ?>"><?= $emp->user_fname.' '.$emp->user_lname; ?></option>
                  <?php
                    }
                  ?>
                 
                </select>
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
              </div>
              <br>
              <!-- /input-group -->
            </div>   
          </div>
          
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit"  class="btn btn-info">Save</button>
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