<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PURCHASE
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">

            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <form method="post" action="<?= base_url('Purchase/savePurcahseVoucher'); ?>">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="2">                 <div class="input-group" style="width:100%;">
                                                <span class="input-group-addon"><i class="fa fa-user"></i> <b>VENDOR / SUPPLIER</b></span>
                                                <input type="text" class="form-control" name="vendor_id" required value="<?= $user_no; ?>">

                                            </div></th>
                                        <th colspan="2">
                                            <div class="input-group" style="width:100%;">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i> <b>PURCHASE DATE</b></span>
                                                <input type="text" class="form-control" id="currentdatepicker" name="purchase_date" required>

                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i> <b>PURCHASE NO</b></span>
                                                <input type="text" class="form-control" name="voucher_no" value="<?= $voucher_no; ?>" readonly required>

                                            </div>
                                        </th>

                                    </tr>
                                    <tr>
                                        <th>CODE</th>
                                        <th>ITEM</th>
                                        <th>QUANTITY</th>
                                        <th>UNIT PRICE</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($x = 1; $x <= 5; $x++) { ?>
                                        <tr>
                                            <td><input type="text" name="code[]" class="form-control code" onblur="getProductDetail(this.value, 'prd_code', this);">
                                                <input type="hidden" name="prd_id[]" class="form-control pur_id"></td>
                                            <td><input type="text" name="item[]" class="form-control item" onblur="getProductDetail(this.value, 'prd_title', this);"></td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);">
                                                    <span class="input-group-addon unit"></span>
                                                    <input type="hidden" name="unit[]" class="unit_id" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control total" name="total[]" readonly>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="3" colspan="3">
                                            ADDITIONAL INFORMATION
                                            <textarea class="form-control" name="additional_info" ></textarea>
                                        </th>
                                        <th class="text-right">SUBTOTAL</th>
                                        <th>
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" name="sub_total" id="sub_total" value="0" required readonly="">
                                            </div>   
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-right">PAID AMOUNT</th>
                                        <th>
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="paid_amount" required name="paid_amount" value="0" onblur="getBalance();">
                                            </div>   
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-right">BALANCE</th>
                                        <th>
                                            <div class="input-group">
                                                <span class="input-group-addon">$</span>
                                                <input type="text" class="form-control" id="balance" name="balance" value="0" readonly> 
                                            </div>   
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-right">
                                            <button class="btn btn-success"><i class="fa fa-save"></i> SAVE PURCHASE</button>
                                            <a href="<?= base_url('Purchase/allVouchers'); ?>" class="btn btn-warning"><i class="fa fa-times"></i> DISCARD</a>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
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
                        row.find('.item').attr('disabled',true);
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
                            $('.table tbody').append('<tr><td><input type="text" name="code[]" class="form-control code" onblur="getProductDetail(this.value, ' + "'prd_code'" + ', this);"><input type="hidden" name="prd_id[]" class="form-control pur_id"></td><td><input type="text" name="item[]" class="form-control item" onblur="getProductDetail(this.value, ' + "'prd_title'" + ', this);"></td><td><div class="input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" /></div></td><td><div class="input-group"><span class="input-group-addon">$</span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);"></div></td><td><div class="input-group"><span class="input-group-addon">$</span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');
                        }
                    } else {
                        var row = $(obj).closest('tr');
                        row.find('.code').val('');
                        row.find('.pur_id').val('');
                        row.find('.item').val('');
                        row.find('.item').attr('disabled',false);
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