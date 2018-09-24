<?php $this->load->view('include/header_tag'); ?>
    
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
            <?php $this->load->view('include/top_banner'); ?>
           
            <div class="mainchild">
               	
               
                		 <div class="container maincontent">
                         
                            <div class="row">
                                
                                <div class="col-md-12 rightpage1">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li class="active">Search Result</li>
                                         
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	Search Result : <?php echo $key;?>
                                    </h3>
                                    
                                     <div class="list-news ">
                                       <?php 
										if(count($event_pages)>0){
											foreach ($event_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/svcaevent/listing/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['title'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                            
                                            
                                            
                                     <?php }}else{ ?>
                                          <!--<h2>No Record Found</h2>-->
                                     <?php } ?>
                                     
                                     
                                     <?php 
										if(count($inner_pages)>0){
											foreach ($inner_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            <!--<div class="img-news other-news">
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/svcaevent/listing/'.$val['image_name']); ?>" alt=""></a>
                                            </div>-->
                                            <div class="info-news">
                                                <a href="<?php echo base_url($val['url_name']); ?>" class="t-header-6"><?php echo $val['page_heading'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['page_content']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url($val['url_name']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     <?php 
										if(count($newsletter_pages)>0){
											//echo "<h2>Newsletter</h2>";
											foreach ($newsletter_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('newsletter-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/newsletter/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('newsletter-details/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['title'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('newsletter-details/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     
                                     <?php 
										if(count($latestnews_pages)>0){
											//echo "<h2>Latest News</h2>";
											foreach ($latestnews_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['title'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                  <!--=========================================-->   
                                     
                                    <?php 
										if(count($rdirectory_pages)>0){
											//echo "<h2>Directory</h2>";
											foreach ($rdirectory_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('rdirectory/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/rdirectory/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('rdirectory/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['descriptions']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('rdirectory/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?> 
                                     
                                     
                                      <?php 
										if(count($publication_pages)>0){
											//echo "<h2>Publications</h2>";
											foreach ($publication_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/publications/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['descriptions']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?> 
                                     
                                     
                                     
                                     <?php 
										if(count($toolkit_pages)>0){
											//echo "<h2>FAQ</h2>";
											foreach ($toolkit_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('toolkit'); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                
                                                <a href="<?php echo base_url('toolkit'); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     <?php 
										if(count($our_network_pages)>0){
											//echo "<h2>FAQ</h2>";
											foreach ($our_network_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('our-network'); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('our-network'); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     <?php 
										if(count($faq_pages)>0){
											//echo "<h2>FAQ</h2>";
											foreach ($faq_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('faq'); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['content']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('faq'); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?> 
                                     
                                     
                                     
                                     
                                     
                                     
                                     <?php 
										if(count($committee_pages)>0){
											//echo "<h2>Publications</h2>";
											foreach ($committee_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('about/committees/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/committee_member/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('about/committees/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('about/committees/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     
                                     <?php 
										if(count($secretariat_pages)>0){
											//echo "<h2>Publications</h2>";
											foreach ($secretariat_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('secretariat'); ?>"><img src="<?php echo base_url('assets/upload/secretariat/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            
                                            
                                            <div class="info-news">
                                                <a href="<?php echo base_url('secretariat'); ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('secretariat'); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php }} ?>
                                     
                                     
                                     
                                     
                                     
                                     
                               <!--================end======================-->      
                                     
                                     
                                     </div>
                                  
                                    
                                </div>
                               
                            </div>
                    </div>
                
               
            </div>
            
        </div><!-- //page -->
       <?php $this->load->view('include/footer'); ?>
      
        <?php echo js('jquery.min'); ?>
        <?php echo js('plugin'); ?>
        <?php echo js('main'); ?>
        
    </body>
</html>