<?php
// echo "<pre>";
// print_r($posSales);
// exit();
?>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->load->view('include/pos_menu'); ?>
    <!-- Content Header (Page header) -->
    <div class="clearfix"></div>
   <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="">
            <div class="row">
                <div class="views data-show list-view" data-view="show">
                          <?php
            // $Subtotal = 0;
            // $date     = date('Y-m-d h:i:s');
            // $newDate  = date('F, d-Y h:i:s',strtotime($date));
           //  $date          = DateTime::createFromFormat('Y-m-d H:i:s', $pur_date);
           // $purchase_date = $date->format("F d Y h:i:s a");
            // echo "<br><br>".$newDate;
        $sno=1;
        foreach($posSales as $order)
        {
            ?>
          <div class="col-md-3">
              <a href="<?= base_url('PointOfSale/SingleView/'.$order['pos_id']); ?>">
          <div class="info-box  <?php 
                                if($order['pos_status']==1)
                                { echo "bg-green"; }
                                if($order['pos_status'] == 0){
                                echo "bg-yellow"; }
                                if($order['pos_status'] == 2){
                                echo "bg-maroon"; 
                                }
                              ?> ">
            <span class="info-box-icon"><b><?= $order['pos_id']; ?></b></span>
            
            <div class="info-box-content">
              <span class="info-box-number">TOTAL: <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?><?= number_format($order['pos_bill_total'],2); ?></span>
              <span class="info-box-text">Paid: <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?><?= number_format($order['pos_paid_amount'],2); ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 0%"></div>
              </div>
              <span class="progress-description">
                    <i class="fa fa-calendar"></i><?php
                       $date1    = DateTime::createFromFormat('Y-m-d H:i:s',$order['pos_date']);
                       $newDate1 = $date1->format("F d Y h:i a");
                    echo $newDate1;
                      ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
              </a>
          </div>
          <?php 
        }
        ?>
                </div>
                <div class="views data-hide table-view" data-view="hidden">
                <div class="col-md-12">
                    <table id="allOrder-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order#</th>
                                <th>Date</th>
                                <th># Of Items</th>
                                <th>Bill Total</th>
                                <th>Discounted Price</th>
                                <th>Status</th>
                                <th style=" width: 80px;"></th>
                                <!-- <th>View</th> -->
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                                // $Subtotal = 0;
                                $date     = date('Y-m-d H:i:s');
                                $newDate  = date('F, d-Y h:i:s',strtotime($date));
                                // echo "<br><br>".$newDate;
                            $sno=1;
                            foreach($posSales as $order)
                            {

                               // $total+=$pro_d->pos_prd_qty*$pro_d->pos_prd_price;
                               // $Subtotal+=$total;
                          ?>
                        
                            <tr>
                              <td><?= $order['pos_id']; ?></td>
                               <td><?php

                                $date1    = DateTime::createFromFormat('Y-m-d H:i:s',$order['pos_date']);
                               $newDate1  = $date1->format("F d Y h:i a");
                                echo $newDate1; 
                                ?></td>
                               <td>3</td>
                              <td>
                                 <span> <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                <?= number_format($order['pos_bill_total'],2); ?></td>
                             
                              <td>
                                 <span> <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                <?= number_format($order['pos_discount_price'],2);   ?></td>
                              <td>
                                  <?php 
                                if($order['pos_status']==1)
                                {
                              ?> 
                                  <label>PAID</label>
                             <?php
                              }
                              else if($order['pos_status']==0)
                              {
                              ?>
                              <label>OPEN</label>
                              <?php
                                }
                                else if($order['pos_status']==2)
                                {
                              ?>
                              <label>CANCEL</label>
                              <?php
                                }
                              ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('PointOfSale/SingleView/'.$order['pos_id']); ?>" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> VIEW</a>
                                </td>
                              <!-- <td><a href="<? //base_url('PointOfSale/SingleOrder/'.$order['pos_id']); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td> -->
                          </tr>
                          
                          <?php 
                            $sno++;   
                            }
                          ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
      </div>
      <!-- /.box -->
</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <script>
    $(document).ready(function () {
        $('#allOrder-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "TODAY Orders", searchPlaceholder: "Filter and Search..."}
        });
        $("div.toolbar").html('');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });

    });
</script>

  

