<?php $this->load->view('include/header_tag'); ?>
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
            <?php $this->load->view('include/news_banner'); ?>
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
                                            	<li  class="has-sub active"><a href="javascript:void(0)">Year 2016<span class="icon-menu"></span></a>
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
                                                        <li  class="active"><a href="latest-news.html">October</a></li>
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
                                          <li><a href="<?php echo base_url('newsletter'); ?>">NEWS </a></li>
                                          <!--<li><a href="latest-news.html">LATEST NEWS </a></li>
                                          <li><a href="latest-news.html">2016 </a></li>
                                          <li><a href="latest-news.html">OCTOBER </a></li>-->
                                          <li class="active"><?php echo $page[0]['title'];?></li>
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	<?php echo $page[0]['title'];?>
                                    </h3>
                                    <div class="date-detail">
                                    	<i class="fa fa-calendar" aria-hidden="true"></i>  <?php echo date("F d, Y", strtotime($page[0]['post_date']));?>
                                    </div>
                                    <div class="document">
                                    	<!--<p><img src="img/tempt/img21.jpg" class="imgright" alt=""/></p>
                                        <p>Nam pulvinar odio vel justo mattis viverra. Praesent ornare iporttitor porttitor. Etiam sit amet tellus non dolor tincidunt ullamcorpe. Donec a arcu euismod, luctus ex at, ornare eros. Donec at dui imetus viverra malesuada quis non nunc. Vestibulum condimentu nulla a venenatis. Lorem ipsum dolor sit amet, consectetur adi elit. Praesent bibendum feugiat tortor eu gravida. Cras accu odio vel accumsan. Pellentesque sed varius ipsum.</p>
                                        <p>Etiam accumsan vitae lorem eu tristique. Morbi pharetra fringilla tortor, eu consequat neque volutpat sit amet. Curabitur dapibus turpis sit amet congue facilisis. Suspendisse et nisl eu ex iaculis vulputate. Mauris elementum pharetra purus, id blandit odio laoreet vel. Proin eu dolor tempus mi molestie aliquet eu facilisis sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec dictum leo. Aenean volutpat tristique nibh nec mattis. Curabitur malesuada condimentum felis, quis volutpat libero. Nam feugiat, felis sit amet porta tempus, enim leo condimentum sapien, eget tempor nulla purus ac purus. </p>
                                        <p>Nulla id felis elementum, facilisis sem eu, faucibus ligula. Nunc condimentum eu ligula a egestas. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis sit amet sollicitudin dolor, at rutrum mauris. Etiam accumsan vitae lorem eu tristique. Morbi pharetra fringilla tortor, eu consequat neque volutpat sit amet. Curabitur dapibus turpis sit amet congue facilisis. Suspendisse et nisl eu ex iaculis vulputate.</p>
                                        <h3>Vivamus quis turpis a neque consectetur gravida. Morbi varius leo in rutrum tristique. Donec lobortis ipsum et finibus varius. Donec at lorem tortor.</h3>-->
                                        <?php echo $page[0]['description'];?>
                                    </div>
                                    <div class="text-right">
                                    	<a href="<?php echo base_url('newsletter'); ?>" class="link-back">BACK TO LISTING</a>
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