<?php
$pos_id = '';
$pos_date = '';
// $voucher_no      = '';
$additional_info = '';
$sub_total = '';
$bill_total = '';
$paid_amount = '0';
$balance = '';
$recent_paid_amount = '0';
$recent_balance = '0';
$pos_status = '0';
$discounted_price = '0';
$pos_discount_off = '0';
$pos_discount_type = '';
$pos_discount_value = '0';
$reason_date = '';
$reason = '';
if (!empty($pos_data)) {

    if (!empty($pos_data['pos'])) {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $pos_data['pos']->pos_date);
        $pos_date = $date->format(" F d Y H:i:s");
        $pos_id = $pos_data['pos']->pos_id;
        $reason_date = $pos_data['pos']->cancelation_date;
        $reason = $pos_data['pos']->cancelation_reason;
        $order_no = $pos_data['pos']->pos_id;
        $additional_info = $pos_data['pos']->pos_additional_note;
        $bill_total = $pos_data['pos']->pos_bill_total;
        $discounted_price = $pos_data['pos']->pos_discount_price;
        $pos_discount_off = $pos_data['pos']->pos_discounted_off;
        $pos_discount_type = $pos_data['pos']->pos_discount_type;
        $pos_discount_value = $pos_data['pos']->pos_discount_value;
        $pos_status = $pos_data['pos']->pos_status;
        $pos_paid_amount = $pos_data['pos']->pos_paid_amount;
        $pos_balance = $pos_data['pos']->pos_balance;
    }
}

// if($pos_status=='1')
// {
//   echo "completed";
// }
// else{
//   echo "Holder order";
// }
//   echo "<pre>";
// print_r($taxes);
// exit();


$tax_id_arr = array();
foreach ($AllTaxes as $value) {

    // $tax_id_arr[] =  $value['pos_tax_title'];
    $tax_id_arr[] = $value;
}
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

<?php
if ($pos_status == '1' || $pos_status == '2') {
    ?>
    <!-- Content Wrapper. Contains page content -->
    <!-- Order Invovice start -->
    <div class="content-wrapper">

        <script>
    //window.print();
        </script>
        <style>
            .invoice {
                border: 0px solid #f4f4f4;
                padding: 0px;
            }  
        </style>
        <!-- Content Wrapper. Contains page content -->
        <div class="">
            <!-- Main content -->
            <section class="invoice">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2><b style="border-bottom: 3px solid #3a4c5a;">POS - SALE</b></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="page-header">
                            BILL#: <?= $prefix ?>POS-<?= $order_no ?>
                            <small class="pull-right">Date: <?= (date('F d Y', strtotime($pos_date))) ?></small>
                        </p>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row">
                    <div class="col-sm-4 invoice-col">
                        <label>Payee: CUSTOMER</label>
                    </div>
                    <div class="col-sm-8 invoice-col">
                        <label>The Sum Of: <?php
                            if (!empty($currency_symbol->symbol)) {
                                echo $currency_symbol->symbol;
                            }
                            ?> <?= number_format($bill_total, 2); ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 invoice-col">

                        <label>Amount In Words</label>:
                    </div>
                </div>
                <!--<div class="row">-->
                <!-- /.col -->
                <!--        <div class="col-sm-4 invoice-col">
                          <label>Method of Payment: <?= $single_voucher_information['voucher']->voucher_paying_via ?></label>
                        </div>-->
                <!--        <div class="col-sm-8 invoice-col">
                         <label>Particulars: <?= $single_voucher_information['voucher']->voucher_particulars ?></label>
                        </div>-->
                <!--</div>-->
                <!-- /.row -->
                <br />
                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:50px;">#</th>
                                    <th>SKU #</th>
                                    <th>Product</th>
                                    <th class="">Price</th>
                                    <th>Qty</th>

                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tbody>
                                <?php
                                $sno = 1;
                                $itmNo = 0;
                                $itmQty = 0;
                                $Subtotal = 0;
                                $total = 0;
                                if (!empty($pos_data)) {
                                    foreach ($pos_data['items'] as $x => $pro_d) {

                                        $total += $pro_d->pos_prd_qty * $pro_d->pos_prd_price;
                                        //$Subtotal = $Subtotal + $total;
                                        $itmNo = $sno;
                                        $itmQty += $pro_d->pos_prd_qty;
                                        ?>
                                        <tr>
                                            <td><?= $sno; ?></td>
                                            <td><?= $pro_d->prd_code; ?></td>
                                            <td><?= $pro_d->prd_title; ?></td>
                                            <td class="">
                                                <span> <?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= number_format($pro_d->pos_prd_price, 2); ?></td>
                                            <td><?= $pro_d->pos_prd_qty; ?></td>

                                            <td class="text-right">
                                                <span> <?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= number_format($pro_d->pos_prd_qty * $pro_d->pos_prd_price, 2); ?></td>

                                        </tr>
                                        <?php
                                        $sno++;
                                    }
                                } else {
                                    echo "No Record Available!";
                                }
                                ?>
                            </tbody>
                            </tbody>
                            <thead>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <label>SUBTOTAL</label>
                                    </td>
                                    <td class="text-right"><b><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                            <?= number_format($total, 2) ?></b></td>
                                </tr>
                                <?php
                                $Gtotal = $total;
                                if (!empty($all_tax)) {
                                    foreach ($all_tax as $t) {
//                                    $taxAmount = 0;
//                                    if ($t->pos_tax_type == '%') {
//                                        $taxAmount = ($total / 100) * $t->pos_tax_value;
//                                    } else {
//                                        $taxAmount = $total + $t->pos_tax_value;
//                                    }
                                        ?>
                                        <tr>
                                            <td class="text-right" colspan="5">
                                                <label><?= $t->pos_tax_title; ?>(<?= $t->pos_tax_on; ?><?= $t->pos_tax_type; ?>)</label>
                                            </td>
                                            <td class="text-right"><b><?php
                                            $Gtotal += $t->pos_tax_value;
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?>
                                                    <?= number_format($t->pos_tax_value, 2) ?></b></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <label>DISCOUNT</label>
                                    </td>
                                    <td class="text-right"><b><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            $Gtotal = $Gtotal - $pos_discount_value;
                                            ?>
                                            <?= number_format($pos_discount_value, 2) ?></b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <label>GRAND TOTAL</label>
                                    </td>
                                    <td class="text-right"><b><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?>
                                            <?= number_format($Gtotal , 2) ?></b></td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <label>PAID AMOUNT</label>
                                    </td>
                                    <td class="text-right"><b><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                            <?= number_format($pos_paid_amount, 2) ?></b></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <!--        <div class="col-xs-6">
                              <p class="no-shadow">
                               <label>ADDITIONAL NOTE : <?= $single_voucher_information['voucher']->voucher_desc ?></label>
                              </p>
                            </div>-->
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-xs-9">
                        <p class="no-shadow">
                            <b>STATUS :</b> 
                            <?php
                            $status = '';
                            if (!empty($pos_status == '0')) {
                                $status .= 'Inpregress';
                            } elseif (!empty($pos_status == '1')) {
                                $status .= 'Completed';
                            } elseif (!empty($pos_status == '2')) {
                                $status .= 'Cancelled';
                            }
                            echo $status;
                            ?> <br>
                            <!-- /.col -->

                            <?php if ($pos_status == '2'): ?>
                                <b>Cancellation Date :</b> <?= date('F d Y', strtotime($reason_date)) ?><br>
                                <b>Reason :</b> <?= $reason ?><br>
                                <b>Cancelled By :</b> <?= $user->user_fname . ' ' . $user->user_lname ?><br>
                            <?php endif; ?>
                        </p>
                    </div>
                    
                </div>
                <hr>
                <!-- /.row -->

                <p class="text-center">
                    <?php $user = $this->db->where('user_id', $this->session->userdata('user')['user_id'])->get('users')->row(); ?>
                    print on: <?= date('M d Y - h:i:sa'); ?> by  <?php
                    if (!empty($user)) {
                        echo $user->user_fname . ' ' . $user->user_lname;
                    }
                    ?>
                    <br> 
                    <br>
                    <span class="text-red"> * This is computer generated payment voucher and does not need any signature or stamp</span>
                </p> 
                <button onclick="window.print();" class="btn btn-flate btn-default col-md-offset-5 col-md-2 btn-print">PRINT</button>
            </section>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- /.content-wrapper -->

    <script>


        $(document).ready(function ()
        {
            var total_am = $('.t_price').html();
            // alert(total_am);
            var equal = '0.00';
            // var res        = 0;
            var tax = '0.00';
            var flat = '0.00';
            var per = '0.00';
            var sign = '';


            var value = $('.tax_value').val();
            // alert(value);
            var tax_type = $('.tax_type').val();
            if (tax_type == 'FLAT')
            {
                flat = parseFloat(value);
                sign = 'flat';
                // tax     = parseInt(flat);
                // alert(flat);
                tax = parseFloat(flat);
            } else if (tax_type == '%' && tax_type == 'FLAT')
            {
                flat = parseFloat(value);
                sign = 'flat';
                per = (parseFloat(total_am) * parseFloat(value)) / 100;
                equal = parseFloat(flat) + parseFloat(per);
                sign += '10 %';
                tax = parseFloat(equal);
            } else
            {

                per = (parseFloat(total_am) * parseFloat(value)) / 100;
                sign = '10 %';
                tax = parseFloat(per);
                // tax   = parseInt(per);
                // alert(per);
            }


            // tax = parseInt(flat) + parseInt(per);
            // res = value;
            // alert(tax)
            tax = parseFloat(tax);
            tax = tax.toFixed(2);
            $('.ShowTax').html(tax);
            $('.tax_sign').html(sign);
            // $('.grand_total').html(equal);
            // GetGrandTotal();





            // $('.ShowTax').html(tax);
            // $('.pos_tax').val(tax);



        });

    </script>










    <!-- ./Order Invoice End -->

    <?php
} else {
    ?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="row pos-row">
                <div class="col-md-12">
                    <table id="new_sale" class="table table-condensed" >
                        <thead>
                            <tr>
                                <th  style="width:300px" class="text-white">PRODUCT</th>
                                <th class="text-white"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($x = 1; $x <= 1; $x++) { ?>

                                <tr >
                                    <td>
                                        <div class="form-group" style="width: 100%;">
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
                                    <td>
                                        <div class="form-group input-group">
                                            <span style="display:none;" class="input-group-addon"><?php
                                                if (!empty($currency_symbol->symbol)) {
                                                    echo $currency_symbol->symbol;
                                                }
                                                ?></span>
                                            <input type="hidden" class="form-control total" name="total[]" value="" id="c_total" readonly>
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
                                            <div class="col-md-3">
                                                <span class="btn btn-success add_cart" onclick="AddCart();"><i class="fa fa-plus"></i> ADD TO CART</span>
                                            </div>
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
                <input type="hidden" name="pos_id" value="<?= $pos_id; ?>">
                <div class="box box-control-sidebar">
                    <div class="">
                        <div class="row">
                            <div class="col-md-9">
                                <table id="sale" class="table table-condensed NewSale">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0.00;
                                        $allTotal = 0.00;
                                        if (!empty($pos_data)) {
                                            if (!empty($pos_data['items'])) {
                                                foreach ($pos_data['items'] as $x => $item) {

                                                    $total = $item->prd_price * $item->pos_prd_qty;

                                                    $allTotal += $total;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <input type="text" class="form-control prd_title" onblur="multiplyPrice(this);" value="<?= $item->prd_title; ?>" readonly>
                                                                <input type="hidden" name="prd_id[]" class="form-control pur_id code_id" value="<?= $item->prd_id; ?>">
                                                            </div>
                                                            <input type="hidden" name="pos_items_id[]" class="form-control pos_items_id" value="<?= $item->pos_items_id; ?>">
                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    }
                                                                    ?></span>
                                                                <input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);" value="<?= number_format($item->pos_prd_price, 2, '.', ''); ?>">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);" value="<?= $item->pos_prd_qty; ?>">
                                                                <span class="input-group-addon"><?= $item->unit_name; ?></span>
                                                                <input type="hidden" name="unit[]" class="unit_id" value="<?= $item->unit_id; ?>"/></div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon"><?php
                                                                    if (!empty($currency_symbol->symbol)) {
                                                                        echo $currency_symbol->symbol;
                                                                    }
                                                                    ?></span>
                                                                <input type="text" class="form-control total" name="total[]" value="<?php echo number_format($total, 2, '.', ''); ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-danger" onclick="RemovePrd(this);"><i class="fa fa-times"></i>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <div class="row intx">
                                    <div class="col-md-4">

                                        <label>DISCOUNT</label>

                                        <div class="form-group  input-group">
                                            <input type="text" id="discountPrice"  class="form-control" onblur="getDiscountOnBlur();" value="<?= number_format($pos_discount_off, 2, '.', ''); ?>">

                                            <div class="input-group-addon">
                                                <label class="">
                                                    <input type="radio" class="discount-price"  value="flat" onchange="getDiscount(this);" <?= (strtoupper($pos_discount_type) == 'FLAT') ? 'checked' : '' ?> > FLAT
                                                </label>
                                                <label class="">
                                                    <input type="radio" class="discount-price"  value="percent" onchange="getDiscount(this);" <?= (strtoupper($pos_discount_type) == 'PERCENT') ? 'checked' : '' ?>> PERCENT
                                                </label>
                                            </div><!-- /btn-group -->
                                        </div><!-- /input-group -->
                                    </div>

                                    <?php foreach ($taxes as $key => $tax) { ?>
                                        <div class="col-md-4">

                                            <label> <?= strtoupper($tax->pos_tax_title) ?> (<?= $tax->pos_tax_value ?> <?= ($tax->pos_tax_type == 0) ? 'FLAT' : '%' ?>)</label>
                                            <div class="form-group input-group ">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" class="taxes" name=""
                                                    <?php
                                                    foreach ($tax_id_arr as $a) {
                                                        if ($a['pos_tax_title'] == $tax->pos_tax_title) {
                                                            ?>
                                                                   checked
                                                                   <?php
                                                               }
                                                           }
                                                           ?> 
                                                           class="tax-checkbox-<?= $key ?> tKey"  onchange="getTax(this);" value="<?= $tax->pos_tax_value; ?>-<?= ($tax->pos_tax_type == 0) ? 'FLAT' : '%' ?>-<?= $key ?>-<?= $tax->pos_tax_title ?>">
                                                </span>


                                                <input type="text" class="form-control tVal" id="tax_<?= $key ?>"  name="pos_tax_value[]?>" value="<?php
                                                if (!empty($a['pos_tax_title'])) {
                                                    $myval = '0.00';
                                                    foreach ($tax_id_arr as $a) {
                                                        if ($a['pos_tax_title'] == $tax->pos_tax_title) {
                                                            $myval = number_format($a['pos_tax_value'], 2, '.', '');
                                                            break;
                                                        }
                                                    }
                                                    echo $myval;
                                                } else {
                                                    echo '0.00';
                                                }
                                                ?>" readonly>
                                                <input type="hidden" id="taxType<?= $key ?>"  name="pos_tax_type[]?>" value="<?= ($tax->pos_tax_type == 0) ? 'FLAT' : '%' ?>"> 
                                                <input type="hidden" id="taxTitle<?= $key ?>"  name="pos_tax_title[]?>" value="<?php echo $tax->pos_tax_title; ?>">
                                                <input type="hidden" id="taxOn<?= $key ?>"  name="pos_tax_on[]?>" value="<?= $tax->pos_tax_on; ?>">

                                            </div>   
                                        </div>

                                    <?php } ?>



                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>ADDITIONAL INFORMATION</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="additional_info"><?= $additional_info ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 totals-sidebar">
                                <label class="text-white">SUBTOTAL</label>
                                <div class="form-group input-group" style="width: 100%;">

                                    <div class="form-group input-group">

                                        <span class="input-group-addon"><?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                        <input type="text" class="form-control" name="sub_total" id="sub_total" value="<?= number_format($allTotal, 2, '.', ''); ?>" required readonly>
                                    </div>
                                </div> 
                                <input type="hidden" name="discountValue" id="discount" value="<?= $pos_discount_value; ?>" >
                                <input type="hidden" name="discountType" id="discountType" value="<?= $pos_discount_type; ?>">
                                <input type="hidden" name="discountOff" id="discountOff" value="<?= $pos_discount_off; ?>">
                                <label class="text-white">DISCOUNTED PRICE</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><?php
                                        if (!empty($currency_symbol->symbol)) {
                                            echo $currency_symbol->symbol;
                                        }
                                        ?></span>
                                    <input type="text" class="form-control" id="discounted_price" required name="discounted_price" value="<?php
                                    if (!empty($discounted_price)) {
                                        echo number_format($discounted_price, '2', '.', '');
                                    } else {
                                        echo '0.00';
                                    }
                                    ?>" readonly>
                                </div> 
                                <label class="text-white">GRAND TOTAL</label>
                                <div class="form-group input-group">

                                    <span class="input-group-addon"><?php
                                        if (!empty($currency_symbol->symbol)) {
                                            echo $currency_symbol->symbol;
                                        }
                                        ?></span>
                                    <input type="text" class="form-control " id="bill_total" required name="bill_total" value="<?php
                                    if (!empty($bill_total)) {
                                        echo number_format($bill_total, '2', '.', '');
                                    } else {
                                        echo '0.00';
                                    }
                                    ?>" readonly>
                                </div> 
                                <label class="text-white">AMOUNT RECEIVED</label>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><?php
                                        if (!empty($currency_symbol->symbol)) {
                                            echo $currency_symbol->symbol;
                                        }
                                        ?></span>
                                    <input type="text" min="0" class="form-control paid_amt" onblur="getBalance()"  id="paid_amount" name="paid_amount" value="<?= number_format($pos_paid_amount, 2, '.', ''); ?>">
                                </div> 
                                <label class="text-white">BALANCE</label>
                                <div class="form-group input-group"  style="width:100%;">

                                    <span class="input-group-addon"><?php
                                        if (!empty($currency_symbol->symbol)) {
                                            echo $currency_symbol->symbol;
                                        }
                                        ?></span>
                                    <input type="text" class="form-control"  required id="balance" name="balance" value="<?php
                                    if (!empty($pos_balance)) {
                                        echo number_format($pos_balance, 2, '.', '');
                                    } else {
                                        echo '0.00';
                                    }
                                    ?>" readonly>
                                </div> 
                                <br>
                                <button type="button"  onclick="payOrder(this);"  class="btn btn-block col-md-3 btn-flat bg-green pay_now">PAY NOW</button>
                                <button type="button" onclick="UpdateOrder(this);"  class="btn btn-block col-md-3 btn-flat bg-orange hold_order">UPDATE ORDER</button>
                                <button type="button" data-toggle="modal" data-target="#cancel-modal"  class="btn btn-block col-md-3 btn-flat bg-maroon">CANCEL ORDER</button>

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
                AddCart();
                // alert(sno);

                // document.test.submit();
                // alert("Key Pressed");
            } else if (keyCode == 68)
            {
                $('#discountPrice').focus();
            } else if (keyCode == 65)
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
                discount = parseFloat(discount);
                discount = discount.toFixed(2);
                $('#discountPrice').val(discount);

                sumAllTotal();
            });

        }
        function AddCart()
        {

            var prd_id = $('#c_id').val();
            // var prd_id    = $('#c_id').val();
            var prd_title = $('#c_title').val();

            var c_unit_name = $('.unit').text();

            var c_qty = $('#c_qty').val();
            var c_price = $('#c_price').val();
            c_price = parseFloat(c_price);
            c_price = c_price.toFixed(2);

            var c_unit = $('#c_unit').val();
            var c_total = $('#c_total').val();
            c_total = parseFloat(c_total);
            c_total = c_total.toFixed(2);


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
                                       ?></span><input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);" value="' + c_price + '"></div></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);" value="' + c_qty + '"><span class="input-group-addon ">' + c_unit_name + '</span><input type="hidden" name="unit[]" class="unit_id" value="' + c_unit + '"/></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php
                                       if (!empty($currency_symbol->symbol)) {
                                           echo $currency_symbol->symbol;
                                       }
                                       ?></span><input type="text" class="form-control total" name="total[]" value="' + c_total + '" readonly></div></td><td><span class="btn btn-danger" onclick="RemovePrd(this);"><i class="fa fa-times"></i></span></td></tr>');
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
            resetDis();
            ResetTax();
        }

        function RemovePrd(obj)
        {

            $(obj).parent().parent().remove();

            sumAllTotal();
            resetDis();
            sumTotal();
            ResetTax();

        }


        function resetDis() {
            var row = $('#discountPrice').closest('tr');
            // row.find('.discount-price').prop('checked', false);
    //            $('#discountPrice').next().find('.discount-price').prop('checked', false);

            $('.code_id').each(function () {
                if ($(this).val() != '') {
                    var row = $(this).closest('tr');
                    row.find('.discountValue').val("");

                }
                getDiscount();
                // $('#discountPrice').val('');
            });

            var discount_total = '0.00';
            $('#discount').val(discount_total);
            $('#discounted_price').val($('#sub_total').val());
            $('#discountPrice').val(discount_total);
            sumAllTotal();


        }

        function ResetTax()
        {
            // alert('top');
            var tax = $('.tVal').val();
            var taxArray = tax.split("-");
            var taxValue = taxArray[0];
            var taxType = taxArray[1];
            var taxString = taxArray[2];
            var taxTitle = taxArray[3];
            // alert('ppp');

            // alert($('.tKey').closest('.intx').find('.tVal').val());
            $('.tKey').each(function () {
                // alert('kk');
                // $(this).closest('row').find('.tVal').val('0');
                // alert($(this).closest('row').find('.tVal').val('0'));
                $('.tKey').closest('.intx').find('.tVal').val();

                // $(this).prop('checked', false);
                $('#tax_' + taxString).val("0");
                // $('.tVal').val("0");
                $('#addonTax' + taxString).text("");
                $('#taxTitle' + taxString).val("");
                $('#taxType' + taxString).val("");
                $('#taxOn' + taxString).val("0");

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

    //                                sumTotal();
    //                                getBalance();
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

    //                                sumTotal();
    //                                getBalance();
    //                                ResetTax();
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


                $('.code_id').each(function () {

                    if ($(this).val() != '') {

                        var row = $(this).closest('tr');
                        row.find('.tax-' + taxString).val(tax);
                        $('#addonTax' + taxString).text(taxValue + ' ' + taxType);
                        $('#taxTitle' + taxString).val(taxTitle);
                        $('#taxType' + taxString).val(taxType);
                        $('#taxOn' + taxString).val(taxValue);

                        var taxT = (taxType == 'FLAT') ? parseFloat(taxValue) : (parseFloat($('#discounted_price').val()) * taxValue / 100);

                        tax_total = (taxT) ? taxT : 0;

                    }

                });

                tax_total = parseFloat(tax_total);
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

                            var discountPrice = (discountType == 'flat') ? parseFloat(discount) : (parseFloat(sub_total) * parseInt(discount) / 100);
                            discount_total = (discountPrice) ? discountPrice : '0.00';
                            // alert(discount_total);
                            discount_total = parseFloat(discount_total);
                            discount_total = discount_total.toFixed(2);
                            $('#discount').val(discount_total);
                            $('#discountType').val(discountType);
                            $('#discountOff').val(discount);
                        }
                    });
                    discount = parseFloat(discount);
                    discount = discount.toFixed(2);
                    $('#discountPrice').val(discount);

                }


                sumDiscountTotal();
                getBalance();

            } else {

                $('.code_id').each(function () {
                    if ($(this).val() != '') {
                        var row = $(this).closest('tr');
                        row.find('.discountValue').val("");
                    }
                });

                discount_total = 0;
                $('#discount').val(discount_total);
                $('#discountType').val("");
                $('#discountOff').val("");
                sumDiscountTotal();
            }
            sumAllTotal();

        }

        function resetDiscount(obj) {
            var row = $(obj).closest('tr');
            // row.find('.discount-price').prop('checked', false);
    //            $(obj).next().find('.discount-price').prop('checked', false);

            $('.code_id').each(function () {
                if ($(this).val() != '') {
                    var row = $(this).closest('tr');
                    row.find('.discountValue').val("");
                }
                getDiscount();
            });

            var discount_total = '0.00';
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
                var tax_total = 0;
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
        }

        function sumDiscountTotal() {

            var sub_total = 0;
            var bill_total = 0;
            var grand_tax_total = 0;
            var discounted_price = parseFloat($('#sub_total').val());

            if ($('#discount').val() != 0) {
                discounted_price = discounted_price - parseFloat($('#discount').val());
            } else {
                discounted_price = parseFloat($('#sub_total').val());
            }
            discounted_price = parseFloat(discounted_price);
            discounted_price = discounted_price.toFixed(2);

            $("#discounted_price").val(discounted_price);

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
                var tax_0 = '0.00';
                $('#tax_0').val(tax_0);
            }

            if ($('#tax_1').length && $('#tax_1').val() != 0) {

                var tax1 = parseFloat($('#taxOn1').val());
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
                var tax2 = parseFloat($('#taxOn2').val());
                var taxType2 = $('#taxType2').val();

                if (taxType2 == 'FLAT') {
                    var tax_2 = tax2;
                } else {
                    var tax_2 = (parseFloat($('#discounted_price').val()) * tax2 / 100);
                }
                tax_2 = parseFloat(tax_2);
                tax_2 = tax_1.toFixed(2);
                $('#tax_2').val(tax_2);

            } else {
                var tax_2 = 0
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
                var taxType5 = $('#taxType5').val();

                if (taxType5 == 'FLAT') {
                    var tax_5 = tax5;
                } else {
                    var tax_5 = (parseFloat($('#discounted_price').val()) * tax5 / 100);
                }

                $('#tax_5').val(tax_4);

            } else {
                var tax_5 = 0
                $('#tax_5').val(tax_5);
            }

            grand_tax_total = tax_0 + tax_1 + tax_2 + tax_3 + tax_4 + tax_5;
            bill_total = bill_total + grand_tax_total;

            bill_total = parseFloat(bill_total);
            bill_total = bill_total.toFixed(2);
            $("#bill_total").val(bill_total);
    //            $("#balance").val('0.00');

            sumAllTotal();
            getBalance();
            // $("#bill_total").val(bill_total);
        }

        function sumAllTotal() {
            var sub_total = 0;
            var bill_total = 0;
            // var paid_total = 0;
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
                var value_1 = '0.00';
            }

            if ($('#tax_1').length) {
                var value_2 = parseFloat($('#tax_1').val());
            } else {
                var value_2 = '0.00';
            }

            if ($('#tax_2').length) {
                var value_3 = parseFloat($('#tax_2').val());
            } else {
                var value_3 = '0.00';
            }

            if ($('#tax_3').length) {
                var value_4 = parseFloat($('#tax_3').val());
            } else {
                var value_4 = '0.00';
            }

            if ($('#tax_4').length) {
                var value_5 = parseFloat($('#tax_4').val());
            } else {
                var value_5 = '0.00';
            }

            if ($('#tax_5').length) {
                var value_6 = parseFloat($('#tax_5').val());
            } else {
                var value_6 = '0.00';
            }

            var grand_tax_total = parseFloat(value_1) + parseFloat(value_2) + parseFloat(value_3) + parseFloat(value_4) + parseFloat(value_5) + parseFloat(value_6);

            bill_total = bill_total + grand_tax_total;

            sub_total = parseFloat(sub_total);
            sub_total = sub_total.toFixed(2);

            bill_total = parseFloat(bill_total);
            bill_total = bill_total.toFixed(2);
            $("#sub_total").val(sub_total);
            $("#bill_total").val(bill_total);
    //            $("#balance").val('0.00');
            getBalance();

        }
        function sumTotal() {
            var sub_total = 0;
            $('.total').each(function () {
                if ($(this).val() != '') {

                    sub_total = parseFloat(sub_total) + parseFloat($(this).val());
                }
            });

            sub_total = parseFloat(sub_total);
            sub_total = sub_total.toFixed(2);
            $("#sub_total").val(sub_total);
            $("#bill_total").val(sub_total);
            $("#discounted_price").val(sub_total);
            getBalance();

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
            paid_amount = parseFloat(paid_amount);
            paid_amount = paid_amount.toFixed(2);
            $('#paid_amount').val(paid_amount);
            var balance = parseFloat(bill_total) - parseFloat(paid_amount);

            balance = parseFloat(balance);
            balance = balance.toFixed(2);
            $('#balance').val(balance);
            getDiscount();
        }

        $('input.discount-price').on('change', function () {
            $('input.discount-price').not(this).prop('checked', false);
        });

        $('.dropdown-menu').click(function (e) {
            e.stopPropagation();
        });


        function payOrder(obj)
        {
            // var status_id = 1;
            var sub_total = $('#sub_total').val();
            if (parseFloat(sub_total) > 0) {
    //            AddCart();
                var p_am = '0.00';
                var balance = $('#balance').val();

                if (balance <= p_am)
                {
                    $('#save_form').attr('action', '<?= base_url('PointOfSale/payOrder/1') ?>');
                    $('#save_form').submit();
                } else
                {
                    alert('Amount Recieved Should be Equal or greater then balance.');
                    $('.paid_amt').focus();
                }
            } else {
                alert('Subtotal should not be zero');
            }

        }

        function UpdateOrder(obj)
        {
            $('#save_form').attr('action', '<?= base_url('PointOfSale/UpdateOrder/') ?>');
            $('#save_form').submit();
        }


    </script>


    <?php
}
?>



<!--model code for posting voucher start-->
<div class="modal fade" id="cancel-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL Invoice</h4>
            </div>
            <form method="post" action="<?= base_url('PointOfSale/cancelOrder/2'); ?>" >
                <div class="modal-body">
                    <input type="hidden" name="invoice_id" value="<?= $this->uri->segment(3); ?>" />

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
                    <button type="button" class="btn btn-default btn-flat  pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button type="submit" class="btn btn-flat btn-success">CANCEL PURCHASE</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>