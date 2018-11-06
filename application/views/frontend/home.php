	<!-- Content Containers -->
	<div class="main-container"> 
		<div class="fullcontainer full-mx">
			<div class="home-pod-holder animatedParent" data-sequence="300">
				<?=$page[0]['page_content']?>
				<div class="clear"></div>
			</div>
		</div>
        <?php //print_r($gallery);?>
		<!-- Section -->
		<div class="fullcontainer">
			<div class="container">
				<div class="inner-container-lg pb40">
					<div class="title-holder animatedParent">
						<div class="title2 text-center txt-yellow animated growIn mb80" data-id="1">Latest Gallery</div>
					</div>
					<div class="row animatedParent" data-sequence="300">
                    <?php foreach($gallery as $gal):?>
						<div class="col-md-6 animated fadeInLeft" data-id="1">
							<div class="row">
								<div class="equalheight1 height960">
									<div class="grid-tb">
										<div class="grid-tc">
											<div class="bdr-img img1"> <img src="<?php echo base_url('assets/upload/gallery/original/'.$gal['image_name']); ?>" alt="" class="responsive"> </div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    <?php endforeach;?>
					</div>
					<div class="row animatedParent" data-sequence="300">
						<div class="col-md-6 pull-right md animated fadeInRight" data-id="1">
							<div class="row">
								<div class="equalheight1 height960">
									<div class="grid-tb">
										<div class="grid-tc">
											<div class="bdr-img img2"> <img src="<?php echo base_url('assets/images/home2.jpg'); ?>" alt="" class="responsive"> </div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 pull-left md animated fadeInLeft" data-id="1">
							<div class="row">
								<div class="equalheight1 height960">
									<div class="grid-tb">
										<div class="grid-tc">
											<div class="cont text-center">
												<div class="title1 txt-dark"><span>We're</span> almost <span>ready</span> to welcome you at our brand new <span>premises!</span></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center pt80"><a href="#" class="button">View All</a></div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
		<!-- Section -->
		<div class="wave-holder">
			<div class="wave wave1" style="background-image:url(<?php echo base_url('assets/images/ban1.png'); ?>wave1.png);" data-paroller-factor="0.8" data-paroller-direction="horizontal"></div>
			<div class="wave wave2" style="background-image:url(<?php echo base_url('assets/images/ban1.png'); ?>wave2.png);" data-paroller-factor="-0.3" data-paroller-direction="horizontal"></div>
			<div class="wave wave3" style="background-image:url(<?php echo base_url('assets/images/ban1.png'); ?>wave3.png);"data-paroller-factor="0.3" data-paroller-direction="horizontal"></div>
			<div class="wave wave4" style="background-image:url(<?php echo base_url('assets/images/ban1.png'); ?>wave4.png);"data-paroller-factor="-0.5" data-paroller-direction="horizontal"></div>
			<img src="images/bg-plain.png" class="responsive" alt=""> </div>
		<!--<div class="bg"><img src="images/bg2.png" alt="" class="responsive"></div> -->
		<div class="fullcontainer bg-color2">
			<div class="container">
				<div class="inner-container-lg">
					<div class="title-holder text-center animatedParent" data-sequence="300">
						<div class="title2 txt-white animated growIn" data-id="1">Testimonials</div>
						<h2 class="title1 txt-white animated growIn" data-id="2"><span>Our</span> <span>students</span> have <span>a</span> lot to <span>say</span></h2>
					</div>
					<div class="home-testimonial">
						 <?php 
					foreach($testimonials as $test): ?>	
						<div class="home-testimonial-slide">
							<div class="htbox">
								<div class="testi-img-holder">
									<div class="testi-img"><img src="<?php echo base_url("assets/upload/testimonial/original/".$test['image_name']);?>" alt="" class="responsive"></div>
								</div>
								<div class="client-testi">
									<p><?=substr($test['content'],0,100)?></p>
									<p class="size18 txt-dark"><strong><?=$test['title']?></strong></p>
									<a href="<?php echo site_url("testimonial");?>" class="button btn-sm">Read More</a> </div>
							</div>
						</div>
                        <div class="home-testimonial-slide">
							<div class="htbox">
								<div class="testi-img-holder">
									<div class="testi-img"><img src="<?php echo base_url("assets/upload/testimonial/original/".$test['image_name']);?>" alt="" class="responsive"></div>
								</div>
								<div class="client-testi">
									<p><?=substr($test['content'],0,100)?></p>
									<p class="size18 txt-dark"><strong><?=$test['title']?></strong></p>
									<a href="<?php echo site_url("testimonial");?>" class="button btn-sm">Read More</a> </div>
							</div>
						</div>
                        <?php endforeach;?>	
					</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
	</div>
	<!-- Content Containers END -->