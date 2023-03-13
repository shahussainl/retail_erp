<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <section class="content-header">
        <h1>
            Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('ProductDetail/products'); ?>" class="btn btn-primary" style="color: #fff;"> All Products</a></li>
        </ol>
    </section>
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="post" class="form-horizontal" action="<?= base_url('ProductDetail/addProduct'); ?>" enctype="multipart/form-data">
                    <!-- text input -->
                    <div class="col-md-5 pull-left">
                        <div class="form-group">
                            <label>Product Category</label>
                            <select name="product_category" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php if (!empty($product_category)) { ?>
                                    <?php foreach ($product_category as $p) { ?>
                                        <option value="<?= $p->prdc_id; ?>"><?= $p->prdc_name; ?></option>
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
                                        <option value="<?= $u->unit_id; ?>"><?= $u->unit_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 pull-left">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter Product name..." required>
                        </div>
                    </div>
                    <div class="col-md-5  pull-right">
                        <div class="form-group">
                            <label>Product Code</label>
                            <input type="text" name="product_code" class="form-control" placeholder="Enter Product code..." required>
                        </div>
                    </div>
                    <div class="col-md-5  pull-left">
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" placeholder="Enter Product Price..." required>
                        </div>
                    </div>
                    <div class="col-md-5 pull-right">
                        <div class="form-group">
                            <label>Discount Price</label>
                            <input type="text" name="discount_price" class="form-control" placeholder="Enter Discount Price..." required>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-2 pull-left">
                        <label>
                            <input type="checkbox" class="flat-red" name="prd_is_sale">for Sale
                        </label>
                    </div>
                    <div class="col-md-2 pull-left">
                        <label>
                            <input type="checkbox" class="flat-red" name="prd_is_purchase">for Purchase
                        </label>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea type="text" name="product_description" class="form-control" placeholder="Enter Product Description..." required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Images</label>
                            <input type="file" id="product_images" name="file[]" class="form-control" multiple />
                        </div>
                    </div>
                    <div class="col-md-12" id="preview-area"></div>
                    <div class="clearfix"></div>
                    <div class="box-footer">
                        <a href='<?= base_url("ProductDetail/addNewProductView"); ?>' class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
