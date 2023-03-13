<?php
// echo "<pre>";
// print_r($posSales);
// exit();
?>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
<style>
    /*css for progress bar*/
    .progress {
        height: 20px;
        margin-bottom: 20px;
        overflow: hidden;
        background-color: #f5f5f5;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }
    .progress {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#ebebeb),to(#f5f5f5));
        background-image: -webkit-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
        background-image: -moz-linear-gradient(top,#ebebeb 0,#f5f5f5 100%);
        background-image: linear-gradient(to bottom,#ebebeb 0,#f5f5f5 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffebebeb',endColorstr='#fff5f5f5',GradientType=0);
    }
    .progress {
        height: 12px;
        background-color: #ebeef1;
        background-image: none;
        box-shadow: none;
    }
    .progress-bar {
        float: left;
        width: 0;
        height: 100%;
        font-size: 12px;
        line-height: 20px;
        color: #fff;
        text-align: center;
        background-color: #428bca;
        -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
        box-shadow: inset 0 -1px 0 rgba(0,0,0,0.15);
        -webkit-transition: width .6s ease;
        transition: width .6s ease;
    }
    .progress-bar {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#428bca),to(#3071a9));
        background-image: -webkit-linear-gradient(top,#428bca 0,#3071a9 100%);
        background-image: -moz-linear-gradient(top,#428bca 0,#3071a9 100%);
        background-image: linear-gradient(to bottom,#428bca 0,#3071a9 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff428bca',endColorstr='#ff3071a9',GradientType=0);
    }
    .progress-bar {
        box-shadow: none;
        border-radius: 3px;
        background-color: #0090D9;
        background-image: none;
        -webkit-transition: all 1000ms cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -moz-transition: all 1000ms cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -ms-transition: all 1000ms cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -o-transition: all 1000ms cubic-bezier(0.785, 0.135, 0.150, 0.860);
        transition: all 1000ms cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -webkit-transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -moz-transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -ms-transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
        -o-transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
        transition-timing-function: cubic-bezier(0.785, 0.135, 0.150, 0.860);
    }
    .progress-bar-success {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#5cb85c),to(#449d44));
        background-image: -webkit-linear-gradient(top,#5cb85c 0,#449d44 100%);
        background-image: -moz-linear-gradient(top,#5cb85c 0,#449d44 100%);
        background-image: linear-gradient(to bottom,#5cb85c 0,#449d44 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5cb85c',endColorstr='#ff449d44',GradientType=0);
    }
    .progress-bar-success {
        background-color: #0AA699;
        background-image: none;
    }
    .progress-bar-info {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#5bc0de),to(#31b0d5));
        background-image: -webkit-linear-gradient(top,#5bc0de 0,#31b0d5 100%);
        background-image: -moz-linear-gradient(top,#5bc0de 0,#31b0d5 100%);
        background-image: linear-gradient(to bottom,#5bc0de 0,#31b0d5 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de',endColorstr='#ff31b0d5',GradientType=0);
    }
    .progress-bar-info {
        background-color: #0090D9;
        background-image: none;
    }
    .progress-bar-warning {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#f0ad4e),to(#ec971f));
        background-image: -webkit-linear-gradient(top,#f0ad4e 0,#ec971f 100%);
        background-image: -moz-linear-gradient(top,#f0ad4e 0,#ec971f 100%);
        background-image: linear-gradient(to bottom,#f0ad4e 0,#ec971f 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff0ad4e',endColorstr='#ffec971f',GradientType=0);
    }
    .progress-bar-warning {
        background-color: #FDD01C;
        background-image: none;
    }
    .progress-bar-danger {
        background-image: -webkit-gradient(linear,left 0,left 100%,from(#d9534f),to(#c9302c));
        background-image: -webkit-linear-gradient(top,#d9534f 0,#c9302c 100%);
        background-image: -moz-linear-gradient(top,#d9534f 0,#c9302c 100%);
        background-image: linear-gradient(to bottom,#d9534f 0,#c9302c 100%);
        background-repeat: repeat-x;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffd9534f',endColorstr='#ffc9302c',GradientType=0);
    }
    .progress-bar-danger {
        background-color: #F35958;
        background-image: none;
    }
    /*progress bar css end*/ 
    .dataTables_filter{
        display: none !important;
    }
    .card {
        font-size: 1em;
        overflow: hidden;
        padding: 0;
        border: none;
        border-radius: .28571429rem;
        box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    }

    .card-block {
        font-size: 1em;
        position: relative;
        margin: 0;
        padding: 1em;
        border: none;
        border-top: 1px solid rgba(34, 36, 38, .1);
        box-shadow: none;
    }

    .card-img-top {
        display: block;
        width: 100%;
        height: auto;
    }

    .card-title {
        font-size: 1.28571429em;
        font-weight: 700;
        line-height: 1.2857em;
    }

    .card-text {
        clear: both;
        margin-top: .5em;
        color: rgba(0, 0, 0, .68);
    }

    .card-footer {
        font-size: 1em;
        position: static;
        top: 0;
        left: 0;
        max-width: 100%;
        padding: .75em 1em;
        color: rgba(0, 0, 0, .4);
        border-top: 1px solid rgba(0, 0, 0, .05) !important;
        background: #fff;
    }

    .card-inverse .btn {
        border: 1px solid rgba(0, 0, 0, .05);
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/stock_menu'); ?>
    <div class="clearfix"></div>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="views data-show table-view" data-view="hidden">
            <div class="">
                <div class="card-body">   
                    <div class="row">
                        <!--Name-->
                        <div class="col-md-3 pl-1">
                            <label>SKU #</label>
                            <div class="form-group input-group" id="filter_col1" data-column="1">

                                <div class="input-group-addon"><i class="fa fa-table"></i></div>
                                <input type="text" name="Name" class="form-control column_filter" id="col1_filter" placeholder="">
                            </div>
                        </div>
                        <!--Name-->
                        <div class="col-md-3 pl-1">
                            <label>PRODUCT NAME</label>
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

            <div class="">
                <div class="row">
                    <div class="">
                        <table id="products-table" class="table table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Product</th>
                                    <th>Desc</th>
                                    <th>Last Stocked</th>
                                    <th>Qty Purchased</th>
                                    <th>Qty Sold</th>
                                    <th>Current Stock</th>
                                    <th>Status</th>
                                    <!-- <th>View</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentStock = 0;
                                $status = '';
                                $class = '';
                                $stockPurchase = 0;
                                $stockSold = 0;


                                // $Subtotal = 0;
                                // $date     = date('Y-m-d H:i:s');
                                // $newDate  = date('F, d-Y H:i:s',strtotime($date));
                                // echo "<br><br>".$newDate;
                                //  $date          = DateTime::createFromFormat('Y-m-d H:i:s', $order['pos_date']);
                                // $purchase_date = $date->format("F d Y h:i:s a");
                                $sno = 1;
                                if (!empty($stock)) {
                                    foreach ($stock as $s) {



                                        // $total+=$pro_d->pos_prd_qty*$pro_d->pos_prd_price;
                                        // $Subtotal+=$total;
                                        ?>

                                        <tr>
                                            <td><a href="<?= base_url('Stock/singleProduct/' . $s['item']->prd_id) ?>"><?= $s['item']->prd_code; ?></a></td>
                                            <td>
                                                <?= $s['item']->prd_title; ?>
                                            </td>
                                            <td><?= $s['item']->prd_desc; ?></td>
                                            <td><?php
                                                if (!empty($s['last_stock'])) {
                                                    echo date('m/d/Y', strtotime($s['last_stock']->date));
                                                } else {
                                                    echo '-';
                                                }
                                                ?></td>
                                            <td><?php
                                                if (!empty($s['qty']) && $s['qty']->total != '') {
                                                    echo $s['qty']->total . ' ' . $s['item']->unit_name;
                                                } else {
                                                    echo 0;
                                                    echo ' ' . $s['item']->unit_name;
                                                }
                                                ?></td>
                                            <td><?php
                                                if (!empty($s['qtyMinus']) && $s['qtyMinus']->total != '') {
                                                    echo $s['qtyMinus']->total;
                                                    echo ' ' . $s['item']->unit_name;
                                                } else {
                                                    echo 0;
                                                    echo ' ' . $s['item']->unit_name;
                                                }
                                                ?></td>
                                            <td>
                                                <?php
                                                $stockPurchase = 0;
                                                $stockSold = 0;

                                                if (!empty($s['qty']) && $s['qty']->total != '') {
                                                    $stockPurchase = $s['qty']->total;
                                                }
                                                if (!empty($s['qtyMinus']) && $s['qtyMinus']->total != '') {
                                                    $stockSold = $s['qtyMinus']->total;
                                                }

                                                echo $stockPurchase - $stockSold;
                                                echo ' ' . $s['item']->unit_name
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $currentStock = $stockPurchase - $stockSold;
                                                $status = '';
                                                $class = '';
                                                if ($currentStock < 50 && $currentStock > 1) {
                                                    $status = 'Short';
                                                    $class = 'label-warning';
                                                    echo '<label class="label label-warning">Short</label>';
                                                } elseif ($currentStock >= 50) {
                                                    $status = 'In Stock';
                                                    $class = 'label-success';
                                                    echo '<label class="label label-success">In Stock</label>';
                                                } elseif ($currentStock < 1) {
                                                    $status = 'Out Of Stock';
                                                    $class = 'label-danger';
                                                    echo '<label class="label label-danger">Out Of Stock</label>';
                                                }
                                                ?>
                                                

                                            </td>
                                        </tr>

                                        <?php
                                        $sno++;
                                    }
                                }
                                ?>
                            </tbody>
    <!--                        <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="views data-hide list-view" data-view="hidden">
            <div class="row">
                <?php
                if (!empty($stock)) {
                    foreach ($stock as $s) {
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mt-4" style="margin-bottom: 20px;">
                            <div class="card">
                                <img class="card-img-top" style="height:200px !important;" src="<?php
                                if (!empty($s['image']->prd_image)) {
                                    echo base_url('img_uploads/product_images/' . $s['image']->prd_image);
                                } else {
                                    echo base_url('img_uploads//no-image.jpg');
                                }
                                ?>">
                                <div class="card-block">

                                    <h4 class="card-title mt-3"><?= $s['item']->prd_title; ?></h4>
                                    <div class="meta">
                                        <?php
                                        $pur = 0;
                                        if (!empty($s['qty']->total)) {
                                            $pur = $s['qty']->total;
                                        }
                                        $sal = 0;
                                        if (!empty($s['qtyMinus']->total)) {
                                            $sal = $s['qtyMinus']->total;
                                        }
                                        $date = '-';
                                        if (!empty($s['last_stock'])) {
                                            $date = date('F d Y', strtotime($s['last_stock']->date));
                                        }
                                        ?>
                                        <b>Purchased:</b>  <?= $pur . ' ' . $s['item']->unit_name; ?><br />
                                        <b>Sold:</b>  <?= $sal . ' ' . $s['item']->unit_name; ?><br />
                                        <b>Current Stock:</b> <?=
                                        $pur - $sal . ' ' . $s['item']->unit_name;
                                        ;
                                        ?><br />
                                    </div>
                                    <div class="card-text">
                                        <p><?= $s['item']->prd_desc; ?></p>
                                    </div>
                                </div>
                                <?php
                                if ($pur == 0 && $sal == 0) {
                                    $avg = 0;
                                    $perc = 0;
                                } elseif ($pur > $sal) {
                                    $avg = ($sal / $pur) * 100;
                                    $perc = 100 - $avg;
                                }
                                ?>
                                <div class="col-md-12">
                                    <div class="progress">
                                        <div data-percentage="0%" style="width: <?= $perc; ?>%;" class="progress-bar <?php if ($perc >= 80) { ?> progress-bar-success <?php } elseif ($perc >= 60 && $perc <= 79) { ?> progress-bar-primary <?php } elseif ($perc >= 45 && $perc <= 59) { ?> progress-bar-info <?php } elseif ($perc >= 30 && $perc <= 44) { ?> progress-bar-warning <?php } else { ?> progress-bar-danger <?php } ?>" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <small>Last Stocked <?= $date; ?></small>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>
            </div>
        </div>
</div>

<!-- /.box -->

</section>
<!-- /.content -->

<!-- /.content-wrapper -->


<script>
    function filterColumn(i) {
        $('#products-table').DataTable().column(i).search(
                $('#col' + i + '_filter').val()
                ).draw();
    }

    $(document).ready(function () {
        $('.input-daterange input').each(function () {
            $(this).datepicker('clearDates');
        });


        $('input.global_filter').on('change', function () {
            filterGlobal();
        });

        $('input.column_filter').on('change', function () {
            filterColumn($(this).parents('div').attr('data-column'));
        });
    });
    $(document).ready(function () {
        var table = $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
            scrollY: '57vh',
            scrollCollapse: true,
            "paging": false,
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                total = api
                        .column(6)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Total over this page
                pageTotal = api
                        .column(6, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                // Update footer
                $(api.column(6).footer()).html(
                        '$' + pageTotal.toFixed(2) + ' ( $' + total.toFixed(2) + ' total)'
                        );
            }

        });

        // Extend dataTables search
        $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
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
        $('.date-range-filter').change(function () {
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



