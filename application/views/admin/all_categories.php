<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/accommodation_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table  table-hover">
                        <thead>
                            <tr>
                                <th>CATEGORY NAME</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)) { ?>
                                <?php
                                foreach ($categories as $key => $cat) {
                                    ?>
                                    <tr>
                                        <td>
                                            <a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right"><?= $cat->category_name; ?></a>
                                            <div class="modal fade " id="<?= $key; ?>">
                                                <div class="modal-dialog scroll-modal">
                                                    <!-- Title -->
                                                    <h1 class="control-sidebar-heading">
                                                        <?= $cat->category_name; ?> 
                                                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                                    </h1>
                                                    <!-- Title -->
                                                    <form role="form" method="post" action="<?= base_url('Accommodation/updateCategory'); ?>" enctype="multipart/form-data">
                                                        <div class="box box-control-sidebar">
                                                            <div class="box-body">
                                                                <input type="hidden" name="category_id" value="<?= $cat->category_id; ?>" />
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group input-group">
                                                                            <label>Category Name</label>
                                                                            <input type="text" name="category_name" class="form-control" placeholder="" value="<?= $cat->category_name; ?>">
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="box-footer">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                        <a href="<?= base_url('Accommodation/trashCategory/' . $cat->category_id); ?>" class="btn btn-danger">DELETE</a>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form> 
                                                </div><!-- /.modal-dialog -->
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
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
              scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,

            language: {search: "CATEGORIES", searchPlaceholder: "Filter and Search..."}

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
        NEW CATEGORY
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form method="post" action="<?= base_url('Accommodation/addCategory'); ?>" enctype='multipart/form-data'>
        <div class="box box-control-sidebar">
            <div class="box-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" name="category_name" class="form-control" placeholder="Cateogy Name..." required />
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-submit">Save Information</button>
                </div>
            </div>
        </div>
    </form>
</aside>


