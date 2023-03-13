<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .dataTables_filter{
        display: none !important;
    }
</style>
<div class="content-wrapper">
    <?php $this->load->view('include/voucher_menu'); ?>
    <form method="post" class="postVouchers" action="<?= base_url('Vouchers/postedVouchers') ?>">
        <div class="modal modal-danger fade" id="post-voucher-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">RECEIVE IN</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="clearfix">&nbsp;</div>
                            <div class="col-md-12">
                                <label>Posting Date</label>
                                <input type="text"  name="posting_date" class="form-control currentdatepicker"  />
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>

                        <button onclick="$('.postVouchers').submit();" class="btn btn-btn btn-outline"> POST VOUCHER</button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <section class="content">
            <div class="">
                            <div class="card-body">
       
                <div class="row">

                  <!--Name-->
                  <div class="col-md-3 pl-1">
                      <label>VOUCHER #</label>
                        <div class="form-group input-group" id="filter_col1" data-column="1">
                            
                            <div class="input-group-addon"><i class="fa fa-table"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col1_filter" placeholder="">
                        </div>
                    </div>
                  
                  <!--Job-->
                  <div class="col-md-3 pl-1">
                      <label>PAYEE</label>
                         <div class="form-group input-group" id="filter_col2" data-column="2">
                             <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" name="Name" class="form-control column_filter" id="col2_filter" placeholder="">
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
                <!-- /.box-header -->
                <div class="row">
                    <div class="">
                        <table id="products-table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 18px;">
                                        <label>
                                            <input type="checkbox" onclick="if ($(this).is(':checked')) {
                                                        $('.myCustomCheckBox').attr('checked', true)
                                                    } else {
                                                        $('.myCustomCheckBox').removeAttr('checked');
                                                    }" class="minimal">
                                        </label>
                                    </th>
                                    <th>Voucher #</th>
                                    <th>Payee</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th style="width: 200px;"></th>
                                </tr>
                            </thead>


                            <tbody>

                                <?php $total_expense = 0 ;
                                      if (!empty($voucher_data)) { ?>
                                    <?php
                                    $count = 1;
                                    
                                    foreach ($voucher_data as $key => $v) {
                                        $style = '';
                                        $status = '';
                                        $can_status = $v['voucher']->voucher_status;
                                        $post_status = $v['voucher']->post_status;
                                        $method = $v['voucher']->voucher_paying_via;

                                        $new_date = date('m/d/Y', strtotime($v['voucher']->voucher_date));
                                        

                                        if ($can_status == 1) {
                                            $status = 'CANCELED';
                                            $style = 'text-warning';
                                        } elseif ($post_status == 1) {
                                            $status = 'POSTED';
                                            $style = 'text-danger';
                                        } elseif ($can_status != 1 && $post_status != 1) {
                                            $status = 'UNPOSTED';
                                            $style = 'text-primary';
                                        }
                                        ?>
                                        <tr class="<?php if($status == "CANCELED"){echo "tbl-red";}elseif($status == "POSTED"){echo "tbl-green";}else{echo "tbl-yellow";} ?>">
                                            <td>
                                                <?php if ($v['voucher']->post_status == 0 && $v['voucher']->voucher_status == 0){ ?>
                                                    <input type="checkbox" class="minimal myCustomCheckBox" name="vocher_id[<?= $v['voucher']->voucher_id ?>]" value="<?= $v['voucher']->voucher_id ?>">
                                                <?php }else{ ?>
                                                    <input type="checkbox" name="" disabled="" readonly="">
                                                <?php } ?>
                                            </td>
                                            <td><a href="<?= base_url('Vouchers/updateVoucher/' . $v['voucher']->voucher_id); ?>"><?= $prefix.' '.$v['voucher']->voucher_number; ?></a></td>
                                             <td><?= $v['voucher']->voucher_interaction; ?></td>
                                            <td><?= $new_date; ?></td>
                                           
                                            <td><?php

                                               $total_expense = $total_expense + $v['amount'];
                                               echo $currency.' '.number_format($v['amount'],2); ?></td>
                                            <td><?= $method; ?></td>
                                            <td>
                                                <span class="badge <?php if($status == "CANCELED"){echo "bg-red";}elseif($status == "POSTED"){echo "bg-green";}else{echo "bg-yellow";} ?>">   <?= $status; ?></span>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-default btn-flat table-btn" href="<?= base_url('Vouchers/updateVoucher/' . $v['voucher']->voucher_id); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-sm btn-info btn-flat table-btn"  href="<?= base_url('Vouchers/printableVoucher/' . $v['voucher']->voucher_id); ?>"><i class="fa fa-print"></i></a>
                                                <?php if ($status == 'UNPOSTED') { ?>
                                                <a class="btn btn-sm btn-success btn-flat table-btn"   onclick="$('.my_voucher_id').val('<?= $v['voucher']->voucher_id; ?>'); $('#post_single_voucher').modal('show');" ><i class="fa fa-dollar"></i></A>
                                                <a class="btn btn-sm btn-danger btn-flat table-btn"  onclick="$('.single_voucher_id').val('<?= $v['voucher']->voucher_id ?>');$('#cancel_single_voucher_modal').modal('show')"><i class="fa fa-times"></i></a>
                                                        <?php } ?>  
                                            </td>


                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear"></i> BULK ACTION    <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a data-toggle="modal" data-target="#post-voucher-modal">Post Voucher</a></li>
                                                <li><a onclick="
                                                            $('.postVouchers').attr('action', '<?= base_url('Vouchers/cancelCheckedVoucher'); ?>');
                                                            $('#cancel_modal').modal('show');
                                                        ">Cancel</a></li>
                                            </ul></div>
                                    </td>
                                    <td colspan="3" style="font-weight: bold; background: #f1f1f1;">
                                    <?php // echo $currency.' '.number_format($total_expense,2); ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        
        <!--model code for posting voucher start-->
<div class="modal fade" id="cancel_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL VOUCHER</h4>
            </div>
                <div class="modal-body">

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
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

                    <button class="btn btn-btn btn-primary">CANCEL VOUCHER</button>
                </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    </form>

</div>
<script type="text/javascript">
    
    function filterColumn ( i ) {
        $('#products-table').DataTable().column( i ).search(
            $('#col'+i+'_filter').val()
        ).draw();
    }
    
    $(document).ready(function() {
        $('.input-daterange input').each(function() {
  $(this).datepicker('clearDates');
});


        $('input.global_filter').on( 'change', function () {
            filterGlobal();
        } );
    
        $('input.column_filter').on( 'change', function () {
            filterColumn( $(this).parents('div').attr('data-column') );
        } );
    } );
    $(document).ready(function () {

    $('.scroll-modal-btn').click(function () {
    $('.modal')
            .prop('class', 'modal fade') // revert to default
            .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
    });
    var  table =  $('#products-table').DataTable({
    "dom": '<"toolbar">frtip',
             scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal.toFixed(2) +' ( $'+ total.toFixed(2) +' total)'
            );
        }
            
    });
    
    // Extend dataTables search
$.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
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
$('.date-range-filter').change(function() {
  table.draw();
});
            $("div.toolbar").html('');
            $('.scroll-modal-btn').click(function () {
    $('.modal')
            .prop('class', 'modal fade') // revert to default
            .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
    });
    });</script>

<script type="text/javascript">
            function appendRow() { // this function is used to append row to payment voucher

                    var data = '';
                    data += `
                         <div class="col-md-4">
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
                            </div>
                        `;
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
                    data += '<div class="col-md-4"><label>Amount ( <?= $currency ?>)</label><div class="form-group input-group">  <input type="text" name="amount[]" class="form-control" required> <span class="input-group-addon btn-danger"  onclick="removeRow(this)"><i class="fa fa-trash"></i></span> </div></div></div>';
                    $('#a').append(data);
            }
   
    function removeRow(obj) {
    $(obj).parent().parent().parent().remove();
    }
    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();
            reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
    }
    }


</script>
<div class="modal fade " id="new-exp-head">
    <div class="modal-dialog scroll-modal">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            ADD NEW EXPENSE HEAD
            <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
        </h1>
        <!-- Title -->
        <form role="form" method="post" action="<?= base_url('Vouchers/AddNewExpHead/'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>COA Head</label>
                                <input type="text" name="coa_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select SubType</label>
                                <select class="form-control" name="coa_subtypeid">
                                    <option value="0"></option>
                                    <?php foreach ($exp_subtypes as $single_type) { ?>
                                        <option value="<?= $single_type->coa_subtype_id; ?>">
                                            <?= $single_type->coa_subtype_name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Short Description</label>
                                <input type="text" name="coa_desc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="number" name="coa_code" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">ADD HEAD</button>
                            <input type="reset" name="" value="RESET" class="btn btn-warning">

                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade " id="new-income-head">
    <div class="modal-dialog scroll-modal">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            ADD NEW INCOME HEAD
            <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
        </h1>
        <!-- Title -->
        <form role="form" method="post" action="<?= base_url('Vouchers/AddNewIncomeHead/'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>COA Head</label>
                                <input type="text" name="coa_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select SubType</label>
                                <select class="form-control" name="coa_subtypeid">
                                    <option value="0"></option>
                                    <?php foreach ($income_subtypes as $single_type) { ?>
                                        <option value="<?= $single_type->coa_subtype_id; ?>">
                                            <?= $single_type->coa_subtype_name; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Short Description</label>
                                <input type="text" name="coa_desc" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="number" name="coa_code" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">ADD HEAD</button>
                            <input type="reset" name="" value="RESET" class="btn btn-warning">

                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php if ($this->uri->segment(2) == 'paymentVouchers') { ?>
    <!--THIS IS NEW PAYMENT VOUCHER MODAL-->
    <aside class="control-sidebar control-sidebar-light">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            EXPENSE VOUCHER
            <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
        </h1>
        <!-- Title -->
        <form method="post" action="<?= base_url('Vouchers/savePaymentVoucher'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Voucher Code</label>
                                    <input type="text" name="voucher_code" class="form-control" required value="<?= $voucher_no; ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payee <span data-toggle="tooltip" data-toggle="tooltip" data-original-title="Person to whom money is paid"><i class="fa fa-info-circle"></i></span></label>
                                    <input type="text" name="payee" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="date" id="currentdatepicker" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Paying VIA</label>
                                    <input type="text" name="paying_via" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Particulars</label>
                                    <input type="text" name="particulars" id="currentdatepicker" class="form-control" placeholder="Check no,Transaction ID etc">
                                </div>
                            </div>
                               <div class="col-md-4">
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
                            </div>
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
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount ( <?= $currency ?>)</label>
                                    <input type="text" name="amount[]" class="form-control"  required>
                                </div>
                            </div>
                            <div id="a" class="remove"></div>
                            <div class="col-md-12">
                                <button type="button" id="add" class="btn btn-default" onclick="appendRow();"><i class="fa fa-plus"></i> New Row</button>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Additional Note</label>
                                    <textarea type="text" name="note" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">ADD VOUCHER</button>
                            </div>


                            <div class="col-md-12" id="preview-area"></div>
                            <div class="clearfix"></div>  
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    Upload Scan / File
                                    <img class="" id="blah" />
                                    <input type="file" id="voucher_img" class="form-control" name="file" onchange="readURL(this);">
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </aside>
<?php } elseif ($this->uri->segment(2) == 'receiptVoucher') { ?>
    <aside class="control-sidebar control-sidebar-light">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            RECEIPT VOUCHER
            <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
        </h1>
        <!-- Title -->
        <form method="post" action="<?= base_url('Vouchers/saveReceiptVoucher'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Voucher Code</label>
                                    <input type="text" name="voucher_code" class="form-control" required value="<?= $voucher_no; ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Payer</label>
                                    <input type="text" name="payer" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="date" id="currentdatepicker" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Receiving VIA</label>
                                    <input type="text" name="receiving_via" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Particulars</label>
                                    <input type="text" name="particulars" id="currentdatepicker" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
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
                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount[]" class="form-control"  required>
                                </div>
                            </div>
                            <div id="a"></div>
                            <div class="col-md-12">
                                <button type="button" id="add" class="btn btn-default" onclick="appendRow2();"><i class="fa fa-plus"></i> New Row</button>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Additional Note</label>
                                    <textarea type="text" name="note" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>


                            <div class="col-md-12" id="preview-area"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    Upload Scan / File
                                    <img class="" id="blah" />
                                    <input type="file" id="voucher_img" class="form-control" name="file" onchange="readURL(this);">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </aside>
<?php } elseif ($this->uri->segment(2) == 'transferVoucher') { ?>
    <aside class="control-sidebar control-sidebar-light">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            TRANSFER VOUCHER
            <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
        </h1>
        <!-- Title -->
        <form method="post" action="<?= base_url('Vouchers/saveTransferVoucher'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Voucher Code</label>
                                    <input type="text" name="voucher_code" class="form-control" required value="<?= $voucher_no; ?>">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Transfer By</label>
                                    <input type="text" name="payer" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="date" id="currentdatepicker" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="clearfix">&nbsp;</div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Transfer VIA</label>
                                    <input type="text" name="receiving_via" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Particulars</label>
                                    <input type="text" name="particulars" id="currentdatepicker" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Transfer From</label>
                                    <select name="from[]" class="form-control payingFor" required>
                                        <?php if (!empty($pay_from)) { ?>
                                            <?php foreach ($pay_from as $pay) { ?>
                                                <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Transfer To</label>
                                    <select name="for[]" class="form-control payingForm" required>
                                        <?php if (!empty($pay_from)) { ?>
                                            <?php foreach ($pay_from as $pay) { ?>
                                                <option value="<?= $pay->coa_id; ?>"><?= $pay->coa_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount[]" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="add" class="btn btn-default" onclick="appendRowTrans();"><i class="fa fa-plus"></i> New Row</button>
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
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>


                            <div class="col-md-12" id="preview-area"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>
                                    Upload Scan / File
                                    <img class="" id="blah" />
                                    <input type="file" id="voucher_img" class="form-control" name="file" onchange="readURL(this);">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </aside>
<?php } ?>


<div class="modal modal-default fade" id="post_single_voucher">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="<?= base_url('Vouchers/postedVouchers'); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">IMPORTANT! You can not update voucher once its posted</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="vocher_id[]" class="my_voucher_id form-control" />
                    <div class="row">
                        <div class="col-md-12">
                            <label>Confirm Date</label>
                            <input type="text"  name="posting_date" class="form-control currentdatepicker" />
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-btn btn-success btn-flat">POST EXPENSE VOUCHER</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    
    
    
    
           <!--model code for posting voucher start-->
<div class="modal fade" id="cancel_single_voucher_modal">
    <form method="post" action="<?= base_url('Vouchers/cancelCheckedVoucher'); ?>">
        <input type="hidden" name="vocher_id[]" class="single_voucher_id" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL VOUCHER</h4>
            </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Reason</label>
                                <textarea name="reason" placeholder="Enter reason of cancelation..." required class="form-control"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left btn-flat" data-dismiss="modal">CLOSE POPUP</button>

                    <button class="btn btn-btn btn-success btn-flat">CANCEL VOUCHER</button>
                </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
</div>