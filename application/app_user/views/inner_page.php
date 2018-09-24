<?php $this->load->view('include/header_tag'); ?>

    <body>

    

        <div class="childpage">        	

        	<?php $this->load->view('include/header'); ?>

            <?php $this->load->view('include/top_banner'); ?>

           

            <div class="mainchild">

               	

               

                		 <div class="container maincontent">

                         

                            <div class="row">

                                

                                <div class="col-md-12 rightpage">

                                	<ol class="breadcrumb">

                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>

                                          <li class="active"><?php echo isset($page[0]['menu_title'])?$page[0]['menu_title']:$page[0]['page_heading'];?></li>

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