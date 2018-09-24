<?php if($this->session->userdata('error_msg')): $type = '';?>
<?php if($this->session->userdata('msg_type')==1){$type = 'successfull';}elseif($this->session->userdata('msg_type')==0){$type = 'error';}?>
<div class="lightbox ajaxcontent">
  <div class="popUp-content <?php echo $type;?>">
  	<?php echo $this->session->userdata('error_msg'); ?>
  	<div class="popUpBtn text-center"><a href="javascript:void(0)" class="featherlight-close">Ok</a></div>
  </div>
</div>
<?php endif; ?>