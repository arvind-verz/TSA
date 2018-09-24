<?php $this->load->view('include/header_inner_tag'); ?>
<body>
<div id="bigmain">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="mainhome widthmain clearfix">
    <?php $this->load->view('include/leftbox'); ?>
    <div class="main-r f-right main-r1"> 
      <!--<div class="breadcums">
					<ul>
						<li><a href="<?php echo base_url('/'); ?>">Home</a></li>
						<li><?php echo $page_cms[0]['title'];?></li>
					</ul>
				</div>-->
      <h3 class="title4"><?php echo $page_cms[0]['title'];?></h3>
      <div class="clearfix"> <?php echo $page_cms[0]['body'];?> </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>