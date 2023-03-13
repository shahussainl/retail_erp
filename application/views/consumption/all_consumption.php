<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
<script src="<?= base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/exporting.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/highcharts/modules/export-data.js'); ?>"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/consumption_menu'); ?>

    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <?php if (!empty($cosumption_data)) { ?>
                    <?php foreach ($cosumption_data as $key => $cons) { 
//                        echo '<pre>';print_r($cons);exit();
                        $cons_product = [];
                        $cons_product_qty = [];
                        $total_qty = 0;
                        foreach($cons['consumpted_items'] as $ct){
                          $cons_product[] =   $ct->prd_title;
                          $cons_product_qty[] =   $ct->quantity;
                          $total_qty = $total_qty + $ct->quantity;
                        }
//                        echo '<pre>';print_r($cons_product);exit();
                        ?>

                        <div class="col-md-6">
                            <div id="graph<?= $key; ?>" style="margin: 0 auto"></div>  
                        </div>
                        <script>
                            // Create the chart
                            Highcharts.chart('graph<?= $key; ?>', {
                                chart: {
                                    type: 'pie'
                                },
                                title: {
                                    text: '<?= $cons['consumption']->prd_title; ?>'
                                },
                                subtitle: {
                                    text: ''
                                },
                                plotOptions: {
                                    series: {
                                        dataLabels: {
                                            enabled: true,
                                            format: '{point.name}: {point.y:.1f}%'
                                        }
                                    }
                                },

                                tooltip: {
                                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                                },

                                series: [
                                    {
                                        name: "Products",
                                        colorByPoint: true,
                                        data: [
                                            <?php $s = sizeof($cons_product);
                                            for($a=0;$a < $s; $a++){
                                                $perc = ($cons_product_qty[$a]/$total_qty)*100;
                                            ?>
                                            {
                                                name: "<?= $cons_product[$a]; ?>",
                                                y: <?= $perc; ?>,
                                                drilldown: "<?= $cons_product[$a]; ?>"
                                            },
                                            <?php } ?>
//                                            ,
//                                            {
//                                                name: "Firefox",
//                                                y: 10.57,
//                                                drilldown: "Firefox"
//                                            },
//                                            {
//                                                name: "Internet Explorer",
//                                                y: 7.23,
//                                                drilldown: "Internet Explorer"
//                                            },
//                                            {
//                                                name: "Safari",
//                                                y: 5.58,
//                                                drilldown: "Safari"
//                                            },
//                                            {
//                                                name: "Edge",
//                                                y: 4.02,
//                                                drilldown: "Edge"
//                                            },
//                                            {
//                                                name: "Opera",
//                                                y: 1.92,
//                                                drilldown: "Opera"
//                                            },
//                                            {
//                                                name: "Other",
//                                                y: 7.62,
//                                                drilldown: null
//                                            }
                                        ]
                                    }
                                ],
//                                drilldown: {
//                                    series: [
//                                        {
//                                            name: "Chrome",
//                                            id: "Chrome",
//                                            data: [
//                                                [
//                                                    "v65.0",
//                                                    0.1
//                                                ],
//                                                [
//                                                    "v64.0",
//                                                    1.3
//                                                ],
//                                                [
//                                                    "v63.0",
//                                                    53.02
//                                                ],
//                                                [
//                                                    "v62.0",
//                                                    1.4
//                                                ],
//                                                [
//                                                    "v61.0",
//                                                    0.88
//                                                ],
//                                                [
//                                                    "v60.0",
//                                                    0.56
//                                                ],
//                                                [
//                                                    "v59.0",
//                                                    0.45
//                                                ],
//                                                [
//                                                    "v58.0",
//                                                    0.49
//                                                ],
//                                                [
//                                                    "v57.0",
//                                                    0.32
//                                                ],
//                                                [
//                                                    "v56.0",
//                                                    0.29
//                                                ],
//                                                [
//                                                    "v55.0",
//                                                    0.79
//                                                ],
//                                                [
//                                                    "v54.0",
//                                                    0.18
//                                                ],
//                                                [
//                                                    "v51.0",
//                                                    0.13
//                                                ],
//                                                [
//                                                    "v49.0",
//                                                    2.16
//                                                ],
//                                                [
//                                                    "v48.0",
//                                                    0.13
//                                                ],
//                                                [
//                                                    "v47.0",
//                                                    0.11
//                                                ],
//                                                [
//                                                    "v43.0",
//                                                    0.17
//                                                ],
//                                                [
//                                                    "v29.0",
//                                                    0.26
//                                                ]
//                                            ]
//                                        }
//                                    ]
//                                }
                            });
                        </script>
                    <?php } ?>
                <?php } ?>

            </div>
        </div>
    </section>


</div>

