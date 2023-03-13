

<div class="content-wrapper">
    <?php if (!empty($accommodation)) { ?>
        <?php foreach ($accommodation as $key => $ac) { ?>
            <a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right">
                <div class="col-md-4">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-primary">
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><?= $ac->title; ?></h3>
                            <h5 class="widget-user-desc"><?= $ac->category_name; ?></h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a data-id="<?= $key; ?>" class="scroll-modal-btn" data-direction="right" href="#"> Size <span class="pull-right badge bg-blue"><?= $ac->accommodation_size; ?></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </a>

            <div class="modal fade " id="<?= $key; ?>">
                <div class="modal-dialog scroll-modal">
                    <!-- Title -->
                    <h1 class="control-sidebar-heading">
                        <?= $ac->title; ?> (<?= $ac->category_name; ?>)
                        <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
                    </h1>
                    <!-- Title -->
                    <form role="form" method="post" action="<?= base_url('Accommodation/addReservation'); ?>" >
                        <div class="box box-control-sidebar">
                            <div class="box-body">
                                <input type="hidden" name="accommodation_id" value="<?= $ac->accommodation_id; ?>" />
                                <div class="col-md-12">
                                    <h3>Accommodation Size : <?= $ac->accommodation_size; ?> </h3>
                                </div>
                                <div class="col-md-12">
                                    <h3>Price per Day : <?= $ac->acc_price; ?> </h3>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>CNIC</label>
                                        <input type="text" name="cnic" class="form-control" placeholder="Enter CNIC without dashes..." required />
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-block pull-left">SAVE RESERVATION</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div><!-- /.modal-dialog -->
            </div>
        <?php } ?>
    <?php } ?>
</div>
<script type="text/javascript">
    $('.scroll-modal-btn').click(function () {
        $('.modal')
                .prop('class', 'modal fade') // revert to default
                .addClass($(this).data('direction'));
        var modal_id = $(this).data('id');
        $('#' + modal_id).modal('show');
    });
</script>