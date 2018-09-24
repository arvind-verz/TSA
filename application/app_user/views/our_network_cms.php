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
                                          <li class="active">OUR NETWORK</li>
                                         
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	<?php echo $our_network['name'];?>
                                    </h3>
                                    <div class="document">
                                    	
                                        <?php echo $our_network['description'];?>

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