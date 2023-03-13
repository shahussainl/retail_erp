<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$title = '';
$id = '';
if (!empty($product_category)) {
    $title = $product_category->prdc_name;
    $id = $product_category->prdc_id;
}
?>    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <section class="content-header">
        <h1>
            Product Categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('Product/productCategory'); ?>" class="btn btn-primary" style="color: #fff;"> All Categories</a></li>
        </ol>
    </section>
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" class="form-horizontal" method="post" action="<?= base_url('Product/updateProductCategory'); ?>">
                    <!-- text input -->
                    <div class="col-md-12">
                        <input type="hidden" name="product_category_id" value="<?= $id; ?>" />
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="product_category" class="form-control" placeholder="Enter Category name..." value="<?= $title; ?>" required>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-footer">
                        <a href='<?= base_url("ProductDetail/productCategory"); ?>' class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>