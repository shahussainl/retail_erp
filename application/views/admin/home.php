<?php
// echo "<pre>";
// print_r($record);
// exit();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            System configuration
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="single-page-wrapper">
            <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/put_data'); ?>" id="form">
                <div class="row single-page-innerwrapper">
                    <div class="col-md-9">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Business / Company Name</label>
                                <input type="text" class="form-control"
                                       name="app_name" value="<?php
                                       if (!empty($record->app_name)) {
                                           echo $record->app_name;
                                       };
                                       ?>" placeholder="">

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Full Address</label>
                                <input type="text" value="<?php
                                if (!empty($record->app_full_address)) {
                                    echo $record->app_full_address;
                                }
                                ?>" name="app_full_address" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="text" value="<?php
                                if (!empty($record->app_contact)) {
                                    echo $record->app_contact;
                                }
                                ?>" name="app_contact" class="form-control" placeholder="">
                            </div>  
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" value="<?php
                                if (!empty($record->app_email)) {
                                    echo $record->app_email;
                                }
                                ?>" name="app_email" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Website</label>
                                <input type="text" value="<?php
                                if (!empty($record->website)) {
                                    echo $record->website;
                                }
                                ?>" name="website" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">NTN / Tax Payer Number</label>
                                <input type="text" value="<?php
                                if (!empty($record->app_email)) {
                                    echo $record->ntn;
                                }
                                ?>" name="ntn" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bill / Voucher / Invoice Short Prefix</label>
                                <input type="text"  value="<?php
                                if (!empty($record->bill_prefix)) {
                                    echo $record->bill_prefix;
                                }
                                ?>"  name="bill_prefix" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Default Currency</label>
                                <select name="set_currency_id" id="app_theme" class="form-control">
                                    <?php if (!empty($currencies)) { ?>
                                        <?php foreach ($currencies As $cur) { ?>
                                            <option value="<?= $cur->currency_id; ?>" <?php if($cur->currency_id==$record->set_currency_id){ echo 'selected'; } ?> ><?= $cur->currency_name; ?></option>

                                        <?php } ?>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputFile">Theme</label>
                                <select name="app_theme" id="" class="form-control">
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                    <option value="yellow">Yellow</option>
                                    <option value="red">Red</option>
                                    <option value="black">Black</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputFile">Logo</label>

                            <?php if (!empty($record->app_logo)) { ?>
                                <input type="hidden" name="old_logo" value="<?= $record->app_logo; ?>" />

                            <?php } ?>
                            <img style="width:100%;" id="blah2"  src="<?php
                            if (!empty($record->app_logo)) {
                                echo base_url('img_uploads/configuration/' . $record->app_logo);
                            }
                            ?>" style="width:70px; height:60px;">
                                 <?php if (empty($record->app_logo)) { ?>
                                <input type="file" class="form-control"  name="app_logo" onchange="readUrl2(this);" id="exampleInputFile">
                            <?php } else { ?>
                                <a href="<?= base_url('Admin/deleteLogo/' . $record->app_id); ?>" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i></a>
                            <?php } ?>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputFile">Background Image</label>
                            <?php if (!empty($record->app_theme)) { ?>
                                <input type="hidden" name="old_back_img" value="<?= $record->app_theme; ?>" />
                            <?php } ?>
                            <img style="width:100%;" id="blah"  src="<?php
                            if (!empty($record->app_theme)) {
                                echo base_url('img_uploads/configuration/' . $record->app_theme);
                            }
                            ?>" style="width:70px; height:60px;">
                                 <?php if (empty($record->app_theme)) { ?>
                                <input type="file" class="form-control"  name="app_theme" id="exampleInputFile" onchange="readUrlL(this);">
                            <?php } else { ?>
                                <a href="<?= base_url('Admin/deleteBackImage/' . $record->app_id); ?>" class="btn btn-danger btn-block"><i class="fa fa-trash-o"></i></a>
                            <?php } ?>

                        </div> 
                    </div>

                    <?php
                    $condtion = '';
                    ?> 

                    <div class="box-body">












                    </div>

                    <div class="box-footer">
                        <?php
                        if (!empty($record)) {
                            ?>
                            <button type="submit" id="update" class="btn btn-primary">update</button>
                        <?php } else { ?>
                            <button type="submit" id="save" class="btn btn-primary">save</button>
                        <?php } ?>
                    </div>




                </div> 
            </form>
        </div>
    </section>
</div>    
<script type="text/javascript">
    function readUrlL(input) {


        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readUrl2(input) {


        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
