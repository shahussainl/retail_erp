  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php $this->load->view('include/single_project_menu'); ?>
   <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                         <table class="table table-condensed table-striped table-bordered" id="uploads-table">
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
<script>
    $(document).ready(function () {
        $('#uploads-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "UPLOADS", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">UPLOAD FILE</a>');

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
        ADD NEW FILE
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form action="<?= base_url('Admin/AddNewFile/'); ?>" enctype="multipart/form-data" method="post">
         <input type="hidden" name="project_id" value="<?= $this->uri->segment(3); ?>">
        <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Title / Short Description / Reference</label>
                          <input type="text" name="note_title" class="form-control" id="inputName" placeholder="" required>
                          
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload File</label>
                             <img class="img-rounded" id="blah" src="" style="width:100px;">
                          <input type="file" id="user_img"  name="file" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">UPLOAD FILE</button>
                        <input type="reset" value="RESET" class="btn btn-warning">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>