<?php $this->load->view('include/header_tag'); ?>
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
            <?php $this->load->view('include/top_banner'); ?>
           
            <div class="mainchild">
               	
               
                		 <div class="container maincontent">
                         	<div class="row">
                            	<!--<div class="col-md-6">
                                	<div class="thanks-img">
                                    <img src="img/tempt/img10.jpg" alt=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="thanks-info">
                                   		<h3>THANK YOU! </h3>
                                        <h4>Your message has been sent</h4>
                                        <h5>We have received your questions/feedback, and dropped you a <br/>confirmation email as well.</h5>
                                        <p>Meanwhile, you may want to find out more below:</p>
                                        <p><a href="aboutus-1.html">ABOUT US</a>
                                        <a href="whyjoinus.html">Membership Types</a>
                                        <a href="events.html">SVCA Events</a></p>
                                        
                                    </div>
                                </div>-->
                                
                                <?php echo $page[0]['page_content'];?>
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