<?php $this->load->view('include/header_tag'); ?>
    
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
             <?php $this->load->view('include/top_banner'); ?>
           
            <div class="mainchild">
               	
               
                		 <div class="container maincontent">
                         
                            <div class="row">
                                   <div class="col-md-3">
                                	<div class="t-header-3">
                                    	NEWS
                                    </div>
                                    
                                    	 <ul class="menuchild" id='menuchild'>
                                    	 <li class="active"><a href="<?php echo base_url('newsletter'); ?>">Newsletter <span class="icon-menu"></span></a></li>
                                    	
                                          <?php 
                                        $start_year = date("Y", strtotime($start_date[0]['post_date']));
                                        $start_month = date("m", strtotime($start_date[0]['post_date']));
                                        $end_year = date("Y", strtotime($end_date[0]['post_date']));
                                        $end_month = date("m", strtotime($end_date[0]['post_date']));
                                        ?>
                                        <li class="has-sub"><a href="javascript:void(0)">Latest News<span class="icon-menu"></span></a>
                                         <ul>
                                         <?php for($end_year; $end_year>=$start_year; $end_year--){?>
                                         		<li  class="has-sub"><a href="javascript:void(0)">Year <?php echo $end_year;?><span class="icon-menu"></span></a>
                                                
                                                <?php $startMonth =''; $endMonth ='';
														$sm = $this->News_model->get_news_list_year_start($end_year);
														$em = $this->News_model->get_news_list_year_end($end_year);
														if(isset($sm[0]['post_date'])){
															$startMonth = date("m", strtotime($sm[0]['post_date']));
															$endMonth = date("m", strtotime($em[0]['post_date']));
														}
		                                        ?>
                                                     <ul <?php if($year==$end_year){echo 'class="selected" style="display: block;"';}?>>
                                                        <?php for($startMonth; $startMonth<=$endMonth; $startMonth++){
                                                        $startMonth = sprintf('%02d', $startMonth);?>
                                                        <?php $news_post = $this->News_model->count_get_news_list($startMonth,$end_year);
                                                        if($news_post>0){?>
                                                        <li <?php if( $month==$startMonth && $year==$end_year){echo 'class="active"';}?>><a href="<?php echo base_url('latest-news/'.$startMonth.'/'.$end_year); ?>"> <?php echo date("F", mktime(0, 0, 0, $startMonth, 10));?></a></li>
                                                        <?php }?>
                                                        <?php }?>
                                                   </ul>
                                                
                                         </li>
                                         <?php }?>
                                         </ul>
                                    	</li>
                                        
                                        
                                         <!--<li class="has-sub"><a href="javascript:void(0)">Latest News<span class="icon-menu"></span></a>
                                        	<ul>
                                            	<li class="has-sub">
													<a href="#">Year 2016<span class="icon-menu"></span></a>
													<ul>
														<li><a href="latest-news.html">January</a></li>
														<li><a href="latest-news.html">February</a></li>
														<li><a href="latest-news.html">March</a></li>
														<li><a href="latest-news.html">April</a></li>
														<li><a href="latest-news.html">May</a></li>
														<li><a href="latest-news.html">June</a></li>
														<li><a href="latest-news.html">July</a></li>
														<li><a href="latest-news.html">August</a></li>
														<li><a href="latest-news.html">September</a></li>
														<li><a href="latest-news.html">October</a></li>
														<li><a href="latest-news.html">November</a></li>
													</ul>
                                                </li>
                                            </ul>
                                        </li>-->
                                    </ul>
                                   
                                   
                                </div>
                                <div class="col-md-9 rightpage">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li><a href="<?php echo base_url('newsletter'); ?>">NEWS</a></li>
                                          <li class="active">Newsletter</li>
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	Newsletter
                                    </h3>
                                    <div class="list-news">
                                    <?php
                                    if(count($newsletter)>0){
										foreach($newsletter as $val)
										{
									?>
                                    <div class="item-news">
                                            <div class="img-news">
                                                <a href="<?php echo base_url('newsletter-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/newsletter/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('newsletter-details/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['title'];?></a>
                                                <div class="date-news"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($val['post_date']));?>  
                                                </div>
                                            </div>
                                        </div>
                                    <?php
										}
									}
									?>
                                    
                                     
                                        
                                       
                                        
                                    </div>
                                          <div class="paging paging-bottom">
                            <nav aria-label="Page navigation">
                              <!--<ul class="pagination">
                                
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li class="last">
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                                  </a>
                                  
                                </li>
                              </ul>-->
                              <?php echo $pagi;?>
                            </nav>
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