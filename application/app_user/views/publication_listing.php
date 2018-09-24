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
                                    	RESOURCES
                                    </div>
                                    	 <!--<ul class="menuchild" id='menuchild'>
                                    	 <li class="has-sub"><a href="resources-publications.html">Directory <span class="icon-menu"></span></a>
                                         	<ul>
                                            	<li><a href="resources.html">Singapore Venture Capital And Private Equity Directory 2016<span class="icon-menu"></span></a></li>
                                            </ul>
                                         </li>
                                         
                                         <li><a href="resources-toolkit.html">Toolkit<span class="icon-menu"></span></a></li>
                                         <li class="has-sub active"><a href="resources-publications.html">Publications<span class="icon-menu"></span></a>
                                         	<ul>
                                            	<li><a href="resources-publications-1.html">FORTUNE Magazine</a></li>
                                                <li><a href="resources-publications-2.html">Venture Capital Fund Management – A Comprehensive Approach to Investment Practices and the Entire Operations of a VC Firm</a></li>
                                                <li><a href="resources-publications-3.html">Entrepreneurial Finance: Start-up To IPO</a></li>
                                                <li><a href="resources-publications-4.html">IPEV Reporting Guidelines</a></li>
                                                <li><a href="resources-publications-5.html">Transaction Trail</a></li>
                                            </ul>
                                         
                                         </li>
                                         <li><a href="resources-ournetwork.html">Our Network<span class="icon-menu"></span></a></li>                                        	
                                    </ul>-->
                                   <?php $this->load->view('include/resource_left'); ?> 
                                   
                                </div>
                                <div class="col-md-9 rightpage">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li><a href="<?php echo base_url('rdirectory/'.$rdirectory[0]['seo_url']) ?>">RESOURCES </a></li>
                                          <li class="active">PUBLICATIONS</li>
                                         
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	Publications
                                    </h3>
                                    
                                     <div class="list-news ">
                                     
                                     <?php if(count($publication)>0)
									       {
											    foreach ($publication as $val)
												{
									 ?>
                                     	<div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']) ?>"><img src="<?php echo base_url('assets/upload/publications/thumb/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']) ?>" class="t-header-6"><?php echo $val['name'];?></a>
                                                <?php echo $val['short_descriptions'];?>
                                                <a href="<?php echo base_url('publications/'.$val['seo_url']) ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                     
                                     <?php
												}
										   }
									 ?>
                                     
                                     	
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