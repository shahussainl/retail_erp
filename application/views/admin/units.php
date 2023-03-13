<?php
// echo"<pre>";
// print_r($products);
// foreach ($products as  $value) {
//     echo $value->prd_price;
//     # code...
// }
// exit();

defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .form-group{
        width:100%;
        margin-bottom: 15px !important;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/product_menu'); ?>
    <!--    <div class="col-md-12">-->
    <div class="clearfix"></div>
    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Unit Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($units)) { ?>
                                <?php
                                $count = 1;
                                foreach ($units as $u) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a data-id="<?= $count; ?>" class="scroll-modal-btn" data-direction="right"><?= $u->unit_name; ?></a>
                                            <div class="modal fade " id="<?= $count; ?>">
                                                <div class="modal-dialog scroll-modal">
                                                    <!-- Title -->
                                                    <h1 class="control-sidebar-heading">
                                                        <?= $u->unit_name; ?> 
                                                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                                    </h1>
                                                    <!-- Title -->
                                                    <form role="form" method="post" action="<?= base_url('Product/updateUnit'); ?>" enctype="multipart/form-data">
                                                        <div class="box box-control-sidebar">
                                                            <div class="box-body">
                                                                <input type="hidden" name="unit_id" value="<?= $u->unit_id; ?>" />
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group input-group">
                                                                            <label>Unit Name</label>
                                                                            <input type="text" name="unit_name" class="form-control" placeholder="" value="<?= $u->unit_name; ?>">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                        <a href="<?= base_url('Product/deleteUnit/' . $u->unit_id); ?>" class="btn btn-danger">DELETE</a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form> 
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                        </td>

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
    </section>
</div>

<script>
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
             scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,
            language: {search: "UNITS", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW UNIT</a>');

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
        ADD NEW UNIT
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form role="form" method="post" action="<?= base_url('Product/addUnit'); ?>" enctype="multipart/form-data">
        <div class="box box-control-sidebar">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group input-group">
                            <label>Unit Name</label>
                            <input type="text" name="unit_name" class="form-control" placeholder="" required>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>


