<?php
if ($this->session->flashdata('error')) {
?>
<div class="pad margin no-print my-0 py-0">
	<div class="alert alert-error alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
		<?php echo $this->session->flashdata('success'); ?>
	</div>
</div>
<?php
}

if ($this->session->flashdata('warning')) {
?>
<div class="pad margin no-print my-0 py-0">
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<?php echo $this->session->flashdata('warning'); ?>
	</div>
</div>
<?php
}