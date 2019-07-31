<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		<?php print_r($page_title);?>
		</h1>
		<?php print_r($breadcrumbs);?>
	</section>
	<?php $this->load->view('backend/include/messages')?>
	<?php if (validation_errors()) {?>
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo validation_errors(); ?>
        </div>
    </div>
    <?php }?>
    <?php $this->aauth->print_errors(); ?>
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<?php
			if($this->session->userdata('user_credentials')['id']==1) {
			?>
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Change Email</h3>
					</div>					
					<?php echo form_open('admin/users/user_details/update'); ?>
					<div class="box-body">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Username</label>
								<input class="form-control" type="text" name="username" value="<?php echo $user_data->username; ?>" placeholder="">
							</div>
							<div class="form-group">
								<label>Email <span class="text-muted">Note: This email will be used for sending as reply email from TSA for Invoices</span></label>
								<input class="form-control" type="text" name="email" value="<?php echo $user_data->email; ?>" placeholder="">
							</div>
						</div>
					</div>
					<div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
				</div>
			</div>
			<?php
			}
			?>
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Change Password</h3>
					</div>					
					<?php echo form_open('admin/users/profile/update'); ?>
					<div class="box-body">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Old Password</label>
								<input class="form-control" type="password" name="old_password" value="" placeholder="">
							</div>
							<div class="form-group">
								<label>New Password</label>
								<input class="form-control" type="password" name="new_password" value="" placeholder="">
							</div>
							<div class="form-group">
								<label>Confirm New Password</label>
								<input class="form-control" type="password" name="confirm_new_password" value="" placeholder="">
							</div>
						</div>
					</div>
					<div class="box-footer">
                        <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                        <button type="submit" class="btn btn-info pull-right"><?php echo UPDATES ?></button>
                    </div>
                    <?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</section>
</div>