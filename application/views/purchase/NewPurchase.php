<?php
// $uri_id = $this->uri->segment(3);
// $cart = $this->cart->contents();
// echo "<pre>";
// print_r($cart);
// exit();
// echo "<pre>";
// print_r(count($vendors));
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
    .nav-tabs-custom {
        margin-bottom: 20px;
        background: transparent;
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0.1);
        border-radius: 3px;
    }
    .nav-tabs-custom > .nav-tabs {
        margin: 0;
        border-bottom-color: #a4ab71;
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
    }
</style>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content">
        <div class="row pos-row">
            <div class="col-md-12">
                <table id="new_sale" class="table table-condensed" >
                    <tbody>
                        <tr>
                            <td colspan="2"><label>PRODUCTS</label></td>
                        </tr>
                        <?php for ($x = 1; $x <= 1; $x++) { ?>

                            <tr >
                                <td class="col-md-9">
                                    
                                    <div class="form-group">
                                        <select name="prd_id[]" class="form-control code_id select2" id="c_id" onchange="getProductDetail(this.value, 'prd_id', this);">
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
                                        <input type="hidden" name="prd_title[]" class="form-control prd_title" id="c_title">
                                    </div>

                                </td>
                                  <!-- <td>
                                      <div class="form-group">
                                          <input type="text" name="item[<?= $x ?>][prd_id]" class="form-control prd_id" onblur="getProductDetail(this.value, 'prd_prd_id', this);">
                                          <input type="hidden" name="item[<?= $x ?>][prd_id]" class="form-control pur_id">
                                      </div>
                                  </td> -->
                                <td style="display:none;">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                        <input type="text" class="form-control price priceFocus" id="c_price" name="price[]" onkeyup="multiplyPrice(this);">
                                    </div>
                                </td>
                                <td style="display:none;">
                                    <div class="form-group input-group">
                                        <input type="text" class="form-control quantity" id="c_qty" name="quantity[]" onkeyup="multiplyPrice(this);">
                                        <span id="unit_name_span" class="input-group-addon unit"></span>
                                        <input type="hidden" name="unit[]" class="unit_id" id="c_unit" />
                                    </div>
                                </td>

                                <td class="col-md-3">
                                    <div class="">
                                        <span class="input-group-addon" style="display:none;"><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                        <input type="hidden" class="form-control total" name="total[]" id="c_total" readonly>
   
                                         <span class="input-group-addon add-discount hide" onclick="excludeDiscount(this)">
                                            <label class="label label-danger">D</label>
                                            <input type="hidden" class="discount-value">
                                            <input type="hidden" class="discountValue" name="item[<?= $x ?>][discountValue]">
                                        </span>
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

                            <label class="text-white">GRAND TOTAL</label>
                            <div class="form-group input-group">

                                <span class="input-group-addon"><?php
if (!empty($currency_symbol->symbol)) {
    echo $currency_symbol->symbol;
}
?></span>
                                <input type="text" class="form-control bill_total" id="bill_total" required name="bill_total" value="0.00" readonly>
                            </div> 
                            <label class="text-white">AMOUNT PAID</label>
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
                            </div><br>
                            <!-- custom tabs start -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" style="text-align:left;">
                                    <a href="#Vender" data-toggle="tab" class="btn btn-flat btn-warning"><i class="fa fa-user"></i> SELECT VENDOR</a>
                                    <a href="#VendorDetails" data-toggle="tab" class="btn btn-flat btn-info" onclick="newVendor();"><i class="fa fa-user-plus"></i> ADD NEW</a>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="Vender">

                                        <div class="form-group">

                                            <select class="form-control vendor_id select2" name="purchase_vendor_id" onchange="getVdr();" id="purchase_vendor_id" required>
                                                <option value="">-Select-</option>
<?php
foreach ($vendors as $vndr) {
    ?>
                                                    <option value="<?= $vndr->user_id; ?>"><?= $vndr->user_fname . '' . $vndr->user_lname; ?></option>
    <?php
}
?>
                                            </select>
                                        </div> 
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="VendorDetails">
                                        <label>Vendor Name</label>
                                        <div class="form-group input-group" style="width: 100%">
                                            <input type="text" class="form-control user_fname" id="user_fname" required name="user_fname" value="" >
                                        </div>
                                        <div class="form-group input-group"  style="width: 100%">
                                            <label>Contact</label>
                                            <input type="text" class="form-control user_contact" id="user_contact" required name="user_contact" value="" >
                                        </div>
                                        <div class="form-group input-group"  style="width: 100%">
                                            <label>Full Address</label>
                                            <input type="text" class="form-control user_address" id="user_address" required name="user_address" value="" ><br>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->


                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom --> 
                            <button type="button"  onclick="SavePurchase(this);" class="btn btn-block col-md-3 btn-flat bg-green pay_now">SAVE PURCHASE</button>
                            <button type="button" onclick="SavePostPurchase(this);" class="btn btn-block col-md-3 btn-flat bg-orange hold_order">SAVE & POST PURCHASE</button>
                            <!--<button type="button"   class="btn btn-block col-md-3 btn-flat bg-maroon">CANCEL PURCHASE</button>-->

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

    $(document).ready(function () {


    });
    // ************* vendor
    function newVendor(){
        $('#purchase_vendor_id').val('').trigger('change');
    }
    function getVdr()
    {
        var v_id = $('#purchase_vendor_id').val();
        // alert(v_id);
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {'vendor_id': v_id},
            url: '<?= base_url('Purchase/getVendors'); ?>',
            success: function (data)
            {
                if (data != null) {
                    // alert(data);
                    $('.user_fname').val(data.user_fname);
                    $('.user_contact').val(data.user_contact);
                    $('.user_address').val(data.user_address);
                    $('.user_fname').attr('readonly', true);
                    $('.user_contact').attr('readonly', true);
                    $('.user_address').attr('readonly', true);
                    $('#Vender').removeClass('active');
                    $('#VendorDetails').addClass('active');

                } else
                {
                    $('.user_fname').val('');
                    $('.user_contact').val('');
                    $('.user_address').val('');
                    $('.user_fname').attr('readonly', false);
                    $('.user_contact').attr('readonly', false);
                    $('.user_address').attr('readonly', false);
                }

            }
        });
    }





    // *************** ./vendor


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
            // multiplyPrice($('.code_id').closest('tr').find('.quantity'));
            setTimeout(function(){
                  AddCart();
              },1000);
            sumTotal();
            sumAllTotal();


            // alert(sno);

            // document.test.submit();
            // alert("Key Pressed");
        }
        // else if(keyCode==68)
        // {
        //     $('#discountPrice').focus();
        // }
        else if (keyCode == 65)
        {
            //$('.paid_amt').focus();
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
        var c_price = 0;
        if($('#c_price').val() != '')
        {
          c_price = parseFloat($('#c_price').val()).toFixed(2);  
        }
        else
        {
           c_price = parseFloat(0).toFixed(2);
        }
        var c_unit = $('#c_unit').val();
        var unit_name_span = $('#unit_name_span').html();
        var c_total = parseFloat($('#c_total').val()).toFixed(2);
        // var  = $('.code_id').val();
        var con = 0;
        if (prd_id == '')
        {
            // alert('Add Cart Items');
            $('#c_id').select2('open');
            // resetDis();
            // ResetTax();

        } else
        {

            // alert('hi');

            // alert(prd_id);
            // alert(c_price);
            // alert(c_qty);
            // alert(c_unit);
            // alert(c_total);
//         alert(unit_name_span);
            $('.NewSale > tbody ').append('<tr>'
                    + '<td><div class=""><input type="text" class="form-control prd_title" onblur="multiplyPrice(this);" value="' + prd_title + '" readonly><input type="hidden" name="prd_id[]" class="form-control pur_id code_id" value="' + prd_id + '"></div></td><td style="width:200px"><div class="form-group input-group"><span class="input-group-addon"><?php
if (!empty($currency_symbol->symbol)) {
    echo $currency_symbol->symbol;
}
?></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);" value="' + c_price + '"></div></td><td style="width:200px"><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);" value="' + c_qty + '"><span class="input-group-addon">' + unit_name_span + '</span><input type="hidden" name="unit[]" class="unit_id" value="' + c_unit + '"/></div></td><td style="width:200px"><div class="form-group input-group"><span class="input-group-addon"><?php
if (!empty($currency_symbol->symbol)) {
    echo $currency_symbol->symbol;
}
?></span><input type="text" class="form-control total" name="total[]" value="' + c_total + '" readonly><span class="input-group-addon btn btn-danger" onclick="RemovePrd(this);"><i class="fa fa-times"></i></span></div></td></tr>');
            // $('#cart_prd_id').val(prd_id);
            // $('#sale').append(closest('tr').$('.cart_prd_id').val(prd_id));
            // $('.cart_prd_id').each(function (){
            //    $(this).val(prd_id);
            //    $(this).trigger('change');
            // });
            // alert(ale);
            // resetDiscount(obj);
            sumTotal();
            sumAllTotal();


        }
        $('#c_id').val('').trigger('change');
        $('#c_title').val('');
        $('#c_qty').val(1);
        $('#c_price').val('0.00');
        $('#c_unit').val('');
        $('#c_total').val('0.00');
        $('.unit').html('');
        $('#c_id').select2('open');
        // resetDis();
        // ResetTax();
        getBalance();
        sumTotal();
        sumAllTotal();
    }

    function RemovePrd(obj)
    {

        $(obj).parent().parent().parent().remove();
         
        
        sumAllTotal();
        // resetDis();
        sumTotal();
        // ResetTax();
        getBalance();

    }


// function resetDis() {
//         var row = $('#discountPrice').closest('tr');
//         // row.find('.discount-price').prop('checked', false);
//          $('#discountPrice').next().find('.discount-price').prop('checked',false);

//         $('.code_id').each(function () {
//             if ($(this).val() != '') {
//                 var row = $(this).closest('tr');
//                 row.find('.discountValue').val("");

//             }
//             getDiscount();
//             // $('#discountPrice').val('');
//         });

//         discount_total = 0;
//         $('#discount').val(discount_total);
//         $('#discounted_price').val($('#sub_total').val());
//         $('#discountPrice').val('');
//         sumAllTotal();


//     }

// function ResetTax()
// {
//   // alert('top');
//         var tax = $('.tVal').val();
//         var taxArray = tax.split("-");
//         var taxValue = taxArray[0];
//         var taxType = taxArray[1];
//         var taxString = taxArray[2];
//         var taxTitle = taxArray[3];
//   // alert('ppp');

//         // alert($('.tKey').closest('.intx').find('.tVal').val());
//         $('.tKey').each(function(){
//           // alert('kk');
//           // $(this).closest('row').find('.tVal').val('0');
//             // alert($(this).closest('row').find('.tVal').val('0'));
//           $('.tKey').closest('.intx').find('.tVal').val();

//             // $(this).prop('checked', false);
//             $('#tax_' + taxString).val("0");
//             // $('.tVal').val("0");
//             $('#addonTax' + taxString).text("");
//             $('#taxTitle' + taxString).val("");
//             $('#taxType' + taxString).val("");
//             $('#taxOn' + taxString).val("0");

//         });
//             sumAllTotal();


// }


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

                    }
                    // else { con=1; alert(con+' con 1');}

                    // if(con==1)
                    // {
                    //   $('#c_id').val('');
                    // }

                }

                // alert(con+' con  0');

            });

            //  alert(con);
            $(obj).addClass('code_id');
            if (con == 1)
            {
                // $(obj).val('');
                // $(obj).select2('refresh');
                // self.select2("")
                $(obj).val('').trigger('change');
                // ResetTax();
                sumTotal();
                sumAllTotal();

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
                    url: '<?= base_url('Purchase/getProducts'); ?>',
                    success: function (data)
                    {
                        if (data != null) {
                            var row = $(obj).closest('tr');

                            row.find('.code_id').val(data.prd_id);
                            row.find('.pur_id').val(data.prd_id);
                            row.find('.prd_title').val(data.prd_title);
                            // row.find('.item').val(data.prd_title);
                            row.find('.item').attr('disabled', true);
                            row.find('.quantity').val(1);
                            row.find('.unit').html(data.unit_name);
                            row.find('.unit_id').val(data.unit_id);
                            row.find('.price').val('0.00');
                            row.find('.total').val('0.00');

                            sumTotal();
                            // getBalance();
                            sumAllTotal();
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
                                // $('#new_sale > tbody ').append('<tr>'
                                //   +'<td><div class="form-group"><select name="item[<?= $x ?>][prd_id]" class="form-control code_id select2" onchange="getProductDetail(this.value, '+"'prd_id'"+', this);"><option>-select-</option>'
                                //                  <?php
//                   foreach($products as $pro)
//                   {
//                 
?>
                                //                  +'<option value="<?= $pro->prd_id; ?>"><?= $pro->prd_title; ?></option>'
                                //                  <?php
//                   }
//                  
?>
                                //                +'</select><input type="hidden" name="prd_id[]" class="form-control pur_id"></div></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" /></div></td><td><div class="form-group input-group"><span class="input-group-addon"><i class="fa <?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } else { ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);"></div></td><td><div class="form-group input-group"><span class="input-group-addon"><i class="fa <?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } else { ?> fa-money <?php } ?>"></i></span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');

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

                            sumTotal();
                            sumAllTotal();
                            // getBalance();
                            // ResetTax();
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
            $('#c_qty').val('1');
            $('#c_price').val('0.00');
            $('#c_unit').val('0');
            $('#c_total').val('0.00');
            $('.unit').html('');
            sumTotal();
            sumAllTotal();
            // getBalance();
            // resetDis();
            // resetDiscount(obj);


        }
    }

    // function getTax(obj) {

    //     var sub_total = 0;
    //     var tax_total = 0;
    //     var tax = $(obj).val();
    //     var taxArray = tax.split("-");
    //     var taxValue = taxArray[0];
    //     var taxType = taxArray[1];
    //     var taxString = taxArray[2];
    //     var taxTitle = taxArray[3];


    //     if ($(obj).is(':checked')) {


    //         $('.code_id').each(function () {

    //             if ($(this).val() != '') {

    //                 var row = $(this).closest('tr');
    //                 row.find('.tax-' + taxString).val(tax);
    //                 $('#addonTax' + taxString).text(taxValue + ' ' + taxType);
    //                 $('#taxTitle' + taxString).val(taxTitle);
    //                 $('#taxType' + taxString).val(taxType);
    //                 $('#taxOn' + taxString).val(taxValue);

    //                 var taxT = (taxType == 'FLAT') ? taxValue : (parseInt($('#discounted_price').val()) * taxValue / 100);

    //                 tax_total = (taxT) ? taxT : 0;

    //             }

    //         });

    //         $('#tax_' + taxString).val(tax_total);
    //         sumAllTotal();

    //     } else {


    //         $('.code_id').each(function () {

    //             if ($(this).val() != '') {

    //                 var row = $(this).closest('tr');
    //                 row.find('.tax-' + taxString.toLowerCase()).val("");

    //             }

    //         });

    //         $('#tax_' + taxString.toLowerCase()).val("0");
    //         $('#addonTax' + taxString).text("");
    //         $('#taxTitle' + taxString).val("");
    //         $('#taxType' + taxString).val("");
    //         $('#taxOn' + taxString).val("");
    //         sumAllTotal();

    //     }

    // }


    // function getDiscount(obj) {

    //     var sub_total = 0;
    //     var discount_total = 0;
    //     var discountType = $(obj).val();
    //     var discount = $('#discountPrice').val();
    //     var sub_total = $('#sub_total').val();



    //     if ($(obj).is(':checked')) {

    //         if (discount == "") {
    //             $(obj).prop('checked', false);
    //             alert('Please enter discount first.');
    //         } else {

    //             $('.code_id').each(function () {
    //                 if ($(this).val() != '') {
    //                     var row = $(this).closest('tr');
    //                     row.find('.discountValue').val(discountPrice);

    //                     var discountPrice = (discountType == 'flat') ? parseInt(discount) : (parseInt(sub_total) * parseInt(discount) / 100);
    //                     discount_total = (discountPrice) ? discountPrice : 0;
    //                 // alert(discount_total);
    //                     $('#discount').val(discount_total);
    //                     $('#discountType').val(discountType);
    //                     $('#discountOff').val(discount);
    //                 }
    //             });


    //         }


    //         sumDiscountTotal();

    //     } else {

    //         $('.code_id').each(function () {
    //             if ($(this).val() != '') {
    //                 var row = $(this).closest('tr');
    //                 row.find('.discountValue').val("");
    //             }
    //         });

    //         discount_total = 0;
    //         $('#discount').val(discount_total);
    //         $('#discountType').val("");
    //         $('#discountOff').val("");
    //         sumDiscountTotal();
    //     }


    // }

    // function resetDiscount(obj) {
    //     var row = $(obj).closest('tr');
    //     // row.find('.discount-price').prop('checked', false);
    //      $(obj).next().find('.discount-price').prop('checked',false);

    //     $('.code_id').each(function () {
    //         if ($(this).val() != '') {
    //             var row = $(this).closest('tr');
    //             row.find('.discountValue').val("");
    //         }
    //         getDiscount();
    //     });

    //     discount_total = 0;
    //     $('#discount').val(discount_total);
    //     $('#discounted_price').val($('#sub_total').val());
    //     sumAllTotal();

    // }

    // function excludeTax(obj, taxString) {

    //     $(obj).addClass('hide');

    //     if ($('body').find('.add-tax-' + taxString.toLowerCase()).not(".hide").length < 1) {

    //         $('.tax-checkbox-' + taxString).prop('checked', false);
    //         $('#addonTax' + taxString.toUpperCase()).text("");

    //     }

    //     var tax_charges = $(obj).find('.tax' + taxString).val();
    //     var row = $(obj).closest('tr');

    //     row.find('.tax' + taxString).val("");

    //     if ($('#tax_' + taxString.toLowerCase()).val() != 0) {
    //         var tax_total = $('#tax_' + taxString.toLowerCase()).val() - tax_charges;
    //     } else {
    //         var tax_total = 0;
    //     }

    //     $('#tax_' + taxString.toLowerCase()).val(tax_total);

    //     sumAllTotal();

    // }


    function multiplyPrice(obj) {
        var $qty = $(obj).val();
         var quantity = $(obj).parent().parent().parent().find('.quantity').val();
            var price = $(obj).parent().parent().parent().find('.price').val();
            var total = parseInt(quantity) * parseFloat(price);
            
        if ( $qty.trim() != '' && quantity.trim() != '' && price.trim() != '' ) {
            
            $(obj).parent().parent().parent().find('.total').val(parseFloat(total).toFixed(2));
            $(obj).parent().parent().parent().find('.price').val(parseFloat(price).toFixed(2));
//            sumTotal();
//            getBalance();
//            sumAllTotal();
//            // ResetTax();
//            // resetDis();

            $(obj).closest('tr').find('.add-tax-g').addClass('hide');
            $(obj).closest('tr').find('.add-tax-s').addClass('hide');
        }
        else if(price.trim() == '')
        {
           $(obj).parent().parent().parent().find('.price').val(parseFloat(0).toFixed(2)); 
        }
        else
        {
//             sumTotal();
//            getBalance();
//            sumAllTotal();
            //$(obj).parent().parent().parent().find('.price').val(parseFloat(0).toFixed(2));
            $(obj).parent().parent().parent().find('.total').val(parseFloat(0).toFixed(2));
        }
         sumTotal();
            getBalance();
            sumAllTotal();
    }

    // function sumDiscountTotal() {

    //     var sub_total = 0;
    //     var bill_total = 0;
    //     var grand_tax_total = 0;
    //     var discounted_price = parseInt($('#sub_total').val());

    //     if ($('#discount').val() != 0) {
    //         discounted_price = discounted_price - parseInt($('#discount').val());
    //     } else {
    //         discounted_price = parseInt($('#sub_total').val());
    //     }

    //     $("#discounted_price").val(discounted_price);

    //     bill_total = bill_total + parseInt(discounted_price);

    //     if ($('#tax_0').length && $('#tax_0').val() != 0) {

    //         var tax0 = parseInt($('#taxOn0').val());
    //         var taxType0 = $('#taxType0').val();

    //         if (taxType0 == 'FLAT') {
    //             var tax_0 = tax0;
    //         } else {
    //             var tax_0 = (parseInt($('#discounted_price').val()) * tax0 / 100);
    //         }

    //         $('#tax_0').val(tax_0);

    //     } else {
    //         var tax_0 = 0;
    //         $('#tax_0').val(tax_0);
    //     }

    //     if ($('#tax_1').length && $('#tax_1').val() != 0) {

    //         var tax1 = parseInt($('#taxOn1').val());
    //         var taxType1 = $('#taxType1').val();

    //         if (taxType1 == 'FLAT') {
    //             var tax_1 = tax1;
    //         } else {
    //             var tax_1 = (parseInt($('#discounted_price').val()) * tax1 / 100);
    //         }

    //         $('#tax_1').val(tax_1);

    //     } else {
    //         var tax_1 = 0
    //         $('#tax_1').val(tax_1);
    //     }

    //     if ($('#tax_2').length && $('#tax_2').val() != 0) {
    //         var tax2 = parseInt($('#taxOn2').val());
    //         var taxType2 = $('#taxType2').val();

    //         if (taxType2 == 'FLAT') {
    //             var tax_2 = tax2;
    //         } else {
    //             var tax_2 = (parseInt($('#discounted_price').val()) * tax2 / 100);
    //         }

    //         $('#tax_2').val(tax_2);

    //     } else {
    //         var tax_2 = 0
    //         $('#tax_2').val(tax_2);
    //     }

    //     if ($('#tax_3').length && $('#tax_3').val() != 0) {
    //         var tax3 = parseInt($('#taxOn3').val());
    //         var taxType3 = $('#taxType3').val();

    //         if (taxType3 == 'FLAT') {
    //             var tax_3 = tax3;
    //         } else {
    //             var tax_3 = (parseInt($('#discounted_price').val()) * tax3 / 100);
    //         }
    //         $('#tax_3').val(tax_3);
    //     } else {
    //         var tax_3 = 0
    //         $('#tax_3').val(tax_3);
    //     }

    //     if ($('#tax_4').length && $('#tax_4').val() != 0) {
    //         var tax4 = parseInt($('#taxOn4').val());
    //         var taxType4 = $('#taxType4').val();

    //         if (taxType4 == 'FLAT') {
    //             var tax_4 = tax4;
    //         } else {
    //             var tax_4 = (parseInt($('#discounted_price').val()) * tax4 / 100);
    //         }

    //         $('#tax_4').val(tax_4);

    //     } else {
    //         var tax_4 = 0
    //         $('#tax_4').val(tax_4);
    //     }

    //     if ($('#tax_5').length && $('#tax_5').val() != 0) {
    //         var tax5 = parseInt($('#taxOn5').val());
    //         var taxType4 = $('#taxType5').val();

    //         if (taxType5 == 'FLAT') {
    //             var tax_5 = tax5;
    //         } else {
    //             var tax_5 = (parseInt($('#discounted_price').val()) * tax5 / 100);
    //         }

    //         $('#tax_5').val(tax_4);

    //     } else {
    //         var tax_5 = 0
    //         $('#tax_5').val(tax_5);
    //     }

    //     grand_tax_total = tax_0 + tax_1 + tax_2 + tax_3 + tax_4 + tax_5;
    //     bill_total = bill_total + grand_tax_total;
    //     ;

    //     $("#bill_total").val(bill_total);
    //     $("#balance").val(bill_total);
    //     // sumAllTotal();

    // }

    function sumAllTotal() {
        var sub_total = 0;
        var bill_total = 0;
        // var discounted_price = $('#discounted_price').val();

        // console.log(discounted_price);

        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = sub_total + parseFloat($(this).val());

            }
        });

        // bill_total = bill_total + parseInt(discounted_price);


        // bill_total = bill_total + grand_tax_total;


        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(sub_total).toFixed(2));
        //$("#balance").val(parseFloat(bill_total).toFixed(2));


        // if ($('#tax_0').length) {
        //     var value_1 = parseInt($('#tax_0').val());
        // } else {
        //     var value_1 = 0
        // }

        // if ($('#tax_1').length) {
        //     var value_2 = parseInt($('#tax_1').val());
        // } else {
        //     var value_2 = 0
        // }

        // if ($('#tax_2').length) {
        //     var value_3 = parseInt($('#tax_2').val());
        // } else {
        //     var value_3 = 0
        // }

        // if ($('#tax_3').length) {
        //     var value_4 = parseInt($('#tax_3').val());
        // } else {
        //     var value_4 = 0
        // }

        // if ($('#tax_4').length) {
        //     var value_5 = parseInt($('#tax_4').val());
        // } else {
        //     var value_5 = 0
        // }

        // if ($('#tax_5').length) {
        //     var value_6 = parseInt($('#tax_5').val());
        // } else {
        //     var value_6 = 0
        // }
// 
        // var grand_tax_total = value_1 + value_2 + value_3 + value_4 + value_5 + value_6;

        // // bill_total = bill_total + grand_tax_total;


        // $("#sub_total").val(sub_total);
        // $("#bill_total").val(bill_total);
        // $("#balance").val(bill_total);

    }
    function sumTotal() {
        var sub_total = 0;
        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = sub_total + parseInt($(this).val());
            }
        });
        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(sub_total).toFixed(2));
        // $("#discounted_price").val(sub_total);

    }
    function getBalance() {
        // var sub_total = $('#sub_total').val();
        // var paid_amount = $('#paid_amount').val();
        // var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        // $('#balance').val(balance);
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        if(bill_total != '0.00' && bill_total != '' && paid_amount != '')
        {
         //alert('ok');
         $('#paid_amount').val(parseFloat(paid_amount).toFixed(2));
         var balance = parseFloat(bill_total) - parseFloat(paid_amount);
         $('#balance').val(parseFloat(balance).toFixed(2));
       }
       else if(bill_total != '0.00' && bill_total != '')
       {
           $('#paid_amount').val('0.00');
           $('#balance').val(parseFloat(bill_total).toFixed(2));
       }   
       else
       {
           $('#balance').val('0.00');
           $('#paid_amount').val('0.00');
       }
    }

    function getAllBalance() {
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(balance);
        // getDiscount();
    }

    // $('input.discount-price').on('change', function () {
    //     $('input.discount-price').not(this).prop('checked', false);
    // });

    // $('.dropdown-menu').click(function (e) {
    //     e.stopPropagation();
    // });

    function SavePurchase(obj) {
        // var status_id = 1;
        var p_am = parseInt($('.paid_amt').val());
        var billtotal = parseInt($('.bill_total').val());
        var vdr = $('#purchase_vendor_id').val();
        var userfname = $('.user_fname').val();
        var usercontact = $('.user_contact').val();
        var useraddress = $('.user_address').val();
        // alert(p_am);
//        if(p_am < billtotal)
//        {
//         // alert(billtotal); 
//          alert('Please Enter Correct AMOUNT PAID');
//          $('.paid_amt').focus();
//        }
//        else if(p_am==0)
//        {
//          alert('Please Enter AMOUNT PAID');
//          $('.paid_amt').focus();
//        }
        if (vdr == '')
        {
            // alert('Please select Vendor Name ');
            $('#purchase_vendor_id').select2('open');
            if ((userfname == '') && (usercontact == '') && (useraddress == ''))
            {
                alert('Please select Vendor Name ');
            } else
            {
                $('#save_form').attr('action', '<?= base_url('Purchase/CreatePurchase/0') ?>');
                $('#save_form').submit();
            }
        } else
        {
            $('#save_form').attr('action', '<?= base_url('Purchase/CreatePurchase/0') ?>');
            $('#save_form').submit();
        }
    }
    function SavePostPurchase(obj) {
        // var status_id = 0;
        var p_am = parseInt($('.paid_amt').val());
        var billtotal = parseInt($('.bill_total').val());
        var vdr = $('#purchase_vendor_id').val();
        var userfname = $('.user_fname').val();
        var usercontact = $('.user_contact').val();
        var useraddress = $('.user_address').val();
        // alert('here');

        if (p_am < billtotal)
        {
            // alert(billtotal); 
            alert('Enter Total Amount');
            $('.paid_amt').focus();
        } else if (p_am == 0)
        {
            alert('Please Enter AMOUNT PAID');
            $('.paid_amt').focus();
        } else if (vdr == '')
        {
            // alert('Please select Vendor Name ');

            if ((userfname == '') && (usercontact == '') && (useraddress == ''))
            {
                alert('Please select Vendor Name ');
                $('#purchase_vendor_id').select2('open');

            } else
            {
                // alert('Please form should be submitted');
                $('#save_form').attr('action', '<?= base_url('Purchase/CreatePurchase/1') ?>');
                $('#save_form').submit();
            }
        } else
        {
            $('#save_form').attr('action', '<?= base_url('Purchase/CreatePurchase/1') ?>');
            $('#save_form').submit();
        }
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
