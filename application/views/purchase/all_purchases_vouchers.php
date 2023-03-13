<?php
// echo "<pre>";
// print_r($pur_vouchers);
// exit();


defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/purchase_menu'); ?>
    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="purchase-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Purchase no</th>
                                <th>Purchase Date</th>
                                <th>Vendor / Supplier</th>
                                <th>Date</th>
                                <th>Note</th>
                                <!--<th>is-ref?</th>-->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pur_vouchers)) { ?>
                                <?php
                                foreach ($pur_vouchers as $prd) {
                                    $pur_date = $prd->purchase_date;
                                    $pur_date2 = $prd->purchase_created_date;
                                    $is_ref = $prd->is_ref;
                                    $date = DateTime::createFromFormat('Y-m-d H:i:s', $pur_date);
                                    $purchase_date = $date->format("F d Y h:i:s a");
                                    $date2 = DateTime::createFromFormat('Y-m-d H:i:s', $pur_date2);
                                    $create_date = $date2->format("F d Y");
                                    if ($is_ref == 1) {
                                        $status = 'Yes';
                                    } else {
                                        $status = 'NO';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $prd->purchase_id; ?></td>
                                        <td><?= $purchase_date; ?></td>
                                        <td><?= $prd->purchase_vendor_id; ?></td>
                                        <td><?= $create_date; ?></td>
                                        <td><?= $prd->purchase_additional_note; ?></td>
                                        <!--<td><? $status; ?></td>-->
                                        <td class="pull-right">
                                            <a href="<?= base_url('Purchase/SinglePurchaseView/' . $prd->purchase_id); ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
<script>
    $(document).ready(function () {
        $('#purchase-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "<?php if ($this->uri->segment(2) == 'index' || $this->uri->segment(2) == '') { ?> UNPOSTED BILLS <?php } elseif ($this->uri->segment(2) == 'payable') { ?> PAYABLE <?php } elseif ($this->uri->segment(2) == 'referenceBills') { ?> REFERENCE BILLS <?php } elseif ($this->uri->segment(2) == 'paid') { ?> PAID BILLS <?php } elseif ($this->uri->segment(2) == 'canceled') { ?> CANCELED BILLS <?php } ?>", searchPlaceholder: "Filter and Search..."}
        });
        // $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW PURCHASE</a>');
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
                            // alert(cellText);
                            if (cellText == '') {
                                a = a + 1;
                            }

                        });
                        if (a == 0) {
                            $('.table tbody').append('<tr><td><input type="text" name="code[]" class="form-control code" onblur="getProductDetail(this.value, ' + "'prd_code'" + ', this);"><input type="hidden" name="prd_id[]" class="form-control pur_id"></td><td><input type="text" name="item[]" class="form-control item" onblur="getProductDetail(this.value, ' + "'prd_title'" + ', this);"></td><td><div class="input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" /></div></td><td><div class="input-group"><span class="input-group-addon"><i class="fa <?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php }else{ ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);"></div></td><td><div class="input-group"><span class="input-group-addon"><i class="fa <?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php }else{ ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');
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
