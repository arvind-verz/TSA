<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="homepage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/banner'); ?>
  <div class="mainhome">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="box1 shadowbox"> 
            <!--<div class="t-header-1">
                                    <h4><span>Welcome to</span></h4>
                                    <h3>Singapore Venture Capital & Private Equity Association</h3>
                                </div>
                                <p><em>The Singapore Venture Capital & Private Equity Association (SVCA) was formed in 1992 to promote the development of the venture capital (VC) and private equity (PE) industry.</em></p>
                                    <p>Our Mission is to foster greater understanding of the importance of venture capital and private equity to the economy in support of entrepreneurship and innovation and to look after the interests of our members. </p>
                                    <a href="aboutus-1.html" class="r-more">READ MORE</a>--> 
            <?php echo $page[0]['page_content'];?> </div>
          <?php $this->load->view('include/mailchimp'); ?>
          <?php
							if(count($advatise)>0)
							{
							?>
          <div class="box3 shadowbox">
            <div class="t-header-2"> Advertise <strong>with Us</strong> </div>
            <div class="slider-adv">
              <?php foreach($advatise as $val){
										?>
              <div>
                <div class="item-adv"> <a href="<?php echo $val['url'];?>" target="_blank" ><img src="<?php echo base_url('assets/upload/advertise/thumb/'.$val['image_name']); ?>" alt=""></a> </div>
              </div>
              <?php
									      }
									?>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <div class="box4 shadowbox">
            <div class="t-header-2"> Upcoming <strong>SVCA Events</strong> </div>
            <div class="scroll-content">
              <?php
                            if(count($events)>0)
							{
								foreach($events as $val)
								{ 
							?>
              <div class="iten-new"> <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="hide-link"></a>
                <div class="date-new">
                  <div class="box-date"> <span class="date"><?php echo date("d", strtotime($val['start_date']));?></span> <span class="month"><?php echo date("M", strtotime($val['start_date']));?></span> </div>
                </div>
                <div class="des-new">
                  <?php if($val['for_member']=='Y'){?>
                  <span class="for-member">Members Only</span>
                  <?php } ?>
                  <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="t-news"><?php echo $val['title'];?></a>
                  <p>
                    <?php 	echo substr(strip_tags($val['description']),0,100).'...'; ?>
                  </p>
                  <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="v-all">VIEW DETAILS</a> </div>
              </div>
              <?php }} ?>
            </div>
            <div class="group-link"> <a href="<?php echo base_url('svca-events'); ?>" class="r-more">VIEW ALL SVCA EVENTS</a> </div>
          </div>
          <div class="box5"> <!--<a href="<?php //echo base_url('benefits'); ?>" class="link-wapper"></a>--> <img src="<?php echo image('bg2.jpg');?>" alt=""/>
            <div class="infobox-5">
              <div class="tbl-info">
                <div class="tbl-cell">
                  <div class="tbl-des">
                    <!--<h4>Join Us Today <br/>
                      <strong>as a Member</strong></h4>
                    <p>Fusce vitae urna ut dolor ultricies sit amet  condimentum mauris blandit.</p>
                    <a href="<?php echo base_url('benefits'); ?>" class="v-more-1">ENJOY THESE BENEFITS</a>-->
                    <?php echo $this->all_function->get_site_options('home_join_us');?> 
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //page -->
<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>