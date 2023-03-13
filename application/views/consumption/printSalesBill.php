<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$app_name = '';
$app_full_address = '';
$app_contact = '';
$app_email = '';
$bill_prefix = '';
$website = '';
$ntn = '';
if(!empty($currency_symbol)){
    $app_name = $currency_symbol->app_name;
    $app_full_address = $currency_symbol->app_full_address;
    $app_contact = $currency_symbol->app_contact;
    $app_email = $currency_symbol->app_email;
    $bill_prefix = $currency_symbol->bill_prefix;
    $website = $currency_symbol->website;
    $ntn = $currency_symbol->ntn;
}

?>    <!-- Content Wrapper. Contains page content -->
<script>
window.print();
</script>

<style>
#Header, #Footer { display: none !important; }
  .invoice {
    border: 0px solid #f4f4f4;
    padding: 0px;
}  
@media print {
    .invoice {
        font-size:12px !important;
        padding-top: 100px;
        width: 90%;
        margin: 0 auto;
    }
        .half-table{
         width:49%;
        
        }
        
        .table-float-right{
            float:right; 
        }
         .table-float-left{
           float:left;  
        }
        table,td,th,label{
         font-size:12px !important;   
        }
 
      }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <!-- Main content -->
 <section class="invoice">
     <div class="row">
         <div class="col-md-12 text-center">
             <h2><b style="border-bottom: 3px solid #3a4c5a;">INVOICE</b></h2>
         </div>
     </div>
      <div class="row">
        <div class="col-xs-12">
          <p class="page-header">
             INV NO: <?= $prefix ?>-INV-<?= $salesInfo['single_order']->sales_number ?>
            <small class="pull-right">Date: <?= date('F d Y', strtotime($salesInfo['single_order']->sales_created_date)); ?></small>
          </p>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row">
        <div class="col-sm-4 invoice-col">
          <label>Payee: <b><?= $salesInfo['to']->user_fname.' '.$salesInfo['to']->user_lname ?></b></label>
        </div>
           <div class="col-sm-8 invoice-col">
           <label>The Sum Of: <b><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= number_format($salesInfo['single_order']->sales_bill_total,2); ?></b></label>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-12 invoice-col">
        
              <label>Amount In Words</label>:
          </div>
           
      </div>

      <!-- /.row -->
      <br />
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width:50px;">S.No</th>
                 <th style="width:100px;">Code #</th>
              <th>Product</th>
             
              <th class="text-right" style="width:150px;">Price</th>
              <th style="width:100px;">Qty</th>
              <th class="text-right" style="width:150px;">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            
       <?php $subTotal =0; $sno = 1; foreach($salesInfo['item'] as $item): ?>
            <tr>
              <td><?= $sno ?></td>
              <td><?= $item->prd_code ?></td>
              <td><?= $item->prd_title ?></td>
              
              <td class="text-right">
                <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                <?= number_format($item->salitem_price,2,'.','') ?></td>
              <td><?= $item->salitem_qty.' ( '.$item->unit_name.' ) ' ?></td>
              <td class="text-right"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= number_format($item->salitem_price*$item->salitem_qty,2,'.','') ?></td>
            </tr>
            <?php $subTotal = $subTotal + ($item->salitem_price*$item->salitem_qty);  $sno++; endforeach; ?>
            </tbody>
            <thead>
                <tr>
                    <td class="text-right" colspan="5">
                        <label>GRAND TOTAL</label>
                    </td>
                    <td class="text-right"><b><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                  <?= number_format($subTotal,2) ?></b></td>
                </tr>
            </thead>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
          
          <div class="">
              <div class="col-md-6">
                  
              <table class="table table-bordered half-table table-float-left">
                     <thead>
                         <tr>
                             <th colspan="2"><label>Payment Receipts</label></th>
                         </tr>
                         <tr>
              <th>Date</th>
              <th>Amount Received</th>
              </tr>
              </thead>
              <tbody>
                  <?php $paymentTotal = 0;
                       foreach($salesInfo['payment'] as $payment):
                        $paymentTotal = $paymentTotal + $payment->salpayment_amount;
                  ?>
                  <tr>
                      <td><?= date('F d Y', strtotime($payment->salpayment_date)) ?></td>
                      <td><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= number_format($payment->salpayment_amount,2,'.','') ?></td>
                  </tr>
                  <?php endforeach; ?>
                  
              </tbody>
              <tfoot>
                  <tr>
                      <th>Total : </th>
                      <td>
                        <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                        <?= number_format($paymentTotal,2,'.','') ?> </td>
                  </tr>
              </tfoot>
              </table>
              </div>
              
              <div class="col-md-6">
                  <table class="table table-bordered half-table table-float-right">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>
                  <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                  <?php $discount = 0; echo number_format($subTotal,2,'.',''); ?></td>
              </tr>
              <?php if($salesInfo['single_order']->sales_discount_value != 0):
                if($salesInfo['single_order']->sales_discount_type == 'FLAT'){ 
                   $discount = $salesInfo['single_order']->sales_discount_value; 
                   
                  }
                else{
                    $discount = $subTotal/100 * $salesInfo['single_order']->sales_discount_value;
                    } ?>
              <tr>
                <th>Discount <?php if($salesInfo['single_order']->sales_discount_type == 'FLAT'){ echo '('.$salesInfo['single_order']->sales_discount_value.')'; }else{ echo '('.$salesInfo['single_order']->sales_discount_value.'% )'; } ?></th>
                <td><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= $discount ?></td>
              </tr>
              <?php endif; ?>
              
              <?php 
                    $taxAmount = 0;
                    $taxName = '';
                    $count = 1;
                  if(!empty($salesInfo['taxes'])):
                  
                    foreach($salesInfo['taxes'] as $tax):
                       if($tax->tax_type == '%')
                       {
                          $taxAmount = $taxAmount + ($subTotal / 100 * $tax->tax_on); 
                       }
                       else
                       {
                         $taxAmount = $taxAmount + $tax->tax_on;  
                       }
                       
                       if($count < count($salesInfo['taxes']))
                       {
                          $taxName .= $tax->tax_name.' | '; 
                       }
                       else
                       {
                          $taxName .= $tax->tax_name; 
                       }
                       
                     $count++;  
                    endforeach;
                    
                  ?>
              <tr>
                <th>Tax (<?= $taxName ?>)</th>
                <td><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= number_format($taxAmount,2) ?></td>
              </tr>
              <?php endif; ?>
               <tr>
                <th>Amount Paid:</th>
                <td>
                  <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                  <?= number_format($paymentTotal,2) ?></td>
              </tr>
              <tr>
                <th>Remaining Amount:</th>
                <td>
                  <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                  <?= number_format(($subTotal - $discount + $taxAmount) - $paymentTotal,2); ?></td>
              </tr>
            </table>
              </div>
              
          </div>
          </div>
          <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-12">
          <p class="no-shadow">
           <label>ADDITIONAL NOTE : <?= $salesInfo['single_order']->sales_additional_note ?></label>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="no-shadow text-right">
     <?php if($salesInfo['single_order']->sales_status == 1): ?>
           <address>
            <strong>Canceled Invoice</strong><br>
            <b>By : </b><?= $salesInfo['single_order']->user_fname.' '.$salesInfo['single_order']->user_lname ?><br>
            <b>Date :</b> <?= date('F d Y',strtotime($salesInfo['single_order']->cancelation_date)) ?><br>
            <b>Reason :</b> <?= $salesInfo['single_order']->cancel_reason ?>
          </address>
            <?php endif; ?>
        </p>
        </div>
        <!-- /.col -->
      </div>
      <hr>
      <!-- /.row -->
      <p class="text-center">
          <?php $user = $this->db->where('user_id',$this->session->userdata('user')['user_id'])->get('users')->row(); ?>
          print on: <?= date('M d Y'); ?> by  <?php if(!empty($user)){ echo $user->user_fname.' '.$user->user_lname; } ?>
          <br>
          <span class="text-red"> * This is computer generated invoice and does not need any signature or stamp</span>
      </p> 
    </section>
 <button onclick="window.print();" class="btn btn-flate btn-default col-md-offset-5 col-md-2 btn-print">PRINT</button>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>