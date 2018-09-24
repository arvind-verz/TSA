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
                                    
                                    	 <?php $this->load->view('include/resource_left'); ?>
                                   
                                   
                                </div>
                                <div class="col-md-9 rightpage">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li><a href="<?php echo base_url('rdirectory/'.$rdirectory[0]['seo_url']) ?>">RESOURCES </a></li>
                                          <li class="active">Toolkit</li>
                                         
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	Toolkit
                                    </h3>
                                     <div class="list-news">
                                     <?php if(count($toolkit)>0)
									       {
											    foreach ($toolkit as $val)
												{
									 ?>
                                     	<div class="item-news item-news-2">
                                            <div class="img-news">
                                                <a href="<?php echo base_url('assets/upload/toolkit/pdf/'.$val['pdf_name']);?>" target="_blank"><img src="<?php echo (empty($val['image_name']))?image('icon-pdf.png'):base_url('assets/upload/toolkit/thumb/'.$val['image_name']);?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('assets/upload/toolkit/pdf/'.$val['pdf_name']);?>" class="t-header-6" target="_blank"><?php echo $val['name'];?></a>
                                                <div class="date-news"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo date("F d, Y", strtotime($val['post_date']));?>  
                                                </div>
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