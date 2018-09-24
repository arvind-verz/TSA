<?php $this->load->view('include/header_tag'); ?>
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
            <?php $this->load->view('include/top_banner'); ?>
            <div class="mainchild">
               		<div class="container maincontent">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li class="active"><?php echo $page[0]['page_heading'];?></li>
                        </ol>
                        <h3 class="t-header-cnt">FAQs</h3>
                        <div class="accordion-content">
                        	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php
                            if(count($faq)>0)
							{$cnt=0;
								foreach($faq as $val)
								{ $cnt++;
							?>
                            		<div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?=$val['id']?>">
                                      <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$val['id']?>" aria-expanded="<?php echo ($cnt==1)?true:false;?>" aria-controls="collapse<?=$val['id']?>" class="<?php echo ($cnt==1)?'':'collapsed';?>">
                                         <?=$val['name']?> <span class="icon-down"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        </a>
                                      </h4>
                                    </div>
                                    <div id="collapse<?=$val['id']?>" class="panel-collapse collapse <?php echo ($cnt==1)?'in':'';?>" role="tabpanel" aria-labelledby="heading<?=$val['id']?>">
                                      <div class="panel-body document">
                                       		<div class="content-panel">
                                            	<?=$val['content']?>
                                            </div>
                                      </div>
                                    </div>
                                  </div>
                            
                            <?php }} ?>
                            
                                 
                                  
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