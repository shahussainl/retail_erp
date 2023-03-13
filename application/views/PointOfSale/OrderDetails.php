<?php
echo "<pre>";
print_r($OrderDetail);
print_r($AllPro_d);
print_r($AllTaxes_d);
exit();


 ?> 

<!-- Order Invovice start -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i>Buraq ERP, Inc.
            <small class="pull-right">Date: <?php echo date('F-d-Y'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <!-- Other Details
          <address>
            <strong>Admin, Inc.</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address> -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <!--  To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address> -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Serial #</th>
              <th>Description</th>
              <th>Price</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                    $sno      =1;
                    $itmNo    =0;
                    $itmQty   =0;
                    $Subtotal =0;
                  if(!empty($AllPro_d))
                  {
                    foreach($AllPro_d as $pro_d)
                    {
                      $total=0;
                      $total+=$pro_d['pos_prd_qty']*$pro_d['pos_prd_price'];
                      $Subtotal+=$total;
                      $itmNo=$sno;
                      $itmQty+=$pro_d['pos_prd_qty'];
                ?>
                  <tr>
                    <td><?= $pro_d['pos_prd_qty']; ?></td>
                    <td><?= $pro_d['prd_title'];   ?></td>
                    <td><?= $pro_d['prd_code'];    ?></td>
                    <td><?= $pro_d['prd_desc'];    ?></td>
                    <td><?= $pro_d['prd_price'];   ?></td>
                    <td><?= $total;                ?></td>
                    
                  </tr>
                <?php
                      $sno++;
                    }
                  }
                  else
                  {
                    echo "No Record Available!";
                  }
                ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-md-6">
          <strong style="font-size: 18px;">Order Status:</strong>
          <span style="font-size: 20px; color: red"><?php 
                    $status='';
                  if(!empty($OrderDetail['pos_status']=='1'))
                  {  
                    $status.='Inpregress';
                  } 
                  elseif(!empty($OrderDetail['pos_status']=='0'))
                  {  
                    $status.='Completed';
                  } 
                  elseif(!empty($OrderDetail['pos_status']=='2'))
                  {  
                    $status.='Cancelled';
                  } 
                  echo $status;
                ?></span><br><br>
           <table class="table">
              <tr>
                <th style="width:50%">Order ID:</th>
                <td><?php if(!empty($OrderDetail)){ echo  $OrderDetail['pos_id']; } ?></td>
              </tr>
              <tr>
                <th>Date</th>
                <td><?php if(!empty($OrderDetail)){ echo  $OrderDetail['pos_date']; } ?></td>
              </tr>
              <tr>
                <th>Order Type</th>
                <td><?php if(!empty($OrderDetail)){ echo $OrderDetail['order_type']; } ?></td>
              </tr>
             <!--  <tr>
                <th>Table #</th>
                <td><?php // if(!empty($OrderDetail)){ echo  $OrderDetail['pos_assign_title']; } ?></td>
              </tr> -->
              <tr>
                <th>Items</th>
                 <td><strong class="ItmsRefresh"><?php echo $itmNo.' ('.$itmQty.')'; ?></strong></td>
              </tr>
            </table>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Amount Date <?php if(!empty($OrderDetail)){ echo $OrderDetail['pos_date']; } ?></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">SubTotal:</th>
                <td class="t_price"><?= $Subtotal.'(Rs)'; ?></td>
              </tr>
              <tr>
                <th>Tax (<span class="tax_sign"></span>)</th>
                 <?php
                      $tax_v =0;
                      $tax_t ='';

                      foreach($AllTaxes_d as $tax)
                      {

                    ?>
                       <input type="hidden" class="tax_value" value="<?= $tax['pos_tax_value']; ?>">
                       <input type="hidden" class="tax_type"  value="<?= $tax['pos_tax_type'];  ?>">
                          
                 <?php
                    }
                  ?>  
                <td><span class="ShowTax"></span>(Rs)</td>
              </tr>
              <tr>
                <th>Discount:</th>
                <td><?php if(!empty($OrderDetail)){ echo $OrderDetail['pos_discount_price'].' ('.$OrderDetail['pos_discount_type'].') '; } ?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php if(!empty($OrderDetail)){ echo $OrderDetail['pos_grand_total'].' (Rs)'; } ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="" onclick="window.print();" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <!-- <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
      <br><br>
      
    </section>
    <a href="<?php echo base_url('PointOfSale/allOrder'); ?>" class="btn btn-primary">Back</a>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

  <script>
    

$(document).ready(function()
{
       var  total_am   = $('.t_price').html();
       // alert(total_am);
       var  equal      = 0;
        // var res        = 0;
        var tax        = 0;
        var flat       = 0;
        var per        = 0;
        var sign       ='';


            var value  = $('.tax_value').val();
        // alert(value);
          var tax_type = $('.tax_type').val();
            if(tax_type =='0')
            {
               flat   = parseInt(value);
               sign   = 'flat';
               // tax     = parseInt(flat);
              // alert(flat);
              tax = parseInt(flat);
            }
            else if(tax_type =='0' && tax_type =='1')
            {
               flat  = parseInt(value);
               sign  = 'flat';
               per   = (parseInt(total_am)*parseInt(value))/100;
               equal = parseInt(flat)+parseInt(per);
               sign +='10 %';
               tax   = parseInt(equal);
            }
            else 
            {
              
              per = (parseInt(total_am)*parseInt(value))/100;
              sign='10 %';
              tax =parseInt(per);
               // tax   = parseInt(per);
              // alert(per);
            }  
          
            
              // tax = parseInt(flat) + parseInt(per);
                          // res = value;
               // alert(tax)
               $('.ShowTax').html(tax);
               $('.tax_sign').html(sign);
               // $('.grand_total').html(equal);
               // GetGrandTotal();

               
      
 
       
               // $('.ShowTax').html(tax);
               // $('.pos_tax').val(tax);

       

});

  </script>