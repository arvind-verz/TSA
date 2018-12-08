<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">

			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
	
				
			<?php
			/* TWO LEVEL MENU SUPPORT */
			$menu_array = [
			[
			'title' => DASHBOARD,
			'icon'  => '<i class="fa fa-dashboard"></i>',
			'url'   => 'admin/dashboard',
			],
			[
			'title' => SUBJECT,
			'icon'  => '<i class="fa fa-book"></i>',
			'url'   => 'admin/subject',
			],
			[
			'title' => TUTOR,
			'icon'  => '<i class="fa fa-user"></i>',
			'url'   => 'admin/tutors',
			],
			[
			'title' => CLASSES,
			'icon'  => '<i class="fa fa-building"></i>',
			'url'   => 'admin/classes',
			],
			[
			'title' => STUDENT,
			'icon'  => '<i class="fa fa-black-tie"></i>',
			'url'   => 'admin/students',
			],
			[
			'title' => ATTENDANCE,
			'icon'  => '<i class="fa fa-check-circle-o"></i>',
			'url'   => 'admin/attendance',
			],
			[
			'title' => MATERIAL,
			'icon'  => '<i class="fa fa-book"></i>',
			'url'   => 'admin/material',
			],
			[
			'title' => ORDER,
			'icon'  => '<i class="fa fa-shopping-cart"></i>',
			'url'   => 'admin/order',
			],
			[
			'title' => BILLING,
			'icon'  => '<i class="fa fa-file"></i>',
			'url'   => 'admin/billing',
			],
			[
			'title' => INVOICE,
			'icon'  => '<i class="fa fa-file"></i>',
			'url'   => 'admin/invoice',
			],
			/*[
			'title' => MENU,
			'icon'  => '<i class="fa fa-dashboard"></i>',
			'url'   => 'admin/manage-menu',
			],
			[
			'title' => CMS,
			'icon'  => '<i class="fa fa-dashboard"></i>',
			'url'   => 'admin/manage-cms',
			],
			[
			'title' => TESTIMONIAL,
			'icon'  => '<i class="fa fa-book"></i>',
			'url'   => 'admin/manage-testimonial',
			],*/
			[
			'title' => USERS,
			'icon'  => '<i class="fa fa-users"></i>',
			'url'   => 'admin/users',
			],
			[
			'title' => REPORTING,
			'icon'  => '<i class="fa fa-file"></i>',
			'url'   => 'admin/reporting',
			],
			[
			'SMS' => [
			'icon' => '<i class="fa fa-envelope"></i>',
			[
			'title' => SMS_TEMPLATE,
			'url'   => 'admin/sms_template',
			],
			[
			'title' => SMS_HISTORY,
			'url'   => 'admin/sms_history',
			],
			[
			'title' => SMS_REMINDER,
			'url'   => 'admin/sms_reminder',
			],
			],
			],
			];
			?>
		<ul class="sidebar-menu" data-widget="tree">
				<?php
				if (count($menu_array)) {
				foreach ($menu_array as $menu) {
				if (count($menu) > 1) {
				?>
				<li class="<?php if (current_url() == site_url($menu['url'])) {echo 'active';}?>">
					<a href="<?php echo site_url($menu['url']); ?>">
						<?php echo $menu['icon']; ?> <span><?php echo $menu['title']; ?></span>
					</a>
				</li>
				<?php
				} else {
				$child_menu_array = ['SMS'];
				$url_array        = [];
				foreach ($child_menu_array as $value) {
				if (array_key_exists($value, $menu)) {
				$child_menu_icon = $menu[$value]['icon'];
				unset($menu[$value]['icon']);
				foreach ($menu[$value] as $child_menu) {
				$url_array[] = site_url($child_menu['url']);
				}
				?>
				<li class="treeview <?php if (in_array(current_url(), $url_array)) {echo 'active';}?>">

					<a href="#">
						<?php echo $child_menu_icon; ?> <span><?php echo $value; ?></span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<?php
						foreach ($menu[$value] as $child_menu) {
						?>
						<li class="<?php if (current_url() == site_url($child_menu['url'])) {echo 'active';}?>">
							<a href="<?php echo site_url($child_menu['url']); ?>">
								<span><?php echo $child_menu['title']; ?></span>
							</a>
						</li>
						<?php
						}
						?>
					</ul>
				</li>
				<?php
				}}}}}
				?>
			</ul>
		</div>
	</section>
	<!-- /.sidebar -->
</aside>