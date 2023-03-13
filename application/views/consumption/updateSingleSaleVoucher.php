<style type="text/css">
    .m-r-10 {
        margin-right: 10px;
    }
    .tax {
        vertical-align: middle;
    }
    .tax-label, .tax-label label, .add-discount, .add-discount label {
        cursor: pointer;
    }
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$totalInvoicesAmount = 0;
$vendor_id = '';
$purchase_date = '';
$voucher_no = '';
$additional_info = '';
$sub_total = '';
$bill_total = '';
$paid_amount = '0.00';
$balance = '';
$purchase_id = '';
$sales_status = '';
$is_ref = '';
$pur_ref_id = '';
$recent_paid_amount = '0.00';
$recent_balance = '0.00';
$post_status = '0';
$close_status = '0';
$is_invoice = '0';
if (!empty($voucher_data)) {

    if (!empty($voucher_data['sales'])) {
        $customer_id = $voucher_data['sales']->sales_vendor_id;
        $date = DateTime::createFromFormat('Y-m-d', $voucher_data['sales']->sales_date);
        $sales_date = $date->format("m/d/Y");

        $voucher_no = $voucher_data['sales']->sales_id;
        $additional_info = $voucher_data['sales']->sales_additional_note;
        $bill_total = $voucher_data['sales']->sales_bill_total;
        $discounted_price = $voucher_data['sales']->sales_discounted_price;
        $sales_discount_off = number_format($voucher_data['sales']->sales_discount_off,2,'.','');
        $sales_discount_type = $voucher_data['sales']->sales_discount_type;
        $sales_discount_value = $voucher_data['sales']->sales_discount_value;
        $is_ref = $voucher_data['sales']->is_ref;
        $pur_ref_id = $voucher_data['sales']->sal_ref_id;
        $post_status = $voucher_data['sales']->post_status;
        $close_status = $voucher_data['sales']->sale_closing_status;
        $is_invoice = $voucher_data['sales']->is_invoice;


        if ($is_ref == 1) {
            $pay_history = $this->API_m->singleRecord('sales_payment', ['sal_ref_id' => $voucher_no]);
            $total_paid_amount = $this->db->query('SELECT sum(`salpayment_amount`) as a FROM `sales_payment` WHERE salpayment_sales_id=' . $pur_ref_id . ' and sal_ref_id !=' . $voucher_no)->row();
        }

        // print_r($discounted_price);die();

        $sales_id = $voucher_data['sales']->sales_id;
        $sales_status = $voucher_data['sales']->sales_status;
    }

    if (!empty($voucher_data['payment_history'])) {
        foreach ($voucher_data['payment_history'] as $pay_his) {
            $paid_amount = $paid_amount + $pay_his->salpayment_amount;
        }
    }

    if ($is_ref == 1) {

        $paid_amount = $total_paid_amount->a;

        $recent_paid_amount = $pay_history->salpayment_amount;
    }
}
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SALES BILL # <?= $prefix ?> <?= $voucher_no; ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="single-page-wrapper">
            <div class="row single-page-innerwrapper">
                <div class="">

                    <?php if ($sales_status == 1) { ?>
                        <h3 class="text-danger">INVOICE Canceled </h3>
                    <?php } ?>
                    <form method="post" action="<?= base_url('Sales/updateSalesVoucherData'); ?>">
                        <?php if ($is_ref == 1) { ?>
                            <h3>Reference of voucher.no: <b class="text-danger"><?= $pur_ref_id; ?></b></h3>
                        <?php } ?>
                        <div class="box-body">

                            <!--model tags end here-->
                            <!--model code for posting voucher start-->
                            <div class="modal modal-primary fade" id="modal-primary">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">RECEIVE IN</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Date</label>
                                                    <input type="text" name="payment_in" id="" class="currentdatepicker form-control" />
                                                </div>
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

                                            <button class="btn btn-btn btn-outline"> SAVE VOUCHER</button>
                                        </div>

                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            <!--model tags end here-->


                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="2">                 <div class="input-group form-group" style="width:100%;">
                                                <span class="input-group-addon"><i class="fa fa-user"></i> <b>CUSTOMER</b></span>
                                                <input type="text" class="form-control" name="vendor_id" required value="<?= $customer_id ?>" <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>
                                                <input type="hidden" name="sales_id" value="<?= $sales_id ?>">
                                                <input type="hidden" value="<?= $post_status; ?>" name="post_status" />
                                                <!--<input type="hidden" name="sales_payment_id" value="<? $voucher_data['payment_history'][0]->salpayment_id ?>">-->

                                            </div></th>
                                        <th colspan="2">
                                            <div class="input-group form-group" style="width:100%;">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i> <b>SALES DATE</b></span>
                                                <input type="text" class="form-control" id="datepicker" name="sales_date" value="<?= $sales_date ?>" required <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>

                                            </div>
                                        </th>
                                        <th>
                                            <div class="input-group form-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i> <b>SALES NO</b></span>
                                                <input type="text" class="form-control" name="voucher_no" value="<?= $voucher_no; ?>" readonly required>

                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                            </table>
                            <div class="row">
                                <div class="col-md-9">
                                    <table class="table table-condensed" id="table1">
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

                                            <?php
                                            if (!empty($voucher_data)) {
                                                if (!empty($voucher_data['items'])) {
                                                    foreach ($voucher_data['items'] as $x => $item) {
                                                        ?>
                                                        <tr>
                                                            
                                                               <td>
                                                                <div class="form-group">
                                                                                <select class="form-control select2 code" name="item[<?= $x ?>][prd_id]" onchange="getProductDetail(this.value, 'prd_id', this);" style="width: 100%;">

                                                                                    <option value="">Select Product</option>
                                                                                    <?php foreach ($products as $product): ?>
                                                                                    <option <?php if($product->prd_id == $item->salitem_item_id): ?> selected="" <?php endif; ?> value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group form-group">
                                                                    <input type="text" name="code[]" readonly="" class="form-control code" value="<?= $item->prd_code; ?>" <?php if ($post_status == 0) { ?> onblur="getProductDetail(this.value, 'prd_code', this);" <?php } ?> <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>
                                                                    <input type="hidden" name="prd_id[]" class="form-control pur_id" value="<?= $item->prd_id ?>">
                                                                    <input type="hidden" name="salitem_id[]" class="form-control salitem_id" value="<?= $item->salitem_id ?>">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group input-group">
                                                                    <input type="text" class="form-control quantity" name="quantity[]" value="<?= $item->salitem_qty; ?>" <?php if ($post_status == 0 || $is_invoice > 0) { ?> onblur="multiplyPrice(this);" <?php } ?> <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>
                                                                    <span class="input-group-addon unit"><?= $item->unit_name; ?></span>
                                                                    <input type="hidden" name="unit[]" value="<?= $item->unit_id; ?>" class="unit_id" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group input-group">
                                                                    <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                                                    <input type="text" class="form-control price" name="price[]" value="<?= $item->salitem_price; ?>" onblur="multiplyPrice(this);" <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group input-group">
                                                                    <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
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
                                                <?php } ?>
                                            <?php } ?>
                                            <?php if ($is_ref != 1) { ?>
                                                <?php if ($is_invoice == 0) { ?> 
                                                    <?php if ($post_status == 0) { ?> 
                                                        <?php if ($sales_status != 1) { ?>
                                                            <tr>
                                                                             <td>
                                              <div class="form-group">
                                                  <select class="form-control select2" name="prd_id[]" onchange="getProductDetail(this.value, 'prd_id', this);" style="width: 100%;">
                  
                                                      <option value="">Select Product</option>
                                                      <?php foreach($products as $product): ?>
                  <option value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
<!--                                            <div class="form-group">
                                                <input type="text"  class="form-control item" >
                                            </div>-->
                                        </td>
                                                                     <td><div class="form-group input-group"><input type="text" readonly="" name="code[]" class="form-control code" >
                                                                   </div></td>
                                                               <td>
                                                                    <div class="form-group input-group">
                                                                        <input type="text" class="form-control quantity" name="quantity[]" onblur="multiplyPrice(this);">
                                                                        <span class="input-group-addon unit"></span>
                                                                        <input type="hidden" name="unit[]" class="unit_id" />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group input-group">
                                                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                                                        <input type="text" class="form-control price" name="price[]" onblur="multiplyPrice(this);">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-group input-group">
                                                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                                                        <input type="text" class="form-control total" name="total[]" value="0" readonly>
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
                                                                            <input type="hidden" class="discountValue" name="discountValue[]">
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <label>ADDITIONAL INFORMATION</label>
                                                    <textarea class="form-control" name="additional_info" <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>><?= $additional_info ?></textarea>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <?php if ($is_ref != 1) { ?>
                                                        <?php if ($post_status == 1) { ?>
                                                            <?php if ($sales_status != 1) { ?>
                                                                <?php if ($close_status != 1) { ?>
                                                                    <div class="input-group form-group pull-right" style="width:50%;">
                                                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                                                
                                                                        <input type="text" class="form-control" id="receive_payment" name="receive_payment" value="<?= $recent_paid_amount; ?>" <?php if ($is_ref == 1) { ?>disabled<?php } ?>>
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-success btn-flat" onclick="openModal2();" >Receive Payment</button>
                                                                        </span>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } else { ?>
                                                            <?php if ($sales_status == 0) { ?>
                                                                <?php if ($is_invoice == 0) { ?>
                                                                    <button class="btn btn-success btn-flat noReceive"><i class="fa fa-edit"></i> UPDATE QUOTATION</button>
                                                                    <a href="<?= base_url('Sales/changeStatusToInvoice/' . $voucher_no); ?>"  class="btn btn-flat btn-warning" onclick="return confirm('Do you want to create invoice?')">CREATE INVOICE</a>
                                                                <?php } ?>
                                                                <button type="button" class="btn btn-flat btn-info" onclick="openModal();">CREATE & POST INVOICE</button>
                                                                <?php if ($is_invoice == 0) { ?>
                                                                    <button type="button" onclick="openCancelModal();" class="btn btn-flat btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                                    <a href="<?= base_url('Sales/print_bill/'.$voucher_no); ?>" class="btn bg-purple btn-flat"><i class="fa fa-print"></i> Print</a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <?php if ($is_ref == 1) { ?>
                                                    <th colspan="3">&nbsp;</th>
                                                    <th class="text-right ">Current Balance</th>
                                                    <th>
                                                        <div class="input-group noReceive">
                                                            <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                                            <input type="number" class="form-control" id="rec_balance" value="<?= $recent_balance; ?>" <?php if ($is_ref == 1) { ?>disabled<?php } ?> > 
                                                        </div>   
                                                    </th>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <th colspan="5">
                                                    <?php if ($is_ref != 1) { ?>
                                                        <?php if ($post_status > 0) { ?>
                                                            <label>PAYMENT HISTORY (Partial Invoice)</label>
                                                            <table class="table table-bordered table-hover table-striped">
                                                                <thead>
                                                                <th>INVOICE #</th>
                                                                <th>DATE</th>
                                                                <th>PAID AMOUNT</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    
                                                                    if (!empty($voucher_data['payment_history'])) {
                                                                        foreach ($voucher_data['payment_history'] as $pay) {
                                                                            $date = DateTime::createFromFormat('Y-m-d', $pay->salpayment_date);
                                                                            $his_date = $date->format("F d Y");
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $pay->sal_ref_id; ?></td>
                                                                                <td><?= $his_date; ?></td>
                                                                                <td><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?> <?= number_format($pay->salpayment_amount,2,'.',''); ?></td>
                                                                            </tr>
                                                                            <?php
                                                                            
                                                                            $totalInvoicesAmount = $totalInvoicesAmount + $pay->salpayment_amount;
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th>Total</th>
                                                                        <td></td>
                                                                        <td><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?> <?= number_format($totalInvoicesAmount,2,'.',''); ?></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </th>
                                            </tr>

                                        </tfoot>
                                    </table>  
                                </div>
                                <div class="col-md-3">
                                    <label>SUBTOTAL</label>
                                    <div class="form-group input-group">

                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                        <input type="text" class="form-control" name="sub_total" id="sub_total" value="0.00" required readonly>
                                    </div>  
                                    <label>DISCOUNT</label>
                                     <div class="form-group input-group">
                                         <input type="text" id="" name="discount_value" class="form-control discount-price" value="<?= number_format($sales_discount_value,2,'.','') ?>" <?php if ($is_ref == 1 || $sales_status == 1) { ?> disabled <?php } ?> <?php if ($post_status > 0 || $is_invoice > 0) { ?> readonly <?php } ?>>
                                        
                                        <span class="input-group-addon">
                                        <input type="radio" class="discount_type" name="discount_type"  value="FLAT" <?= ($sales_discount_type == 'FLAT' || $sales_discount_type == 0) ? 'checked' : '' ?> > FLAT
                                        </span>
                                        <span class="input-group-addon">
                                         <input type="radio" class="discount_type" name="discount_type"  value="%" <?= ($sales_discount_type == '%') ? 'checked' : '' ?>> PERCENT
                             
                                         </span>
                                        
                                        
                                        
                                        <!-- /btn-group -->
                                    </div><!-- /input-group -->
                                    <input type="hidden" name="discountValue" id="discount" value="<?= $sales_discount_value ?>">
                                    <input type="hidden" name="discountType" id="discountType" value="<?= $sales_discount_type ?>">
                                    <input type="hidden" name="discountOff" id="discountOff" value="<?= $sales_discount_off ?>">
                                    <label>DISCOUNTED PRICE</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                        <input type="text" class="form-control" id="discounted_price" required name="discounted_price" value="<?= $discounted_price ?>" readonly>
                                    </div>
                                    <?php foreach ($taxes as $key => $tax) { ?>

                                        <label><?= strtoupper($tax->tax_title) ?></label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><input <?php if ($post_status > 0 || $sales_status == 1 || $is_invoice > 0) { ?> disabled <?php } ?> type="checkbox" class="tax-checkbox-<?= $key ?>"  <?= (isset($voucher_data['tax_history'][$key]) && $voucher_data['tax_history'][$key]->tax_name == $tax->tax_title) ? 'checked=true' : '' ?> onchange="getTax(this);" value="<?= $tax->tax_value ?>-<?= ($tax->tax_type == 0) ? 'FLAT' : '%' ?>-<?= $key ?>-<?= $tax->tax_title ?>"></span>
                                            <input type="text" class="form-control" id="tax_<?= $key ?>"  name="taxes_value[]?>" value="<?= (isset($voucher_data['tax_history'][$key])) ? number_format($voucher_data['tax_history'][$key]->tax_value,2,'.','') : '0.00'; ?>" readonly>
                                            <input type="hidden" id="taxType<?= $key ?>"  name="taxes_type[]?>" value="<?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_type : '' ?>"> 
                                            <input type="hidden" id="taxTitle<?= $key ?>"  name="taxes_title[]?>" value="<?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_name : '' ?>">
                                            <input type="hidden" id="taxOn<?= $key ?>"  name="taxes_on[]?>" value="<?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_on : 0 ?>">
                                            <input type="hidden" id="taxId<?= $key ?>"  name="taxes_id[]?>" value="<?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_amount_id : '' ?>">
                                            <span class="input-group-addon" id="addonTax<?= $key ?>"><?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_on : '' ?> <?= (isset($voucher_data['tax_history'][$key])) ? $voucher_data['tax_history'][$key]->tax_type : '' ?></span>
                                        </div>     

                                    <?php } ?>
                                    <label>GRAND TOTAL</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                        <input type="text" class="form-control" id="bill_total" required name="bill_total" value="<?= number_format($bill_total,2,'.','') ?>" readonly>
                                    </div>  
                                    <label>PAID AMOUNT</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                        <input type="text" class="form-control" id="paid_amount" required name="paid_amount" value="<?= number_format($totalInvoicesAmount,2,'.','') ?>" onblur="getAllBalance();" readonly>
                                    </div> 
                                    <label>BALANCE</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span>
                                        <input type="text" class="form-control" id="balance" name="balance" value="0.00" readonly> 
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
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
                    $('.produtSalesOrderRow').each(function(){ count++; });
                    
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

                        $('#table1 >tbody >  tr').find('td:nth-child(2) input').each(function () {

                            var cellText = $(this).val();
//                        alert(cellText);
                            if (cellText == '') {
                                a = a + 1;
                            }

                        });
                        if (a == 0) {
                            $('#table1 > tbody ').append('<tr class="produtSalesOrderRow"><td><div class="form-group input-group" ><select class="form-control select2" name="prd_id[]" onchange="getProductDetail(this.value, ' + "'prd_id'" + ', this);"><option value="">Select Product</option><?php foreach ($products as $product): ?><option value="<?= $product->prd_id ?>"><?= $product->prd_title ?></option><?php endforeach; ?></select></div></td><td><input type="text" readonly="" class=" form-control code" /></td><td><div class="form-group input-group"><input type="text" class="form-control quantity" name="item[' + count + '][quantity]" onblur="multiplyPrice(this);"><span class="input-group-addon unit"></span><input type="hidden" name="item[' + count + '][unit]" class="unit_id" /></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span><input type="text" class="form-control price" name="item[' + count + '][price]" onblur="multiplyPrice(this);"></div></td><td><div class="form-group input-group"><span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ ?><?= $currency_symbol->symbol; ?><?php } ?></span><input type="text" class="form-control total" name="total[]" readonly></div></td></tr>');
                            $('.select2').each(function(){ $(this).select2(); });
                        }
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
                    $('#taxId' + taxString).val(taxValue);

                    var taxT = (taxType == 'FLAT') ? taxValue : (parseFloat($('#discounted_price').val()) * taxValue / 100);

                    tax_total = (taxT) ? taxT : 0;

                }

            });

            $('#tax_' + taxString).val(parseFloat(tax_total).toFixed(2));
            sumAllTotal();

        } else {


            $('.code').each(function () {

                if ($(this).val() != '') {

                    var row = $(this).closest('tr');
                    row.find('.tax-' + taxString.toLowerCase()).val("");

                }

            });

            $('#tax_' + taxString.toLowerCase()).val("0");
            $('#addonTax' + taxString).text("");
            $('#taxTitle' + taxString).val("");
            $('#taxType' + taxString).val("");
            $('#taxOn' + taxString).val("");
            $('#taxId' + taxString).val("");
            sumAllTotal();

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

                $('.code').each(function () {
                    if ($(this).val() != '') {
                        var row = $(this).closest('tr');
                        row.find('.discountValue').val(discountPrice);

                        var discountPrice = (discountType == 'flat') ? parseFloat(discount) : (parseFloat(sub_total) * parseFloat(discount) / 100);
                        discount_total = (discountPrice) ? discountPrice : 0;

                        $('#discount').val(parseFloat(discount_total).toFixed(2));
                        $('#discountType').val(discountType);
                        $('#discountOff').val(parseFloat(discount).toFixed(2));
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
        if ($qty.trim() != '') {
            var quantity = $(obj).parent().parent().parent().find('.quantity').val();
            var price = $(obj).parent().parent().parent().find('.price').val();
            var total = parseFloat(quantity) * parseFloat(price);
            $(obj).parent().parent().parent().find('.total').val(parseFloat(total).toFixed(2));
            var discounted_price = parseFloat($('#discounted_price').val());
            sumTotal();
            // getBalance();

            $(obj).closest('tr').find('.add-tax-g').addClass('hide');
            $(obj).closest('tr').find('.add-tax-s').addClass('hide');

        }
        $('.discount-price').trigger('keyup');
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

        $("#discounted_price").val(parseFloat(discounted_price).toFixed(2) );

        bill_total = parseFloat(bill_total) + parseFloat(discounted_price);


        if ($('#tax_0').length && $('#tax_0').val() != 0) {

            var tax0 = parseFloat($('#taxOn0').val());
            var taxType0 = $('#taxType0').val();

            if (taxType0 == 'FLAT') {
                var tax_0 = tax0;
            } else {
                var tax_0 = (parseFloat($('#discounted_price').val()) * tax0 / 100);
            }

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

            $('#tax_1').val(parseFloat(tax_1).toFixed(2));

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

            $('#tax_2').val(tax_2);

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
            var tax_3 = '0.00';
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
            var tax_4 = '0.00';
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

        $("#bill_total").val(parseFloat(bill_total).toFixed(2));
        $("#balance").val(parseFloat(bill_total).toFixed(2));
         sumAllTotal();
    }


    function resetDiscount(obj) {
        var sub_total = 0;
        var bill_total = 0;
        var grand_tax_total = 0;
        var row = $(obj).closest('div');
        row.find('.discount-price').prop('checked', false);

        $('.code').each(function () {
            if ($(this).val() != '') {
                var row = $(this).closest('tr');
                row.find('.discountValue').val("");
            }
        });

        discount_total = 0;
        $('#discount').val(discount_total);
        $('#discounted_price').val($('#sub_total').val());

        var discounted_price = parseFloat($('#sub_total').val());

        bill_total = parseFloat(bill_total) + parseFloat(discounted_price);


        if ($('#tax_0').length && $('#tax_0').val() != 0) {

            var tax0 = parseFloat($('#taxOn0').val());
            var taxType0 = $('#taxType0').val();

            if (taxType0 == 'FLAT') {
                var tax_0 = tax0;
            } else {
                var tax_0 = (parseFloat($('#discounted_price').val()) * tax0 / 100);
            }

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

            $('#tax_2').val(tax_2);

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
            var tax_3 = '0.00';
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
            var tax_4 = '0.00';
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

        $("#bill_total").val(parseFloat(bill_total).toFixed(2));
        var balance = $('#bill_total').val() - $('#paid_amount').val();
        $("#balance").val(parseFloat(balance).toFixed(2));
        // sumAllTotal();
    }

    function sumAllTotal() {
        var sub_total = 0;
        var bill_total = 0;
        var discounted_price = $('#discounted_price').val();


        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = parseFloat(sub_total) + parseFloat($(this).val());

            }
        });

        bill_total = parseFloat( bill_total) + parseFloat(discounted_price);

        if ($('#tax_0').length && $('#tax_0').length != "") {
            var value_1 = parseFloat($('#tax_0').val());
        } else {
            var value_1 = '0.00';
        }

        if ($('#tax_1').length && $('#tax_1').length != "") {
            var value_2 = parseFloat($('#tax_1').val());
        } else {
            var value_2 = '0.00';
        }

        if ($('#tax_2').length && $('#tax_2').length != "") {
            var value_3 = parseFloat($('#tax_2').val());

        } else {
            var value_3 = '0.00';
        }

        if ($('#tax_3').length && $('#tax_3').length != "") {
            var value_4 = parseFloat($('#tax_3').val());
        } else {
            var value_4 = '0.00';
        }

        if ($('#tax_4').length && $('#tax_4').length != "") {
            var value_5 = parseFloat($('#tax_4').val());
        } else {
            var value_5 = '0.00';
        }

        if ($('#tax_5').length && $('#tax_5').length != "") {
            var value_6 = parseFloat($('#tax_5').val());
        } else {
            var value_6 = '0.00';
        }

        var grand_tax_total = value_1 + value_2 + value_3 + value_4 + value_5 + value_6;

        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);

        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(bill_total).toFixed(2));
        var balance = parseFloat($('#bill_total').val()) - parseFloat($('#paid_amount').val());
        $("#balance").val(parseFloat(balance).toFixed(2));

    }
    function sumTotal() {
        var sub_total = 0;
        var discount_total = 0;
        var bill_total = 0;
        var grand_tax_total = 0;
        $('.total').each(function () {
            if ($(this).val() != '') {

                sub_total = parseFloat(sub_total) + parseFloat($(this).val());
            }
        });


        $("#sub_total").val(parseFloat(sub_total).toFixed(2));
        $("#bill_total").val(parseFloat(sub_total).toFixed(2));
        $("#discounted_price").val(parseFloat(sub_total));

        var discount = parseFloat($('#discountPrice').val());
        var discountType = $('#discountType').val();

        var discountPrice = (discountType == 'FLAT') ? parseFloat(discount) : (parseFloat(sub_total) * parseFloat(discount) / 100);
        discount_total = (discountPrice) ? discountPrice : 0;

        $('#discounted_price').val(sub_total - discount_total);
        var discounted_price = $('#discounted_price').val();

        bill_total = bill_total + parseFloat(discounted_price);


        if ($('#tax_0').length && $('#tax_0').val() != 0) {

            var tax0 = parseFloat($('#taxOn0').val());
            var taxType0 = $('#taxType0').val();

            if (taxType0 == 'FLAT') {
                var tax_0 = tax0;
            } else {
                var tax_0 = (parseFloat(discounted_price) * tax0 / 100);
            }

            $('#tax_0').val(tax_0);

        } else {
            var tax_0 = 0;
            $('#tax_0').val(tax_0);
        }

        if ($('#tax_1').length && $('#tax_1').val() != 0) {

            var tax1 = parseFloat($('#taxOn1').val());
            var taxType1 = $('#taxType1').val();

            if (taxType1 == 'FLAT') {
                var tax_1 = tax1;
            } else {
                var tax_1 = (parseFloat(discounted_price) * tax1 / 100);

            }

            $('#tax_1').val(tax_1);

        } else {
            var tax_1 = 0
            $('#tax_1').val(tax_1);
        }

        if ($('#tax_2').length && $('#tax_2').val() != 0) {
            var tax2 = parseFloat($('#taxOn2').val());
            var taxType2 = $('#taxType2').val();

            if (taxType2 == 'FLAT') {
                var tax_2 = tax2;
            } else {
                var tax_2 = (parseFloat(discounted_price) * tax2 / 100);
            }

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
                var tax_3 = (parseFloat(discounted_price) * tax3 / 100);
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
                var tax_4 = (parseFloat(discounted_price) * tax4 / 100);
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
                var tax_5 = (parseFloat(discounted_price) * tax5 / 100);
            }

            $('#tax_5').val(tax_4);

        } else {
            var tax_5 = 0
            $('#tax_5').val(tax_5);
        }

        grand_tax_total = tax_0 + tax_1 + tax_2 + tax_3 + tax_4 + tax_5;

        bill_total = parseFloat(bill_total) + parseFloat(grand_tax_total);

        $("#bill_total").val(bill_total);

        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();

        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $("#balance").val(parseFloat(balance).toFixed(2));

    }
    function getBalance() {
        var sub_total = $('#sub_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(sub_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
        $('#receive_payment').attr('max', balance);
    }

    function getAllBalance() {
        var bill_total = $('#bill_total').val();
        var paid_amount = $('#paid_amount').val();
        var balance = parseFloat(bill_total) - parseFloat(paid_amount);
        $('#balance').val(parseFloat(balance).toFixed(2));
        $('#receive_payment').attr('max', balance);
    }

    $('input.discount-price').on('change', function () {
        $('input.discount-price').not(this).prop('checked', false);
    });

    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });

    $(document).ready(function () {

        var sub_total = 0;

        $('#table1 > tbody > tr').each(function () {

            var qty = $(this).find('.quantity').val();
            var price = $(this).find('.price').val();
            if (qty == '') {
                qty = 0;
            }
            if (price == '') {
                price = 0;
            }
            var priceQty = qty * price;

            $(this).find('.total').val(priceQty);
            sub_total = sub_total + parseFloat(priceQty);
        });

        var balance = $('#bill_total').val() - $('#paid_amount').val();
        $('#balance').val(parseFloat(balance).toFixed(2));
        $('#sub_total').val(parseFloat(sub_total).toFixed(2));
        $('#receive_payment').attr('max', parseFloat(balance).toFixed(2));


        var status = '<?= $is_ref; ?>';
        if (status == 1) {
            var rec = $('#receive_payment').val();
            var sum = parseInt(balance) - parseFloat(rec);
            $('#rec_balance').val(sum);
        }

    });

    function openModal() {
        var subtotal = $('#sub_total').val();

        var discountedPrice = $('#discounted_price').val();
        var discountAllowed = subtotal - discountedPrice;

        var billTotal = $('#bill_total').val();

        var tax = billTotal - discountedPrice;

        var paidAmt = $('#paid_amount').val();
        var balance = $('#balance').val();
        var voucherDate = $('#datepicker').val();


        $('#sales_amt').val(subtotal);
        $('#paid_amt').val(paidAmt);
        $('#account_receivable').val(balance);
        $('#discount_allowed').val(discountAllowed);
        $('#tax_payable').val(tax);
        $('#voucher_date').val(voucherDate);

        $('#paid_amt').attr('max', balance);

        $('#modal-danger').modal('show');
    }
    var blance_message = 0;
    function openModal2() {
        var subtotal = $('#sub_total').val();
        var paidAmt = $('#paid_amount').val();
        var balance = parseFloat($('#balance').val());
        var recievedPayment = parseFloat($('#receive_payment').val());
        if(recievedPayment > balance || recievedPayment < 0)
        {
            
            if(blance_message == 0)
            {
                blance_message = 1;
                 $('#receive_payment').parent().parent().append('<span style="line-height:50px;" class="pull-right blanceMSG">required blance is '+balance+'&nbsp;&nbsp;&nbsp;</span>');
            }
           $('#receive_payment').parent().css('border','1px solid red');
        }
        else
        {
         blance_message = 0;
        $('#receive_payment').parent().parent().find('.blanceMSG').text(' ');
        $('#receive_payment').parent().css('border','');
        $('#purchase_amt2').val(subtotal);
        $('#paid_amt2').val(paidAmt);
        $('#libility2').val(balance);
        $('#modal-primary').modal('show');
        }
    }
    function openCancelModal() {
        $('#cancel_modal').modal('show');
    }

$(document).on('keyup','.discount-price',function(){
    var value = parseFloat($(this).val());
    var sub_total = parseInt($('#sub_total').val());
//    alert(sub_total);
    if(!isNaN(value))
    {
        var amount = 0;
        var type = '';
        $('.discount_type').each(function(){
           if($(this).is(':checked') == true)
           {
             if($(this).val() == '%')
            {
                type = '%';
                amount = (sub_total / 100) * value;
            }
            else if($(this).val() == 'FLAT')
            {
                type = 'FLAT';
                amount = value;
            }
           }
        });
        var dicounted_amount =  sub_total - amount;
        $('#discounted_price').val(dicounted_amount);
        $('#discount').val(amount);
        $('#discountType').val(type);
        $('#discountOff').val(amount);
         
    }
    else
    {
        $('#discounted_price').val(sub_total);
        $('#discount').val(0);
        $('#discountType').val('');
        $('#discountOff').val(0);
    }
    
    sumDiscountTotal();
      
});





$(document).on('click','.discount_type',function(){
    var value = parseFloat($('.discount-price').val());
    var sub_total = parseInt($('#sub_total').val());
    if(!isNaN(value))
    {
        var amount = 0;
        var type = '';
  
             if($(this).val() == '%')
            {
                type = '%';
                amount = (sub_total / 100) * value;
            }
            else if($(this).val() == 'FLAT')
            {
                type = 'FLAT';
                amount = value;
            }
        var dicounted_amount =  sub_total - amount;
        $('#discounted_price').val(dicounted_amount);
        $('#discount').val(amount);
        $('#discountType').val(type);
        $('#discountOff').val(amount);
         
    }
    else
    {
        $('#discounted_price').val(sub_total);
        $('#discount').val(0);
        $('#discountType').val('');
        $('#discountOff').val(0);
    }
    
    sumDiscountTotal();
      
});

   $(document).on('blur','#paid_amt',function(){ $('#paid_amt').val(parseFloat($(this).val()).toFixed(2)); });

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
<div class="modal modal-default fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Important! Once it is Posted then you will not  be able to cancel it.</h4>
            </div>
            <form method="post" action="<?= base_url('Sales/postSaleVoucher'); ?>">
                <input type="hidden" name="sales_id" value="<?= $sales_id; ?>" />

                <input type="hidden" name="sales_amt" id="sales_amt" />
                <input type="hidden" name="voucher_date" id="voucher_date" />

                <input type="hidden" name="account_receivable" id="account_receivable" />
                <input type="hidden" name="discount_allowed" id="discount_allowed" />
                <input type="hidden" name="tax_payable" id="tax_payable" />
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
                    <?php if(!empty($currency_symbol)){ echo $currency_symbol->symbol; } ?>
                  </div>
                            <input type="number" name="paid" id="paid_amt" class="form-control" min="0" max="0" step="any" />
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
                    <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-flat btn-success"> POST INVOICE</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<!--model code for posting voucher start-->
<div class="modal fade" id="cancel_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL VOUCHER</h4>
            </div>
            <form method="post" action="<?= base_url('Sales/deleteSaleVoucher'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="sale_id" value="<?= $sales_id; ?>" />

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
                    <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-btn btn-success btn-flat">CANCEL VOUCHER</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>