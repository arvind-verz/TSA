<div class="clear"></div>
<div class="pushContainer"></div>
<div class="clear"></div>
</div>
<!-- Content Containers END -->


</div>
<!-- Footer -->
<footer class="footer-wrapper" style="opacity: 1;"> 
<div class="footer"> <div class="container"> <div class="inner-container-xs"> 
<div class="social-bar">
<?php if(get_system_settings()->instagram_link!="" && get_system_settings()->instagram_link!="#" ){?>
<a href="<?=get_system_settings()->instagram_link?>" target="_blank"><i class="jcon-instagram"></i></a>
<?php }?>
<?php if(get_system_settings()->facebook_link!="" && get_system_settings()->facebook_link!="#" ){?>
<a href="<?=get_system_settings()->facebook_link?>" target="_blank"><i class="jcon-facebook"></i></a>
<?php }?>
<!--<a href="#"><i class="jcon-linkedin"></i></a><a href="#"><i class="jcon-twitter"></i></a> --></div> 
<?php $footer = get_footer();echo $footer->content; ?> 
<div class="clear"></div> 
</div> 
</div> 
</div> 
</footer>
<!-- Footer END -->
<!-- Get In Touch -->
<div class="get-in-touch">
	<div class="get-btn"><img src="<?php echo base_url('assets/images/btn.png'); ?>" alt="" class="responsive"></div>
	<div class="get-holder">
		<h3 class="title4 text-center txt-dark mb0">Quick Enquiry</h3>
		<p class="text-center">Feel free to send us a message!</p>
		<?php echo form_open('quick-enquiry/submit'); ?>
		<?php $this->load->view('backend/include/messages')?>
		<?php if ($this->session->flashdata('error1')) {
			?>
			<div class="pad margin no-print my-0 py-0">
				<div class="alert alert-error alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<?php echo $this->session->flashdata('error1'); ?>
				</div>
			</div>
			<?php
		}
		if (validation_errors()) {?>
					<div class="col-lg-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo validation_errors(); ?>
						</div>
					</div>
					<?php }
		?>
	<div class="get-form">
		<div class="form-group">
			<input type="text" name="fname" required id="fname" placeholder="Name" class="gt-input">
		</div>
		<div class="form-group">
			<input type="email"name="email_id" required id="email_id" placeholder="Email Address" class="gt-input">
		</div>
		<div class="form-group">
			<input type="text" required name="phone" id="phone" placeholder="Contact No." class="gt-input">
		</div>
		<div class="form-group">
			<textarea required name="message" id="message" placeholder="Message" class="gt-input"></textarea>
		</div>
		<div class="form-group">
			<div class="g-recaptcha" data-sitekey="6Lc-G7AUAAAAAIXMi5dMy7e9DGoqwR6pbfjUbLJC"></div>
		</div>
		<div class="form-group">
			<button type="submit" class="button btn-md btn-block">Submit</button>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
</div>
<!-- Get In Touch END-->
<a href="#0" class="cd-top">Top</a>
<script src="<?php echo base_url('assets/js/animation.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/slick.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sticky-kit.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/sticky.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugins.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/mCustomScrollbar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/mscript.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/mCustomScrollbar.css'); ?>" rel="stylesheet" type="text/css" >
<script src="<?php echo base_url('assets/js/bootstrap-select.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAyo44V823PEdTTSwswtXWTQIxmCa4--8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.fancybox.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
<script src="<?php echo base_url('assets/js/jquery.paroller.js'); ?>"></script> 
<script>
    $(document)
        .ready(function () {
            $('[data-paroller-factor]').paroller();
        });
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
</body>
</html>