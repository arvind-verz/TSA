<?php 
if($status==1){
	$class = 'send';	
}elseif($status==0){
	$class = 'error';	
}elseif($status==2){
	$class = 'error';	
}
?>
<span class="<?php echo $class;?>"><?php echo $notification;?><span>