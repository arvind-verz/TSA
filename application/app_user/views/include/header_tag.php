<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('include/meta'); ?>  
<?php echo css('plugin'); ?>
<?php echo css('main'); ?>
<?php echo css('all_commen'); ?>
<?php //echo js('jquery.min'); ?>
<?php echo js('jquery-1.9.1.min'); ?>    
<!--<link href="css/plugin.css" rel="stylesheet" />
<link href="css/main.css" rel="stylesheet" />  -->    
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php  echo $this->all_function->get_site_options('google_analytics');?>
<link href="<?php echo base_url(); ?>assets/css/featherlight.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/featherlight.js"></script>
</head>