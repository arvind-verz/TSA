<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title>
        <?php echo $title; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Ionicons -->
    <link href="<?php echo base_url('assets/plugins/Ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet">
    <!-- Morris chart -->
    <link href="<?php echo base_url('assets/plugins/morris.js/morris.css'); ?>" rel="stylesheet">
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap.css'); ?>" rel="stylesheet">
    <!-- Date Picker -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Daterange picker -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a class="logo" href="index2.html">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                        <b>
                            A
                        </b>
                        LT
                    </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                        <b>
                            Admin
                        </b>
                        LTE
                    </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a class="sidebar-toggle" data-toggle="push-menu" href="#" role="button">
                    <span class="sr-only">
                            Toggle navigation
                        </span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <img alt="User Image" class="user-image" src="dist/img/user2-160x160.jpg">
                                <span class="hidden-xs">
                                            Alexander Pierce
                                        </span>
                                </img>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img alt="User Image" class="img-circle" src="dist/img/user2-160x160.jpg">
                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>
                                                    Member since Nov. 2012
                                                </small>
                                    </p>
                                    </img>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat" href="#">
                                                Profile
                                            </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="#">
                                                Sign out
                                            </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a data-toggle="control-sidebar" href="#">
                                <i class="fa fa-gears">
                                    </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>