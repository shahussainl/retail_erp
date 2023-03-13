<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$product_id = '';
$product_cat_id = '';
$product_name = '';
$product_code = '';
$product_desc = '';
$product_price = '';
$product_disc_price = '';
$product_unit ='';
$is_sale ='';
$is_purchase ='';
if (!empty($product)) {

    $product_id = $product->prd_id;
    $product_cat_id = $product->prd_prdc_id;
    $product_name = $product->prd_title;
    $product_code = $product->prd_code;
    $product_desc = $product->prd_desc;
    $product_price = $product->prd_price;
    $product_disc_price = $product->prd_wholesales_price;
    $product_unit = $product->prd_unit_id;
    $is_purchase = $product->prd_is_purchase;
    $is_sale = $product->prd_is_sale;
}
?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <section class="content-header">
        <h1>
            Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('Product/index'); ?>" class="btn btn-primary" style="color: #fff;"> All Products</a></li>
        </ol>
    </section>
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="post" class="form-horizontal" action="<?= base_url('Product/updateProduct'); ?>" enctype="multipart/form-data">
                    <!-- text input -->
                    <input type="hidden" name="product_id" value="<?= $product_id; ?>" />
                    <div class="col-md-5 pull-left">
                        <div class="form-group">
                            <label>Product Category</label>
                            <select name="product_category" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php if (!empty($product_category)) { ?>
                                    <?php foreach ($product_category as $p) { ?>
                                        <option <?php if ($p->prdc_id == $product_cat_id) { ?>selected<?php } ?> value="<?= $p->prdc_id; ?>"><?= $p->prdc_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="form-group">
                            <label>Product Unit</label>
                            <select name="product_unit" class="form-control" required>
                                <option value="">Select Unit</option>
                                <?php if (!empty($units)) { ?>
                                    <?php foreach ($units as $u) { ?>
                                <option <?php if($u->unit_id == $product_unit){ ?> selected <?php } ?> value="<?= $u->unit_id; ?>"><?= $u->unit_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 pull-left">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter Product name..." required value="<?= $product_name; ?>" >
                        </div>
                    </div>
                    <div class="col-md-5  pull-right">
                        <div class="form-group">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="Enter Product code..." required value="<?= $product_code; ?>" >
                        </div>
                    </div>
                    <div class="col-md-5  pull-left">
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" placeholder="Enter Product Price..." required value="<?= $product_price; ?>" >
                        </div>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="form-group">
                            <label>Discount Price</label>
                            <input type="text" name="discount_price" class="form-control" placeholder="Enter Discount Price..." required value="<?= $product_disc_price; ?>" >
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-2 pull-left">
                        <label>
                            <input type="checkbox" <?php if(!empty($is_sale) && $is_sale != null && $is_sale == '1'){?> checked <?php } ?> class="flat-red" name="prd_is_sale">for Sale
                        </label>
                    </div>
                    <div class="col-md-2 pull-left">
                        <label>
                            <input type="checkbox" <?php if(!empty($is_purchase) && $is_purchase != null && $is_purchase == '1'){?> checked <?php } ?> class="flat-red" name="prd_is_purchase">for Purchase
                        </label>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea type="text" name="product_description" class="form-control" placeholder="Enter Product Description..." required><?= $product_desc; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Images</label>
                            <input type="file" id="product_images" name="file[]" class="form-control" multiple />
                        </div>
                    </div>
                    <div class="col-md-12" id="preview-area"></div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Image Title</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($products_images)) { ?>
                                    <?php foreach ($products_images as $r) { ?>
                                        <tr>
                                            <td><img src="<?= base_url('img_uploads/product_images/' . $r->prd_image); ?>" style="max-height: 100px !important;" /></td>
                                            <td><?= $r->prdimg_title; ?></td>
                                            <td><a href="<?= base_url('Product/deleteProductPic/'.$r->prdimg_id.'/'.$r->prdimg_prd_id); ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-footer">
                        <a href='<?= base_url("ProductDetail/addNewProductView"); ?>' class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
