	</div>
	<!-- Content Containers END -->
	<div class="clear"></div>
	<div class="pushContainer"></div>
	<div class="clear"></div>
</div>
<!-- Footer -->
<footer class="footer-wrapper">
	<div class="footer">
		<div class="container">
			<div class="inner-container-xs">
					<div class="social-bar"><a href="https://www.instagram.com/tsathescienceacademy/" target="_blank"><i class="jcon-instagram"></i></a><a href="https://www.facebook.com/tsathescienceacademy" target="_blank"><i class="jcon-facebook"></i></a><!--<a href="#"><i class="jcon-linkedin"></i></a><a href="#"><i class="jcon-twitter"></i></a> --></div>
				<div class="copyright">Copyright &copy; <script>document.write( new Date().getFullYear() );</script> The Science Academy Pte Ltd <br>All rights reserved.</div>
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
         <?php echo form_open('quick-enquiry'); ?>
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


<?php if($url=='gallery'):?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.fancybox.js?v=2.1.5'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$('.fancybox').fancybox();
});
</script>
<?php endif;  ?>
</body>
</html>