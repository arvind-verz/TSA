<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"> <a href="<?php echo base_url('/'); ?>" class="home"></a><a href="<?php echo base_url('news'); ?>" class="diable"><?php echo $page[0]['page_heading'];?></a> </div>
        <div class="listing_wrap">
          <div class="col_left">
            <h2><?php echo $page[0]['page_heading'];?></h2>
            <div class="news_left">
              <?php 
$start_year = date("Y", strtotime($start_date[0]['post_date']));
$start_month = date("m", strtotime($start_date[0]['post_date']));
$end_year = date("Y", strtotime($end_date[0]['post_date']));
$end_month = date("m", strtotime($end_date[0]['post_date']));
?>
              <ul>
                <?php for($end_year; $end_year>=$start_year; $end_year--){?>
                <li><span><a ><?php echo $end_year;?></a></span>
                  <ul>
                    <?php for($start_month; $start_month<=$end_month; $start_month++){
			$start_month = sprintf('%02d', $start_month);?>
                    <li><a href="<?php echo base_url('news/'.$start_month.'/'.$end_year); ?>" 
			<?php if( $month==$start_month && $year==$end_year){echo 'class="Select"';}?> > <?php echo date("F", time(0, 0, 0, $start_month, 10));?></a></li>
                    <?php }?>
                  </ul>
                </li>
                <?php }?>
              </ul>
            </div>
          </div>
          <div class="col_right">
            <h1 class="page_title">Latest NEWS</h1>
            <?php foreach ($news as $key => $val): ?>
            <section class="news_row"> <span class="date_tag"> <strong><?php echo date("d", strtotime($val['post_date']));?></strong> <?php echo date("M", strtotime($val['post_date']));?> </span>
              <article>
                <h3><a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>" ><?php echo $val['title'];?></a></h3>
                <?php if(strlen($val['description'])>460){
	echo substr($val['description'],0,460).'...';
}else{
	echo $val['description'];
}
?>
              </article>
              <div class="link_wrap"> <a href="<?php echo base_url('news-details/'.$val['seo_url']); ?>" class="Continue_reading">Continue reading</a> </div>
            </section>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>