<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <?php $this->load->view('include/user_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->
    <div class="clearfix">&nbsp;</div>
    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-12">
                    <table id="products-table" class="table  table-hover">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)) { ?>
                                <?php
                                $userlname = '';
                                $userfname = '';
                                $useremail = '';
                                $usercontact = '';
                                $useraddress = '';
                                $userimg = '';
                                $userid = '';
                                $userrole = '';

                                foreach ($users as $key => $user) {

                                    $userid = $user->user_id;
                                    $userfname = $user->user_fname;
                                    $userlname = $user->user_lname;
                                    $useremail = $user->user_email;
                                    $usercontact = $user->user_contact;
                                    $useraddress = $user->user_address;
                                    $userimg = $user->users_img;
                                    $userrole = $user->user_role;

                                    $role = $user->user_role;
                                    if ($role == 1) {
                                        $role_name = 'Admin';
                                    } elseif ($role == 2) {
                                        $role_name = 'Vendor';
                                    } elseif ($role == 3) {
                                        $role_name = 'Supplier';
                                    } elseif ($role == 4) {
                                        $role_name = 'Employee';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $user->user_id; ?></td>
                                        <td>
                                            <a href="<?= base_url('Admin/userDetail/' . $user->user_id); ?>"><?= $user->user_fname; ?> <?= $user->user_lname; ?></a>

                                        </td>
                                        <td class="emailUser"><?= $user->user_email; ?></td>
                                        <td><?= $user->user_contact; ?></td>
                                        <td><?= $user->user_address; ?></td>
                                        <td><?= $role_name; ?></td>

                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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

    function emailChecking() {

        var desicion = 0;
        var email = $('#newUserEmail').val();
        var emailTable = '';
        $('#products-table > tbody').find('.emailUser').each(function () {
            emailTable = $(this).html();
            if (email == emailTable) {
                desicion = 1;
            }
        });

        if (desicion > 0) {
            alert("Email Already Exsist");
            return false;
        }

    }


</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#products-table').DataTable({
            "dom": '<"toolbar">frtip',
              scrollY:        '57vh',
        scrollCollapse: true,
            "paging": false,

            language: {search: "ALL USERS", searchPlaceholder: "Filter and Search..."}

        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW USER</a>');
        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });
    });</script>
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        NEW USER
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form method="post" action="<?= base_url('Admin/addUser'); ?>" enctype='multipart/form-data' onsubmit="return emailChecking();">
        <div class="box box-control-sidebar">
            <div class="box-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <img class="img-rounded" id="blah" src="" >
                        <input type="file" id="user_img" name="file" class="form-control" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="email" id="newUserEmail" name="email" class="form-control" placeholder="example@gmail.com" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="****" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="contact" class="form-control" placeholder="Contact Number"  />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select name="role" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Vendor</option>
                            <option value="3">Customer</option>
                            <option value="4">Employee</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea name="address" class="form-control" placeholder="Enter full address..." ></textarea>
                    </div>
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="col-md-3">
                    <button type="submit"  class="btn btn-primary btn-submit">Save Information</button>
                </div>
            </div>
        </div>
    </form>
</aside>