<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/accounts_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
    <section class="content">
        <div class="">
            
            
            <div class="card-body">

                    <div class="row">

                        <!--Name-->
                        <div class="col-md-2 pl-1">
                            <label>VOUCHER #</label>
                            <div class="form-group input-group" id="filter_col0" data-column="0">

                                <div class="input-group-addon"><i class="fa fa-table"></i></div>
                                <input type="text" name="Name" class="form-control column_filter" id="col0_filter" placeholder="">
                            </div>
                        </div>
                          <div class="col-md-3 pl-1">
                            <label>HEAD</label>
                            <div class="form-group input-group" id="filter_col4" data-column="4">

                                <div class="input-group-addon"><i class="fa fa-table"></i></div>
                                <input type="text" name="Name" class="form-control column_filter" id="col4_filter" placeholder="">
                            </div>
                        </div>

                        <!--From-->
                        <div class="col-md-3 pl-1">
                            <label>FETCH DAY</label>
                            <div class="form-group input-group" id="filter_col3" data-column="3">

                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                <input type="text" name="From" class="form-control column_filter currentdatepicker" id="col3_filter" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>DATE RANGE</label>
                            <div class="form-group input-group input-daterange">
                                <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>
                                <input type="text" id="min-date" class="form-control date-range-filter datepicker"  placeholder="">

                                <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>

                                <input type="text" id="max-date" class="form-control date-range-filter datepicker"  placeholder="">

                            </div>
                        </div>
                    </div>

                </div>

            <!-- /.box-header -->
            <div class="row">
                <div class="">
                    <table id="products-table" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Voucher no#</th>
                                <th>Voucher Type</th>
                                <th>Particulars</th>
                                <th>Posted Date</th>
                                <th>Account Head</th>
                                <th>Debit</th>
                                <th>Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $credit = 0;
                             $debit = 0;
                            if (!empty($voucher_data)) { ?>
                                <?php
                                foreach ($voucher_data as $v) {
                                    $date2 = DateTime::createFromFormat('Y-m-d', $v->general_journal_date);
                                    $create_date = $date2->format("m/d/Y");
                                    
                                    $url = '';
                                    
                                    if($v->general_journal_source == 'purchase POS')
                                    {
                                      $url = 'Purchase/SinglePurchaseView/';  
                                    }
                                    else if($v->general_journal_source == 'POS-Terminal')
                                    {
                                       $url = 'PointOfSale/SingleView/'; 
                                    }
                                    else if($v->general_journal_source == 'PAYMENT')
                                    {
                                       $url = 'Vouchers/updateVoucher/'; 
                                    }
                                    else if($v->general_journal_source == 'SALE')
                                    {
                                      $url = 'Sales/singleSaleVoucher/';   
                                    }
                                    ?>
                                    <tr>
                                        <td><a href="<?= base_url($url.$v->general_journal_source_id) ?>"><?= $prefix ?> <?= $v->general_journal_source_id; ?></a></td>
                                        <td><?= $v->general_journal_source; ?></td>
                                        <td><?= $v->general_journal_particulars; ?></td>
                                        <td><?= $create_date; ?></td>
                                        <td><?= $v->coa_name; ?></td>
                                        <td>
                                           <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?>
                                            <?= number_format($v->general_journal_debit,2); ?></td>
                                        <td>
                                           <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?>
                                            <?= number_format($v->general_journal_credit,2); ?></td>

                                    </tr>
                                <?php
                                
                                $credit = $credit + $v->general_journal_credit;
                                $debit = $debit + $v->general_journal_debit;
                                           } ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                
                                <td colspan="6" class="text-right"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= $debit ?></td>
                                <td><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= $credit ?></td>
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
        function filterColumn(i) {
        $('#products-table').DataTable().column(i).search(
                $('#col' + i + '_filter').val()
                ).draw();
        
    }

    $(document).ready(function () {
        $('.input-daterange input').each(function () {
            $(this).datepicker('clearDates');
            
        });


        $('input.global_filter').on('change', function () {
            filterGlobal();
        });

        $('input.column_filter').on('change', function () {
            filterColumn($(this).parents('div').attr('data-column'));
        });
     
      var table = $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
              scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                   // Total over all pages
                g_total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                
                      g_pageTotal = api
                        .column(5, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                // Update footer
                $(api.column(5).footer()).html(
                        '$' + g_pageTotal.toFixed(2)
                        );

                // Total over all pages
                p_total = api
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Total over this page
                p_pageTotal = api
                        .column(6, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Update footer
                $(api.column(6).footer()).html(
                        '$' + p_pageTotal.toFixed(2)
                        );

            }

        });

        // Extend dataTables search
        $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min-date').val();
                    var max = $('#max-date').val();
                    var createdAt = data[3] || 0; // Our date column in the table

                    if (
                            (min == "" || max == "") ||
                            (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
                            ) {
                        return true;
                    }
                    
                    return false;
                    
                    
                }
        );

// Re-draw the table when the a date range filter changes
        $('.date-range-filter').change(function () {
            table.draw();
        });
        
//        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW PAYMENT</a>');
//                $('.scroll-modal-btn').click(function () {
//            $('.modal')
//                    .prop('class', 'modal fade') // revert to default
//                    .addClass($(this).data('direction'));
//            var modal_id = $(this).data('id');
//            $('#' + modal_id).modal('show');
//        });
    });
});
</script>
