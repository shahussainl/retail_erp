<?php

// echo "<pre>";
// print_r($prodWidget);
// print_r($ProdImages);
// exit();
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<style>
    .form-group{
        width:100%;
        margin-bottom: 15px !important;
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
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php $this->load->view('include/product_menu'); ?>
    <!--    <div class="col-md-12">-->
    <div class="clearfix"></div>
   <!-- <form method="post" class="postProduct" action=""> -->
  
    <section class="content">
        <div class="">
            <!-- widget start  Usman code-->
<div class="views data-hide list-view" data-view="show">
     <div class="row">
         <?php if (!empty($prodWidget)) { ?>
                    <?php
                    $count = 1;
                    foreach ($prodWidget as $prd) {
                        
         ?>
         <!-- showing modal -->
         <a data-id="<?= $count; ?>" class="scroll-modal-btn"  data-direction="right">

             <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
                         <div class="card">
                             <img class="card-img-top" src="<?php if(!empty($prd['i'])){ echo base_url('img_uploads/product_images/'.$prd['i']->prd_image);} else { echo base_url('img_uploads/no-image.jpg'); } ?>">
                             <div class="card-block">
                                 <h4 class="card-title"> <?= $prd['p']->prd_title;  ?> ( <?= $prd['p']->prd_code ?>  )</h4>
                                 <div class="meta">
                                     <?= $prd['p']->prdc_name; ?>
                                 </div>
                                 <div class="card-text">
                                     <?= $prd['p']->prd_desc;  ?>
                                 </div>
                             </div>
                             <div class="card-footer">
                                 <span class="pull-right">
                                 <?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?>
                    <?= number_format($prd['p']->prd_price,2); ?>
                                 </span>
                                 <span><i class=""></i>
                                             <?php
                                             $decision = '';
                                             if ($prd['p']->prd_is_sale == '1' && $prd['p']->prd_is_purchase == '0') {
                                                 $decision .= 'Sale';
                                             } elseif ($prd['p']->prd_is_purchase == '1' && $prd['p']->prd_is_sale == '0') {
                                                 $decision .= 'Purchase';
                                             } elseif ($prd['p']->prd_is_sale == '1' && $prd['p']->prd_is_purchase == '1') {
                                                 $decision .= 'Sale / Purchase';
                                             } elseif (empty($prd['p']->prd_is_sale) && empty($prd['p']->prd_is_purchase)) {
                                                 $decision .= 'None';
                                             } elseif (!empty($prd['p']->prd_is_sale == '0') && !empty($prd['p']->prd_is_purchase == '0')) {
                                                 $decision .= 'None';
                                             }

                                             echo $decision;
                                             ?>
                                 </span>
                             </div>
                         </div>
                     </div>

    </a>
    <?php
    $count++;
}
?>
<?php } ?>
      </div>
        </div>
      <!-- /.row -->

            <!-- widget end -->
            <!-- /.box-header -->
<div class="views data-show table-view" data-view="hidden">
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table table-hover">
                
                        <thead>
                            <tr>
                                <th>
                                    <label>
                  <input type="checkbox" class="minimal chAll" onclick="if($(this).is(':checked')){$('.myCustomCheckBox').attr('checked',true)}else{$('.myCustomCheckBox').removeAttr('checked');}">
                </label>
                                </th>
                                <th>Image</th>
                                <th> Product</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Sale / Purchase</th>
                                <th>Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($products)) { ?>
                                <?php
                                $count = 1;
                                foreach ($products as $prd) {
                                    
                                   // print_r($prd['p']->prd_title);
                                    ?>
                                    <tr class="trcheck">
                                        <td>
                                            <label>
                  <input type="checkbox" onclick="checkId()"  class="minimal myCustomCheckBox ch_ID" name="pro_id[<?= $prd['p']->prd_id ?>]" value="<?= $prd['p']->prd_id ?>">
                </label>
                                        </td>
                                        <td><img src="<?php if(!empty($prd['i'])){ echo base_url('img_uploads/product_images/'.$prd['i']->prd_image);}else{  echo base_url('img_uploads/no-image.jpg'); } ?>" style="width: 50px; height: 50px;"></td>
                                        <td> 
                                            <a data-id="<?= $count; ?>" class="scroll-modal-btn" data-direction="right"><?= $prd['p']->prd_title;  ?></a>
                                            <!-- model start -->
                                            <!-- model end -->
                                        </td>
                                        <td><?= $prd['p']->prd_code; ?></td>
                                        <td><?= $prd['p']->prdc_name; ?></td>
                                        <td>
                                            <span><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                            <?= number_format($prd['p']->prd_price,2); ?></td>
                                        <td>
                                            <?php
                                                $decision ='';
                                                    if ($prd['p']->prd_is_sale=='1' && $prd['p']->prd_is_purchase=='0')
                                                    {
                                                        $decision.='Sale';
                                                    }
                                                    elseif ($prd['p']->prd_is_purchase=='1' && $prd['p']->prd_is_sale=='0')
                                                    {
                                                        $decision.='Purchase';
                                                    }
                                                    elseif($prd['p']->prd_is_sale=='1' && $prd['p']->prd_is_purchase=='1')
                                                    {
                                                        $decision.='Sale/Purchase';
                                                    }
                                                    elseif (empty($prd['p']->prd_is_sale) && empty($prd['p']->prd_is_purchase))
                                                    {
                                                         $decision.='None';
                                                    }
                                                    elseif (!empty($prd['p']->prd_is_sale=='0') && !empty($prd['p']->prd_is_purchase=='0'))
                                                    {
                                                         $decision.='None';
                                                    }

                                                echo $decision;

                                            ?>

                                        </td>
                                        <td><?= $prd['p']->unit_name; ?></td>
                                       
                                        
        <!--                                <td class="">
                                            <a data-toggle="tooltip" data-placement="bottom" title="View" href="<? base_url('Product/updateProductView/' . $prd->prd_id); ?>" class="table-btn btn-info"><i class="fa fa-eye"></i></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Disable" href="<? base_url('Product/updateProductView/' . $prd->prd_id); ?>" class="table-btn btn-warning"><i class="fa fa-ban"></i></a>
                                            <a data-toggle="tooltip" data-placement="bottom" title="Delete" href="<? base_url('Product/deleteProduct/' . $prd->prd_id); ?>" class="table-btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>-->
                                    </tr>
                                    <?php
                                    $count++;
                                }
                                ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear"></i> BULK ACTION    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a onclick="deleteChecked(this);">DELETE</a></li>
                                                </ul></div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
</div>
        </div>
    </section>
    <!-- model start -->
        <?php if (!empty($products)) { ?>
        <?php
        $count = 1;
        foreach ($products as $prd) {
            ?>
  <div class="modal fade " id="<?= $count; ?>">
    <div class="modal-dialog scroll-modal">
        <!-- Title -->
        <h1 class="control-sidebar-heading">
            <?= $prd['p']->prd_title; ?> (<?= $prd['p']->prd_code; ?>)
            <i class="fa fa-times control-sidebar-times close" data-dismiss="modal"></i>
        </h1>
        <!-- Title -->
        <form role="form" method="post" action="<?= base_url('Product/updateProduct'); ?>" enctype="multipart/form-data">
            <div class="box box-control-sidebar">
                <div class="box-body">
            <input type="hidden" name="product_id" value="<?= $prd['p']->prd_id; ?>" />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group input-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control" placeholder="" value="<?= $prd['p']->prd_title; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group input-group">
                                <label>Product Category</label>
                                <select name="product_category" class="form-control" required>
                                    <option value="0"></option>
                                    <?php if (!empty($product_category)) { ?>
                                        <?php foreach ($product_category as $p) { ?>
                                            <option <?php
                                            if ($p->prdc_id == $prd['p']->prdc_id) {
                                                echo "selected";
                                            }
                                            ?> value="<?= $p->prdc_id; ?>"><?= $p->prdc_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group input-group">
                                <label>Product Unit</label>
                                <select name="product_unit" class="form-control" required>
                                    <option value="0"></option>
                                    <?php if (!empty($units)) { ?>
                                        <?php foreach ($units as $u) { ?>
                                            <option <?php
                                            if (!empty($prd)) {
                                                if ($prd['p']->prd_unit_id == $u->unit_id) {
                                                    ?> selected <?php
                                                    }
                                                }
                                                ?> value="<?= $u->unit_id; ?>"><?= $u->unit_name; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group input-group">
                                <label>Product Code</label>
                                <input type="text" name="product_code" class="form-control" placeholder="" value="<?= $prd['p']->prd_code; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label>Product Price</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                <input type="text" name="product_price" class="form-control product_price" placeholder="" value="<?= number_format($prd['p']->prd_price,2,'.',''); ?>" onBlur="if(this.value<1){this.value='0.00';}">
                            </div>
                        </div>
                        <div class="col-md-4">
                                <label>Discounted Price</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                                <input type="text" name="discount_price" class="form-control dis_price" placeholder="" value="<?= number_format($prd['p']->prd_wholesales_price,2,'.',''); ?>" onBlur="if(this.value<1){this.value='0.00';}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group input-group">
                                <label>Product Description</label>
                                <textarea type="text" name="product_description" class="form-control" placeholder=""><?= $prd['p']->prd_desc; ?></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>
                                    <input <?php
                                    $is_sale = $prd['p']->prd_is_sale;
                                    if (!empty($is_sale) && $is_sale != null && $is_sale == '1') {
                                        ?> checked <?php } ?> type="checkbox" class="flat-red" name="prd_is_sale"> Product for Sale
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                <label>
                                    <input <?php
                                    $st = $prd['p']->prd_is_raw;
                                    $is_purchase = $prd['p']->prd_is_purchase;
                                    if (!empty($is_purchase) && $is_purchase != null && $is_purchase == '1') {
                                        ?> checked <?php } ?> type="checkbox" class="flat-red" name="prd_is_purchase"> Product for Purchase
                                </label>
                               
                            </div>
                               <div class="form-group pull-right">
                             <label class="text-red"><b>Is This a Raw Product?</b></label>&nbsp;&nbsp;&nbsp;
                             <input type="radio" name="raw-product" <?php if($st == 1){ ?> checked <?php } ?> value="1"> <label>YES</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="raw-product" <?php if($st == 0){ ?> checked <?php } ?> value="0"> <label>NO</label> 
                    </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="col-md-12">
                        <div class="row  preview-area_2">
                             <?php

                    $products_images = $this->API_m->singleRecordArray('product_images', ['prdimg_prd_id' => $prd['p']->prd_id]);
                    if (!empty($products_images)) { ?>
                    <?php foreach ($products_images as $r) { ?>
                            <div class="col-sm-6 col-md-3 col-lg-3 mt-4" style="height: 400px !important;">
                <div class="card">
                    <img class="card-img-top" src="<?= base_url('img_uploads/product_images/' . $r->prd_image); ?>">
                    <div class="card-block">
                         <div class="meta">
                           <?= $r->prdimg_title; ?>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <a onclick="return confirm('are you sure want to remove this?');" href="<?= base_url('Product/deleteProductPic/' . $r->prdimg_id . '/' . $r->prdimg_prd_id); ?>" class="btn btn-danger pull-right btn-sm"><i class="fa fa-trash"></i></a>
                    
                    </div>
                </div>
            </div>
                    <!-- /.col -->
                 <?php } ?>
             <?php } ?>
                    
                </div>
                <!-- ./widget row -->
                      
                    </div>
            
            <div class="row">
                        <div class="col-md-12">
                            <div class="form-group input-group">
                                <label>Upload Product Images</label>
                                <input type="file"  name="file[]" class="form-control product_images_2" multiple onchange="previewImages2(this);" />
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                            <a href="<?= base_url('Product/deleteProduct/' . $prd['p']->prd_id); ?>" class="btn btn-danger">DELETE</a>

                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
     <?php
        $count++;
    }
    ?>
<?php } ?>
    <!-- ./model end -->
  
</div>

<script>
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
              scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,
            language: {search: "PRODUCTS", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW PRODUCT</a>');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });

        // $('.showMdl').click(function () {
        //     // $('.table-view').show();
        //     $('.modal')
        //             .prop('class', 'modal fade') // revert to default
        //             .addClass($(this).data('direction'));
        //     var modal_id = $(this).data('id');
        //     $('#' + modal_id).modal('show');

        //     // setTimeout(function(){
        //     //      $('.table-view').hide();
        //     // },3000);

        // });
    });
</script>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        ADD NEW PRODUCT
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form role="form" method="post" action="<?= base_url('Product/addProduct'); ?>" enctype="multipart/form-data">
        <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Category</label>
                            <select name="product_category" class="form-control" required>
                                <option value="0"></option>
                                <?php if (!empty($product_category)) { ?>
                                    <?php foreach ($product_category as $p) { ?>
                                        <option value="<?= $p->prdc_id; ?>"><?= $p->prdc_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Unit</label>
                            <select name="product_unit" class="form-control" required>
                                <option value="0"></option>
                                <?php if (!empty($units)) { ?>
                                    <?php foreach ($units as $u) { ?>
                                        <option value="<?= $u->unit_id; ?>"><?= $u->unit_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Product Price</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                            <input type="text" name="product_price" value="0.00" min="0.00" class="form-control product_price" placeholder="" onBlur="if(this.value<1){this.value='0.00';}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <label>Discounted Price</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><?php if(!empty($currency_symbol->symbol)){ echo $currency_symbol->symbol; } ?></span>
                            <input type="text" name="discount_price" value="0.00" min="0.00" class="form-control dis_price" placeholder="" onBlur="if(this.value<1){this.value='0.00';}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea type="text" name="product_description" class="form-control" placeholder="" ></textarea>
                        </div>
                    </div>

                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="flat-red" name="prd_is_sale"> Product for Sale
                            </label>
                            &nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="checkbox" class="flat-red" name="prd_is_purchase"> Product for Purchase
                            </label>
                        </div>
                         <div class="form-group">
                             <label class="text-red"><b>Is This a Raw Product?</b></label>&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="raw-product" value="1"> <label>YES</label>
                    &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="raw-product" value="0"> <label>NO</label> 
                    </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-md-12" id="preview-area"></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Product Images</label>
                            <input type="file" id="product_images" name="file[]" class="form-control" multiple />
                        </div>
                    </div>   
                </div>



            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success btn-flat">SAVE PRODUCT</button>
                        <input type="reset" value="RESET" class="btn btn-danger btn-danger" value="CLEAR">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>

<form method="post" class="postProduct" action="">
    <!-- <input type="hidden" class="Checkd_id" id="Checkd_id" name="Checkd_id[]" value=""> -->
</form>

<script>
   $(document).ready(function(){

        $('.chAll').click(function(){
          checkId();

         });

        $('.product_price').on('blur',function(){

             var prdPrice = parseFloat($(this).val());
             // alert(prdPrice.toFixed(2));
             var vl = prdPrice.toFixed(2);
             $(this).val(vl);


        });

        $('.dis_price').on('blur',function(){

             var disPrice = parseFloat($(this).val());
            
                 var vl = disPrice.toFixed(2);
                 $(this).val(vl);
             // alert(disPrice.toFixed(2));
            

        });
        
   });
   
    function checkId()
    {
        var check_id = 0;
        var html ='';
        $('.myCustomCheckBox').each(function(){
            if($(this).is(':checked'))
            {
                check_id = $(this).val();
                html+='<input type="hidden" class="Checkd_id" id="Checkd_id" name="Checkd_id[]" value="'+check_id+'">'
               // $('#Checkd_id').val(check_id);
                
               $('.postProduct').html(html);
            }

           
        });
        // $('#Checkd_id').val(check_id);
    }

     function deleteChecked(obj)
      { 
        
        // if(!$('myCustomCheckBox').is(':checked'))
        // {
        //     alert('Pease');
        // }
         if(confirm('are you sure want to delete this ?') == true){

            // $('.postProduct').submit();
            $('.postProduct').attr('action', '<?= base_url('Product/deleteCheckedProduct') ?>');
            $('.postProduct').submit();

        }

        
      }
</script>