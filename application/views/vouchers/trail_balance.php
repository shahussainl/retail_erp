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
                                <th>S.No#</th>
                                <th>Head</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                              
                            $debit = 0;
                            $credit = 0;
                            if(!empty($data)) { ?>
                                <?php
                                foreach ($data as $key => $v) {  ?>
                                    <tr>
                                        <td><?= $key= $key + 1; ?></td>
                                        <td><?= $v['data']->coa_subtype_name; ?></td>
                                        <td>
                                            <span> <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                            <?php if($v['amount']->debit == ''){ echo 0; } else{ $debit = $debit + $v['amount']->debit; echo $v['amount']->debit; }  ?></td>
                                        <td>
                                            <span> <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                            <?php if($v['amount']->credit == ''){ echo 0; } else { $credit = $credit + $v['amount']->credit; echo $v['amount']->credit; } ?></td>

                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= $debit; ?></th>
                                <th><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= $credit; ?></th>
                            </tr>
                        </tfoot>
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

            language: {search: "Trail Balance", searchPlaceholder: "Filter and Search..."}

        });
        
//        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW PAYMENT</a>');
//                $('.scroll-modal-btn').click(function () {
//            $('.modal')
//                    .prop('class', 'modal fade') // revert to default
//                    .addClass($(this).data('direction'));
//            var modal_id = $(this).data('id');
//            $('#' + modal_id).modal('show');
//        });
    });</script>
