<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <?php
        $menu_array = [
        [
        'title' => LOGO,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-logo',
        ],
        [
        'title' => CMS,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-cms',
        ],
        [
        'title' => MENU,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-menu',
        ],
        [
        'title' => TESTIMONIAL,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-testimonial',
        ],
        [
        'title' => GALLERY,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-gallery',
        ],
        [
        'title' => FOOTER,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/manage-footer',
        ],
		[
        'title' => SYSTEM_SETTINGS,
        'icon'  => '<i class="menu-icon fa fa-check"></i>',
        'url'   => 'admin/system-settings',
        ],
        ];
    ?>
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
            <a data-toggle="tab" href="#control-sidebar-home-tab">
                <i class="fa fa-wrench">
                </i> CMS
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <ul class="control-sidebar-menu">
                <?php
                
                if (count($menu_array)) {
                foreach ($menu_array as $menu) {
                if (count($menu) > 1) {
                ?>
                <li>
                    <a href="<?php echo site_url($menu['url']); ?>">
                        <?php echo $menu['icon']; ?>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">
                                <?php echo $menu['title']; ?>
                            </h4>
                        </div>
                    </a>
                </li>
                <?php
                }}}
                ?>
                
            </ul>
            <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg">
</div>