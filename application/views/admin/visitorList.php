<?php
// echo "<pre>";
// print_r($visitors);
// exit();
?>
<!--<body class="hold-transition skin-blue sidebar-mini">-->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="clearfix"></div>
   <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table id="visitor-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name=""></th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Purpose</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($visitors)) { ?>
                                <?php
                                $count = 1;
                                foreach ($visitors as $value) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a data-id="<?= $count; ?>" class="scroll-modal-btn" data-direction="right"><?= $value->visitor_name; ?></a>
                                            <div class="modal fade " id="<?= $count; ?>">
                                                <div class="modal-dialog scroll-modal">
                                                    <!-- Title -->
                                                    <h1 class="control-sidebar-heading">
                                                        <?= $value->visitor_name; ?>
                                                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                                    </h1>
                                                    <!-- Title -->
                                                    <form role="form" method="post" action="<?php echo  base_url('Admin/update_visitorList/'.$value->visitor_id); ?>">
                                                        <div class="box box-control-sidebar">
                                                            <div class="box-body">
                                                      <input type="hidden" name="visitor_id" value="<?= $value->visitor_id; ?>" />
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group input-group">
                                                                            <label>Visitor Name</label>
                                                                            <input type="text" name="visitor_name" class="form-control" placeholder="" value="<?= $value->visitor_name; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group input-group">
                                                                            <label>Contact</label>
                                                                            <input type="text" name="visitor_contact" class="form-control" placeholder="" value="<?= $value->visitor_contact; ?>">
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                                  <br>
                                                                  <div class="row">
                                                                    <div class="col-md-6">
                                                                      <h5>Visit Purpose</h5>
                                                                      <div class="input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                                                        <textarea class="form-control" rows="4" cols="30"  name="visitor_purpose"><?= $value->visitor_purpose; ?></textarea>
                                                                      </div>
                                                                    </div>
                                                                  </div> 
                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                        <a onclick="return window.confirm('Are you sure want to delete this?')" href="<?= base_url('Admin/DeleteVisitor/'.$value->visitor_id);?>" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form> 
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>
                                      <td><?php echo $value->visitor_contact; ?></td>
                                      <td><?php echo $value->visitor_purpose; ?></td>
                                        
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
      <!-- /.box -->
</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <script>
    $(document).ready(function () {
        $('#visitor-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "VISITORS", searchPlaceholder: "Filter and Search..."}
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW VISITOR</a>');

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
        ADD NEW VISITOR
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form action="<?php echo  base_url('Admin/AddVisitor/'); ?>" method="post" enctype="multipart/form-data">
        <div class="box box-control-sidebar">
            <div class="box-body">

            <div class="row">
              <div class="col-md-6">
                <h5>Visitor Name</h5>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control" name="visitor_name" placeholder=" Your Name">
                </div>
              </div>
              <div class="col-md-4">
                <h5>Contact</h5>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                  <input type="text" class="form-control" name="visitor_contact" placeholder="Contact Number">
                </div>
              </div>
            </div>
              <div class="row">
                <div class="col-md-6">
                  <h5>Visit Purpose</h5>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                    <textarea class="form-control" name="visitor_purpose"></textarea>
                  </div>
                </div>
              </div>
         </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">SAVE VISITOR</button>
                        <input type="reset" value="RESET" class="btn btn-warning">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>

