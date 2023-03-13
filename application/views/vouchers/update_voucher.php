<?php
$voucher_no = '';
$voucher_type = '';
$voucher_interaction = '';
$voucher_id = '';
$voucher_date = '';
$voucher_pay_via = '';
$voucher_particulars = '';
$voucher_note = '';
$post_status = '';
$voucher_status = '';
$img = '';
if (!empty($single_voucher_information)) {
    foreach ($single_voucher_information as $single) {
        $voucher_no = $single['voucher']->voucher_number;
        $voucher_type = $single['voucher']->voucher_type;
        $voucher_interaction = $single['voucher']->voucher_interaction;
        $voucher_date = $single['voucher']->voucher_date;
        $voucher_pay_via = $single['voucher']->voucher_paying_via;
        $voucher_particulars = $single['voucher']->voucher_particulars;
        $voucher_note = $single['voucher']->voucher_desc;
        $voucher_id = $single['voucher']->voucher_id;
        $voucher_status = $single['voucher']->voucher_status;
        $post_status = $single['voucher']->post_status;
        $img = $single['voucher']->voucher_img;
    }
}
?> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1 class="inline">
            <?php if ($voucher_status > 0) { ?>
                Canceled Voucher
                <?php
            } else {
                echo $voucher_type . " Voucher";
            }
            ?>
        </h1>
        <a class="btn btn-primary site-button pull-right text-uppercase" href="<?= base_url('Vouchers/paymentVouchers'); ?>"> Back to <?= $voucher_type; ?> Vouchers</a>
    </section>
    <div class="clearfix clear"></div>
    <!-- Main content -->
    <section class="content">
        <div class="single-page-wrapper">
            <div class="row single-page-innerwrapper">
                <form role="form" method="post" class="" action="<?= base_url('Vouchers/updateMultipleVoucher'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="voucher_id"  value="<?= $voucher_id; ?>"/>
                    <input type="hidden" name="voucher_type" value="<?= $voucher_type; ?>"/>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Voucher Code</label>
                                        <input type="text" name="voucher_code" class="form-control" required value="<?= $voucher_no; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php if ($voucher_type == 'TRANSFER') { ?>Transfer by<?php } else { ?>Paye<?php if ($voucher_type == 'RECEIPT') { ?>r<?php } else { ?>e<?php } ?><?php } ?></label>
                                        <input type="text" name="payee" class="form-control" required value="<?= $voucher_interaction; ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" name="date" class="form-control" readonly value="<?= $voucher_date; ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?>>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php if ($voucher_type == 'RECEIPT') { ?>Receiving<?php } elseif ($voucher_type == 'PAYMENT') { ?>Paying<?php } else { ?> Transfer <?php } ?> VIA</label>
                                        <input type="text" name="paying_via" class="form-control" value="<?= $voucher_pay_via; ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Particulars</label>
                                        <input type="text" name="particulars" class="form-control" placeholder="Check no,Transaction ID etc" value="<?= $voucher_particulars; ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?>>
                                    </div>
                                </div>
                               
                                    <!-- *************** payment Conditon start -->
                                <?php if ($voucher_type == 'PAYMENT') { ?>
                                    <?php if (!empty($single_voucher_information)) { ?>
                                        <?php foreach ($single_voucher_information as $s) {
                                            ?>

                                            <?php
                                            foreach ($s['voucher_heads'] as $key => $head) {
                                                $sizVoucher = sizeof($s['voucher_heads']) - 1;
                                                ?>

                                                <div>
                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Select Expanse Account</label>
                                                                            <select name="paying_for[]" class="form-control payingFor" required>
                                                                                <?php if (!empty($payable_accounts)) { ?>
                                                                                    <?php foreach ($payable_accounts as $pay) { ?>
                                                                                        <option <?php if ($head->for_A_H == $pay->coa_id) { ?> selected <?php } ?> value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label>Payment Source</label>
                                                                            <select name="paying_from[]" class="form-control payingForm" required>
                                                                                <?php if (!empty($pay_from)) { ?>
                                                                                    <?php foreach ($pay_from as $pay) { ?>
                                                                                        <option <?php if ($head->from_A_H == $pay->coa_id) { ?> selected <?php } ?> value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                    <div class="col-md-4">
                                                        <label>Amount ( <?= $currency ?>)</label><div class="form-group input-group">
                                                            <input type="text" name="amount[]" class="form-control" required value="<?php echo $head->amount; if(strpos($head->amount,'.') === false){ echo '.00'; } ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?> >
                                                            <?php if($post_status == 0) : ?>
                                                                
                                                                <span class="input-group-addon btn-danger"  onclick="removeRow(this)"><i class="fa fa-trash"></i></span> 
                                                                <?php
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- <div id="a"></div> -->
                                                <div class="col-md-12">
                                                    <?php // if ($post_status <= 0 && $voucher_status != 1) { ?> 
                                                    <?php
                                                    // if ($key == $sizVoucher) { 
                                                    ?>
                                                            <!-- <button type="button" id="add" class="btn btn-default btn-flat" onclick="appendRow();"><i class="fa fa-plus"></i> New Row</button> -->
                                                    <?php // } else { 
                                                    ?>
                                                            <!-- <button type="button" id="remove" class="btn btn-block btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button> -->
                                                            <!-- <button type="button" id="add" class="btn btn-default btn-flat" onclick="appendRowTran();"><i class="fa fa-plus"></i> New Row</button> -->
                                                    <?php
                                                    // } 
                                                    ?>
                                                    <?php //}   ?>
                                                </div>


                                            <?php } ?>
                                        <?php } ?>
                                        <div id="a"></div>
                                        <?php if($post_status == 0) : ?>
                                        <div class="col-md-12" style="margin-top:15px;margin-bottom:15px;">
                                            <button type="button" id="add" class="btn btn-default btn-flat" onclick="appendRow();"><i class="fa fa-plus"></i> New Row</button>
                                        </div>
                                    <?php endif; } ?>
                                    <!-- **************./Payment Condition end -->
                                    <!--*************** Transfer Condition Start -->
                                <?php } elseif ($voucher_type == 'TRANSFER') { ?>
                                    <?php if (!empty($single_voucher_information)) { ?>
                                        <?php foreach ($single_voucher_information as $s) { ?>
                                            <?php
                                            foreach ($s['voucher_heads'] as $key => $head) {
                                                $sizVoucher = sizeof($s['voucher_heads']) - 1;
                                                ?>
                                                <div><div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Transfer From</label>
                                                            <select name="paying_from[]" class="form-control <?php if ($key < 1) { ?> payingForm <?php } ?>" required <?php if ($post_status > 0) { ?> disabled <?php } ?>>
                                                                <?php if (!empty($pay_from)) { ?>
                                                                    <?php foreach ($pay_from as $pay) { ?>
                                                                        <option <?php if ($head->from_A_H == $pay->coa_id) { ?> selected <?php } ?>  value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-md-offset-1">
                                                        <div class="form-group">
                                                            <label>Transfer To</label>
                                                            <select name="paying_for[]" class="form-control <?php if ($key < 1) { ?> payingFor <?php } ?>" required <?php if ($post_status > 0) { ?> disabled <?php } ?>>
                                                                <?php if (!empty($pay_from)) { ?>
                                                                    <?php foreach ($pay_from as $pay) { ?>
                                                                        <option <?php if ($head->from_A_H == $pay->coa_id) { ?> selected <?php } ?>  value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3  col-md-offset-1">
                                                        <label>Amount</label><div class="form-group input-group">
                                                            <input type="text" name="amount[]" class="form-control" required value="<?php  if(is_float($head->amount)){ echo $head->amount; }else{ echo $head->amount.'.00';} ?>" <?php if ($post_status > 0) { ?> readonly <?php } ?> >
                                                            <?php
                                                            if ($key <= $sizVoucher) {
                                                                ?>
                                                                <span class="input-group-addon btn-danger"  onclick="removeRow(this)"><i class="fa fa-trash"></i></span> 
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <!-- <div id="a"></div> -->
                                                    <div class="col-md-12">
                                                        <?php //if ($post_status <= 0 && $voucher_status != 1) {   ?> 
                                                        <?php //if ($key == $sizVoucher) { ?>
                                                                <!-- <button type="button" id="add" class="btn btn-default btn-flat" onclick="appendRowTran();"><i class="fa fa-plus"></i> New Row</button> -->
                                                        <?php // } else {   ?>

                                                                                                                                                                                                                                                                                                                    <!-- <button type="button" id="remove" class="btn btn-block btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button> -->
                                                        <?php //}   ?>
                                                        <?php //}   ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <div id="a"></div>
                                        <button type="button" id="add" class="btn btn-default btn-flat" onclick="appendRowTran();"><i class="fa fa-plus"></i> New Row</button>
                                    <?php }
                                    ?>
                                <?php }
                                ?>   

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Additional Note</label>
                                        <textarea type="text" name="note" class="form-control" <?php if ($post_status > 0) { ?> readonly <?php } ?>><?= $voucher_note; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="hidden" name="image" value="<?= $img; ?>" />
                                <div class="form-group">
                                    <label>
                                        <?php if($post_status == 0){ ?>
                                        Upload Scan / File
                                        <?php } ?>
                                        <img style="max-height:200px;max-width:200px;" src="<?= base_url('img_uploads/voucher_img/'.$img); ?>" class="" id="blah" />
                                        <?php if($post_status == 0){ ?>
                                        <input type="file" id="voucher_img" class="form-control" name="file" onchange="readURL(this);">
                                        <?php } ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">

                                <?php if ($post_status > 0) { ?>

                                <?php } else { ?>
                                    <?php if ($voucher_status == 0) { ?>
                                        <button type="submit" class="btn btn-primary btn-flat">UPDATE VOUCHER</button>
                                        <button type="button" onclick="openCancelModal();" class="btn btn-danger  btn-flat"> CANCEL VOUCHER</button>
                                        <button  type="button" class="btn btn-success btn-flat" onclick="openModalPost()">POST VOUCHER</button>
                                    <?php } ?>
                                <?php } ?>    
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function appendRow() { // TO APPEND ROW TO PAYMENT VOUCHER


        var data = '';

        data += `  <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Expanse Account</label>
                                    <select name="paying_for[]" class="form-control payingFor" required>
                                        <?php if (!empty($payable_accounts)) { ?>
                                            <?php foreach ($payable_accounts as $pay) { ?>
                                                <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>`;

        data += `   
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payment Source</label>
                                    <select name="paying_from[]" class="form-control payingForm" required>
                                        <?php if (!empty($pay_from)) { ?>
                                            <?php foreach ($pay_from as $pay) { ?>
                                                <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>`;
        data += '<div class="col-md-4"><label>Amount ( <?= $currency ?>)</label><div class="form-group input-group"> <input type="text" name="amount[]" class="form-control" required> <span class="input-group-addon btn-danger"  onclick="removeRow(this)"><i class="fa fa-trash"></i></span> </div></div></div>';
        $('#a').append(data);
    }
    function appendRowRec() { // TO APPEND ROW TO RECEIPT VOUCHER
        var payingFor = '';
        var payingForm = '';
        $('.payingForm').find('option').each(function () {

            payingForm += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });
        $('.payingFor').find('option').each(function () {

            payingFor += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });

        var data = '<div><div class="col-md-4"><div class="form-group"><label>Receiving Amount For</label><select name="receive_for[]" class="form-control" required>';

        data += payingFor;

        data += '</select></div></div><div class="col-md-4"><div class="form-group"><label>Receiving In</label><select name="receive_from[]" class="form-control" required>';
        data += payingForm;
        data += '</select></div></div><div class="col-md-4"><label>Amount</label><div class="form-group input-group"><input type="text" name="amount[]" class="form-control" required> <span class="input-group-addon btn-danger" id="remove" onclick="removeRow(this)"><i class="fa fa-trash"></i></span></div></div></div>';
        $('#a').append(data);
    }
    function appendRowTran() { // TO APPEND ROW TO TRANSFER VOUCHER
        var payingFor = '';
        var payingForm = '';
        $('.payingForm').find('option').each(function () {

            payingForm += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });
        $('.payingFor').find('option').each(function () {

            payingFor += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });

        var data = '<div><div class="col-md-3"><div class="form-group"><label>Transfer From</label><select name="paying_from[]" class="form-control" required>';

        data += payingFor;

        data += '</select></div></div><div class="col-md-3 col-md-offset-1"><div class="form-group"><label>Transfer To</label><select name="paying_for[]" class="form-control" required>';
        data += payingForm;
        data += '</select></div></div><div class="col-md-3  col-md-offset-1"><div class="form-group"><label>Amount</label><input type="text" name="amount[]" class="form-control" required></div></div><div class="col-md-1"><div class="clearfix">&nbsp;</div><button type="button" id="remove" class="btn btn-block btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button></div></div>';

        $('#a').append(data);
    }
    function removeRow(obj) {
        $(obj).parent().parent().parent().remove();
    }
    function openCancelModal() {
        $('#cancel_modal').modal('show');
    }
    function openModalPost() {
        $('#modal-danger').modal('show');

    }
</script>

<!--model code for posting voucher start-->
<div class="modal fade" id="cancel_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL VOUCHER</h4>
            </div>
            <form method="post" action="<?= base_url('Vouchers/cancelVoucher'); ?>">
                <div class="modal-body">
                    <input type="hidden" name="voucher_id" value="<?= $voucher_id; ?>" />
                    <input type="hidden" name="voucher_type" value="<?= $voucher_type; ?>" />

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Reason</label>
                                <textarea name="reason" placeholder="Enter reason of cancelation..." required class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-flat btn-btn btn-success">CANCEL VOUCHER</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal modal-default fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">RECEIVE IN</h4>
            </div>
            <form method="post" action="<?= base_url('Vouchers/postVoucher/' . $voucher_id); ?>">

                <div class="modal-body">
                    <div class="row">
                        <div class="clearfix">&nbsp;</div>
                        <div class="col-md-12">
                            <label>Posting Date</label>
                            <input type="text"  name="posting_date" class="form-control currentdatepicker" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-flat btn-success"> POST VOUCHER</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>