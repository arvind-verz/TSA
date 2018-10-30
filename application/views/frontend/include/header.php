<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
<title>The Science Academy Pte Ltd</title>
<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon.png" />
<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/jcon-font.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/animation.css'); ?>" rel="stylesheet" type="text/css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="<?php echo base_url('assets/js/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-latest.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/meanmenu.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/meanmenu.css'); ?>" rel="stylesheet" type="text/css"  media="all">
<link href="<?php echo base_url('assets/css/slick.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper"> 
	<!-- Header -->
	<header id="header" class="header">
		<div class="container">
			<div class="logo"><a href="<?php echo site_url('home'); ?>"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="The Science Academy Pte Ltd" /></a></div>
			<!--<div class="top-user"> <a href="#" class="tp-user"><i class="jcon-user-1 ileft"></i>Login</a> </div>!-->
			<div class="topRightContainer">
				<div class="nav-wrapper">
					<div class="nav-container">
						<nav class="nav">
							<?php include "menu.php";?>
						</nav>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</header>
	<!-- Header END --> 
    
 
    <?php if($url!='home'){?>
	<!-- Banner -->
	<div class="banner-holder inner-banner background parallax" style="background-image:url(<?php echo base_url('assets/upload/pagebanner/original/'.$page[0]['image_name']); ?>);" data-img-width="1400" data-img-height="502" data-diff="100">
		<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt="" class="responsive"></div>
		<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt="" class="responsive"></div>
		<div class="bn-caption">
			<div class="container">
				<div class="bn-content">
					<div>
						<h2><?php echo $page[0]['page_heading'];?></h2>
						<div class="breadcrumbs">
							<ul>
								<li><a href="home">Home</a></li>
								<li><a href="#">About Us</a></li>
								<li><strong>The Science Academy</strong></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- Banner END --> 
    <?php }else{?>
	<!-- Banner -->
	<div class="banner-holder main-banner background parallax" style="background-image:url(<?php echo base_url('assets/upload/pagebanner/original/'.$page[0]['image_name']); ?>);" data-img-width="1400" data-img-height="768" data-diff="100">
		<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt="" class="responsive"></div>
		<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt="" class="responsive"></div>
		<div class="bann-scroll"><a href="#HomeAbout">Scroll down</a></div>
		<div class="bn-caption">
			<div class="container">
				<div class="bn-content">
					<div>
						<?php echo $page[0]['banner_heading'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Banner END --> 
    <?php }?>