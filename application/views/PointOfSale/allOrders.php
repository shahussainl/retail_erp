<?php
// echo "<pre>";
// print_r($posSales);
// exit();
?>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <?php $this->load->view('include/pos_menu'); ?>
    <div class="clearfix"></div>
   <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="">
            <div class="row">
            <div class="views data-hide list-view" data-view="show">
                          <?php
            // $Subtotal = 0;
            $date     = date('Y-m-d H:i:s');
            $newDate  = date('F, d-Y H:i:s',strtotime($date));
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
                    <i class="fa fa-calendar"></i> <?php
                       $date1    = DateTime::createFromFormat('Y-m-d H:i:s',$order['pos_date']);
                               $newDate1  = $date1->format("F d Y h:i a");
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
                  <div class="views data-show table-view" data-view="hidden">
                <div class="">
                    <div class="col-md-12">
                        <div class="card-body">   
                <div class="row">
                  <!--Name-->
                  <div class="col-md-3 pl-1">
                      <label>ORDER #</label>
                        <div class="form-group input-group" id="filter_col1" data-column="1">
                            
                            <div class="input-group-addon"><i class="fa fa-table"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col1_filter" placeholder="">
                        </div>
                    </div>
                   <!--Name-->
                  <div class="col-md-3 pl-1">
                      <label>ORDER STATUS</label>
                        <div class="form-group input-group" id="filter_col8" data-column="8">
                            
                            <div class="input-group-addon"><i class="fa fa-tag"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col8_filter" placeholder="">
                        </div>
                    </div> 
                  <!--From-->
                    <div class="col-md-2 pl-1">
                        <label>FETCH DAY</label>
                        <div class="form-group input-group" id="filter_col3" data-column="3">
                            
                             <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" name="From" class="form-control column_filter currentdatepicker" id="col3_filter" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>DATE RANGE</label>
    <div class="form-group input-group input-daterange">
        <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>
      <input type="text" id="min-date" class="form-control date-range-filter datepicker"  placeholder="">

       <div class="input-group-addon"><i class="fa fa-calendar-plus-o"></i></div>

      <input type="text" id="max-date" class="form-control date-range-filter datepicker"  placeholder="">

    </div>
  </div>
                </div>
              
            </div>
                </div>
                    <div class="row">
                    <div class="col-md-12">
                    <table id="products-table" class="table table-hover dataTable">
                    <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Order #</th>
                                <th>Created By</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th># Of Items</th>
                                <th>Bill Total</th>
                                <th>Discounted Price</th>
                                <th>Status</th>
                                <th style="width: 50px;"></th>
                                <!-- <th>View</th> -->
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                                // $Subtotal = 0;
                                // $date     = date('Y-m-d H:i:s');
                                // $newDate  = date('F, d-Y H:i:s',strtotime($date));
                                // echo "<br><br>".$newDate;
                                //  $date          = DateTime::createFromFormat('Y-m-d H:i:s', $order['pos_date']);
                                // $purchase_date = $date->format("F d Y h:i:s a");
                            $sno=1;
                            foreach($posSales as $order)
                            {

                               // $total+=$pro_d->pos_prd_qty*$pro_d->pos_prd_price;
                               // $Subtotal+=$total;
                          ?>
                        
                            <tr class="<?php 
                                if($order['pos_status']==1)
                                {
                                    echo "tbl-green";
                                }
                                else if($order['pos_status']==0)
                                {
                                    echo "tbl-warm";
                              
                                }
                                else if($order['pos_status']==2)
                                {
                                    echo "tbl-red";
                                }
                              ?>">
                                <td><?= $sno; ?></td>
                              <td><?= $order['pos_id']; ?></td>
                              <td><?= $order['user_fname'].' '.$order['user_lname'] ?></td>
                               <td><?php 
                                $date    = DateTime::createFromFormat('Y-m-d H:i:s', $order['pos_date']);
                                $newDate = $date->format("m/d/Y");

                                   echo  $newDate;
                                  ?></td>
                               <td><?php  $date    = DateTime::createFromFormat('Y-m-d H:i:s', $order['pos_date']);
                                $newDate = $date->format("h:i:s a");

                                   echo  $newDate; ?></td>
                               <td>3</td>
                              <td>
                                 <?php  if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?>
                                <?= number_format($order['pos_bill_total'],2); ?></td>
                             
                              <td>
                                <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?>
                                <?= number_format($order['pos_discount_price'],2); ?></td>
                              <td>
                                  <?php 
                                if($order['pos_status']==1)
                                {
                              ?> 
                                  <span class="badge bg-green">PAID</span>
                             <?php
                              }
                              else if($order['pos_status']==0)
                              {
                              ?>
                              <span class="badge bg-yellow">OPEN</span>
                              <?php
                                }
                                else if($order['pos_status']==2)
                                {
                              ?>
                              <span class="badge bg-red">CANCEL</span>
                              <?php
                                }
                              ?>
                                </td>
                                <td class="text-right">
                                    <a href="<?= base_url('PointOfSale/SingleView/'.$order['pos_id']); ?>" class="btn btn-sm btn-default btn-flat table-btn"><i class="fa fa-eye"></i></a>
                                </td>
                              <!-- <td><a href="<? //base_url('PointOfSale/SingleOrder/'.$order['pos_id']); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td> -->
                          </tr>
                          
                          <?php 
                            $sno++;   
                            }
                          ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6"></td>
                                <td colspan="4" style="font-weight: bold;background: #f1f1f1;"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                        </div>
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
      function filterColumn ( i ) {
        $('#products-table').DataTable().column( i ).search(
            $('#col'+i+'_filter').val()
        ).draw();
    }
    
    $(document).ready(function() {
        $('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});


        $('input.global_filter').on( 'change', function () {
            filterGlobal();
        } );
    
        $('input.column_filter').on( 'change', function () {
            filterColumn( $(this).parents('div').attr('data-column') );
        } );
    } );
    $(document).ready(function () {
            var  table =  $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
            scrollY:        '57vh',
            scrollCollapse: true,
            "paging": false,
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 6 ).footer() ).html(
                '$'+pageTotal.toFixed(2) +' ( $'+ total.toFixed(2) +' total)'
            );
        }
            
    });
    
    // Extend dataTables search
$.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
    var min = $('#min-date').val();
    var max = $('#max-date').val();
    var createdAt = data[3] || 0; // Our date column in the table

    if (
      (min == "" || max == "") ||
      (moment(createdAt).isSameOrAfter(min) && moment(createdAt).isSameOrBefore(max))
    ) {
      return true;
    }
    return false;
  }
);

// Re-draw the table when the a date range filter changes
$('.date-range-filter').change(function() {
  table.draw();
});

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });

    });
</script>

  

