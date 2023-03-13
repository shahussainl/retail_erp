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
</style>
<?php
$res = '';


$res = $this->Purchase_m->singleRecordByName('users', ['user_id' => $created_by_id]);
$res2 = $this->Purchase_m->singleRecordByName('users', ['user_id' => $vendor_id]);

// echo "<pre>";
// print_r($res->user_fname);
//$fromName = $res->user_fname.' '.$res->user_lname;
//$toName   = $user_fname;
// exit;
?>
<script>
window.print();
</script>
<!-- Content Wrapper. Contains page content -->
<!-- Order Invovice start -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="invoice">
        <div class="row">
         <div class="col-md-12 text-center">
             <h2><b style="border-bottom: 3px solid #3a4c5a;">INVOICE</b></h2>
         </div>
     </div>
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <p class="page-header">
                    Purchase NO:  <?= $prefix ?> <?= $purchase_number ?>
                    <small class="pull-right">Date: <?= date('F d Y', strtotime($purchase_date)) ?></small>
                </p>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->

        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.no</th>
                            <th>Code #</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <!--<th>Description</th>-->
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sno = 1;
                        $itmNo = 0;
                        $itmQty = 0;
                        $Subtotal = 0;
                        $paidAmount = 0;
                        if (!empty($purchase_data)) {
                            foreach ($purchase_data['items'] as $x => $pro_d) {
                                $total = 0;
                                $total += $pro_d->puritem_qty * $pro_d->puritem_price;
                                $Subtotal += $total;
                                $itmNo = $sno;
                                $itmQty += $pro_d->puritem_qty;
                                ?>
                                <tr>
                                    <td><?= $sno; ?></td>
                                    <td><?= $pro_d->prd_code; ?></td>
                                    <td><?= $pro_d->prd_title; ?></td>
                                    <td>
                                        <span> <?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                        <?= number_format($pro_d->puritem_price, 2); ?></td>
                                    <td><?= $pro_d->puritem_qty; ?></td>
                                    <!--<td><?= $pro_d->prd_desc; ?></td>-->
                                    <td class="text-right">
                                        <span> <?php
                                            if (!empty($currency_symbol->symbol)) {
                                                echo $currency_symbol->symbol;
                                            }
                                            ?></span>
                                        <?= number_format($total, 2); ?></td>

                                </tr>
                                <?php
                                $sno++;
                            }
                        } else {
                            echo "No Record Available!";
                        }
                        ?>
                    </tbody>
                    <thead>
                        <tr>
                            <td class="text-right" colspan="5">
                                <label>GRAND TOTAL</label>
                            </td>
                            <td class="text-right"><b><?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                    <?= number_format($Subtotal, 2) ?></b></td>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <table class="table table-bordered">
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>Payment</th>

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
                        <td colspan="2" class="text-right"><b>Total</b></td>
                        <td><?php
                            if (!empty($currency_symbol->symbol)) {
                                echo $currency_symbol->symbol;
                            }
                            ?> <?= number_format($totalPayment, 2); ?></td>
                    </tr>
                </table>

                <?php if ($note != ''): ?>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <?= $note ?>
                    </p>
                <?php endif; ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <!--<p class="lead">&nbsp;</p>-->

                <div class="table-responsive">
                    <table class="table table-bordered">

                        <tr>
                            <th class="text-right">Bill Total:</th>
                            <td class="text-right">
                                <span> <?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <?php
                                if (!empty($purchase_data)) {
                                    echo number_format($bill_total, 2);
                                }
                                ?></td>
                        </tr>
                        <tr>
                            <th class="text-right" style="width:50%">Paid Amount:</th>
                            <td class="t_price text-right">
                                <span> <?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <?= number_format($totalPayment, 2); ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Balance:</th>
                            <td class="text-right">
                                <span> <?php
                                    if (!empty($currency_symbol->symbol)) {
                                        echo $currency_symbol->symbol;
                                    }
                                    ?></span>
                                <?php
                                $blance = 0;
                                if (!empty($purchase_data)) {
                                    $blance = $Subtotal - $totalPayment;
                                    echo number_format($blance, 2);
                                }
                                ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
            
        <!-- this row will not appear when printing -->
        <div class="col-xs-6">
            <p class="no-shadow text-right">
                <?php if (!empty($purchase_data['purchase']->cancel_reason)): ?>
                <address>
                    <strong>Canceled Invoice</strong><br>

                    <b>Date :</b> <?= $Canceldate ?><br>
                    <b>Reason :</b> <?= $cancelReason; ?>
                </address>
            <?php endif; ?>
            </p>
        </div>
        </div>
        <!-- /.row -->

        <p class="text-center">
          <?php $user = $this->db->where('user_id',$this->session->userdata('user')['user_id'])->get('users')->row(); ?>
          print on: <?= date('M d Y - h:i:sa'); ?> by  <?php if(!empty($user)){ echo $user->user_fname.' '.$user->user_lname; } ?>
          <br>
          <span class="text-red"> * This is computer generated payment voucher and does not need any signature or stamp</span>
      </p> 
    </section>
    
    <button onclick="window.print();" class="btn btn-flate btn-default col-md-offset-5 col-md-2 btn-print">PRINT</button>
    <!-- /.content -->
    <div class="clearfix"></div>
</div>

<!-- /.content-wrapper -->

<!-- ./Order Invoice End -->



