<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/accounts_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->

    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Source Title</th>
                                <th>Source Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)) { ?>
                                <?php
                                foreach ($data as $v) {
                                    ?>
                                    <tr>
                                        <td><?= $v->coa_name; ?></td>
                                        <td><?= $v->coa_subtype_name; ?></td>
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

            language: {search: "Payment Sources ", searchPlaceholder: "Filter and Search..."}

        });

        $("div.toolbar").html('<a data-id="new-exp-head" style="float:right;" class="btn btn-primary site-button scroll-modal-btn" data-direction="right">NEW HEAD</a>');
        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            
            $('#' + modal_id).modal('show');
        });
    });
</script>
<div class="modal fade " id="new-exp-head">
    <div class="modal-dialog scroll-modal">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            ADD NEW SOURCE
            <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
        </h1>
        <!-- Title -->
        <form role="form" method="post" action="<?= base_url('Accounts/addNewSource'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Source Title</label>
                                <input type="text" name="coa_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Source SubType</label>
                                <select class="form-control" name="coa_subtypeid" required>
                                    <option value="0"></option>
                                    <?php foreach ($assets as $as) { ?>
                                        <option value="<?= $as->coa_subtype_id; ?>">
                                            <?= $as->coa_subtype_name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Short Description</label>
                                <input type="text" name="coa_desc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="number" name="coa_code" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">ADD SOURCE</button>
                            <input type="reset" name="" value="RESET" class="btn btn-warning">

                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div><!-- /.modal-dialog -->
</div>

