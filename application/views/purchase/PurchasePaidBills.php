<?php
// echo "<pre>";
// print_r($PaidBills);
// exit();
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
<div class="content-wrapper">
    <?php $this->load->view('include/purchase_menu'); ?>
    <section class="content">
        <div class="">
            <div class="card-body">

                <div class="row">

                    <!--Name-->
                    <div class="col-md-2 pl-1">
                        <label>PURCHASE #</label>
                        <div class="form-group input-group" id="filter_col1" data-column="1">

                            <div class="input-group-addon"><i class="fa fa-table"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col1_filter" placeholder="">
                        </div>
                    </div>

                    <!--Job-->
                    <div class="col-md-2 pl-1">
                        <label>VENDOR / SUPPLIER</label>
                        <div class="form-group input-group" id="filter_col2" data-column="2">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col2_filter" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-2 pl-1">
                        <label>STATUS</label>
                        <div class="form-group input-group" id="filter_col9" data-column="9">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col9_filter" placeholder="">
                        </div>
                    </div>
                    <!--From-->
                    <div class="col-md-2 pl-1">
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
                    <table id="products-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill #</th>
                                <th>Vendor / Supplier</th>
                                <th>Date</th>
                                <th>BD</th>
                                <th>Stock</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($PaidBills)) { ?>
                                <?php
                                $countt = 1;
                                foreach ($PaidBills as $paidBill) {
                                    $pur_date = $paidBill['info']->purchase_date;
                                    $pur_date2 = $paidBill['info']->purchase_created_date;
                                    $vendorName = $paidBill['info']->user_fname;
                                    $billTotal = $paidBill['info']->purchase_bill_total;
                                    //$paidTotal     = $paidBill->purchase_paid_amount;
                                    $is_ref = $paidBill['info']->is_ref;
                                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $pur_date);
                                    $purchase_date = $date->format("m/d/Y");
                                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $pur_date2);
                                    $create_date = $date2->format("m/d/Y");
                                    // if ($is_ref == 1) {
                                    //     $status = 'Yes';
                                    // } else {
                                    //     $status = 'NO';
                                    // }
                                    ?>
                                    <tr class="<?php
                                    if ($paidBill['info']->is_stock == 1) {
                                        echo "tbl-green";
                                    } else if ($paidBill['info']->is_stock == 0) {
                                        echo "tbl-warm";
                                    }
                                    ?>">
                                        <td><?= $countt; ?></td>
                                        <td><?= $prefix ?> <?= $paidBill['info']->purchase_id; ?></td>
                                        <td><?= $vendorName; ?></td>
                                        <td><?= $purchase_date; ?></td>
                                        <td><?php
                                            if ($purchase_date != $create_date) {
                                                echo '<i class="fa fa-warning text-yellow"></i>';
                                            } else {
                                                echo '<i class="fa fa-check-circle text-green"></i>';
                                            }
                                            ?></td>
                                        <td>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn dropdown-toggle" style="background: transparent;" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="fa fa-list"></span></button>
                                                <ul class="dropdown-menu inv-details">
                                                    <table class="table table-condensed table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Prd</th>
                                                                <th>Qty</th>
                                                                <th>Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $count = 1;
                                                        $g_total = 0;
                                                        foreach ($paidBill['items'] as $bill_items) {
                                                            ?>

                                                            <tr>
                                                                <td><?= $count; ?></td>
                                                                <td><?= $bill_items->prd_title; ?></td>
                                                                <td><?= $bill_items->puritem_qty; ?></td>
                                                                <td><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    } echo number_format($bill_items->puritem_price, 2);
                                                                    ?></td>
                                                                <td><?php
                                                                    $s_total = $bill_items->puritem_price * $bill_items->puritem_qty;
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    } echo number_format($s_total, 2);
                                                                    $g_total = $g_total + $s_total;
                                                                    ?></td>
                                                            </tr>
                                                            <?php
                                                            $count++;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="4" class="text-right"><b>Grand Total</b></td>
                                                            <td><b><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    } echo number_format($g_total, 2);
                                                                    ?></b></td>
                                                        </tr>
                                                    </table>
                                                </ul>
                                            </div>
                                        </td>
                                        <td><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?>
                                            <?php echo number_format($billTotal, 2); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $t_payment = 0;
                                            foreach ($paidBill['payments'] as $sin_payment) {
                                                $t_payment = $t_payment + $sin_payment->purpayment_amount;
                                            }
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            echo number_format($t_payment, 2);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $g_total = $billTotal - $t_payment;
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            echo number_format($g_total, 2);
                                            ?>
                                        </td>
                                        <td><?php
                                            if ($paidBill['info']->is_stock == 1) {
                                                ?>
                                                <span class="badge bg-green">STOCKED</span>

                                            <?php } else if ($paidBill['info']->is_stock == 0) { ?>

                                                <span class="badge bg-yellow">NOT STOCKED YET</span>

                                            <?php } ?>

                                            </td>
                                        <!--                                       <?php
                                        if (!empty($currency_symbol->symbol)) {
                                            echo $currency_symbol->symbol;
                                        }
                                        ?></span>
                                        <?= $paidTotal; ?></td>-->
                                        <td class="text-right">
                                            <a href="<?= base_url('Purchase/SinglePurchaseView/' . $paidBill['info']->purchase_id); ?>" class="btn btn-sm btn-default btn-flat table-btn"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-sm btn-info btn-flat table-btn"  href="<?= base_url('Purchase/SinglePurchasePrint/' . $paidBill['info']->purchase_id); ?>"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $countt++;
                                }
                                ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6" class="text-right"><label>TOTAL</label></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
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
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Total over this page
                g_pageTotal = api
                        .column(6, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Update footer
                $(api.column(6).footer()).html(
                        '$' + g_pageTotal.toFixed(2)
                        );

                // Total over all pages
                p_total = api
                        .column(7)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Total over this page
                p_pageTotal = api
                        .column(7, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Update footer
                $(api.column(7).footer()).html(
                        '$' + p_pageTotal.toFixed(2)
                        );

                // Total over all pages
                b_total = api
                        .column(8)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Total over this page
                b_pageTotal = api
                        .column(8, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Update footer
                $(api.column(8).footer()).html(
                        '$' + b_pageTotal.toFixed(2)
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
    });
</script>

<script type="text/javascript">
    function getProductDetail(values, dbColName, obj) {

        if (values.trim() != '') {
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                    "value": values,
                    "dbColName": dbColName
                },
                url: '<?= base_url('Purchase/getProductDetail'); ?>',
                success: function (data)
                {
                    if (data != null) {
                        var row = $(obj).closest('tr');

                        row.find('.code').val(data.prd_code);
                        row.find('.pur_id').val(data.prd_id);
                        row.find('.item').val(data.prd_title);
                        row.find('.item').attr('disabled', true);
                        row.find('.quantity').val('1');
                        row.find('.unit').html(data.unit_name);
                        row.find('.unit_id').val(data.unit_id);
                        row.find('.price').val(data.prd_price);
                        row.find('.total').val(data.prd_price);

                        sumTotal();
                        getBalance();

                        var a = 0;
                        $('.table tbody tr').find('td:nth-child(2) > input').each(function () {
                            var cellText = $(this).val();
//                        alert(cellText);
                            if (cellText == '') {
                                a = a + 1;
                            }

                        });
                        if (a == 0) {
                            $('.table tbody').append('<tr><td><input type="text" name="code[]" class="form-control code" onblur="getProductDetail(this.value, ' + "'prd_code'" + ', this);"><input type="hidden" name="prd_id[]" class="form-control pur_id"></td><td><input type="text" name="item[]" class="form-control item" onblur="getProductDetail(this.value, ' + "'prd_title'" + ', this);"></td><td><div class="input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" /></div></td><td><div class="input-group"><span class="input-group-addon"><i class="fa <?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } else { ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);"></div></td><td><div class="input-group"><span class="input-group-addon"><i class="fa <?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } else { ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');
                        }
                    } else {
                        var row = $(obj).closest('tr');
                        row.find('.code').val('');
                        row.find('.pur_id').val('');
                        row.find('.item').val('');
                        row.find('.item').attr('disabled', false);
                        row.find('.quantity').val('');
                        row.find('.unit').html('');
                        row.find('.unit_id').val('');
                        row.find('.price').val('');
                        row.find('.total').val('');

                        sumTotal();
                        getBalance();
                    }

                },
                error: function ()
                {
                    alert('ajax call error:');
                }

            });
        }
    }
    function multiplyPrice(obj) {
        var $qty = $(obj).val();
        if ($qty.trim() != '') {
            var quantity = $(obj).parent().parent().parent().find('.quantity').val();
            var price = $(obj).parent().parent().parent().find('.price').val();
            var total = parseInt(quantity) * parseInt(price);
            $(obj).parent().parent().parent().find('.total').val(total);

            sumTotal();
            getBalance();

        }
    }
    function sumTotal() {
        var sub_total = 0;
        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = sub_total + parseInt($(this).val());
            }
        });
        $("#sub_total").val(sub_total);

    }
    function getBalance() {
        var sub_total = $('#sub_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        $('#balance').val(balance);
    }

</script>
