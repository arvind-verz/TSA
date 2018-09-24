<div class="left-menu">
  <h2>News<i class="click fa fa-reorder" aria-hidden="true"></i></h2>
  <div class="menu">
    <?php 
$start_year = date("Y", strtotime($start_date[0]['post_date']));
$start_month = date("m", strtotime($start_date[0]['post_date']));
$end_year = date("Y", strtotime($end_date[0]['post_date']));
$end_month = date("m", strtotime($end_date[0]['post_date']));
?>
    <ul id="accordion">
      <?php for($end_year; $end_year>=$start_year; $end_year--){?>
      <li class="Sub <?php if($year==$end_year){echo 'active';}?>"><span><a ><?php echo $end_year;?></a></span>
        <?php $startMonth =''; $endMonth ='';
		$sm = $this->News_model->get_news_list_year_start($end_year);
		$em = $this->News_model->get_news_list_year_end($end_year);
		if(isset($sm[0]['post_date'])){
			$startMonth = date("m", strtotime($sm[0]['post_date']));
			$endMonth = date("m", strtotime($em[0]['post_date']));
		}
		?>
        <ul <?php if($year==$end_year){echo 'class="selected" style="display: block;"';}?>>
          <?php for($startMonth; $startMonth<=$endMonth; $startMonth++){
				$startMonth = sprintf('%02d', $startMonth);?>
          <?php $news_post = $this->News_model->count_get_news_list($startMonth,$end_year);
		if($news_post>0){?>
          <li <?php if( $month==$startMonth && $year==$end_year){echo 'class="active"';}?>><a href="<?php echo base_url('news/'.$startMonth.'/'.$end_year); ?>"> <?php echo date("F", mktime(0, 0, 0, $startMonth, 10));?></a></li>
          <?php }?>
          <?php }?>
        </ul>
      </li>
      <?php }?>
    </ul>
  </div>
</div>
