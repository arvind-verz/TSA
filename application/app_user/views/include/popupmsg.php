<a data-featherlight="ajax" href="<?php echo base_url('error'); ?> .ajaxcontent" id="error"></a>
<script>
<?php if($error_status==1){?>
$(document).ready(function(){
	$('#error')[0].click();
});
<?php }?>
</script>