<?php
$user_id = $this->session->userdata('user')['user_id'];
$status = '0';
$notify = $this->Notifications_m->getAllNotifications('notifications', ['notify_created_for' => $user_id], ['notify_status' => $status]);
$currency_symbol = $this->Admin_m->getSelectedCurrency(); 
// echo "<pre>";
// print_r($notify);
// exit();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $currency_symbol->app_name; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
        <!-- Theme style -->

        <link rel="stylesheet" href="<?= base_url('assets/bower_components/fullcalendar/dist/fullcalendar.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css'); ?>" media="print">



        <link rel="stylesheet" href="<?= base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.css'); ?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/skins/skin-blue.css'); ?>">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/morris.js/morris.css'); ?>">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/jvectormap/jquery-jvectormap.css'); ?>">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
        <!--SELECT 2 CSS-->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/select2/dist/css/select2.min.css'); ?>">

        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/plugins/iCheck/all.css'); ?>" >

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script src="<?= base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <style>
            .sidebar-menu li a{
                color: #fff;
                font-size: 16px;
            }
    
            .control-sidebar-bg, .control-sidebar {
                top: 0px;
                right: -2100px;
                width: 86%;
                padding: 30px 50px;
            }
            .control-sidebar{
                z-index: 1200;
            }
            label {
                display: inline-block;
                max-width: 100%;
                margin-bottom: 5px;
                font-weight: normal;
                font-size: 16px;
                text-transform: capitalize;
            }
            .form-group .form-control {
                border-radius: 0 !important;
                box-shadow: none;
                border-color: #d2d6de;
                font-size: 16px;
                height: 35px;
                -webkit-appearance: none;
            }
            .control-sidebar-heading {
                font-weight: 400;
                font-size: 24px;
                padding: 10px 0;
                margin-bottom: 30px;
            }

            .control-sidebar-times{
                float: right;
                font-weight: 100;
                border: 1px solid #ccc;
                padding: 7px 10px;
                border-radius: 50%;
                background: #fff;
                color: #6f6f6f;
            }

            .box-control-sidebar{
                border-radius: 0px;
                background: #ffffff;
                border-top: 0px solid #d2d6de;
                margin-bottom: 20px;
                width: 100%;
                box-shadow: 0 0px 0px rgba(0,0,0,0);  
            }

            .box-control-sidebar .box-body{
                padding: 20px;  
            }
            
            @media print
            {
                .btn-print
                {
                    display:none;
                }
            }
        </style>
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        <div>
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="" class="logo" style="background-color: #3b4c5a;">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><img style="max-height: 50px !important;width: 100%;" class="img-rectangle" src="<?= base_url('img_uploads/configuration/'.$currency_symbol->app_logo); ?>" /></span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><img style="max-height: 50px !important;width: 100%;" class="img-rectangle" src="<?= base_url('img_uploads/configuration/'.$currency_symbol->app_logo); ?>" /> <?= $currency_symbol->app_name; ?></span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>

                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <!-- Messages: style can be found in dropdown.less-->
                                <li class="dropdown messages-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="label label-success">4</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 4 messages</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <li><!-- start message -->
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            Support Team
                                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <!-- end message -->
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            AdminLTE Design Team
                                                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            Developers
                                                            <small><i class="fa fa-clock-o"></i> Today</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            Sales Department
                                                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <div class="pull-left">
                                                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            Reviewers
                                                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                        </h4>
                                                        <p>Why not buy a new awesome theme?</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="footer"><a href="#">See All Messages</a></li>
                                    </ul>
                                </li>
                                <!-- Notifications: style can be found in dropdown.less -->
                                <li class="dropdown notifications-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-bell-o"></i>
                                        <span class="label label-warning"><?= count($notify); ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have <?= count($notify); ?> notifications</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
<?php
foreach ($notify as $ntfy) {
    ?>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-warning text-yellow"></i>
    <?php
    echo $ntfy->notify_operation . ' ' . $ntfy->notify_activity_on . ' ' . $ntfy->activity_name;
    ?>
                                                        </a>
                                                    </li>
                                                            <?php }
                                                        ?>

                                            </ul>
                                        </li>
                                        <li class="footer"><a href="#">View all</a></li>
                                    </ul>
                                </li>
                                <!-- Tasks: style can be found in dropdown.less -->
                                <li class="dropdown tasks-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-flag-o"></i>
                                        <span class="label label-danger">9</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="header">You have 9 tasks</li>
                                        <li>
                                            <!-- inner menu: contains the actual data -->
                                            <ul class="menu">
                                                <li><!-- Task item -->
                                                    <a href="#">
                                                        <h3>
                                                            Design some buttons
                                                            <small class="pull-right">20%</small>
                                                        </h3>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">20% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- end task item -->
                                                <li><!-- Task item -->
                                                    <a href="#">
                                                        <h3>
                                                            Create a nice theme
                                                            <small class="pull-right">40%</small>
                                                        </h3>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">40% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- end task item -->
                                                <li><!-- Task item -->
                                                    <a href="#">
                                                        <h3>
                                                            Some task I need to do
                                                            <small class="pull-right">60%</small>
                                                        </h3>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">60% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- end task item -->
                                                <li><!-- Task item -->
                                                    <a href="#">
                                                        <h3>
                                                            Make beautiful transitions
                                                            <small class="pull-right">80%</small>
                                                        </h3>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">80% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <!-- end task item -->
                                            </ul>
                                        </li>
                                        <li class="footer">
                                            <a href="#">View all tasks</a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- User Account: style can be found in dropdown.less -->
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php if (!empty($user_info)) { ?>
                                            <img src="<?= base_url('img_uploads/user_images/' . $user_info->users_img); ?>" class="user-image" alt="User Image">
<?php } ?>
                                        <?php if (!empty($user_info)) { ?>
                                            <span class="hidden-xs"><?= $user_info->user_fname . ' ' . $user_info->user_lname; ?></span>
                                        <?php } ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
<?php if (!empty($user_info)) { ?>
                                                <img src="<?= base_url('img_uploads/user_images/' . $user_info->users_img); ?>" class="img-circle" alt="User Image">
<?php } ?>

                                            <p style="color:black;">
                                            <?php if (!empty($user_info)) { ?>
                                                <?= $user_info->user_fname . ' ' . $user_info->user_lname; ?> 
<?php } ?>
                                                <?php
                                                $role = '';
                                                if ($this->session->userdata('user')['role'] != '') {
                                                    switch ($this->session->userdata('user')['role']) {
                                                        case 1:
                                                            $role = 'Admin';
                                                            break;
                                                        case 2:
                                                            $role = 'Vendor';
                                                            break;
                                                        case 3:
                                                            $role = 'Customer';
                                                            break;
                                                    }
                                                }
                                                ?>
                                                <small style="color:black;"><?= $role; ?></small>

                                            </p>
                                        </li>
                                        <!-- Menu Body -->
                                        <li class="user-body">
                                            <div class="row">
                                                <div class="col-xs-4 text-center">
                                                    <a href="#">Followers</a>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <a href="#">Sales</a>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                    <a href="#">Friends</a>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="<?= base_url('Login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Control Sidebar Toggle Button -->

                            </ul>
                        </div>
                    </nav>

                </header>
