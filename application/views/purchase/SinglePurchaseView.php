<?php
$purchase_id = '';
$pos_date = '';
// $voucher_no      = '';
$additional_info = '';
$user_fname = '';
$user_contact = '';
$user_address = '';
$sub_total = '';
$bill_total = '0';
$paid_amount = '0';
$balance = '';
$recent_paid_amount = '0';
$purchase_amount = '0.00';
$purchase_status = '0';
$vendor_id = '';
$cancelReason = '';
$cancelby = '';
$created_by_id = '';
$is_close = 0;
$remaining_blance = 0;
$note = '';
$purchase_number = '';
$reaminBlance = 0;
$is_stock = 0;
if (!empty($purchase_data)) {

    if (!empty($purchase_data['purchase'])) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $purchase_data['purchase']->purchase_date);
        $purchase_date = $date->format("F d y h:i:s a");
        $purchase_id = $purchase_data['purchase']->purchase_id;
        $order_no = $purchase_data['purchase']->purchase_id;
        $purchase_number = $purchase_data['purchase']->purchase_number;
        $vendor_id = $purchase_data['purchase']->purchase_vendor_id;
        $additional_info = $purchase_data['purchase']->purchase_additional_note;
        $bill_total = $purchase_data['purchase']->purchase_bill_total;
        $purchase_status = $purchase_data['purchase']->purchase_status;
        //$purchase_paid_amount      = $purchase_data['purchase']->purchase_paid_amount;
        $purchase_amount = $purchase_data['purchase']->purchase_bill_total;
        $user_fname = $purchase_data['purchase']->user_fname;
        $user_contact = $purchase_data['purchase']->user_contact;
        $user_address = $purchase_data['purchase']->user_address;
        $created_by_id = $purchase_data['purchase']->purchase_created_by;
        $is_close = $purchase_data['purchase']->is_purchase_close;
        $note = $purchase_data['purchase']->purchase_additional_note;
        $is_stock = $purchase_data['purchase']->is_stock;
        if (!empty($purchase_data['purchase']->cancel_reason)) {
            $cancelReason = $purchase_data['purchase']->cancel_reason;
            $cancelby = $purchase_data['purchase']->cancel_by;
            $Cdate = DateTime::createFromFormat('Y-m-d H:i:s', $purchase_data['purchase']->cancelation_date);
            $Canceldate = $Cdate->format("F d y h:i:s a");
        }
    }
}
if (!empty($paidAmount)) {
    $remaining_blance = $bill_total - $paidAmount->total;
}

// echo "<pre>";
// print_r($purchase_data['items']);
// print_r($tax_id_arr);
// foreach ($tax_id_arr as $value) {
//   echo $value['pos_tax_title'];
// } 
// echo "<pre>";
// print_r($purchase_data['purchase']);
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
    .pos-row{
        background: #2f3d48 !important;
        color: #fff;
        margin-top: -15px;
    }
    .text-white{
        color: #fff !important;
    }

    .totals-sidebar{
        background: #3a4c5a;
        padding-top: 20px;
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
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <?php if ($purchase_status == '0') { ?>
            <div class="row pos-row">
                <?php if ($is_stock == '0') { ?>
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
                                                <input type="text" class="form-control price priceFocus" id="c_price" name="price[]" onblur="multiplyPrice(this);">
                                            </div>
                                        </td>
                                        <td style="display:none;">
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control quantity" id="c_qty" name="quantity[]" onblur="multiplyPrice(this);">
                                                <span class="input-group-addon unit"></span>
                                                <input type="hidden" name="unit[]" class="unit_id" id="c_unit" />
                                            </div>
                                        </td>
                                        <td class="col-md-3">


                                            <span class="input-group-addon" style="display:none;"><?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                            <input type="hidden" class="form-control total" name="total[]" value="" id="c_total" readonly>

                                            <span class="btn btn-success btn-block add_cart" onclick="AddCart();"><i class="fa fa-plus"></i> ADD TO CART</span>



                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>  
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <!-- <div class="row">
          <div class="col-md-12"> -->
        <!-- /.box-header -->
        <form method="post" class="" id="save_form" action="">
            <input type="hidden" name="purchase_id" value="<?= $purchase_id; ?>">
            <div class="box box-control-sidebar">
                <div class="">
                    <div class="row">
                        <div class="col-md-9">
                            <table id="sale" class="table table-condensed NewSale">
                                <thead>

                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $allTotal = 0;
                                    if (!empty($purchase_data)) {
                                        if (!empty($purchase_data['items'])) {
                                            foreach ($purchase_data['items'] as $x => $item) {

                                                $total = $item->puritem_price * $item->puritem_qty;
                                                $allTotal += $total;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control prd_title" onblur="multiplyPrice(this);" value="<?= $item->prd_title; ?>" readonly>
                                                            <input type="hidden" name="prd_id[]" class="form-control pur_id code_id" value="<?= $item->prd_id; ?>">
                                                        </div>
                                                        <input type="hidden" name="puritem_id[]" class="form-control puritem_id" value="<?= $item->puritem_id; ?>">
                                                    </td>
                                                    <td style="width:200px">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } ?>
                                                            </span>
                                                            <input type="text" class="form-control price" name="price[]" <?php if ($purchase_status != '0') { ?>readonly <?php } ?> onblur="multiplyPrice(this);" value="<?php
                                                            echo $item->puritem_price;
                                                            if (strpos($item->puritem_price, '.') === false) {
                                                                echo '.00';
                                                            }
                                                            ?>">
                                                        </div>
                                                    </td>
                                                    <td style="width:200px">
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control quantity" name="quantity[]" <?php if ($purchase_status != '0') { ?>readonly <?php } ?> onblur="multiplyPrice(this);" value="<?= $item->puritem_qty; ?>">
                                                            <span class="input-group-addon unit"><?= $item->unit_name; ?></span>
                                                            <input type="hidden" name="unit[]" class="unit_id" value="<?= $item->unit_id; ?>"/></div>
                                                    </td>
                                                    <td style="width:200px">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><?php if (!empty($currency_symbol->symbol)) { ?><?= $currency_symbol->symbol; ?><?php } ?>
                                                            </span>
                                                            <input type="text" class="form-control total" name="total[]" value="<?php
                                                            echo $total;
                                                            if (strpos($total, '.') === false) {
                                                                echo '.00';
                                                            }
                                                            ?>" readonly>
                                                                   <?php if ($purchase_status == '0') { ?>
                                                                       <?php if ($is_stock == '0') { ?>
                                                                    <span class="input-group-addon btn btn-danger" onclick="deletePrd(this, '<?= $item->puritem_id; ?>');"><i class="fa fa-times"></i></span>

                                                                <?php } ?>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>

                                </tbody>
                            </table>



                            <div class="row">

                                <div class="col-md-12">
                                    <label>ADDITIONAL INFORMATION</label>
                                    <div class="form-group">
                                        <textarea class="form-control" name="additional_info" <?php if ($purchase_status != '0') { ?>readonly<?php } ?>><?= $additional_info ?></textarea>
                                    </div>
                                </div>

                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr> 
                                        </tr>
                                        <?php
                                        $totalPayment = 0;
                                        $sno = 1;
                                        foreach ($payments as $pay):
                                            ?>
                                            <tr>
                                                <td><?= $sno; ?></td>

                                                <td><?= date('F d Y', strtotime($pay->purpayment_date)); ?></td>
                                                <td><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?><?= number_format($pay->purpayment_amount, 2); ?></td>
                                            </tr>
                                            <?php
                                            $totalPayment = $totalPayment + $pay->purpayment_amount;
                                            $sno++;
                                        endforeach;
                                        ?>

                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td><?php
                                                if (!empty($currency_symbol->symbol)) {
                                                    echo $currency_symbol->symbol;
                                                }
                                                ?> <?= number_format($totalPayment, 2); ?></td>
                                        </tr>
                                    </table>
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
                                <input type="text" class="form-control" name="sub_total" id="sub_total" value="<?php echo number_format($allTotal, 2, '.', ''); ?>" required readonly>

                            </div> 

                            <label class="text-white">GRAND TOTAL</label>
                            <div class="form-group input-group">

                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control bill_total" id="bill_total" required name="bill_total" value="<?php echo number_format($allTotal, 2, '.', ''); ?>" readonly>
                            </div> 
                            <label class="text-white">AMOUNT PAID</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input readonly="" type="text" min="0" class="form-control paid_amt" onblur="getBalance()"  id="paid_amount" name="paid_amount" value="<?php
                                $paidAmountBilled = '0.00';
                                if (!empty($paidAmount) and $paidAmount->total != 0) {
                                    $paidAmountBilled = $paidAmount->total;
                                    echo number_format($paidAmount->total, 2, '.', '');
                                } else {
                                    echo '0.00';
                                }
                                ?>">
                            </div> 



                            <label class="text-white">BALANCE</label>
                            <div class="form-group input-group"  style="width:100%;">

                                <span class="input-group-addon"><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <input type="text" class="form-control"  required id="balance" name="balance" value="<?php
                                $reaminBlance = $purchase_amount - $paidAmountBilled;
                                echo number_format($reaminBlance, 2, '.', '')
                                ?>" readonly>
                            </div> 
                            <br>
                            <!-- custom tabs start -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs" style="text-align:left;">
                                    <a href="#Vender" data-toggle="tab" class="btn btn-flat btn-warning"><i class="fa fa-user"></i> SELECT VENDOR</a>
                                    <a href="#VendorDetails" data-toggle="tab" class="btn btn-flat btn-info" onclick="newVendor();"><i class="fa fa-user-plus"></i> ADD NEW</a>
                                </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="Vender">

                                        <div class="form-group">

                                            <select class="form-control vendor_id select2" name="purchase_vendor_id" onchange="getVdr();" id="purchase_vendor_id" required <?php if ($purchase_status != '0') { ?>disabled<?php } ?>>
                                                <option value="">-Select-</option>
                                                <?php
                                                foreach ($vendors as $vndr) {
                                                    ?>
                                                    <option value="<?= $vndr->user_id; ?>" <?php
                                                    if ($vndr->user_id == $vendor_id) {
                                                        echo 'selected';
                                                    }
                                                    ?> ><?= $vndr->user_fname . '' . $vndr->user_lname; ?></option>
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
                                            <input type="text" class="form-control user_fname" id="user_fname" required name="user_fname" value="<?= $user_fname; ?>" readonly>
                                        </div>
                                        <div class="form-group input-group"  style="width: 100%">
                                            <label>Contact</label>
                                            <input type="text" class="form-control user_contact" id="user_contact" required name="user_contact" value="<?= $user_contact; ?>"  readonly>
                                        </div>
                                        <div class="form-group input-group"  style="width: 100%">
                                            <label>Full Address</label>
                                            <input type="text" class="form-control user_address" id="user_address" required name="user_address" value="<?= $user_address; ?>"  readonly><br>
                                        </div>
                                    </div>

                                    <!-- /.tab-pane -->


                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                            <?php if ($purchase_status != 2) { ?>
                                <?php if ($reaminBlance > 0): ?>
                                    <button type="button" data-toggle="modal" data-target="#purchase-payment" class="btn btn-block col-md-3 btn-flat bg-green">PAY NOW</button>

                                <?php endif; ?>
                                <?php if ($is_stock == '0') { ?>
                                    <button type="button" onclick="openModalStock();" class=" btn btn-flat bg-purple btn-block col-md-3">ADD TO STOCK</button>
                                <?php } ?>
                                <?php if ($totalPayment == 0): ?>
                                    <?php if ($is_stock == '0') { ?>
                                        <button type="button"  onclick="UpdatePurchase(this);" class="btn btn-block col-md-3 btn-flat bg-yellow pay_now">UPDATE PURCHASE</button>
                                        <!--<button type="button" onclick="PostPurchase(this);" class="btn btn-block col-md-3 btn-flat bg-orange hold_order">POST PURCHASE</button>-->
                                        <button type="button" onclick="openCancelModal();"  class="btn btn-block col-md-3 btn-flat bg-maroon">CANCEL PURCHASE</button>
                                    <?php } ?>
                                <?php endif; ?>   
                            <?php } ?>

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




<!--model code for posting voucher start-->
<div class="modal fade" id="cancel_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL PURCHASE</h4>
            </div>
            <form method="post" action="<?= base_url('Purchase/CancelPurchase/2') ?>" >
                <div class="modal-body">
                    <input type="hidden" name="purchase_id" value="<?= $purchase_id; ?>" />

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Reason</label>
                                <textarea name="Cancelreason" placeholder="Enter reason of cancelation..." required class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button onclick="CancelPurchase(this);" class="btn btn-btn btn-flat btn-success">CANCEL PURCHASE</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>


    function openModalStock() {
        $('#stock_modal').modal('show');
    }

    function openCancelModal() {
        $('#cancel_modal').modal('show');
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

</script>

<script>
    $(document).on('blur', '.quantity', function () {
        sumAllTotal();
    });
    // $(document).on('blur','.price', function(){getTax(obj);});
    $(document).on('blur', '.price', function () {
        sumAllTotal();
    });

    // $(document).on('each','.vendor_id', function(){getVdr();});

    document.onkeyup = function (evt) {
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        // var sno = 0;
        if (keyCode == 13)
        {
            //your function call here
            setTimeout(function () {
                AddCart();
            }, 1000);
            sumTotal();
            sumAllTotal();


            // document.test.submit();
            // alert("Key Pressed");
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

        getBalance();
        var prd_id = $('#c_id').val();
        // var prd_id    = $('#c_id').val();
        var prd_title = $('#c_title').val();
        var c_qty = $('#c_qty').val();
        var c_price = $('#c_price').val();
        var c_unit = $('#c_unit').val();
        var c_total = $('#c_total').val();

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
            $('.NewSale > tbody ').append('<tr>'
                    + '<td><div class="form-group input-group"><input type="text" class="form-control prd_title" onblur="multiplyPrice(this);" value="' + prd_title + '" readonly><input type="hidden" name="prd_id[]" class="form-control pur_id code_id" value="' + prd_id + '"></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php
                            if (!empty($currency_symbol->symbol)) {
                                echo $currency_symbol->symbol;
                            }
                            ?></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);" value="' + c_price + '"></div></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);" value="' + c_qty + '"><span class="input-group-addon unit"></span><input type="hidden" name="unit[]" class="unit_id" value="' + c_unit + '"/></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php
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


        }
        $('#c_id').val('').trigger('change');
        $('#c_title').val('');
        $('#c_qty').val('');
        $('#c_price').val('');
        $('#c_unit').val('');
        $('#c_total').val('');
        $('.unit').html('');
        $('#c_id').select2('open');
        // resetDis();
        // ResetTax();

        getBalance();
    }

    function RemovePrd(obj)
    {

        $(obj).parent().parent().parent().remove();

        sumAllTotal();
        sumTotal();
        getBalance();
        // ResetTax();

    }

    function deletePrd(obj, id) {
        $(obj).parent().parent().parent().remove();
        $.ajax({
            type: 'post',
            data: {'id': id},
            url: '<?php echo base_url('Purchase/deletePurchaseItem'); ?>'
        });
        sumAllTotal();
        sumTotal();
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
                            row.find('.price').val('0.00');
                            row.find('.total').val('0.00');

                            sumTotal();
                            getBalance();
                            $('.priceFocus').focus();

                            var a = 0;

                            $('#new_sale >tbody >  tr').find('td:nth-child(2) input').each(function () {

                                var cellText = $(this).val();
                                // alert(cellText);
                                if (cellText == '') {
                                    a = a + 1;
                                    //alert(cellText);
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
            $('#c_qty').val('0');
            $('#c_price').val('0.00');
            $('#c_unit').val('0');
            $('#c_total').val('0.00');
            $('.unit').html('');
            sumTotal();
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
    //         getBalance();

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
    //         getBalance();

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
        var price = $(obj).parent().parent().parent().find('.price').val();
        if ($qty.trim() != '' && price.trim() != '') {
            var quantity = $(obj).parent().parent().parent().find('.quantity').val();

            var total = parseInt(quantity) * parseFloat(price);
            $(obj).parent().parent().parent().find('.total').val(parseFloat(total).toFixed(2));
            $(obj).parent().parent().parent().find('.price').val(parseFloat(price).toFixed(2));


            // ResetTax();
            // // resetDis();
            // // resetDis
            // sumDiscountTotal();
            $(obj).closest('tr').find('.add-tax-g').addClass('hide');
            $(obj).closest('tr').find('.add-tax-s').addClass('hide');

        } else if (price.trim() == '')
        {
            $(obj).parent().parent().parent().find('.price').val(parseFloat(0).toFixed(2));
            $(obj).parent().parent().parent().find('.total').val(parseFloat(0).toFixed(2));
        } else
        {
            $(obj).parent().parent().parent().find('.total').val(parseFloat(0).toFixed(2));
        }

        sumAllTotal();
        sumTotal();
        getBalance();
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
    //     $("#balance").val('0');

    //     sumAllTotal();
    //     // $("#bill_total").val(bill_total);
    // }

    function sumAllTotal() {
        var sub_total = 0;
        var bill_total = 0;
        // var paid_total = 0;
        // var discounted_price = $('#discounted_price').val();

        // console.log(discounted_price);

        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = parseFloat(sub_total) + parseFloat($(this).val());

            }
        });

        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(sub_total).toFixed(2));
        $("#balance").val('0.00');
        $("#paid_amt").val('0.00');

        // bill_total = bill_total + parseInt(discounted_price);


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

        // var grand_tax_total = value_1 + value_2 + value_3 + value_4 + value_5 + value_6;

        // bill_total = bill_total + grand_tax_total;


        // $("#sub_total").val(sub_total);
        // $("#bill_total").val(bill_total);
        // $("#balance").val('0');

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
        $("#paid_amt").val('0.00');
        // $("#discounted_price").val(sub_total);
        // getBalance();

    }
    function getBalance() {
        // var sub_total = $('#sub_total').val();
        // var paid_amount = $('#paid_amount').val();
        // var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        // $('#balance').val(balance);
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
    }

    function getAllBalance() {
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
        // getDiscount();
    }

    // $('input.discount-price').on('change', function () {
    //     $('input.discount-price').not(this).prop('checked', false);
    // });

    // $('.dropdown-menu').click(function (e) {
    //     e.stopPropagation();
    // });


    function PostPurchase(obj)
    {
        var p_am = parseFloat($('.paid_amt').val());
        var vdr = $('#purchase_vendor_id').val();
        var billtotal = parseFloat($('.bill_total').val());
        // alert(p_am);
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
            alert('Please select Vendor Name ');
            $('#purchase_vendor_id').select2('open');
        } else
        {
            $('#save_form').attr('action', '<?= base_url('Purchase/PostPurchase/1') ?>');
            $('#save_form').submit();
        }
    }
    function UpdatePurchase(obj)
    {

        var p_am = parseInt($('.paid_amt').val());
        var vdr = $('#purchase_vendor_id').val();
        var billtotal = parseInt($('.bill_total').val());
        // alert(p_am);
        // alert(billtotal);


        if (vdr == '')
        {
            alert('Please select Vendor Name ');
            $('#purchase_vendor_id').select2('open');
        } else
        {
            $('#save_form').attr('action', '<?= base_url('Purchase/UpdatePurchase/') ?>');
            $('#save_form').submit();
        }
    }


</script>
<!--model code for posting voucher start-->
<div class="modal fade" id="purchase-payment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">PAY TO VENDOR</h4>
            </div>
            <form method="post" action="<?= base_url('Purchase/installment_payment/' . $this->uri->segment(3)) ?>">
                <div class="modal-body">
                    <label>REMAINING BALANCE</label>
                    <input type="tex" class="form-control" readonly="" name="remain_blance" value="<?= number_format($remaining_blance, 2, '.', ''); ?>" />

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group input-group">

                                <span class="input-group-addon">
                                    <?php
                                    $count = 0;
                                    if (number_format($remaining_blance) == 0) {
                                        $count = number_format($remaining_blance, 2, '.', '');
                                    }
                                    ?>
                                    <?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?>
                                </span>
                                <input type="number" min="<?= $count ?>" max="<?= number_format($remaining_blance, 2, '.', ''); ?>" class="form-control" name="payment" required="" step="any">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">CLOSE POPUP</button>

                    <button type="submit" class="btn btn-btn btn-success btn-flat">PAY NOW</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal modal-default fade" id="stock_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('Purchase/addToStock'); ?>">
                <input type="hidden" name="purchase_id" value="<?= $purchase_id; ?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">IMPORTANT! Once Item of this voucher added to stock, You will not be able to cancel this voucher.</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Stock Date</label>
                            <input type="text"  name="stock_date" class="form-control currentdatepicker" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-btn btn-success btn-flat">ADD</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>