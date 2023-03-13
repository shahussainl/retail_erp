<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/time_track_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->

    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table  table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Hours</th>
                            </tr>
                        </thead>
                        <?php if (!empty($allDays)) { ?>
                            <tbody>
                                <?php foreach ($allDays as $key => $record): ?>
                                    <tr>
                                        <td>
                                            <a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right"><?= date('F d Y', strtotime($record['date'])); ?></a>
                                            <div class="modal fade " id="<?= $key; ?>">
                                                <div class="modal-dialog scroll-modal">
                                                    <!-- Title -->
                                                    <h1 class="control-sidebar-heading">
                                                        <?= date('F d Y', strtotime($record['date'])); ?>
                                                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                                                    </h1>
                                                    <!-- Title -->

                                                    <div class="box box-control-sidebar">
                                                        <div class="box-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Time</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php  foreach ($record['detail'] as $detail): ?>

                                                                        <tr>
                                                                            <td><?= date('h:i:s a', strtotime($detail->timer_record_date)) ?></td>
                                                                            <td><?= $detail->timer_record_status ?></td>
                                                                        </tr>
                                                                    <?php  endforeach; ?>
                                                                </tbody>
                                                            </table>


                                                        </div>
                                                    </div>

                                                </div><!-- /.modal-dialog -->
                                            </div>
                                        </td>
                                        <td><?php echo date('h:i:s a', strtotime($record['start']->timer_record_date)) ?></td>
                                        <td><?php if (!empty($record['close']->timer_record_date)) { ?> <?php echo date('h:i:s a', strtotime($record['close']->timer_record_date)) ?><?php } ?></td>
                                        <td><?php if (!empty($record['close']->timer_record_date)) { ?> 
                                                <?php
                                                $date1 = date_create($record['start']->timer_record_date);

                                                $date2 = date_create($record['close']->timer_record_date);

                                                $diff = date_diff($date1, $date2);

                                                $hour = $diff->h;
                                                echo $hour;
                                                ?><?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,

            language: {search: "Your Record", searchPlaceholder: "Filter and Search..."}

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



