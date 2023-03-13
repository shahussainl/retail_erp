<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/product_menu'); ?>
    <!--    <div class="col-md-12">-->
    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="category-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($product_category)) {
                                ?>
                                <?php foreach ($product_category as $key => $pro_cat) { ?>
                                    <tr>
                                        <td>
                                            <a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right"><?= $pro_cat->prdc_name; ?></a>
                                            <div class="modal fade " id="<?= $key; ?>">
                                                <div class="modal-dialog scroll-modal">
                                                    <!-- Title -->
                                                    <h1 class="control-sidebar-heading">
                                                        <?= $pro_cat->prdc_name; ?>
                                                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                                    </h1>
                                                    <!-- Title -->
                                                    <form role="form" method="post" action="<?= base_url('Product/updateProductCategory'); ?>">
                                                        <input type="hidden" name="product_category_id" value="<?= $pro_cat->prdc_id; ?>" />
                                                        <div class="box box-control-sidebar">
                                                            <div class="box-body">
                                                                <!--<input type="hidden" name="product_id" value="<? $prd->prd_id; ?>" />-->
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group input-group">
                                                                            <label>Category Name</label>
                                                                            <input type="text" name="product_category" class="form-control" placeholder="Enter Category name..." value="<?= $pro_cat->prdc_name; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                        <a href="<?= base_url('Product/deleteCategory/' . $pro_cat->prdc_id); ?>" class="btn btn-danger">DELETE</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--</div>-->
</div>

<script>
    $(document).ready(function () {
        $('#category-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "CATEGORIES", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW CATEGORY</a>');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });
    });
</script>
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        ADD NEW CATEGORY
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form role="form" method="post" action="<?= base_url('Product/addProductCategory'); ?>" enctype="multipart/form-data">
        <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Category Title</label>
                            <input type="text" name="product_category" class="form-control" placeholder="" required>
                        </div>
                    </div>

                </div>

            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-flat">SAVE CATEGORY</button>
                        <input type="reset" value="RESET" class="btn btn-danger btn-flat" value="CLEAR">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>
