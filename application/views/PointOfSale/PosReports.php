<?php

// echo "<pre>";
// print_r($totalOrders);
// echo "<br>";
// print_r($cancel);
// echo "<br>";
// print_r($hold);
// exit();
?>

<style>
    .info-box-number {
        display: block;
        font-weight: normal;
        font-size: 30px;
    }
    .info-box-text {
        display: block;
        font-size: 20px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<script src="<?= base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/export-data.js'); ?>"></script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->load->view('include/sales_menu'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            PoS REPORT
            <small style="color: #fff;">Complete Point of Sale report with interactive graphs</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Orders</span>
                                <span class="info-box-number"><?= $totalOrders; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Completed Orders</span>completed


                                <span class="info-box-number"><?= $completed; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Hold Orders</span>
                                <span class="info-box-number"><?= $hold; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Cancel Orders</span>
                                <span class="info-box-number"><?= $cancel; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="info-box bg-purple">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Paid Invoices</span>
                                <span class="info-box-number"><?= $getClosedInvBalance; ?></span>
                            </div>
                             /.info-box-content 
                        </div>
                    </div> -->
                </div>

            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">OPEN INVOICES</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive" style="height: 183px; overflow-y: scroll;">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <!--<th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($open_inv_detail)) { ?>

                                        <?php
                                        foreach ($open_inv_detail as $open) {
                                            $pur_date = $open['sales_data']->sales_date;
                                            $date = DateTime::createFromFormat('Y-m-d', $pur_date);
                                            $sale_date = $date->format("F d Y");
                                            ?>
                                            <tr>
                                                <td><a href="<?= base_url('Sales/singleSaleVoucher/'.$open['sales_data']->sales_id); ?>"><?= $open['sales_data']->sales_id; ?></a></td>
                                                <td><?= $sale_date; ?></td>
                                                <td><?= $open['sales_data']->sales_bill_total; ?></td>
                                                <td><?= $open['pay_amt']->salpayment_amount; ?></td>
                                                <td><?= $open['sales_data']->sales_bill_total - $open['pay_amt']->salpayment_amount; ?></td>
                                                <!--<td><span class="label label-success">Shipped</span></td>-->
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Invoices</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>

        </div>
        <!-- /.row (main row) -->
        <div class="row margin-bottom">
            <div class="col-md-12">
                <div id="current-month" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
        <div class="row margin-bottom">
            <div class="col-md-12">
                <div id="current-year" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </section>
    
    <!-- /.content -->
</div>
<script type="text/javascript">
    Highcharts.chart('current-month', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Sales Report'
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
                text: 'Amount'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
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
                data: [<?= implode($monthlySalesAvg, ',')?>]

            }, {
                name: 'Discounts',
                data: [<?= implode($disc_monthly, ','); ?>]

            }, {
                name: 'Revenue',
                data: [<?= implode($monthlyRevenueAvg, ',');?>]

            }]
    });
</script>
<script type="text/javascript">
    var years = [];
    
var currentYear = "<?= date('Y'); ?>";
    
    var prevYear = currentYear - 5;
    var nextYear = parseInt(currentYear) + 6;
    for (i = prevYear; i <= nextYear; i++) {
                years.push(i);
    }
    Highcharts.chart('current-year', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Yearly Sales Report'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: years,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
                data: [<?= implode($sale_yearly,','); ?>]

            }, {
                name: 'Discounts',
                data: [<?= implode($disc_yearly,','); ?>]

            }, {
                name: 'Revenue',
                data: [<?= implode($yearlyRevenueAvg,','); ?>]

            }]
    });
</script>