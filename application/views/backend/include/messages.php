<?php
if ($this->session->flashdata('error')) {
?>
<div class="pad margin no-print my-0 py-0">
	<div class="alert alert-error alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-times"></i> Error!</h4>
		<?php echo $this->session->flashdata('error'); ?>
	</div>
</div>
<?php
}

if ($this->session->flashdata('success')) {
?>
<div class="pad margin no-print my-0 py-0">
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Success!</h4>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
</div>
<?php
}