<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<title>The Science Academy – Learning Institution</title>

	<meta name="description"
		content="The Science Academy aims to teach advanced skills in Mathematics, Physics, Chemistry and Biology. We are committed to providing quality education and deliver quality teaching at its finest using the right tools and measure of perseverance. Visit our website to know more!" />

	<meta name="keywords"
		content="The Science Academy, Learning Institution Singapore, Quality Education Singapore, Advanced Teaching Singapore, Learning Institute Singapore, Chemistry Programme Singapore, Biology Programme Singapore, Physics Programme Singapore, Math Programme Singapore" />

	<meta name="dcterms.rightsHolder" content="thescienceacademy.sg – The Science Academy" />

	<link rel="shortcut icon" href="https://thescienceacademy.sg/favicon.ico" />
	<link rel="icon" type="image/gif" href="https://thescienceacademy.sg/animated_favicon1.gif" />

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
	<link href="<?php echo base_url('assets/css/meanmenu.css'); ?>" rel="stylesheet" type="text/css" media="all">
	<link href="<?php echo base_url('assets/css/slick.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css">
	<script>
		$(function () {

			var subject_id = window.location.href;
			console.log(subject_id.split('#')[1]);
			if (subject_id.split('#')[1] !== undefined || subject_id.split('#')[1] != "undefined") {

				//console.log("inside");

				console.log(subject_id + "   " + window.location.href);

				$(".all_classes").removeClass("active");

				$("#" + subject_id.split('#')[1] + "_active").addClass("active");

			}

			$(".subject_time").click(function () {



				var selected_id = (this).id;

				console.log($("#" + selected_id).parent().prevAll().eq(1).text());

				var trim_me = "Hi, I am interested in " + $("#" + selected_id).attr("subject_name") + ", " +
					$("#" + selected_id).parent().prevAll().eq(1).text() + ", " + $("#" + selected_id).text();



				$("#message").text($.trim(trim_me.replace(/[\t\n]+/g, ' ')))

			});

		})

	</script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-143352239-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-143352239-1');

	</script>

</head>

<body>
	<?php if($url=='thank-you'){?>
	<div id="wrapper" class="bg-img thankyou-page"
		style="background-image:url(<?php if($page[0]['image_name']!='')  echo base_url('assets/files/cms/'.$page[0]['image_name']); else echo ''; ?>);">
		<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt="" class="responsive">
		</div>
		<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt="" class="responsive">
		</div>
		<?php }else{?>
		<div id="wrapper">
			<?php }?>
			<!-- Header -->
			<header id="header" class="header">
				<div class="container">
					<?php $logo	=	get_logo(); ?>
					<div class="logo"><a href="<?php echo site_url('home'); ?>"><img
								src="<?php echo isset($logo->logo) ? base_url('assets/files/logo/' . $logo->logo) : ''; ?>"
								alt="The Science Academy Pte Ltd" /></a></div>
					<!--<div class="top-user"> <a href="#" class="tp-user"><i class="jcon-user-1 ileft"></i>Login</a> </div>!-->
					<?php if($this->session->has_userdata('student_credentials')) { ?>
					<div class="top-user">
						<div class="dropdown">
							<button class="tp-user" type="button" id="Topdropdown" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false"><i
									class="jcon-user-1 ileft"></i><?php echo ucfirst($this->session->userdata('student_credentials')['username']); ?></button>
							<ul class="dropdown-menu" aria-labelledby="Topdropdown">
								<li><a href="<?php echo site_url('student-profile'); ?>">My Profile </a></li>
								<li><a href="<?php echo site_url('student-classes'); ?>">My Classes</a></li>
								<li><a href="<?php echo site_url('student-invoices'); ?>">Invoices</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="<?php echo site_url('logout'); ?>"><strong>Logout</strong></a></li>
							</ul>
						</div>
					</div>
					<?php }else { ?>
					<div class="top-user"> <a href="<?php echo site_url('login'); ?>" class="tp-user"><i
								class="jcon-user-1 ileft"></i>Login</a> </div>
					<?php } ?>
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


			<?php if($url=='home'){?>
			<!-- Banner -->
			<div class="banner-holder main-banner background parallax"
				style="background-image:url(<?php if($page[0]['image_name']!='')  echo base_url('assets/files/cms/'.$page[0]['image_name']); else echo ''; ?>);"
				data-img-width="1400" data-img-height="768" data-diff="100">
				<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt=""
						class="responsive"></div>
				<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt=""
						class="responsive"></div>
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
			<?php }else if($url=='student-profile' || $url == 'student-invoices' || $url == 'student-classes'){?>
			<!-- Banner -->
			<div class="banner-holder inner-banner background parallax"
				style="background-image:url(<?php echo base_url('assets/images/banner-about.jpg'); ?>)"
				data-img-width="1400" data-img-height="502" data-diff="100">
				<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.jpg'); ?>" alt=""
						class="responsive"></div>
				<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.jpg'); ?>" alt=""
						class="responsive"></div>
				<div class="bn-caption">
					<div class="container">
						<div class="bn-content">
							<div>
								<!-- <div class="student-dp"><img src="<?php echo isset($student_profile->profile_picture) ? base_url('assets/files/profile_picture/' . $student_profile->profile_picture) : ''; ?>" class="responsive" alt=""></div> -->
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<!-- Banner END -->
			<?php }
			else if($url=='404 Page'){?>
			<!-- Banner -->
			<div class="banner-holder inner-banner background parallax"
				style="background-image:url(<?php echo base_url('assets/images/banner-about.jpg');?>);"
				data-img-width="1400" data-img-height="502" data-diff="100">
				<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt=""
						class="responsive"></div>
				<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt=""
						class="responsive"></div>
				<div class="bn-caption">
					<div class="container">
						<div class="bn-content">
							<div>
								<h2>404 Page</h2>
								<?php echo $breadcrumbs;?>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<!-- Banner END -->
			<?php }
			else if($url!='thank-you'){?>
			<!-- Banner -->
			<div class="banner-holder inner-banner background parallax"
				style="background-image:url(<?php if($page[0]['image_name']!='')  echo base_url('assets/files/cms/'.$page[0]['image_name']); else echo ''; ?>);"
				data-img-width="1400" data-img-height="502" data-diff="100">
				<div class="pd-img p1"><img src="<?php echo base_url('assets/images/ban1.png'); ?>" alt=""
						class="responsive"></div>
				<div class="pd-img p2"><img src="<?php echo base_url('assets/images/ban2.png'); ?>" alt=""
						class="responsive"></div>
				<div class="bn-caption">
					<div class="container">
						<div class="bn-content">
							<div>
								<h2><?php echo $page[0]['page_heading'];?></h2>
								<?php echo $breadcrumbs;?>
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<!-- Banner END -->
			<?php }?>
