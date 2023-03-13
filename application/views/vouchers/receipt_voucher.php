<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Receipt Voucher
            <small>it all starts here</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active"></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-primary">
            <form role="form" method="post" class="form-horizontal" action="<?= base_url('Vouchers/saveReceiptVoucher'); ?>">
                <div class="box-body">
                    <!-- text input -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Voucher Code</label>
                            <input type="text" name="voucher_code" class="form-control" required value="<?= $voucher_no; ?>">
                        </div>
                    </div>

                    <div class="col-md-3 col-md-offset-1">
                        <div class="form-group">
                            <label>Payer</label>
                            <input type="text" name="payer" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-3 col-md-offset-1">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="currentdatepicker" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="clearfix">&nbsp;</div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Receiving VIA</label>
                            <input type="text" name="receiving_via" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-7 col-md-offset-1">
                        <div class="form-group">
                            <label>Particulars</label>
                            <input type="text" name="particulars" id="currentdatepicker" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Receiving Amount For</label>
                            <select name="receive_for[]" class="form-control payingFor" required>
                                <?php if (!empty($payable_accounts)) { ?>
                                    <?php foreach ($payable_accounts as $pay) { ?>
                                        <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-1">
                        <div class="form-group">
                            <label>Receiving In</label>
                            <select name="receive_from[]" class="form-control payingForm" required>
                                <?php if (!empty($pay_from)) { ?>
                                    <?php foreach ($pay_from as $pay) { ?>
                                        <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3  col-md-offset-1">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount[]" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="clearfix">&nbsp;</div>
                        <button type="button" id="add" class="btn btn-block btn-primary" onclick="appendRow();"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div id="a"></div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label>Additional Note</label>
                            <textarea type="text" name="note" class="form-control" required></textarea>
                        </div>
                    </div>



                    <div class="col-md-12" id="preview-area"></div>
                    <div class="clearfix"></div>

                </div>
                <div class="box-footer">
                    <a href='<?= base_url("Vouchers/allVouchers"); ?>' class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </form>

        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    function appendRow() {
        var payingFor = '';
        var payingForm = '';
        $('.payingForm').find('option').each(function () {

            payingForm += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });
        $('.payingFor').find('option').each(function () {

            payingFor += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';

        });

        var data = '<div><div class="col-md-3"><div class="form-group"><label>Receiving Amount For</label><select name="receive_for[]" class="form-control" required>';

        data += payingFor;

        data += '</select></div></div><div class="col-md-3 col-md-offset-1"><div class="form-group"><label>Receiving In</label><select name="receive_from[]" class="form-control" required>';
        data += payingForm;
        data += '</select></div></div><div class="col-md-3  col-md-offset-1"><div class="form-group"><label>Amount</label><input type="text" name="amount[]" class="form-control" required></div></div><div class="col-md-1"><div class="clearfix">&nbsp;</div><button type="button" id="remove" class="btn btn-block btn-danger" onclick="removeRow(this)"><i class="fa fa-trash"></i></button></div></div>';
        $('#a').append(data);
    }
    function removeRow(obj) {
        $(obj).parent().parent().remove();
    }
</script>