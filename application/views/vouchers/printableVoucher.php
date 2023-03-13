<?php 
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
$g_total = 0;
                   foreach($single_voucher_information['voucher_heads'] as $voucher):  $g_total = $g_total + $voucher->amount; endforeach;
?>
<script>
window.print();
</script>
<style>
  .invoice {
    border: 0px solid #f4f4f4;
    padding: 0px;
}  
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
 <!-- Main content -->
 <section class="invoice">
     <div class="row">
         <div class="col-md-12 text-center">
             <h2><b style="border-bottom: 3px solid #3a4c5a;">PAYMENT VOUCHER</b></h2>
         </div>
     </div>
      <div class="row">
        <div class="col-xs-12">
          <p class="page-header">
             PV NO: <?= $prefix; ?><?= $single_voucher_information['voucher']->voucher_number ?>
            <small class="pull-right">Date: <?= (date('F d Y',strtotime($single_voucher_information['voucher']->voucher_date))) ?></small>
          </p>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row">
        <div class="col-sm-4 invoice-col">
          <label>Payee: <?= $single_voucher_information['voucher']->voucher_interaction ?></label>
        </div>
           <div class="col-sm-8 invoice-col">
           <label>The Sum Of: <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?> <?= number_format($g_total,2); ?></label>
        </div>
      </div>
      <div class="row">
          <div class="col-sm-12 invoice-col">
        
              <label>Amount In Words</label>:
          </div>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <label>Method of Payment: <?= $single_voucher_information['voucher']->voucher_paying_via ?></label>
        </div>
        <div class="col-sm-8 invoice-col">
         <label>Particulars: <?= $single_voucher_information['voucher']->voucher_particulars ?></label>
        </div>
      </div>
      <!-- /.row -->
      <br />
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
                <th style="width:50px">S.No</th>
              <th>Description</th>
              <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>
            
             <?php $sno = 1;
                   $total = 0;
                   foreach($single_voucher_information['voucher_heads'] as $voucher): ?>
            <tr>
              <td><?= $sno ?></td>
              <td><?= $voucher->for ?></td>
              <td class="text-right">
                <span> <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                <?= number_format($voucher->amount,2); ?></td>
            </tr>
            <?php $total = $total + $voucher->amount; $sno++; endforeach; ?>
            </tbody>
            <thead>
                <tr>
                    <td class="text-right" colspan="2">
                        <label>GRAND TOTAL</label>
                    </td>
                    <td class="text-right"><b><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                  <?= number_format($total,2) ?></b></td>
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
          <p class="no-shadow">
           <label>ADDITIONAL NOTE : <?= $single_voucher_information['voucher']->voucher_desc ?></label>
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
            <p class="no-shadow text-right">
 <b>STATUS :</b> <?php if($single_voucher_information['voucher']->post_status == 1 and $single_voucher_information['voucher']->voucher_status == 0){?> POSTED <?php }elseif($single_voucher_information['voucher']->voucher_status == 1){ ?>CANCELLED <?php }else{ ?> UNPOSTED <?php } ?> <br>
              <!-- /.col -->
        <?php if($single_voucher_information['voucher']->voucher_status != 0): ?>
          <b>Cancellation Date :</b> <?= date('F d Y', strtotime($single_voucher_information['voucher']->voucher_cancelation_date)) ?><br>
          <b>Reason :</b> <?= $single_voucher_information['voucher']->voucher_cancelation_reason ?><br>
          <b>Cancelled By :</b> <?= $single_voucher_information['voucher']->fname.' '.$single_voucher_information['voucher']->lname ?><br>
       <?php endif; ?>
        </p>
        </div>
        <!-- /.col -->
      </div>
      <hr>
      <!-- /.row -->
      <p class="text-center">
          print on: <?= date('M d Y - h:i:sa'); ?> by 
          <br>
          <span class="text-red"> * This is computer generated payment voucher and does not need any signature or stamp</span>
      </p> 
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>