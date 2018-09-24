<?php if($this->session->userdata('success_msg')): ?>
<div class="notification msgsuccess"> <a class="close"></a>
  <p><?php echo $this->session->userdata('success_msg'); ?></p>
</div>
<?php endif; ?>
<?php if($this->session->userdata('error_msg')): ?>
<div class="notification msgerror"> <a class="close"></a>
  <p><?php echo $this->session->userdata('error_msg'); ?></p>
</div>
<?php endif; ?>
<?php if(isset($success_msg)): ?>
<div class="notification msgsuccess"> <a class="close"></a>
  <p><?php echo $success_msg; ?></p>
</div>
<?php endif; ?>
<?php if(isset($error_msg)): ?>
<div class="notification msgerror"> <a class="close"></a>
  <p><?php echo $error_msg; ?></p>
</div>
<?php endif; ?>