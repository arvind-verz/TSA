<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="<?php if(current_url() == site_url('admin/dashboard')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/dashboard'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo DASHBOARD ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/subject')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/subject'); ?>">
						<i class="fa fa-book"></i> <span><?php echo SUBJECT ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/tutors')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/tutors'); ?>">
						<i class="fa fa-user"></i> <span><?php echo TUTOR ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/classes')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/classes'); ?>">
						<i class="fa fa-building"></i> <span><?php echo CLASSES ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/attendance')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/attendance'); ?>">
						<i class="fa fa-check-circle-o"></i> <span><?php echo ATTENDANCE ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/material')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/material'); ?>">
						<i class="fa fa-book"></i> <span><?php echo MATERIAL ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/order')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/order'); ?>">
						<i class="fa fa-shopping-cart"></i> <span><?php echo ORDER ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/billing')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/billing'); ?>">
						<i class="fa fa-file"></i> <span><?php echo BILLING ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/invoice')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/invoice'); ?>">
						<i class="fa fa-file"></i> <span><?php echo INVOICE ?></span>
					</a>
				</li>
				<li class="">
					
					<a href="<?php echo site_url('admin/students'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo STUDENT ?></span>
					</a>
				</li>
				<li class="">
					
					<a href="<?php echo site_url('admin/manage-menu'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo MENU ?></span>
					</a>
				</li>
				<li class="">
					
					<a href="<?php echo site_url('admin/manage-cms'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo CMS ?></span>
					</a>
				</li>
				<li class="">
					
					<a href="<?php echo site_url('admin/manage-testimonial'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo TESTIMONIAL ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/students')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/students'); ?>">
						<i class="fa fa-dashboard"></i> <span><?php echo STUDENT ?></span>
					</a>
				</li>
				<li class="<?php if(current_url() == site_url('admin/users')) { echo 'active'; } ?>">
					<a href="<?php echo site_url('admin/users'); ?>">
						<i class="fa fa-users"></i> <span><?php echo USERS ?></span>
					</a>
				</li>
				
				<li class="treeview <?php if(current_url() == site_url('admin/sms_template') || current_url() == site_url('admin/sms_history') || current_url() == site_url('admin/sms_template/sms_template_create')) { echo 'active'; } ?>">
					<a href="#">
						<i class="fa fa-envelope"></i> <span>SMS</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="<?php if(current_url() == site_url('admin/sms_template') || current_url() == site_url('admin/sms_template/sms_template_create')) { echo 'active'; } ?>">
							<a href="<?php echo site_url('admin/sms_template'); ?>">
								<span><?php echo SMS_TEMPLATE ?></span>
							</a>
						</li>
						<li class="<?php if(current_url() == site_url('admin/sms_history')) { echo 'active'; } ?>">
							<a href="<?php echo site_url('admin/sms_history'); ?>">
								<span><?php echo SMS_HISTORY ?></span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</section>
	<!-- /.sidebar -->
</aside>