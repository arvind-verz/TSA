<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('include/meta'); ?>
<?php echo css('style'); ?>
<?php echo css('responsive'); ?>
<?php echo css('ddsmoothmenu'); ?>
<?php echo css('mobile-menu'); ?>
<?php echo css('font-awesome.min'); ?>
<?php echo css('reset'); ?>
<?php echo css('flexslider'); ?>
<?php echo css('all_commen'); ?>

<script type="text/javascript">
var downarrowclass='<?php echo image('blank-down.png'); ?>'
var rightarrowclass='<?php echo image('arrow-right-blank.png'); ?>'
</script>

<?php echo js('jquery.min'); ?>
<?php echo js('ddsmoothmenu'); ?>
<?php echo js('drop-down'); ?>
<?php echo js('mobile-menu'); ?>

<!--<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="js/drop-down.js"></script>
<script type="text/javascript" src="js/mobile-menu.js"></script>-->
<script type="text/javascript">
ddsmoothmenu.init({
 mainmenuid: "smoothmenu1", //menu DIV id
 orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
 classname: 'ddsmoothmenu', //class added to menu's outer DIV
 //customtheme: ["#1c5a80", "#18374a"],
 contentsource: "markup", //"markup" or ["container_id", "path_to_menu_file"]
 shadow:false
})

var html_img='<img src="<?php echo image('top.png'); ?>" style="width:36px; height:35px" />';
</script>

<?php echo css('jcarousel.responsive'); ?>
<?php echo js('jquery.jcarousel.min'); ?>
<?php echo js('jcarousel.responsive'); ?>
<?php echo js('scrolltopcontrol'); ?>

<!--[if lt IE 9]><?php echo js('ie8-responsive-file-warning'); ?><![endif]-->
<?php echo js('ie-emulation-modes-warning'); ?>
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  
<?php  echo $this->all_function->get_site_options('google_analytics');?>  
</head>