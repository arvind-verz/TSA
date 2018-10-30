	<!-- Content Containers -->
	<div class="main-container"> 
		<!-- Section -->
		<div class="fullcontainer">
			<div class="container">
				<div class="inner-container-md">
					<div class="animatedParent" data-sequence="300">
						<h1 class="title1 text-center txt-dark animated growIn" data-id="1"><span>Get</span> in <span>touch</span></h1>
					</div>
					<div class="map-holder relative">
						<div class="contact-box" style="z-index:1">
							<h3 class="txt-dark size18"><strong>The Science Academy</strong></h3>
							<ul class="icon-list i-blue">
								<li><i class="jcon-location"></i>Block 192 Lor 4 Toa Payoh,<br>#01-674 (Level 2)<br>Singapore 310192</li>
								<li><i class="jcon-phone-1"></i>6566 8425</li>
								<li><i class="jcon-mail-alt"></i><a href="#">contactus@thesciacdm.com</a></li>
							</ul>
						</div>
						
    <div class="map">
    
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.740720769598!2d103.848287314754!3d1.3316789990287505!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da17d6e9b37273%3A0x12a0401b6fee30a2!2sTSA+THE+SCIENCE+ACADEMY!5e0!3m2!1sen!2sus!4v1535786806288" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

						
						<!--<div class="map" id="contact-map1" data-title="The Science Academy." data-address="Lor 4 Toa Payoh, #01-674, Block 192, Singapore 310192" data-zoom="16" data-marker="images/map-pin.png"></div>-->
					</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
		<!-- Section -->
		<div class="bg"><img src="images/bg1.png" alt="" class="responsive"></div>
		<div class="fullcontainer bg-color1">
			<div class="container">
				<div class="inner-container-md">
					<div class="animatedParent" data-sequence="300">
						<div class="title1 text-center txt-dark animated growIn" data-id="1"><span>Send</span> an <span>enquiry</span></div>
						<p class="text-center animated growIn" data-id="2">Do you have any enquiries or suggestions? Fill out the enquiry form and we’ll get back to you soon!</p>
					</div>
					<div class="cont-sm">
					 <?php echo form_open('contact'); ?>
						<div class="form-holder pt50">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label>Full Name</label>
									</div>
									<div class="col-sm-9">
										<input type="text" required name="fname" id="fname" class="form-control" placeholder="Full Name">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label>Email Address</label>
									</div>
									<div class="col-sm-9">
										<input type="email" required name="email_id" class="form-control" placeholder="Email Address">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label>Contact No.</label>
									</div>
									<div class="col-sm-9">
										<input type="text" required name="phone" class="form-control" placeholder="Contact No.">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label>Enquiry Purpose</label>
									</div>
									<div class="col-sm-9">
										<select required name="programme" class="selectpicker" data-width="100%" data-style="" title="General/Programmes">
											<option value="General/Programmes">General/Programmes</option>
									
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label>Message</label>
									</div>
									<div class="col-sm-9">
										<textarea required name="message" class="form-control" placeholder="Message"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-9 col-sm-offset-3">
										<div class="text-center pt30">
											<button class="button" type="submit">Submit Enquiry</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
		<!-- BanSectionner -->
		<div class="fullcontainer bottom background parallax" style="background-image:url(<?php echo base_url('assets/images/bottom-bg.jpg');?>);" data-img-width="1400" data-img-height="400" data-diff="100">
			<div class="container">
				<div class="inner-container-md animatedParent">
					<div class="title3 text-center txt-white pcentered pb0 mb0 animated growIn">The Science Academy complies with the<br>
						Personal Data Protection Act 2012 (PDPA) of Singapore</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
	</div>
	<!-- Content Containers END -->