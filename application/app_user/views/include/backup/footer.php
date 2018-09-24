<footer class="footer-wrap">
<div class="footer-top">
<div class="container">
<div class="col-01">
<img src="<?php echo base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('footer_logo'));?>" alt="">
<article>
<?php echo $this->all_function->get_site_options('footer_about');?>
</article>
</div>
<div class="col-02">
<h2>Our <span>Sitemap</span></h2>
<div class="menu-footer clear-fix">
<?php $FooterMenu = $this->All_function_model->get_menu_pid_Mposition(0,'footerBottom');
      if(count($FooterMenu)>0){ $cnt=0;        
?>
<ul>
<?php foreach ($FooterMenu as $key => $val){ $cnt++;
  $selectMenu = $this->All_function_model->get_selected_menu_id($menu_id, $val['id'],'footerBottom'); ?>
  
  <li <?php if($selectMenu=='Y'){echo 'class="Select"';}elseif($url==$val['url_name']){echo 'class="Select"';}?>>
	<?php if($val['link_type']=='external'){?>
    <a href="<?php echo $val['external_url'];?>" <?php if($selectMenu=='Y'){echo 'class="Select"';}elseif($url==$val['url_name']){echo 'class="Select"';}?> <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>>
	<?php echo $val['menu_title'];?></a>
    <?php }elseif($val['link_type']=='internal'){?>
    <a href="<?php echo base_url($val['url_name']);?>" class="<?php if($selectMenu=='Y'){echo 'Select';}elseif($url==$val['url_name']){echo 'Select';}?> <? if($cnt==5){echo 'border-bottom';}?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>>
	<?php echo $val['menu_title'];?></a>
    <?php }?>
  </li>
  <?php } ?>
   
<!--<li><a href="about-us.html">About Us</a></li>
<li><a href="News.html">News</a></li>              
<li><a href="Desktop-Monitor.html">Products</a></li> 
<li><a href="Our-Clients.html">Our Clients</a></li>  
<li class="border-bottom"><a href="Services.html">Services</a></li>                 
<li><a href="Contact-Us.html">Contact Us </a></li>-->        
</ul>
<?php } ?>
</div>
</div>
<div class="footer-address">
<h2>Contact <span>AIS</span></h2>
<address class="adress">
<ul>
<li><i class="fa fa-map-marker" aria-hidden="true"></i><strong>Locate Us:</strong><?php echo $this->all_function->get_site_options('site_address1');?></li>
<li><i class="fa fa-phone" aria-hidden="true"></i><strong>Call Us:</strong> <?php echo $this->all_function->get_site_options('cantact_no');?></li>
<li><i class="fa fa-envelope" aria-hidden="true"></i><strong>Email:</strong>  <a href="mailto:<?php echo $this->all_function->get_site_options('contact_email');?>"> <?php echo $this->all_function->get_site_options('contact_email');?></a></li>
<li><i class="fa fa-clock-o" aria-hidden="true"></i><strong>Operating Hours:  </strong><?php echo $this->all_function->get_site_options('operating_hours');?></li>
</ul>
</address>

</div>
</div>
</div>
<div class="footer">
<div class="container">
<!--Copyright &copy; 2016 Absolute Instrument Systems-->
Copyright &copy; <?php echo date("Y"); ?> <?php echo $this->all_function->get_site_options('site_name');?>
</div>
</div>
</footer>
<script type="text/javascript">

jQuery(function($) { 

 $("a.close").click(function() {

  $('div.notification').hide();

 }); 

}); 

</script>