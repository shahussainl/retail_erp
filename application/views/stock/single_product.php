<?php
// echo "<pre>";
// print_r($sal_vouchers);
$currency_symbol = $this->API_m->currentCurrency();
 

defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .form-group{
        width:100%;
        margin-bottom: 15px !important;
    }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive" src="<?php if(!empty($product['image']) ){ echo base_url('img_uploads/product_images/' . $product['image']->prd_image); }else{ echo base_url('assets/dist/img/placeholder.gif'); } ?>" style="width:100%;" alt="Upload Product Image">
              <h3 class="profile-username"><?= $product['item']->prd_title ?></h3>

              <p class="text-muted">
              <?= $product['item']->prdc_name ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Code#</b> <a class="pull-right"><?= $product['item']->prd_code ?></a>
                </li>
                <li class="list-group-item">
                  <b>Created at</b> <a class="pull-right"><?= date('F d Y',strtotime($product['item']->prd_created_date)) ?></a>
                </li>
                <?php if($product['item']->prd_is_sale == 1): ?>
                <li class="list-group-item">
                  <b>Product For</b> <a class="pull-right">Sale</a>
                </li>
                <?php endif; ?>
                <?php if($product['item']->prd_is_purchase == 1): ?>
                <li class="list-group-item">
                  <b>Product For</b> <a class="pull-right">Purchase</a>
                </li>
                <?php endif; ?>
                
              </ul>

           </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box bg-maroon">
            <div class="inner">
                <h3><?= $currency_symbol; ?> <?= number_format($purchase,2); ?></h3>

              <p>PURCHASE</p>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
                </div>
                    <div class="col-md-6">
                    <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $currency_symbol; ?> <?= number_format($sales,2); ?></h3>

              <p>SALES</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
                </div>
                    <div class="col-md-6">
                    <div class="small-box bg-purple">
            <div class="inner">
                <h3><?= $currency_symbol; ?> <?= number_format($sales_avg,2)?></h3>

              <p>AVG SELLING PRICE</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
                </div>
                    <div class="col-md-6">
                    <div class="small-box bg-orange">
            <div class="inner">
                <?php 
                $unitProfit = $sales_avg - $purchase_unit_price; 
                if($unitProfit<0){
                    $unitProfit = 0;
                }
                ?> 
                
                <h3><?= $currency_symbol; ?> <?= number_format($unitProfit,2)?></h3>

              <p>AVG UNIT PROFIT</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
                </div>
            </div>
                  <table id="sales-table" class="table table-bordered table-hover">
                      <thead>
                          <tr>
                              <th colspan="5"><label class="text-uppercase"><?= $product['item']->prdc_name ?> HISTORY</label></th>
                          </tr>
                          <tr>
                              <th>S.No</th>
                              <th>Qty</th>
                              <th>Unit</th>
                              <th>Date</th>
                              <th>Activity</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($product['detail'])) { 
                              
                              ?>
                              <?php
                              foreach ($product['detail'] as $key => $prd) {
                                  ?>
                                  <tr>
                                     <td><?= $key; ?></td>
                                      <td><?= $prd->storeitem_quantity; ?></td>
                                      <td><?= $product['item']->unit_name; ?></td>
                                      <td><?= date('F d Y',strtotime($prd->date)); ?></td>
                                      <td><b><?php  if(trim($prd->status) == "+"){echo '<label class="label label-success">Stocked</label>';}elseif(trim($prd->status) == "-"){echo '<label class="label label-danger">Sold</label>';} ?></b></td>
                                      
                                  </tr>
                              <?php } ?>
                          <?php } ?>
                      </tbody>
                  </table>
          <!-- /.nav-tabs-custom -->
        </div>
        <div class="col-md-12">
            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

<!-- Control Sidebar -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script>
    $(document).ready(function (){
        abc();
    });
$(document).on('click','.deleteUserImage',function(event){
    event.preventDefault();
    var id = $(this).data('id');
    var obj = $(this);
    obj.removeClass();
    if(confirm('are you sure want to remove this?') == true)
    {
       $.ajax({
           type:'POST',
           data:{'id':id},
           url:'<?= base_url('Admin/deleteUserProfileImage'); ?>',
           success:function()
           {
             obj.attr('type','file');
             $('#blah').attr('src','');
           }    
            
       
       });
    }
});
//$.getJSON(
//    'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/usdeur.json',

//var data = JSON.parse("<?= $graph_data; ?>");
var data = "<?= $graph_data; ?>";
    function abc(data) {
//console.log(data);
//alert(data);
        Highcharts.chart('container', {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: 'Sale / Purchase over time'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Quantity'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Quantity',
                data: data
            }]
        });
    }
//);
</script>