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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Sub Type</th>
                                 <th>Account</th>
                                 <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data)) { ?>
                                <?php
                                foreach ($data as $head) {
                                    ?>
                                    <tr>
                                        <td><?= $head->coa_code; ?></td>
                                        <td><?= $head->coa_name; ?></td>
                                        <td><?= $head->coa_subtype_name; ?></td>
                                        <td><?= $head->coa_type_name; ?></td>
                                        <td><?php if($head->coa_is_system == 1){echo '<i class="fa fa-lock"></i>';}else{echo '<i class="fa fa-unlock">';} ?></td>
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

            language: {search: "Chart of Accounts", searchPlaceholder: "Filter and Search..."}

        });
        
//        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">Add </a>');
//                $('.scroll-modal-btn').click(function () {
//            $('.modal')
//                    .prop('class', 'modal fade') // revert to default
//                    .addClass($(this).data('direction'));
//            var modal_id = $(this).data('id');
//            $('#' + modal_id).modal('show');
//        });
    });</script>
