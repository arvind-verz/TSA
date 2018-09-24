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
                                    	ABOUT US 
                                    </div>
                                    <?php $this->load->view('include/about_left'); ?>
                                    	 
                                   
                                   
                                </div>
                                <div class="col-md-9 rightpage">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li><a href="<?php echo base_url('history'); ?>">ABOUT US</a></li>
                                          <li class="active"><?php echo $page[0]['menu_title'];?></li>
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	<?php echo $page[0]['page_heading'];?>
                                    </h3>
                                    <div class="document">
                                    	<?php echo $page[0]['page_content'];?>
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