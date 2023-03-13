<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
<div class="content-wrapper">
    <?php // $this->load->view('include/consumption_menu'); ?>
    <section class="content">
        <div class="">
            <div class="card-body">
            </div>
            <!-- /.box-header -->
            <div class="row">
                <div class="">
                    <!-- Title -->
                    <form method="post"  action="<?= base_url('Consumption/addConsumptionData'); ?>">
                        <input type="hidden" name="type" id="type" value="" />
                        <div class="modal modal-default fade" id="modal-danger" style="z-index:10000;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Important! Once it is Posted then you will not  be able to cancel it</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="col-md-12">
                                                <label>Posting Date</label>
                                                <input type="text"  name="posting_date" class="form-control currentdatepicker" />
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="col-md-12">
                                                <label>Amount Receiving</label>
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <?php if (!empty($currency_symbol)) {
                                                            echo $currency_symbol->symbol;
                                                        } ?>
                                                    </div>
                                                    <input type="number" name="receive_amt" id="receive_amt" value="0.00"  class="form-control" min="0" max="0" step="any" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="col-md-12">
                                                <label>Account</label>
                                                <select name="account_head" class="form-control">
                                                    <?php if (!empty($assets)) { ?>
                                                        <?php foreach ($assets as $a) { ?>
                                                            <option value="<?= $a->coa_id; ?>"><?= $a->coa_name; ?></option>
    <?php } ?>
<?php } ?>
                                                </select>
                                            </div>
                                            <div class="clearfix">&nbsp;</div>
                                            <div class="col-md-12">
                                                <label>Particulars</label>
                                                <input type="text" name="particulars" class="form-control" placeholder="Account Number,Check Number,Transaction ID etc" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn pull-left btn-flat btn-danger" data-dismiss="modal">CLOSE POPUP</button>

                                        <button class="btn btn-flat btn-success"> POST INVOICE</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>





                        <div class="box box-control-sidebar">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table" >

                                            <tr>
                                                <th>                 
                                                    <div class="form-group input-group" style="width:100%;">
                                                        <span class="input-group-addon"><i class="fa fa-leaf"></i> <b>SELECT END PRODUCT</b></span>
                                                        <select class="form-control" onchange="getProductPrice(this.value);" name="manufactor_product" required="">
                                                            <option value="">Select Product</option>
                                                            <?php foreach ($products as $product): ?>
                                                                <option value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option>
<?php endforeach; ?>
                                                        </select>

                                                    </div></th>
                                            </tr>
                                        </table>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <table id="new_sale" class="table table-condensed" >
                                            <thead>
                                                <tr>

                                                    <th>ITEM</th>
                                                    <th>CODE</th>
                                                    <th>QUANTITY</th>
                                                    <th>UNIT PRICE</th>
                                                    <th>TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php for ($x = 1; $x <= 3; $x++) { ?>

                                                    <tr>
                                                        <td>
                                                            <div class="form-group ">
                                                                <select class="form-control select2" name="prd_id[]" onchange="getProductDetail(this.value, 'prd_id', this);" style="width: 100%;">

                                                                    <option value="">Select Product</option>
                                                                    <?php foreach ($get_raw_prd as $product): ?>
                                                                        <option value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option>
    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <!--                                            <div class="form-group">
                                                                                                            <input type="text"  class="form-control item" >
                                                                                                        </div>-->
                                                        </td>
                                                        <td>
                                                            <input type="text" readonly=""  class=" form-control code" />

                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);">
                                                                <span class="input-group-addon unit"></span>
                                                                <input type="hidden" name="unit[]" class="unit_id" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    }
                                                                    ?></span>
                                                                <input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    }
                                                                    ?></span>
                                                                <input type="text" class="form-control total" name="total[]" readonly>
    <?php foreach ($taxes as $key => $tax) { ?>
                                                                    <span class="input-group-addon tax-label add-tax-<?= $key ?> hide" onclick="excludeTax(this, '<?= $key ?>')">
                                                                        <label class="label label-primary"><?= $tax->tax_title[0] ?></label>
                                                                        <input type="hidden" class="tax-<?= $key ?>">
                                                                        <input type="hidden" class="taxes">
                                                                        <input type="hidden" class="tax<?= $key ?>" name="item[<?= $x ?>][tax][<?= $key ?>]">
                                                                        <input type="hidden" class="tax-title-<?= $key ?>" name="item[<?= $x ?>][taxTitle][<?= $key ?>]" >
                                                                    </span>
    <?php } ?>
                                                                <span class="input-group-addon add-discount hide" onclick="excludeDiscount(this)">
                                                                    <label class="label label-danger">D</label>
                                                                    <input type="hidden" class="discount-value">
                                                                    <input type="hidden" class="discountValue" name="item[<?= $x ?>][discountValue]">
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
<?php } ?>
                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <td colspan="5">
                                                        ADDITIONAL INFORMATION
                                                        <textarea class="form-control" name="additional_info"></textarea>
                                                    </td>

                                                </tr>
                                            </tfoot>
                                        </table>
                                        <button type='submit' class="btn btn-success btn-flat"><i class="fa fa-save"></i> SAVE PRODUCT CONSUMPTION</button>
                                    </div>
                                    <div class="col-md-3">
                                        <label>PRODUCT PRICE</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><?php
                                                if (!empty($currency_symbol->symbol)) {
                                                    echo $currency_symbol->symbol;
                                                }
                                                ?></span>
                                            <input type="text" id="main_product_price" class="form-control" name="main_product_price" readonly="" value="0.00">
                                        </div>
                                        <label>MANUFACTURING COST</label>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><?php
                                                if (!empty($currency_symbol->symbol)) {
                                                    echo $currency_symbol->symbol;
                                                }
                                                ?></span>
                                            <input type="text" class="form-control" name="sub_total" id="sub_total" value="0.00" required readonly>
                                        </div>
                                        <label>PROFIT MARGIN</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><?php
                                                if (!empty($currency_symbol->symbol)) {
                                                    echo $currency_symbol->symbol;
                                                }
                                                ?></span>
                                            <input type="text" class="form-control" name=""  value="0.00" required readonly id="profit_margin">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>


</div>





<script type="text/javascript">
    function getMarginProfit() {
        var sub_total = $('#sub_total').val();
        var main_product_price = $('#main_product_price').val();

        var profit = parseFloat(main_product_price) - parseFloat(sub_total);

        $('#profit_margin').val(profit);
    }

    function getProductPrice(values) {
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                "value": values,
                "dbColName": 'prd_id'
            },
            url: '<?= base_url('Sales/getProductDetail'); ?>',
            success: function (data)
            {
                var count = 1;
                $('.produtSalesOrderRow').each(function () {
                    count++;
                });

                if (data != null) {
                    $('#main_product_price').val(parseFloat(data.prd_price).toFixed(2));


                    sumTotal();
                    getBalance();
                    getMarginProfit();

                } else {
                    $('#main_product_price').val('0.00');

                    sumTotal();
                    getBalance();
                    getMarginProfit();

                }
                $('.discount-price').trigger('keyup');

            },
            error: function ()
            {
                alert('ajax call error:');
            }

        });
    }
    function getProductDetail(values, dbColName, obj) {

        //if (values.trim() != '') {
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                "value": values,
                "dbColName": dbColName
            },
            url: '<?= base_url('Sales/getProductDetail'); ?>',
            success: function (data)
            {
                var count = 1;
                $('.produtSalesOrderRow').each(function () {
                    count++;
                });

                if (data != null) {
                    var row = $(obj).closest('tr');

                    row.find('.code').val(data.prd_code);
                    //row.find('.pur_id').val(data.prd_id);
                    //row.find('.item').val(data.prd_title);
                    //row.find('.item').attr('disabled', true);
                    row.find('.quantity').val('1');
                    row.find('.unit').html(data.unit_name);
                    row.find('.unit_id').val(data.unit_id);
                    row.find('.price').val(parseFloat(data.prd_price).toFixed(2));
                    row.find('.total').val(parseFloat(data.prd_price).toFixed(2));

                    sumTotal();
                    getBalance();

                    var a = 0;

                    $('#new_sale >tbody >  tr').find('td:nth-child(2) input').each(function () {

                        var cellText = $(this).val();
//                        alert(cellText);
                        if (cellText == '') {
                            a = a + 1;
                        }

                    });
                    if (a == 0) {
                        $('#new_sale > tbody ').append('<tr class="produtSalesOrderRow"><td><div class="form-group" ><select class="form-control select2" name="prd_id[]" onchange="getProductDetail(this.value, ' + "'prd_id'" + ', this);"><option value="">Select Product</option><?php foreach ($products as $product): ?><option value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option><?php endforeach; ?></select></div></td><td><input type="text" readonly="" class=" form-control code" /></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" /></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } ?></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);"></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } ?></span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');
                        $('.select2').each(function () {
                            $(this).select2();
                        });
                    }

                    getMarginProfit();
                } else {
                    var row = $(obj).closest('tr');
                    row.find('.code').val('');
                    //row.find('.pur_id').val('');
                    //row.find('.item').val('');
                    //row.find('.item').attr('disabled', false);
                    row.find('.quantity').val('1');
                    row.find('.unit').html('');
                    row.find('.unit_id').val('');
                    row.find('.price').val('0.00');
                    row.find('.total').val('0.00');

                    sumTotal();
                    getBalance();
                    getMarginProfit();

                }
                $('.discount-price').trigger('keyup');

            },
            error: function ()
            {
                alert('ajax call error:');
            }

        });
        //}
    }

    function getTax(obj) {

        var sub_total = 0;
        var tax_total = 0;
        var tax = $(obj).val();
        var taxArray = tax.split("-");
        var taxValue = taxArray[0];
        var taxType = taxArray[1];
        var taxString = taxArray[2];
        var taxTitle = taxArray[3];


        if ($(obj).is(':checked')) {


            $('.code').each(function () {

                if ($(this).val() != '') {

                    var row = $(this).closest('tr');
                    row.find('.tax-' + taxString).val(tax);
                    $('#addonTax' + taxString).text(taxValue + ' ' + taxType);
                    $('#taxTitle' + taxString).val(taxTitle);
                    $('#taxType' + taxString).val(taxType);
                    $('#taxOn' + taxString).val(taxValue);

                    var taxT = (taxType == 'FLAT') ? parseFloat(taxValue) : (parseFloat($('#discounted_price').val()) * taxValue / 100);

                    tax_total = (taxT) ? taxT : 0.00;


                }

            });
            tax_total = parseFloat(tax_total);
            tax_total = tax_total.toFixed(2);
            $('#tax_' + taxString).val(tax_total);
            sumAllTotal();

        } else {


            $('.code').each(function () {

                if ($(this).val() != '') {

                    var row = $(this).closest('tr');
                    row.find('.tax-' + taxString.toLowerCase()).val("");

                }

            });

            $('#tax_' + taxString.toLowerCase()).val("0.00");
            $('#addonTax' + taxString).text("");
            $('#taxTitle' + taxString).val("");
            $('#taxType' + taxString).val("");
            $('#taxOn' + taxString).val("");
            sumAllTotal();

        }

    }


    function getDiscount(obj) {

        var sub_total = 0;
        var discount_total = 0;
        var discountType = $(obj).val();
        var discount = parFloat($('#discountPrice').val());
        var sub_total = parFloat($('#sub_total').val());



        if ($(obj).is(':checked')) {

            if (discount == "") {
                $(obj).prop('checked', false);
                alert('Please enter discount first.');
            } else {

                $('.code').each(function () {
                    if ($(this).val() != '') {
                        var row = $(this).closest('tr');
                        row.find('.discountValue').val(parFloat(discountPrice).toFixed(2));

                        var discountPrice = (discountType == 'flat') ? parFloat(discount) : (parFloat(sub_total) * parFloat(discount) / 100);
                        discount_total = (discountPrice) ? discountPrice : 0;

                        $('#discount').val(parFloat(discount_total).toFixed(2));
                        $('#discountType').val(discountType);
                        $('#discountOff').val(parFloat(discount).toFixed(2));
                    }
                });


            }


            sumDiscountTotal();

        } else {

            $('.code').each(function () {
                if ($(this).val() != '') {
                    var row = $(this).closest('tr');
                    row.find('.discountValue').val("");
                }
            });

            discount_total = 0;
            $('#discount').val(parseFloat(discount_total).toFixed(2));
            $('#discountType').val("");
            $('#discountOff').val("");
            sumDiscountTotal();
        }


    }

    function resetDiscount(obj) {
        var row = $(obj).closest('div');
        row.find('.discount-price').prop('checked', false);

        $('.code').each(function () {
            if ($(this).val() != '') {
                var row = $(this).closest('tr');
                row.find('.discountValue').val("");
            }
        });

        discount_total = 0;
        $('#discount').val(parseFloat(discount_total).toFixed(2));
        $('#discounted_price').val(parseFloat($('#sub_total').val()).toFixed(2));
        sumAllTotal();
    }

    function excludeTax(obj, taxString) {

        $(obj).addClass('hide');

        if ($('body').find('.add-tax-' + taxString.toLowerCase()).not(".hide").length < 1) {

            $('.tax-checkbox-' + taxString).prop('checked', false);
            $('#addonTax' + taxString.toUpperCase()).text("");

        }

        var tax_charges = $(obj).find('.tax' + taxString).val();
        var row = $(obj).closest('tr');

        row.find('.tax' + taxString).val("");

        if ($('#tax_' + taxString.toLowerCase()).val() != 0) {
            var tax_total = $('#tax_' + taxString.toLowerCase()).val() - tax_charges;
        } else {
            var tax_total = 0;
        }

        $('#tax_' + taxString.toLowerCase()).val(parseFloat(tax_total).toFixed(2));

        sumAllTotal();

    }


    function multiplyPrice(obj) {
        
        var $qty = $(obj).val();
        if ($qty.trim() != '') {
            var quantity = $(obj).parent().parent().parent().find('.quantity').val();
            var price = $(obj).parent().parent().parent().find('.price').val();
            var total = parseFloat(quantity) * parseFloat(parseFloat(price).toFixed(2));
            $(obj).parent().parent().parent().find('.total').val(parseFloat(total).toFixed(2));
            $(obj).parent().parent().parent().find('.price').val(parseFloat(price).toFixed(2));

            sumTotal();
            getBalance();

            $(obj).closest('tr').find('.add-tax-g').addClass('hide');
            $(obj).closest('tr').find('.add-tax-s').addClass('hide');

        }

        $('.discount-price').trigger('keyup');
getMarginProfit();
    }

    function sumDiscountTotal() {

        var sub_total = 0;
        var bill_total = 0;
        var grand_tax_total = 0;
        var discounted_price = parseFloat($('#sub_total').val());
        if ($('#discount').val() != 0) {
            discounted_price = parseFloat(discounted_price) - parseFloat($('#discount').val());
        } else {
            discounted_price = parseFloat($('#sub_total').val());
        }

        $("#discounted_price").val(parseFloat(discounted_price).toFixed(2));

        bill_total = parseFloat(bill_total) + parseFloat(discounted_price);

        if ($('#tax_0').length && $('#tax_0').val() != 0) {

            var tax0 = parseFloat($('#taxOn0').val());
            var taxType0 = $('#taxType0').val();

            if (taxType0 == 'FLAT') {
                var tax_0 = parseFloat(tax0);
            } else {
                var tax_0 = (parseFloat($('#discounted_price').val()) * tax0 / 100);
            }

            $('#tax_0').val(parseFloat(tax_0).toFixed(2));

        } else {
            var tax_0 = '0.00';
            $('#tax_0').val(tax_0);
        }

        if ($('#tax_1').length && $('#tax_1').val() != 0) {

            var tax1 = parseFloat($('#taxOn1').val());
            var taxType1 = $('#taxType1').val();

            if (taxType1 == 'FLAT') {
                var tax_1 = parseFloat(tax1);
            } else {
                var tax_1 = (parseFloat($('#discounted_price').val()) * tax1 / 100);
            }

            $('#tax_1').val(parseFloat(tax_1).toFixed(2));

        } else {
            var tax_1 = '0.00';
            $('#tax_1').val(tax_1);
        }

        if ($('#tax_2').length && $('#tax_2').val() != 0) {
            var tax2 = parseFloat($('#taxOn2').val());
            var taxType2 = $('#taxType2').val();

            if (taxType2 == 'FLAT') {
                var tax_2 = parseFloat(tax2);
            } else {
                var tax_2 = (parseFloat($('#discounted_price').val()) * tax2 / 100);
            }

            $('#tax_2').val(parseFloat(tax_2).toFixed(2));

        } else {
            var tax_2 = '0.00';
            $('#tax_2').val(tax_2);
        }

        if ($('#tax_3').length && $('#tax_3').val() != 0) {
            var tax3 = parseFloat($('#taxOn3').val());
            var taxType3 = $('#taxType3').val();

            if (taxType3 == 'FLAT') {
                var tax_3 = tax3;
            } else {
                var tax_3 = (parseFloat($('#discounted_price').val()) * tax3 / 100);
            }
            $('#tax_3').val(tax_3);
        } else {
            var tax_3 = 0
            $('#tax_3').val(tax_3);
        }

        if ($('#tax_4').length && $('#tax_4').val() != 0) {
            var tax4 = parseFloat($('#taxOn4').val());
            var taxType4 = $('#taxType4').val();

            if (taxType4 == 'FLAT') {
                var tax_4 = tax4;
            } else {
                var tax_4 = (parseFloat($('#discounted_price').val()) * tax4 / 100);
            }

            $('#tax_4').val(tax_4);

        } else {
            var tax_4 = 0
            $('#tax_4').val(tax_4);
        }

        if ($('#tax_5').length && $('#tax_5').val() != 0) {
            var tax5 = parseFloat($('#taxOn5').val());
            var taxType4 = $('#taxType5').val();

            if (taxType5 == 'FLAT') {
                var tax_5 = tax5;
            } else {
                var tax_5 = (parseFloat($('#discounted_price').val()) * tax5 / 100);
            }

            $('#tax_5').val(tax_4);

        } else {
            var tax_5 = '0.00';
            $('#tax_5').val(tax_5);
        }

        grand_tax_total = tax_0 + tax_1 + tax_2 + tax_3 + tax_4 + tax_5;
        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);
        ;

        $("#bill_total").val(parseFloat(bill_total).toFixed(2));
        $("#balance").val(parseFloat(bill_total).toFixed(2));
        sumAllTotal();

    }

    function sumAllTotal() {
        var sub_total = 0;
        var bill_total = 0;
        var discounted_price = parseFloat($('#discounted_price').val());

        // console.log(discounted_price);

        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = parseFloat(sub_total) + parseFloat($(this).val());

            }
        });

        bill_total = bill_total + parseFloat(discounted_price);


        if ($('#tax_0').length) {
            var value_1 = parseFloat($('#tax_0').val());
        } else {
            var value_1 = 0
        }

        if ($('#tax_1').length) {
            var value_2 = parseFloat($('#tax_1').val());
        } else {
            var value_2 = 0
        }

        if ($('#tax_2').length) {
            var value_3 = parseFloat($('#tax_2').val());
        } else {
            var value_3 = 0
        }

        if ($('#tax_3').length) {
            var value_4 = parseFloat($('#tax_3').val());
        } else {
            var value_4 = 0
        }

        if ($('#tax_4').length) {
            var value_5 = parseFloat($('#tax_4').val());
        } else {
            var value_5 = 0
        }

        if ($('#tax_5').length) {
            var value_6 = parseFloat($('#tax_5').val());
        } else {
            var value_6 = 0
        }

        var grand_tax_total = value_1 + value_2 + value_3 + value_4 + value_5 + value_6;

        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);


        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(bill_total).toFixed(2));
        $("#balance").val(parseFloat(bill_total).toFixed(2));

    }
    function sumTotal() {
        var sub_total = 0;
        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = parseFloat(sub_total) + parseFloat($(this).val());
            }
        });
        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(sub_total).toFixed(2));
        $("#discounted_price").val(parseFloat(sub_total).toFixed(2));

    }
    function getBalance() {
        var sub_total = $('#sub_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
    }

    function getAllBalance() {
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
    }

    $('input.discount-price').on('change', function () {
        $('input.discount-price').not(this).prop('checked', false);
    });

    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });

    function createQuotation(obj) {
        var saleDate = $('#currentdatepicker').val();
        if (saleDate.trim() != '') {
            $('#save_form').attr('action', '<?= base_url('Sales/saveSalesVoucher') ?>');
            $('#type').val('1');
            $('#save_form').submit();
        } else {
            alert('Kindly Enter Sales Date!');
        }
    }
    function createInvoice(obj) {

        if (window.confirm('Are you sure you want to save invoice?') == true) {
            var saleDate = $('#currentdatepicker').val();
            if (saleDate.trim() != '') {
                $('#save_form').attr('action', '<?= base_url('Sales/saveSalesVoucher') ?>');
                $('#type').val('2');
                $('#save_form').submit();
            } else {
                alert('Kindly Enter Sales Date!');
            }
        }
    }
    function createPostInvoice(obj) {
        $('#modal-danger').modal('show');
        var total = $('#bill_total').val();
        $('#receive_amt').attr('max', total);
        $('#type').val('3');
        $('#save_form').attr('action', '<?= base_url('Sales/saveSalesVoucher') ?>');
//            $('#save_form').submit();
    }

    $(document).on('blur', '#receive_amt', function () {
        $('#receive_amt').val(parseFloat($(this).val()).toFixed(2));
    });

    $(document).on('keyup', '.discount-price', function () {
        var value = parseFloat($(this).val());
        var sub_total = parseFloat($('#sub_total').val());
//    alert(sub_total);
        if (!isNaN(value))
        {
            var amount = 0;
            var type = '';
            $('.discount_type').each(function () {
                if ($(this).is(':checked') == true)
                {
                    if ($(this).val() == '%')
                    {
                        type = '%';
                        amount = (sub_total / 100) * value;
                    } else if ($(this).val() == 'FLAT')
                    {
                        type = 'FLAT';
                        amount = value;
                    }
                }
            });
            var dicounted_amount = sub_total - amount;
            $('#discounted_price').val(parseFloat(dicounted_amount).toFixed(2));
            $('#discount').val(parseFloat(amount).toFixed(2));
            $('#discountType').val(type);
            $('#discountOff').val(parseFloat(amount).toFixed(2));

        } else
        {
            $('#discounted_price').val(parseFloat(sub_total).toFixed(2));
            $('#discount').val('0.00');
            $('#discountType').val('');
            $('#discountOff').val('0.00');
        }

        sumDiscountTotal();

    });





    $(document).on('click', '.discount_type', function () {
        var value = parseFloat($('.discount-price').val());
        var sub_total = parseFloat($('#sub_total').val());
        if (!isNaN(value))
        {
            var amount = 0;
            var type = '';

            if ($(this).val() == '%')
            {
                type = '%';
                amount = (sub_total / 100) * value;
            } else if ($(this).val() == 'FLAT')
            {
                type = 'FLAT';
                amount = value;
            }
            var dicounted_amount = sub_total - amount;
            $('#discounted_price').val(parseFloat(dicounted_amount).toFixed(2));
            $('#discount').val(parseFloat(amount).toFixed(2));
            $('#discountType').val(type);
            $('#discountOff').val(parseFloat(amount).toFixed(2));

        } else
        {
            $('#discounted_price').val(parseFloat(sub_total).toFixed(2));
            $('#discount').val('0.00');
            $('#discountType').val('');
            $('#discountOff').val(0.00);
        }

        sumDiscountTotal();

    });

    $(document).on('blur', '.discount-price', function () {

        if ($(this).val() == '')
        {
            $(this).val('0.00');
        } else
        {
            $(this).val(parseFloat($(this).val()).toFixed(2))
        }
    });
</script>


<!--model code for posting voucher start-->
<div class="modal fade" id="cancel-single-sale">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL VOUCHER</h4>
            </div>
            <form method="post" action="<?= base_url('Sales/cancelSingleReport') ?>">
                <input type="hidden" class="cancelSingleSaleBillId" name="id" />
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Reason</label>
                                <textarea name="reason" placeholder="Enter reason of cancelation..." required class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                    <button class="btn btn-btn btn-primary">CANCEL VOUCHER</button>
                </div>
            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!--model code for posting voucher start-->
<div class="modal modal-danger fade" id="post-payment-voucher-danger">
    <form method="post" action="<?= base_url('Sales/postSaleVoucherInvoice'); ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">RECEIVE IN</h4>
                </div>

                <input type="hidden" name="sales_id" class="post_invoice_sales_id" />
                <div class="modal-body">
                    <div class="row">
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12">
                            <label>Posting Date</label>
                            <input type="text"  name="posting_date" class="form-control currentdatepicker" />
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12">
                            <label>Amount Receiving</label>
                            <input type="number" name="paid" id="paid_amt" class="form-control" min="0" max="0" step="any" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12">
                            <label>Account</label>
                            <select name="account_head" class="form-control">
                                <?php if (!empty($assets)) { ?>
                                    <?php foreach ($assets as $a) { ?>
                                        <option value="<?= $a->coa_id; ?>"><?= $a->coa_name; ?></option>
    <?php } ?>
<?php } ?>
                            </select>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12">
                            <label>Particulars</label>
                            <input type="text" name="particulars" class="form-control" placeholder="Account Number,Check Number,Transaction ID etc" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>

                    <button class="btn btn-btn btn-outline"> POST VOUCHER</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

</div>

