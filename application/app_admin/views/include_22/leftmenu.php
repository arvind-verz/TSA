<!--<?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>
<div class="leftpanel">
        <div class="arrowlistmenu">
            
            
            <h1 class="menuheader expandable">Vendors </h1>
                <ul class="categoryitems">
                <li><a href="<?php echo base_url('manage-vendors'); ?>" <?php if($method_name == 'manage_vendors') echo 'class="Select"'; ?> >Manage Vendors</a></li>
                <li><a href="<?php echo base_url('add-vendors'); ?>" <?php if($method_name == 'add_vendors') echo 'class="Select"'; ?> >Add Vendors</a></li>
				<li><a href="<?php echo base_url('most-famous-vendors'); ?>" <?php if($method_name == 'most_famous_vendors') echo 'class="Select"'; ?> >Most Famous Vendors</a></li>
				 <li><a href="<?php echo base_url('export-vendors'); ?>" <?php if($method_name == 'export_vendors') echo 'class="Select"'; ?> >Export Vendors</a></li>
                <li><a href="<?php echo base_url('import-vendors'); ?>" <?php if($method_name == 'import_vendors') echo 'class="Select"'; ?> >Import Vendors</a></li>
                </ul>
            <h1 class="menuheader expandable">Categories </h1>
                <ul class="categoryitems">
                <li><a href="<?php echo base_url('manage-categories'); ?>" <?php if($method_name == 'manage_categories') echo 'class="Select"'; ?> >Manage Categories</a></li>
                <li><a href="<?php echo base_url('add-categories'); ?>" <?php if($method_name == 'add_categories') echo 'class="Select"'; ?> >Add Category</a></li>
                <li><a href="<?php echo base_url('export-categories'); ?>" <?php if($method_name == 'export_categories') echo 'class="Select"'; ?> >Export Category</a></li>
                <li><a href="<?php echo base_url('import-categories'); ?>" <?php if($method_name == 'import_categories') echo 'class="Select"'; ?> >Import Category</a></li>
                </ul>
              <h1 class="menuheader expandable">Enquiries</h1>
                <ul class="categoryitems">
                <li><a href="<?php echo base_url('manage-enquiries'); ?>" <?php if($method_name == 'manage_enquiries') echo 'class="Select"'; ?> >Users Enquiries</a></li>
                <li><a href="<?php echo base_url('export-enquiries'); ?>" <?php if($method_name == 'export_enquiries') echo 'class="Select"'; ?> >Export Enquiries</a></li>
                <li><a href="<?php echo base_url('enquiries-temp/1'); ?>" <?php if($method_name == 'enquiries_temp') echo 'class="Select"'; ?> >Enquiries Template</a></li>
                <li><a href="<?php echo base_url('enquiries-temp/2'); ?>" <?php if($method_name == 'enquiries_temp') echo 'class="Select"'; ?> >Auto Responder Template</a></li>
                </ul>
                
            <h1 class="menuheader expandable">Users</h1>
                <ul class="categoryitems">
                <li><a href="<?php echo base_url('manage-users'); ?>" <?php if($method_name == 'manage_users') echo 'class="Select"'; ?> >Manage Users</a></li>
                <li><a href="<?php echo base_url('add-users'); ?>" <?php if($method_name == 'add_users') echo 'class="Select"'; ?> >Add Users</a></li>
                <li><a href="<?php echo base_url('edit-profile').'/'.$user_id; ?>" <?php if($method_name == 'edit_profile') echo 'class="Select"'; ?> >Edit Profile</a></li>
                </ul>
                
                 <h1 class="menuheader expandable">Banner</h1>
                <ul class="categoryitems">
                <li><a href="<?php echo base_url('manage-banner'); ?>" <?php if($method_name == 'manage_banner') echo 'class="Select"'; ?> >Banner Manage</a></li>
                <li><a href="<?php echo base_url('add-banner'); ?>" <?php if($method_name == 'add_banner') echo 'class="Select"'; ?> >Add Banner</a></li>
                <li><a href="<?php echo base_url('top-banner'); ?>" <?php if($method_name == 'top_banner') echo 'class="Select"'; ?> >Top Banner</a></li>
                </ul>
                
                <h1 class="menuheader expandable">Others </h1>
                
                <ul class="categoryitems">
                
                <li><a href="<?php echo base_url('manage-adds'); ?>" <?php if($method_name == 'manage_adds') echo 'class="Select"'; ?> >Manage Adds</a></li>
                <li><a href="<?php echo base_url('add-adds'); ?>" <?php if($method_name == 'adds_adds') echo 'class="Select"'; ?> >Adds Adds</a></li>
                
                <li><a href="<?php echo base_url('manage-cms'); ?>" <?php if($method_name == 'manage_cms') echo 'class="Select"'; ?> >Manage CMS</a></li>
                <li><a href="<?php echo base_url('manage-seo'); ?>" <?php if($method_name == 'manage_seo') echo 'class="Select"'; ?> >Manage SEO</a></li>
                
                </ul>
                <h1 class="menuheader"><a href="<?php echo base_url('google-analytics'); ?>" <?php if($method_name == 'google_analytics') echo 'class="Select"'; ?>>Google analytics</a></h1>
                <h1 class="menuheader"><a href="<?php echo base_url('footer-text'); ?>" <?php if($method_name == 'footer_text') echo 'class="Select"'; ?>>Footer Text</a></h1>
                <h1 class="menuheader"><a href="<?php echo base_url('settings/general'); ?>" <?php if($method_name == 'all_general') echo 'class="Select"'; ?>>General settings</a></h1>
              
            	<h1 class="menuheader"><a href="<?php echo base_url('logout') ?>">Logout</a></h1>
                
        </div>
     </div>
-->