<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$app_name = '';
$app_full_address = '';
$app_contact = '';
$app_email = '';
$bill_prefix = '';
$website = '';
$ntn = '';
if (!empty($currency_symbol)) {
    $app_name = $currency_symbol->app_name;
    $app_full_address = $currency_symbol->app_full_address;
    $app_contact = $currency_symbol->app_contact;
    $app_email = $currency_symbol->app_email;
    $bill_prefix = $currency_symbol->bill_prefix;
    $website = $currency_symbol->website;
    $ntn = $currency_symbol->ntn;
}

$vendor_id = '';
$purchase_date = '';
$voucher_no = '';
$additional_info = '';
$sub_total = '';
$bill_total = '';
$paid_amount = '0';
$balance = '';
$purchase_id = '';
$sales_status = '';
$is_ref = '';
$pur_ref_id = '';
$recent_paid_amount = '0';
$recent_balance = '0';
$post_status = '0';
$close_status = '0';
$is_invoice = '0';
$recipt_no = '';
$recipt_of = '';
$rec_amount = '0';
$is_ref = '1';
$receipt_date = '';
if (!empty($recipt_data)) {
    $recipt_no = $recipt_data->rec_id;
    $recipt_of = $recipt_data->inv_id;
    $rec_amount = $recipt_data->rec_amount;
    $receipt_date = date('F d Y', strtotime($recipt_data->created_date));
}
if (!empty($voucher_data)) {

    if (!empty($voucher_data['sales'])) {
        $customer_id = $voucher_data['sales']->sales_vendor_id;
        $date = DateTime::createFromFormat('Y-m-d', $voucher_data['sales']->sales_date);
        $sales_date = $date->format("m/d/Y");

        $voucher_no = $voucher_data['sales']->sales_id;
        $additional_info = $voucher_data['sales']->sales_additional_note;
        $bill_total = $voucher_data['sales']->sales_bill_total;
        $discounted_price = $voucher_data['sales']->sales_discounted_price;
        $sales_discount_off = $voucher_data['sales']->sales_discount_off;
        $sales_discount_type = $voucher_data['sales']->sales_discount_type;
        $sales_discount_value = $voucher_data['sales']->sales_discount_value;
//        $is_ref = $voucher_data['sales']->is_ref;
        $pur_ref_id = $voucher_data['sales']->sales_id;
        $post_status = $voucher_data['sales']->post_status;
        $close_status = $voucher_data['sales']->sale_closing_status;
        $is_invoice = $voucher_data['sales']->is_invoice;


        if ($is_ref == 1) {

            $total_paid_amount = $this->db->query('SELECT sum(`salpayment_amount`) as a FROM `sales_payment` WHERE salpayment_sales_id =' . $pur_ref_id . ' and sal_ref_id !=' . $voucher_no)->row();
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

        $recent_paid_amount = $rec_amount;
    }
}
?>
<script>
//window.print();
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> RECEIPT NUMBER # <?= $prefix ?> <?= $recipt_no ?>
                    <b class="pull-right">RECEIPT of INV #: <?= $recipt_of; ?></b>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From 
                <address>
                    <strong><?= $app_name; ?><br>
                        <?= $app_full_address; ?><br>
                        Phone : <?= $app_contact ?><br>
                        Email : <?= $app_email ?>
                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?= $voucher_data['sales']->user_fname . ' ' . $voucher_data['sales']->user_lname ?></strong><br>
                                <?= $voucher_data['sales']->user_address ?><br>
                                Phone : <?= $voucher_data['sales']->user_contact ?><br>
                                Email : <?= $voucher_data['sales']->user_email ?>
                            </address>

                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <?php if ($voucher_data['sales']->sales_status == 1): ?>
                                <address>
                                    <strong>Canceled Invoice</strong><br>
                                    <b>By : </b><?= $voucher_data['sales']->user_fname . ' ' . $voucher_data['sales']->user_lname ?><br>
                                    <b>Date :</b> <?= date('F d Y', strtotime($voucher_data['sales']->cancelation_date)) ?><br>
                                    <b>Reason :</b> <?= $voucher_data['sales']->cancel_reason ?>
                                </address>
                            <?php endif; ?>

                            <b>NTN :</b> <?= $ntn; ?><br>
                            <b>Website :</b> <?= $website; ?><br>
                            <b>Receipt Date :</b> <?= date('F d Y', strtotime($receipt_date)) ?><br>
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <br /><br />
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Product</th>
                                            <th>Serial #</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $subTotal = 0;
                                        $sno = 1;
                                        foreach ($voucher_data['items'] as $item):
                                            ?>
                                            <tr>
                                                <td><?= $sno ?></td>
                                                <td><?= $item->prd_title ?></td>
                                                <td><?= $item->prd_code ?></td>
                                                <td>
                                                    <span><?php
                                                        if (!empty($currency_symbol->symbol)) {
                                                            echo $currency_symbol->symbol;
                                                        }
                                                        ?></span>
                                                    <?= number_format($item->salitem_price, 2, '.', '') ?></td>
                                                <td><?= $item->salitem_qty . ' ( ' . $item->unit_name . ' ) ' ?></td>
                                                <td><?= number_format($item->salitem_price * $item->salitem_qty, 2, '.', '') ?></td>
                                            </tr>
                                            <?php
                                            $subTotal = $subTotal + ($item->salitem_price * $item->salitem_qty);
                                            $sno++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    NOTE : <?= $additional_info ?>
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <p class="lead">&nbsp;</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>
                                                <span><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?php
                                                $discount = 0;
                                                echo number_format($subTotal, 2, '.', '');
                                                ?></td>
                                        </tr>

                                        <?php
                                        if ($sales_discount_value != 0):
                                            if ($sales_discount_type == 'FLAT') {
                                                $discount = $sales_discount_value;
                                            } else {
                                                $discount = $subTotal / 100 * $sales_discount_value;
                                            }
                                            ?>
                                            <tr>
                                                <th>Discount <?php
                                                    if ($sales_discount_type == 'FLAT') {
                                                        echo '(' . $sales_discount_value . ')';
                                                    } else {
                                                        echo '(' . $sales_discount_value . '% )';
                                                    }
                                                    ?></th>
                                                <td><?= $discount ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        <?php
                                        $taxAmount = 0;
                                        $taxName = '';
                                        $count = 1;
                                        if (!empty($voucher_data['tax_history'])):

                                            foreach ($voucher_data['tax_history'] as $tax):
                                                if ($tax->tax_type == '%') {
                                                    $taxAmount = $taxAmount + ($subTotal / 100 * $tax->tax_on);
                                                } else {
                                                    $taxAmount = $taxAmount + $tax->tax_on;
                                                }

                                                if ($count < count($voucher_data['tax_history'])) {
                                                    $taxName .= $tax->tax_name . ' | ';
                                                } else {
                                                    $taxName .= $tax->tax_name;
                                                }

                                                $count++;
                                            endforeach;
                                            ?>
                                            <tr>
                                                <th>Tax (<?= $taxName ?>)</th>
                                                <td><?= $taxAmount ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <th>Total:</th>
                                            <td>
                                                <span><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= $subTotal - $discount + $taxAmount; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Recent Paid Amount:</th>
                                            <td>
                                                <span><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= number_format($recent_paid_amount, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Paid Amount:</th>
                                            <td>
                                                <span><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= number_format($paid_amount, 2); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Balance:</th>
                                            <td>
                                                <span><?php
                                                    if (!empty($currency_symbol->symbol)) {
                                                        echo $currency_symbol->symbol;
                                                    }
                                                    ?></span>
                                                <?= ($subTotal - $discount + $taxAmount) - $paid_amount; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        </section>
                        </div>




