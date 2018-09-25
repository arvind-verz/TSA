<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
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
                <li>
                    <a href="{{ url('/admin/cms/settings/logo') }}">
                        <i class="menu-icon fa fa-check">
                        </i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">
                                Logo
                            </h4>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/cms/settings/header') }}">
                        <i class="menu-icon fa fa-check">
                        </i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">
                                Header
                            </h4>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/cms/pages') }}">
                        <i class="menu-icon fa fa-check">
                        </i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">
                                Pages
                            </h4>
                        </div>
                    </a>
                </li>
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