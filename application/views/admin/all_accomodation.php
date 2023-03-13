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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($accommodation)) { ?>
                                <?php
                                foreach ($accommodation as $key => $ac) {
                                    ?>
                                    <tr>
                                        <td><a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right"><?= $ac->title; ?></a></td>
                                <div class="modal fade " id="<?= $key; ?>">
                                    <div class="modal-dialog scroll-modal">
                                        <!-- Title -->
                                        <h1 class="control-sidebar-heading">
                                            <?= $ac->title; ?> (<?= $ac->category_name; ?>)
                                            <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                        </h1>
                                        <!-- Title -->
                                        <form role="form" method="post" action="<?= base_url('Accommodation/updateAccommodation'); ?>" >
                                            <div class="box box-control-sidebar">
                                                <div class="box-body">
                                                    <input type="hidden" name="accommodation_id" value="<?= $ac->accommodation_id; ?>" />
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" name="acc_title" class="form-control" placeholder="Title..." required value="<?= $ac->title; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Size</label>
                                                            <input type="text" name="acc_size" class="form-control" placeholder="Number Of Guest..." required value="<?= $ac->accommodation_size; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="text" name="price" class="form-control" placeholder="Price" required value="<?= $ac->acc_price; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Accommodation Type</label>
                                                            <select name="acc_category" class="form-control" required>
                                                                <option value="">Select Category</option>
                                                                <?php
                                                                if (!empty($categories)) {
                                                                    foreach ($categories as $cat) {
                                                                        ?>
                                                                        <option <?php if ($ac->category_id == $cat->category_id) { ?> selected <?php } ?> value="<?= $cat->category_id; ?>"><?= $cat->category_name; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="box-footer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary pull-left">UPDATE</button>
                                                            <a href="<?= base_url('Accommodation/trashAccommodation/' . $ac->accommodation_id); ?>" class="btn btn-danger pull-right">DELETE</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form> 
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <td><?= $ac->category_name; ?></td>
                                <td><?= $ac->accommodation_size; ?></td>
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
            "paging": false,

            language: {search: "ACCOMMODATIONS", searchPlaceholder: "Filter and Search..."}

        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW ACCOMMODATION</a>');
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
        NEW ACCOMMODATION
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form method="post" action="<?= base_url('Accommodation/addAccommodation'); ?>" enctype='multipart/form-data'>
        <div class="box box-control-sidebar">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="acc_title" class="form-control" placeholder="Title..." required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="acc_size" class="form-control" placeholder="Number Of Guest..." required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="price" class="form-control" placeholder="Price per Day..." required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="acc_category" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php
                            if (!empty($categories)) {
                                foreach ($categories as $cat) {
                                    ?>
                                    <option value="<?= $cat->category_id; ?>"><?= $cat->category_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
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


