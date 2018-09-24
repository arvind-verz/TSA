<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a >EVENTS</a></li>
        <li class="active"><?php echo $page[0]['page_heading'];?></li>
      </ol>
      <div class="group-tagline">
        <div class="row">
          <div class="col-md-6">
            <h3 class="t-header-cnt"><?php echo $page[0]['page_heading'];?></h3>
          </div>
          <div class="col-md-6">
            <div class="paging">
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
                
                <?php echo $pagi;?> </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="list-grid4">
        <?php

                            if(count($oe)>0)

							{

								foreach($oe as $val)

								{ 

							?>
        <div class="list-grid4-item"> <a href="<?php echo $val['url'];?>" target="_blank"><img src="<?php echo base_url('assets/upload/otherevent/thumb/'.$val['image_name']); ?>" alt=""/></a> </div>
        <?php }} ?>
      </div>
      <div class="paging paging-bottom">
        <nav aria-label="Page navigation"> <?php echo $pagi;?> </nav>
      </div>
    </div>
  </div>
</div>
<!-- //page -->

<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>