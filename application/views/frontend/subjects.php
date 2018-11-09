<div class="main-container"> 

		

		<!-- Section -->

		

		<div class="fullcontainer">

			<div class="container">

				<div class="inner-container-md pb0">

					<div class="animatedParent" data-sequence="300">

						<h1 class="title1 text-center txt-dark animated growIn" data-id="1"><span><?=$page[0]['page_heading']?></span></h1>

						<div class="lead pcentered animated growIn" data-id="2">

							<?=$page[0]['page_content']?>
						</div>

					</div>

				</div>

			</div>

		</div>

		

		<!-- Section END --> 

		

		<!-- Section -->

		

		<div class="bg"><img src="<?php echo base_url('assets/images/bg1.png'); ?>" alt="" class="responsive"></div>

		<div class="fullcontainer bg-color1">

			<div class="container">

				<div class="inner-container-md" data-sticky_parent>

					<div class="row">

						<div class="col-sm-3 col-md-2">

							<div class="subject-nav-holder pt25" id="menu-center" data-sticky_column>

								<ul class="subject-nav">
                                <?php 
								$i=0;
								foreach($subjects as $subject):
								$i++;
								
								?>
									<li><a href="#<?php echo $subject['subject_id'];?>" id="<?php echo $subject['subject_id'];?>_active" class="all_classes <?php echo ($i==1) ? 'active' : '';?>"><?php echo $subject['subject_name'];?></a></li>
                                <?php endforeach;?>
								</ul>

							</div>

						</div>

						<div class="col-sm-9 col-md-10">
                        <?php foreach($subjects as $subject):
						$cms_sub=$this->Cms_model->get_cms_subjects($subject['subject_id']);
						if(count($cms_sub)>0)
						{
						?>
							<section class="sub-section" id="<?php echo $subject['subject_id'];?>">

								<div class="title1 txt-dark"><span><?php echo $subject['subject_name'];?></span></div>

								<?php echo $cms_sub[0]['page_content'];?>


							</section>
                       <?php }else{echo 'Comtent not found';}
					   
					   
					    endforeach;?>
							
						</div>

					</div>

				</div>

			</div>

		</div>

		

		<!-- Section END --> 

		

	</div>