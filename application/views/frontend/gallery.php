	<!-- Content Containers -->
	<div class="main-container"> 
		<!-- Section -->
		<div class="fullcontainer">
			<div class="container">
				<div class="inner-container-md">
					<div class="animatedParent">
						<h1 class="title1 text-center txt-dark animated growIn">The <span>science</span> <span>academy</span> <span>gallery</span></h1>
					</div>
					<div class="row pt30 animatedParent" data-sequence="300">
                    <?php foreach($gallery as $gal):?>
						<div class="col-sm-6 animated fadeIn" data-id="1">
							<div class="gallery-box"> <a href="<?php echo base_url('assets/upload/gallery/original/'.$gal['image_name']); ?>" class="fancybox img-effect" data-fancybox-group="gallery" title="<?php echo $gal['title'];?>">
								<div class="img-holder"><img src="<?php echo base_url('assets/upload/gallery/thumb/'.$gal['image_name']); ?>" alt="" class="responsive"></div>
								<h3><?php echo $gal['title'];?></h3>
								</a> </div>
						</div>
					<?php endforeach;?>	
					</div>
				</div>
			</div>
		</div>
		<!-- Section END --> 
	</div>
	<!-- Content Containers END -->