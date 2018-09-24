<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<div class="wrap-bred">
    <div class="container">
      <div class="bred-camb"><a href="<?php echo base_url('/')?>">HOME</a><span class="seprster ">/</span>PARTS</div>
      
    </div>
  </div>
<div class="body-inner">
    <div class="container"> 
<div class="parts-row-top">
<div class="parts-top-left clear-fix">
<h2>PART SEARCH</h2><span class="prts-right">Search for tool drawing</span>

</div>
<div class="Keyword-search">
<form action="<?php echo base_url('parts')?>" method="get">
<input type="text"  name="key" placeholder="Search in parts" onblur="if(this.placeholder=='')this.placeholder='Search in parts';" onfocus="if(this.placeholder=='Search in parts')this.placeholder='';" required>
<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form> 
</div>
</div>
      <div class="parts-row-top2">
<span class="filter"><i class="fa fa-list" aria-hidden="true"></i>FILTER</span>
<div class="filter-name clear-fix">
<ul>
<?php 
for ($i=0;$i<=9;$i++) {
 ?>
<li class="<?php echo (is_numeric($key) && $i==$key)?'Select':'';?>"><a href="<?php echo base_url('parts/'.$i)?>"><?php echo $i ?></a></li> 
 <?php   
}
?>
<?php 
foreach (range('A', 'Z') as $char) {
 ?>
<li class="<?php echo (strtolower($char)==$key)?'Select':'';?>"><a href="<?php echo base_url('parts/'.strtolower($char))?>"><?php echo $char ?></a></li> 
 <?php   
}
?>
</ul>
</div>
</div>

<div class="wrap-pdf">

<?php if(count($parts)>0)
{$cnt=-1;
	foreach($parts as $val)
	{
	 $cnt++;
	 if($cnt==0) 	
	 echo '<div class="pdf-row clear-fix">';	
?>
<div class="col-pdf"><a href="<?php echo base_url('assets/upload/parts/'.$val['pdf_name']);?>" target="_blank"><?php echo $val['name'];?></a></div>
<?php if($cnt==3){echo '</div>';$cnt=-1;} ?>

<?php } 
if($cnt<3)echo '</div>';

}else{ ?>
<div class="pdf-row clear-fix">
<div class="col-pdf">No Record Found</div>
</div>
<?php } ?>

</div>
    </div>
    
    
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
<?php echo js('mobile-menu'); ?>
<?php echo css('mobile-menu'); ?>
<?php echo css('left-menu'); ?>


<script>
$("#accordion > li > span").click(function(){

	if(false == $(this).next().is(':visible')) {
		$('#accordion ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});

$(".click").click(function(){
	$(".menu").slideToggle(300);
});


//$('#accordion ul:eq(0)').show();

</script>
<?php echo js('plugins'); ?>
</html>
