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
                                          <!--<li><a href="aboutus.html">COMMITTEES</a></li>-->
                                          <li class="active"><?php echo $committee_cat['name']?> COMMITTEE</li>
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	<?php echo $committee_cat['name']?> Committee
                                    </h3>
                                    <div class="list-group1 clearfix">
                                    
                                    <?php if(count($committee)>0){
										
										foreach($committee as $val){
										?>
                                    		<div class="list-group1-item">
                                        	<div class="list-group1-img">
                                            	<img src="<?php echo base_url('assets/upload/committee_member/thumb/'.$val['image_name']); ?>" alt=""/>
                                            </div>
                                            <div class="list-group1-info">
                                            	<h4><?php echo $val['name'];?></h4>
                                                <p><?php echo $val['description'];?></p>
                                            </div>
                                        </div>
                                    
                                    <?php }}else{ ?>
                                    <h3>No Record Found</h3>
                                    <?php } ?>
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