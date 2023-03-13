<style>
    .todo-list > li {
    border-radius: 2px;
    padding-left: 5px;
    padding-bottom: 10px;
    background: #ffffff;
    margin-bottom: 6px;
    border-left: 0px solid #3a4c5a;
    color: #a8ad70;
}
.users-list > li {
    width: 33%;
    float: left;
    padding: 10px;
    text-align: center;
}
.users-list > li > .fa {
    font-size: 2.2em;
    color: #a8ad70;
    padding-bottom: 5px;
}
.users-list-name {
    font-weight: normal;
    color: #444;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.content-wrapper {
    min-height: 100%;
    background-color: #efefef;
    z-index: 800;
}
</style>
<script src="<?= base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/export-data.js'); ?>"></script>
<?php
// echo "<pre>";
// print_r($todaySalePrice[0]['total']);
// print_r($todaySalePrice);
// echo $todaySalePrice->total;

// exit();

// defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

           <div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $currency ?> <?php echo number_format($todaySale,2); ?></h3>

              <p>TOTAL SALES</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $currency ?> <?php echo number_format($avgSales,2); ?></h3>

              <p>AVG TRANSACTION VALUE</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $currency ?> <?php echo number_format($avgSalesItems,2); ?><sup style="font-size: 20px"></sup></h3>

              <p>AVG UNIT SOLD PRICE</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
          </div>
        </div>
        <!-- ./col -->

      </div>
      <!-- /.row -->
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">MONTHLY RECAP REPORT FOR YEAR <?= date('Y'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                     <div class="chart tab-pane active" id="rev-chart" style="position: relative; height: 350px;"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                      <h5 class="description-header"><?php echo $currency.' '.number_format($currentYearTotalSales,2); ?></h5>
                    <span class="description-text">TOTAL SALES</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><?php echo $currency.' '.number_format($currentYearTotalPurchase,2); ?></h5>
                    <span class="description-text">TOTAL PURCHASE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><?php echo $currency.' '.number_format($getCurrentYearTotalExpense,2); ?></h5>
                    <span class="description-text">TOTAL EXPERNSE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $currency.' '.number_format($getCurrentYearProfiltLost,2); ?></h5>
                    <span class="description-text">PROFIT / LOSS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>

<script>
    Highcharts.chart('rev-chart', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Sales(<?= $currency ?>)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} <?= $currency ?></b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
     series: [{
        name: 'Sales',
        data: [<?= implode(',', $currentYearSales); ?>]

    }, {
        name: 'Expense',
        data: [<?= implode(',', $getCurrentYearExpense); ?>]

 }
//    , {
//        name: 'Revenue',
//        data: [12.0,12.0,12.0,12.0,12.0,12.0,12.0,12.0,12.0]
//
//    }
        ]
});
    </script>