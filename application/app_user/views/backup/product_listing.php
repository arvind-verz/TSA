<?php $this->load->view('include/header_tag'); ?>
<body onLoad="add_options(0,0);">
<div id='bigmain'>
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class='maincontent'>
    <div class="container">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/');?>">Home</a></li>
        <li class="active">Products</li>
      </ol>
      <div class='main-l'> 
        <!--<h3 class="title-4">Sorting by</h3>-->
        <ul class="menusub" id="navac">
          <?php $c = 0; foreach ($options as $key => $val){
							if($c==0){ $class="class='activeted'"; $style='style="display: block;"';}else{$class=""; $style='';} $c++;
							?>
          <li><a href="#pre" <?php echo $class;?>><?php echo $val['products_options_name']; ?></a>
            <ul>
              <li>
              <form name="option" id="option" method="post" action="<?php echo base_url('product-listing'); ?>" >
                <input type="radio" <?php if($this->session->userdata('options_'.$val['products_options_id'])==0){echo 'checked';}?> name="options_<?php echo $val['products_options_id']; ?>" id="0" value="0" onClick="this.form.submit()">
                <label for="Radio01">All</label>
                </li>
              </form>
              <?php $values = $this->all_function->get_values($val['products_options_id']);?>
              <?php foreach ($values as $key => $val){?>
              <form name="option" id="option" method="post" action="<?php echo base_url('product-listing'); ?>" >
                <li>
                  <input type="radio" <?php if(($this->session->userdata('options_'.$val['products_options_id']))&&($this->session->userdata('options_'.$val['products_options_id'])==$val['products_options_values_id'])){echo 'checked';}?> name="options_<?php echo $val['products_options_id']; ?>" id="<?php echo $val['products_options_values_id']; ?>" value="<?php echo $val['products_options_values_id']; ?>" onClick="this.form.submit()">
                  <label for="Radio02"><?php echo $val['products_options_values_name']; ?></label>
                </li>
              </form>
              <?php }?>
            </ul>
          </li>
          <?php }?>
        </ul>
      </div>
      <div class='main-r'>
        <div class='ajaxList'> <a name="pre" id="pre"></a>
          <div class="ajaxContent">
            <div class="pager clearfix"> <span>Showing <?php echo $current_items;?> of <?php echo $total_items;?></span> <a href="<?php echo base_url('product-listing');?>" class="s-all">Show All</a> <?php echo $pagi;?> </div>
            <ul class="box-listing">
              <?php foreach ($products_list as $key => $val): ?>
              <li> <a href="<?php echo base_url('product-detail/'.$val['id']); ?>"> <img src="<?php echo base_url('assets/upload/products/listing/'.$val['image_name']); ?>" alt=""/></a>
                <p><strong><?php echo $val['product_name'] ?></strong></p>
                <p><?php echo substr($val['sort_details'],0,95); if(strlen($val['sort_details'])>95){echo '...';} ?> <a href='<?php echo base_url('product-detail/'.$val['id']); ?>' class='v-more-r'>More</a></p>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class='box3'>
        <h3 class="title-3"><span>Glossary</span></h3>
        <ul class="box3-item">
          <?php foreach ($glossary as $key => $val){?>
          <li><a href="#"><img src="<?php echo base_url('assets/upload/glossary/original/'.$val['image_name']); ?>" alt=""/></a>
            <div class="showpopup">
              <h3><?php echo $val['title'];?></h3>
              <p><?php echo substr($val['content'],0,65); if(strlen($val['content'])>65){echo '...';} ?></p>
            </div>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery-1.8.3.min') ?> <?php echo js('bootstrap.min') ?> <?php echo css('acrodian') ?> 
<script type="text/javascript">
$(document).ready(function () {
	$('#navac > li > a').click(function(){
		if ($(this).attr('class') != 'active'){
		  $('#navac li ul').slideUp();
		  $(this).next().slideToggle();
		  $('#navac li a').removeClass('active');
		  $(this).addClass('active');
		}
  });
  //$("#navac > li:first > a").trigger("click");
  //$("#navac > li > a.activeted").trigger("click");
});
</script> 
<?php echo js('pluginsI') ?>
</body>
</html>