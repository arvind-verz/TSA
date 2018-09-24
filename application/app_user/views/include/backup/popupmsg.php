<a data-featherlight="ajax" href="<?php echo base_url('error'); ?> .ajaxcontent" id="error"></a>
<script>
<?php if($error_status==1){?>
jQuery(function(){	
	jQuery('#error').trigger('click');
});
<?php }?>
</script>