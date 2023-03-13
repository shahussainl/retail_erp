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
    <?php $this->load->view('include/voucher_menu'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            EXPANSE REPORT
            <small style="color: #fff;">Complete report with interactive graphs</small>
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
                                <span class="info-box-text">Expanse Voucher</span>
                                <span class="info-box-number"><?php echo $currency.' '.number_format($getTotalExpense,2); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Posted</span>
                                <span class="info-box-number"><?php  echo $currency.' '.number_format($total_expense,2); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Pending</span>
                                <span class="info-box-number"><?php echo $currency.' '.number_format($getPendingExpense,2); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-box bg-maroon">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">SALARY PAID</span>
                                <span class="info-box-number"><?php echo  $currency.' '.number_format($salaryPaid,2); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">EXPANSE ACCOUNT HEADS</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive" style="height: 183px; overflow-y: scroll;">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Sub Type</th>
                                        <th>Account</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($expenseAccountHeads)) { ?>
                                        <?php foreach ($expenseAccountHeads as $ex) { ?>
                                            <tr>
                                                <td><?= $ex->coa_code; ?></td>
                                                <td><?= $ex->coa_name; ?></td>
                                                <td><?= $ex->coa_subtype_name; ?></td>
                                                <td><?= $ex->coa_type_name ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
<!--                    <div class="box-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Invoices</a>
                    </div>-->
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
            text: 'Monthly Expense Report'
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
                text: '<?= $currency ?>'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} <?= $currency ?> </b></td></tr>',
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
                name: 'Total Expense',
                data: [
<?= implode($getExpenseMonthly, ','); ?>
                ]

            }, {
                name: 'Salary Paid',
                data: [
<?= implode($getSalaryPaidMonthly, ','); ?>
                ]

            }]
    });</script>
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
            text: 'Yearly Expense Report'
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
                text: '<?= $currency ?>'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} <?= $currency ?> </b></td></tr>',
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
                name: 'Total Expense',
                data: [<?= implode($getExpenseYearly,','); ?>]

            }, {
                name: 'Salary Paid',
                data: [<?= implode($getSalaryPaidYearly,','); ?>]

            }]
    });
</script>