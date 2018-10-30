<!-- Section -->
		<div class="sub-nav bg-color1">
			<div class="container">
				<div class="navigation">About Us</div>
				<ul>
					<li <?php if($url=='about-us') echo 'class="selected"';?>><a href="<?php echo site_url('about-us');?>">The Science Academy</a></li>
					<li <?php if($url=='mission-and-vision') echo 'class="selected"';?>><a href="<?php echo site_url('mission-and-vision');?>">Mission &amp; Vision</a></li>
					<li <?php if($url=='our-core-team') echo 'class="selected"';?>><a href="<?php echo site_url('our-core-team');?>">Our Core Team</a></li>
				</ul>
			</div>
		</div>
		<?=$page[0]['page_content']?>
		<!-- Section END --> 
        <?php if($url=='about-us'){?>
		<!-- Section -->
		<div class="fullcontainer bottom background parallax" style="background-image:url(<?php echo base_url('assets/images/bottom-bg.jpg');?>)" data-img-width="1400" data-img-height="400" data-diff="100">
			<div class="container">
				<div class="inner-container-md animatedParent">
					<div class="title3 text-center txt-white pcentered pb0 mb0 animated growIn">Here at The Science Academy, we recognise the needs of each and every student.<br>
						You can trust that our tutors are there for you, be it in class or beyond.</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
        <?php }?>