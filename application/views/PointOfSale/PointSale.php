<?php
// $uri_id = $this->uri->segment(3);
// $cart = $this->cart->contents();
// echo "<pre>";
// print_r($cart);
// exit();
// echo "<pre>";
// print_r($products);
// exit();
?>
<style type="text/css">
    .nav-tabs > li {
        float:none;
        display:inline-block;
        zoom:1;
    }

    .nav-tabs {
        text-align:center;
    }
    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        width: 100% !important;
    }
    .form-group {
        margin-bottom: 0px;
    }
    .pos-row {
        background: #2f3d48 !important;
        color: #fff;
        margin-top: -15px;
    }
    .text-white{
        color: #fff !important;
    }

    .totals-sidebar{
        background: #3a4c5a;
        padding-top:20px;
        padding-bottom: 20px;
        min-height: 90vh;
    }
    .table > thead > tr > th {
        border-bottom: 0px solid #f4f4f4;
    }
    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        border-top: 0px solid #f4f4f4;
    }
</style>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <div class="row pos-row">
            <div class="col-md-12">
                <table id="new_sale" class="table table-condensed" >
                    <thead>
                        <tr>
                            <th  style="width:300px" class="text-white">PRODUCT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($x = 1; $x <= 1; $x++) { ?>

                            <tr >
                                <td class="col-md-9">
                                    <div class="form-group">
                                        <select  class="form-control code_id select2" id="c_id" onchange="getProductDetail(this.value, 'prd_id', this);">
                                            <option value="">-select-</option>
                                            <?php
                                            foreach ($products as $pro) {
                                                ?>
                                                <option value="<?= $pro->prd_id; ?>"><?= $pro->prd_title; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                             <!-- <input type="text" name="item[<?= $x ?>][prd_id]" class="form-control prd_id" onblur="getProductDetail(this.value, 'prd_prd_id', this);"> -->
                                        <input type="hidden"  class="form-control prd_title" id="c_title">
                                    </div>

                                </td>
                                <td style="display:none;">
                                    <div class="form-group input-group">
                                        <input type="hidden" class="form-control price priceFocus" id="c_price">
                                    </div>
                                </td>
                                <td style="display:none;">
                                    <div class="form-group input-group">
                                        <input type="hidden" class="form-control quantity" id="c_qty" >
                                        <span class="input-group-addon unit" style="display:none;"></span>
                                        <input type="hidden" class="unit_id" id="c_unit" />
                                    </div>
                                </td>

                                <td class="col-md-3">
                                    <div class="form-group input-group" style="display:none;">
                                        <input type="hidden" class="form-control total" id="c_total" readonly>
                                        <?php foreach ($taxes as $key => $tax) { ?>
                                            <span style="display:none;" class="input-group-addon tax-label add-tax-<?= $key ?> hide" onclick="excludeTax(this, '<?= $key ?>')">
                                                <label class="label label-primary"><?= $tax->tax_title[0] ?></label>
                                                <input type="hidden" class="tax-<?= $key ?>">
                                                <input type="hidden" class="taxes">
                                                <input type="hidden" class="tax<?= $key ?>" >
                                                <input type="hidden" class="tax-title-<?= $key ?>" >
                                            </span>
                                        <?php } ?>
                                        <span class="input-group-addon add-discount hide" onclick="excludeDiscount(this)" style="display:none;">
                                            <label class="label label-danger">D</label>
                                            <input type="hidden" class="discount-value">
                                            <input type="hidden" class="discountValue" >
                                        </span>
                                    </div>
                                    <div>
                                        <span class="btn btn-success btn-block add_cart" onclick="AddCart();"><i class="fa fa-plus"></i> ADD TO CART</span>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>  
            </div>
        </div>
        <!-- <div class="row">
          <div class="col-md-12"> -->
        <!-- /.box-header -->
        <form method="post" class="" id="save_form" action="">
            <div class="box box-control-sidebar">
                <div class="">
                    <div class="row">
                        <div class="col-md-9">
                            <table id="sale" class="table table-condensed NewSale">
                                <thead>

                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="row intx">
                                <div class="col-md-4">

                                    <label>DISCOUNT</label>

                                    <div class="form-group  input-group">
                                        <input type="text" id="discountPrice" class="form-control" onblur="getDiscountOnBlur();" value="0.00">
                                        <div class="input-group-addon">
                                            <label class="">
                                                <input type="radio" class="discount-price" id="flt" checked  value="flat" onchange="getDiscount(this);"> FLAT
                                            </label>
                                            <label class="">
                                                <input type="radio" class="discount-price"  value="percent" onchange="getDiscount(this);"> PERCENT
                                            </label>
                                        </div><!-- /btn-group -->
                                    </div><!-- /input-group -->
                                </div>

                                <?php foreach ($taxes as $key => $tax) { ?>
                                    <div class="col-md-4">

                                        <label> <?= strtoupper($tax->tax_title) ?> (<?= $tax->tax_value ?> <?= ($tax->tax_type == 0) ? 'FLAT' : '%' ?>)</label>
                                        <div class="form-group input-group ">
                                            <span class="input-group-addon"><input type="checkbox"  class="tax-checkbox-<?= $key ?> tKey"  onchange="getTax(this);" value="<?= $tax->tax_value ?>-<?= ($tax->tax_type == 0) ? 'FLAT' : '%' ?>-<?= $key ?>-<?= $tax->tax_title ?>"></span>
                                            <input type="text" class="form-control tVal" id="tax_<?= $key ?>"  name="taxes_value[]?>" value="0.00" readonly>
                                            <input type="hidden" id="taxType<?= $key ?>"  name="taxes_type[]?>" value="0"> 
                                            <input type="hidden" id="taxTitle<?= $key ?>"  name="taxes_title[]?>" value="0">
                                            <input type="hidden" id="taxOn<?= $key ?>"  name="taxes_on[]?>" value="0">

                                        </div>   
                                    </div>

                                <?php } ?>



                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>ADDITIONAL INFORMATION</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="additional_info"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 totals-sidebar">
                            <label class="text-white">SUBTOTAL</label>
                            <div class="form-group input-group">

                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control" name="sub_total" id="sub_total" value="0.00" required readonly>
                            </div> 
                            <input type="hidden" name="discountValue" id="discount">
                            <input type="hidden" name="discountType" id="discountType">
                            <input type="hidden" name="discountOff" id="discountOff">
                            <label class="text-white">DISCOUNTED PRICE</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control" id="discounted_price" required name="discounted_price" value="0.00" readonly>
                            </div> 
                            <label class="text-white">GRAND TOTAL</label>
                            <div class="form-group input-group">

                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control " id="bill_total" required name="bill_total" value="0.00" readonly>
                            </div> 
                            <label class="text-white">AMOUNT RECEIVED</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" min="0" class="form-control paid_amt" onblur="getBalance()"  id="paid_amount" name="paid_amount" value="0.00">
                            </div> 
                            <label class="text-white">BALANCE</label>
                            <div class="form-group input-group"  style="width:100%;">

                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control"  required id="balance" name="balance" value="0.00" readonly>
                            </div> 
                            <br>
                            <button type="button"  onclick="createOrder(this);" class="btn btn-block col-md-3 btn-flat bg-green pay_now">PAY NOW</button>
                            <button type="button" onclick="holdOrder(this);" class="btn btn-block col-md-3 btn-flat bg-orange hold_order">HOLD ORDER</button>
                            <!--<button type="button"   class="btn btn-block col-md-3 btn-flat bg-maroon">CANCEL ORDER</button>-->

                        </div>

                    </div>

                </div>
            </div>

            </div>

        </form>
        </aside>
        <!-- </div>
      </div> -->

</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).on('blur', '.quantity', function () {
        sumAllTotal();
    });
    // $(document).on('blur','.price', function(){getTax(obj);});
    $(document).on('blur', '.price', function () {
        sumAllTotal();
    });


    document.onkeyup = function (evt) {
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        // var sno = 0;
        if (keyCode == 13)
        {
            //your function call here
            setTimeout(function () {

                AddCart();
            }, 300);
            // alert(sno);

            // document.test.submit();
            // alert("Key Pressed");
        } else if (keyCode == 68)
        {
            $('#discountPrice').focus();
        } else if (keyCode == 65)
        {
            $('.paid_amt').focus();
        }
        // else if(keyCode==84)
        // {
        //     // $('.tKey').closest('row').find('.tKey').focus();
        // }
    }




    $(document).ready(function () {

        // $('#c_id').focus();
        $('#c_id').select2('open');
        // alert('select2');
        // $('#id').select2('focus');
        // $('#c_id').trigger('click');
        // $('#c_id').trigger('focus');

    });
</script>


<script type="text/javascript">

    function AddCart()
    {

        var prd_id = $('#c_id').val();
        // var prd_id    = $('#c_id').val();
        var prd_title = $('#c_title').val();
        var c_qty = $('#c_qty').val();
        var c_price = $('#c_price').val();
        var c_unit = $('#c_unit').val();
        var c_unit_name = $('.unit').text();
        var c_total = $('#c_total').val();

        c_price = parseFloat(c_price);
        c_total = parseFloat(c_total);

        // var  = $('.code_id').val();

        var con = 0;

        if (prd_id == '')
        {
            // alert('Add Cart Items');
            $('#c_id').select2('open');
            resetDis();
            ResetTax();
        } else
        {


            $('.NewSale > tbody ').append('<tr>'
                    + '<td><div class="form-group input-group"><input type="text" class="form-control prd_title" onblur="multiplyPrice(this);" value="' + prd_title + '" readonly><input type="hidden" name="prd_id[]" class="form-control pur_id code_id" value="' + prd_id + '"></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);" value="' + c_price.toFixed(2) + '"></div></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);" value="' + c_qty + '"><span class="input-group-addon ">' + c_unit_name + '</span><input type="hidden" name="unit[]" class="unit_id" value="' + c_unit + '"/></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span><input type="text" class="form-control total" name="total[]" value="' + c_total.toFixed(2) + '" readonly></div></td><td><span class="btn btn-danger" onclick="RemovePrd(this);"><i class="fa fa-times"></i></span></td></tr>');



        }
        $('#c_id').val('').trigger('change');
        $('#c_title').val('');
        $('#c_qty').val('');
        $('#c_price').val('');
        $('#c_unit').val('');
        $('#c_total').val('');
        $('.unit').html('');
        $('#c_id').select2('open');
        resetDis();
        ResetTax();
        getBalance();
    }

    function RemovePrd(obj)
    {

        $(obj).parent().parent().remove();

        sumAllTotal();
        resetDis();
        sumTotal();
        ResetTax();

    }

    function getDiscountOnBlur() {
        var sub_total = 0;
        var discount_total = 0;
        var discount = $('#discountPrice').val();
        var sub_total = $('#sub_total').val();
        $('.discount-price').each(function () {
            if ($(this).is(':checked')) {
                var discountType = $(this).val();
                if (discount == "") {
                    $(this).prop('checked', false);
                    alert('Please enter discount first.');
                } else {
                    $('.code_id').each(function () {
                        if ($(this).val() != '') {
                            var row = $(this).closest('tr');
                            row.find('.discountValue').val(discountPrice);

                            var discountPrice = (discountType == 'flat') ? parseInt(discount) : (parseInt(sub_total) * parseInt(discount) / 100);
                            discount_total = (discountPrice) ? discountPrice : 0.00;
                            // alert(discount_total);
                            $('#discount').val(discount_total);
                            $('#discountType').val(discountType);
                            $('#discountOff').val(discount);
                        }
                    });


                }


                sumDiscountTotal();

            }
                sumAllTotal();
                discount = parseFloat(discount);
                discount = discount.toFixed(2);
                $('#discountPrice').val(discount);
        });

    }
    function resetDis() {
        var row = $('#discountPrice').closest('tr');
        // row.find('.discount-price').prop('checked', false);
//        $('#discountPrice').next().find('.discount-price').prop('checked', false);

        $('.code_id').each(function () {
            if ($(this).val() != '') {
                var row = $(this).closest('tr');
                row.find('.discountValue').val("");

            }
            getDiscount();
            // $('#discountPrice').val('');
        });

        var discount_total = 0.00;
        $('#discount').val(discount_total);
        $('#discounted_price').val($('#sub_total').val());
        $('#discountPrice').val('0.00');
        sumAllTotal();


    }

    function ResetTax()
    {
        // alert('top');

        // alert('ppp');

        // alert($('.tKey').closest('.intx').find('.tVal').val());
        $('.tKey').each(function () {
            var tax = $(this).val();

            var taxArray = tax.split("-");
            var taxValue = taxArray[0];
            var taxType = taxArray[1];
            var taxString = taxArray[2];
            var taxTitle = taxArray[3];

            // $(this).closest('row').find('.tVal').val('0');
            // alert($(this).closest('row').find('.tVal').val('0'));
            $('.tKey').closest('.intx').find('.tVal').val();

            // $(this).prop('checked', false);
            $('#tax_' + taxString).val('0.00');
//             $('.tVal').val("0123123");
            $('#addonTax' + taxString).text("");
            $('#taxTitle' + taxString).val("");
            $('#taxType' + taxString).val("");
            $('#taxOn' + taxString).val("0.00");
            $(this).prop('checked', false);
        });
        sumAllTotal();


    }


// ************** old js code 
    function getProductDetail(values, dbColName, obj) {
        if (values.trim() != '') {
            var con = 0;
            // alert(values);
            $(obj).removeClass('code_id');
            $('.code_id').each(function ()
            {

                if (($(this).val() != ''))
                {
                    // alert($(this).val());
                    var cur = values;

                    // alert(qty);
                    var sel = $(this).val();
                    // alert(values+'current');
                    // alert(cur+'selected');
                    if (sel == cur)
                    {
                        var qty = parseInt($(this).closest('tr').find('.quantity').val()) + 1;
                        $(this).closest('tr').find('.quantity').val(qty);
                        multiplyPrice($(this).closest('tr').find('.quantity'));
                        // alert(con+' con equal');
                        con = 1;
//                        getBalance();

                    }


                }

                // alert(con+' con  0');

            });


            $(obj).addClass('code_id');

            if (con == 1)
            {

                $(obj).val('').trigger('change');
                ResetTax();
                getBalance();

            }
            if (con == 0)
            {

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    data: {
                        "value": values,
                        "dbColName": dbColName
                    },
                    url: '<?= base_url('PointOfSale/getProductDetail'); ?>',
                    success: function (data)
                    {
                        if (data != null) {
                            var row = $(obj).closest('tr');

                            row.find('.code_id').val(data.prd_id);
                            row.find('.pur_id').val(data.prd_id);
                            row.find('.prd_title').val(data.prd_title);
                            // row.find('.item').val(data.prd_title);
                            row.find('.item').attr('disabled', true);
                            row.find('.quantity').val('1');
                            row.find('.unit').html(data.unit_name);
                            row.find('.unit_id').val(data.unit_id);
                            row.find('.price').val(data.prd_price);
                            row.find('.total').val(data.prd_price);

//                            sumTotal();
//                            getBalance();
                            $('.priceFocus').focus();

                            var a = 0;

                            $('#new_sale >tbody >  tr').find('td:nth-child(2) input').each(function () {

                                var cellText = $(this).val();
                                // alert(cellText);
                                if (cellText == '') {
                                    a = a + 1;
                                }

                            });
                            if (a == 0) {

                            }
                        } else {
                            var row = $(obj).closest('tr');
                            row.find('.code_id').val('');
                            row.find('.pur_id').val('');
                            row.find('.item').val('');
                            row.find('.item').attr('disabled', false);
                            row.find('.quantity').val('');
                            row.find('.unit').html('');
                            row.find('.unit_id').val('');
                            row.find('.price').val('');
                            row.find('.total').val('');

//                            sumTotal();
//                            getBalance();
//                            ResetTax();
                        }

                    },
                    error: function ()
                    {
                        alert('ajax call error:');
                    }

                });
            } //else{ alert('already'); } // con==0 condition
        } else
        {
            // alert('helleo');
            // $('#c_id').val('').trigger('change');
            $('#c_title').val('');
            $('#c_qty').val('0');
            $('#c_price').val('0');
            $('#c_unit').val('0');
            $('#c_total').val('0');
            $('.unit').html('');
            sumTotal();
            getBalance();
            resetDis();
            // resetDiscount(obj);


        }
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
            tax = parseFloat(tax);


            $('.code_id').each(function () {

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
            tax_total = tax_total.toFixed(2);

            $('#tax_' + taxString).val(tax_total);
            sumAllTotal();
            getBalance();

        } else {


            $('.code_id').each(function () {

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
            getBalance();
        }

    }


    function getDiscount(obj) {

        var sub_total = 0;
        var discount_total = 0;
        var discountType = $(obj).val();
        var discount = $('#discountPrice').val();
        var sub_total = $('#sub_total').val();



        if ($(obj).is(':checked')) {

            if (discount == "") {
                $(obj).prop('checked', false);
                alert('Please enter discount first.');
            } else {
                $('.code_id').each(function () {
                    if ($(this).val() != '') {
                        var row = $(this).closest('tr');
                        row.find('.discountValue').val(discountPrice);

                        var discountPrice = (discountType == 'flat') ? parseInt(discount) : (parseInt(sub_total) * parseInt(discount) / 100);
                        discount_total = (discountPrice) ? discountPrice : 0.00;
                        // alert(discount_total);
                        $('#discount').val(discount_total);
                        $('#discountType').val(discountType);
                        $('#discountOff').val(discount);
                    }
                });


            }


            sumDiscountTotal();

        } else {


            $('.code_id').each(function () {
                if ($(this).val() != '') {
                    var row = $(this).closest('tr');
                    row.find('.discountValue').val("");
                }
            });

            discount_total = 0.00;
            $('#discount').val(discount_total);
            $('#discountType').val("");
            $('#discountOff').val("");
            sumDiscountTotal();
        }

        discount = parseFloat(discount);
        discount = discount.toFixed(2);
        $('#discountPrice').val(discount);
        sumAllTotal();
    }

    function resetDiscount(obj) {
        var row = $(obj).closest('tr');
        // row.find('.discount-price').prop('checked', false);
        $(obj).next().find('.discount-price').prop('checked', false);

        $('.code_id').each(function () {
            if ($(this).val() != '') {
                var row = $(this).closest('tr');
                row.find('.discountValue').val("");
            }
            getDiscount();
        });

        discount_total = 0;
        $('#discount').val(discount_total);
        $('#discounted_price').val($('#sub_total').val());
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
            var tax_total = 0.00;
        }

        $('#tax_' + taxString.toLowerCase()).val(tax_total);

        sumAllTotal();

    }


    function multiplyPrice(obj) {
        var $qty = $(obj).val();
//        if ($qty.trim() != '') {
        var quantity = $(obj).parent().parent().parent().find('.quantity').val();
        var price = $(obj).parent().parent().parent().find('.price').val();
        if (price == '') {
            price = 0;
        }
        if (quantity == '') {
            quantity = 1;
        }
        $(obj).parent().parent().parent().find('.quantity').val(quantity);
        price = parseFloat(price);
        price = price.toFixed(2);
        $(obj).parent().parent().parent().find('.price').val(price);

        var total = parseInt(quantity) * parseFloat(price);
        total = total.toFixed(2);

        $(obj).parent().parent().parent().find('.total').val(total);

        sumTotal();
        getBalance();
        ResetTax();
        resetDis();

        $(obj).closest('tr').find('.add-tax-g').addClass('hide');
        $(obj).closest('tr').find('.add-tax-s').addClass('hide');

//        }
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

        var headache = parseFloat(discounted_price);
        headache = headache.toFixed(2);
        
        $("#discounted_price").val(headache);

        bill_total = bill_total + parseFloat(discounted_price);

        if ($('#tax_0').length && $('#tax_0').val() != 0) {

            var tax0 = parseFloat($('#taxOn0').val());
            var taxType0 = $('#taxType0').val();

            if (taxType0 == 'FLAT') {
                var tax_0 = tax0;
            } else {
                var tax_0 = (parseFloat($('#discounted_price').val()) * tax0 / 100);
            }
            tax_0 = parseFloat(tax_0);
            tax_0 = tax_0.toFixed(2);
            
            $('#tax_0').val(tax_0);

        } else {
            var tax_0 = 0;
            tax_0 = parseFloat(tax_0);
            tax_0 = tax_0.toFixed(2);
            $('#tax_0').val(tax_0);
        }

        if ($('#tax_1').length && $('#tax_1').val() != 0) {

            var tax1 = parseInt($('#taxOn1').val());
            var taxType1 = $('#taxType1').val();

            if (taxType1 == 'FLAT') {
                var tax_1 = tax1;
            } else {
                var tax_1 = (parseFloat($('#discounted_price').val()) * tax1 / 100);
            }
            
            tax_1 = parseFloat(tax_1);
            tax_1 = tax_1.toFixed(2);
            $('#tax_1').val(tax_1);

        } else {
            var tax_1 = '0.00';
            $('#tax_1').val(tax_1);
        }

        if ($('#tax_2').length && $('#tax_2').val() != 0) {
            var tax2 = parseInt($('#taxOn2').val());
            var taxType2 = $('#taxType2').val();

            if (taxType2 == 'FLAT') {
                var tax_2 = tax2;
            } else {
                var tax_2 = (parseFloat($('#discounted_price').val()) * tax2 / 100);
            }
            tax_2 = parseFloat(tax_2);
            tax_2 = tax_0.toFixed(2);
            $('#tax_2').val(tax_2);

        } else {
            var tax_2 = '0.00';
            $('#tax_2').val(tax_2);
        }

        if ($('#tax_3').length && $('#tax_3').val() != 0) {
            var tax3 = parseInt($('#taxOn3').val());
            var taxType3 = $('#taxType3').val();

            if (taxType3 == 'FLAT') {
                var tax_3 = tax3;
            } else {
                var tax_3 = (parseFloat($('#discounted_price').val()) * tax3 / 100);
            }
            tax_3 = parseFloat(tax_3);
            tax_3 = tax_0.toFixed(2);
            $('#tax_3').val(tax_3);
        } else {
            var tax_3 = '0.00';
            $('#tax_3').val(tax_3);
        }

        if ($('#tax_4').length && $('#tax_4').val() != 0) {
            var tax4 = parseInt($('#taxOn4').val());
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
            var tax5 = parseInt($('#taxOn5').val());
            var taxType4 = $('#taxType5').val();

            if (taxType5 == 'FLAT') {
                var tax_5 = tax5;
            } else {
                var tax_5 = (parseInt($('#discounted_price').val()) * tax5 / 100);
            }

            $('#tax_5').val(tax_4);

        } else {
            var tax_5 = 0
            $('#tax_5').val(tax_5);
        }


        grand_tax_total = tax_0 + tax_1 + tax_2 + tax_3 + tax_4 + tax_5;
        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);
        bill_total = parseFloat(bill_total);
        bill_total = bill_total.toFixed(2);


        $("#bill_total").val(bill_total);
        $("#balance").val(bill_total);
        // sumAllTotal();
        getBalance();

    }

    function sumAllTotal() {

        var sub_total = 0;
        var bill_total = 0;
        var discounted_price = $('#discounted_price').val();

        // console.log(discounted_price);

        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = sub_total + parseFloat($(this).val());

            }
        });

        bill_total = bill_total + parseFloat(discounted_price);


        if ($('#tax_0').length) {
            var value_1 = parseFloat($('#tax_0').val());
        } else {
            var value_1 = 0;
        }

        if ($('#tax_1').length) {
            var value_2 = parseFloat($('#tax_1').val());
        } else {
            var value_2 = 0;
        }

        if ($('#tax_2').length) {
            var value_3 = parseFloat($('#tax_2').val());
        } else {
            var value_3 = 0;
        }

        if ($('#tax_3').length) {
            var value_4 = parseFloat($('#tax_3').val());
        } else {
            var value_4 = 0;
        }

        if ($('#tax_4').length) {
            var value_5 = parseFloat($('#tax_4').val());
        } else {
            var value_5 = 0;
        }

        if ($('#tax_5').length) {
            var value_6 = parseFloat($('#tax_5').val());
        } else {
            var value_6 = 0;
        }

        var grand_tax_total = value_1 + value_2 + value_3 + value_4 + value_5 + value_6;


        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);
        bill_total = parseFloat(bill_total);
        sub_total = sub_total.toFixed(2);
        bill_total = bill_total.toFixed(2);
        $("#sub_total").val(sub_total);

        $("#bill_total").val(bill_total);
        $("#balance").val(bill_total);

    }
    function sumTotal() {
        var sub_total = 0;
        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = sub_total + parseFloat($(this).val());
            }
        });
        sub_total = sub_total.toFixed(2);
        $("#sub_total").val(sub_total);
        $("#bill_total").val(sub_total);
        $("#discounted_price").val(sub_total);

    }
    function getBalance() {
        // var sub_total = $('#sub_total').val();
        var paid_amount = $('#paid_amount').val();

        paid_amount = parseFloat(paid_amount);
        $('#paid_amount').val(paid_amount.toFixed(2));
        // var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        // $('#balance').val(balance);
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        balance = parseFloat(balance);


        $('#balance').val(balance.toFixed(2));

    }

    function getAllBalance() {
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(balance);
        getDiscount();
    }

    $('input.discount-price').on('change', function () {
        $('input.discount-price').not(this).prop('checked', false);
    });

    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });

    function createOrder(obj) {
        // var status_id = 1;
        var sub_total = $('#sub_total').val();
        if (parseFloat(sub_total) > 0) {
//            AddCart();
            var p_am = parseFloat('0.00');
            var balance = parseFloat($('#balance').val());

            if (balance > p_am )
            {
                alert('Amount Recieved Should be Equal or greater then balance.');
                $('.paid_amt').focus();
            } else
            {

                $('#save_form').attr('action', '<?= base_url('PointOfSale/CreateOrder/1') ?>');
                $('#save_form').submit();
            }
        } else {
            alert('Subtotal should not be zero');
        }
    }
    function holdOrder(obj) {
        // var status_id = 0;
//        var p_am = $('.paid_amt').val();
        // alert(p_am);

        $('#save_form').attr('action', '<?= base_url('PointOfSale/CreateOrder/0') ?>');
        $('#save_form').submit();

    }
//     function createInvoice(obj) {

//         if (window.confirm('Are you sure you want to save invoice?') == true) {
//             $('#save_form').attr('action', '<?// base_url('Sales/saveSalesVoucher') ?>');
//             $('#type').val('2');
//             $('#save_form').submit();
//         }
//     }
//     function createPostInvoice(obj) {
//         $('#modal-danger').modal('show');
//         var total = $('#bill_total').val();
//         $('#receive_amt').attr('max', total);
//         $('#type').val('3');
//         $('#save_form').attr('action', '<?// base_url('Sales/saveSalesVoucher') ?>');
// //            $('#save_form').submit();
//     }


</script>
