<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$userfname = '';
$userlname = '';
$useremail = '';
$usercontact = '';
$useraddress = '';
$userimg = '';
$userid = '';
$userrole = '';
if (!empty($users)) {
    $userid = $users->user_id;
    $userfname = $users->user_fname;
    $userlname = $users->user_lname;
    $useremail = $users->user_email;
    $usercontact = $users->user_contact;
    $useraddress = $users->user_address;
    $userimg = $users->users_img;
    $userrole = $users->user_role;
}
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <section class="content-header">
        <h1>
            Users
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('Admin/allUsers'); ?>" class="btn btn-primary" style="color: #fff !important">All Users</a></li>
        </ol>
    </section>
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">
                <form method="post" action="<?= base_url('Admin/updateUser'); ?>" enctype='multipart/form-data' >
                    <div class="modal-body">
                        <div class="col-md-12">
                            <input type="hidden" value="<?= $userid; ?>" name="user_id" />
                            <div class="form-group">
                                <img class="img-rounded" id="blah" src="<?= base_url('img_uploads/user_images/' . $userimg); ?>" >
                                <input type="file" id="user_img" name="file" class="form-control" />
                                <input type="hidden" name="old_img_name" value="<?= $userimg; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required value='<?= $userfname ?>' />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required value='<?= $userlname ?>' />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="example@gmail.com" required value='<?= $useremail ?>' />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="contact" class="form-control" placeholder="Contact Number" required value='<?= $usercontact ?>' />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    <option <?php if ($userrole == 1) { ?>selected<?php } ?> value="1">Admin</option>
                                    <option <?php if ($userrole == 2) { ?>selected<?php } ?> value="2">Vendor</option>
                                    <option <?php if ($userrole == 3) { ?>selected<?php } ?> value="3">Customer</option>
                                    <option <?php if ($userrole == 4) { ?>selected<?php } ?> value="4">Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="address" class="form-control" placeholder="Enter full address..." required > <?= $useraddress; ?></textarea>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#user_img").change(function () {
        readURL(this);
    });
    
</script>