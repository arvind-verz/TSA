<?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>
<section class="top_nav">
  <div class="Nav_menu">
    <nav class="menu" id="menu">
    <ul>
      <li><a href="<?php echo base_url('dashboard'); ?>" <?php if($method_name == 'admin_home') echo 'class="Select"'; ?> >Dashboard </a></li>
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_tools_products' || $method_name == 'edit_tools_products' || $method_name == 'add_tools_products' || $method_name == 'manage_tools_categories' || $method_name == 'add_tools_categories' || $method_name == 'edit_tools_categories') echo 'class="Select"'; ?> >Tools</a>
        <ul>
          <li><a href="<?php echo base_url('manage-tools-products'); ?>" <?php if($method_name == 'manage_products' || $method_name == 'edit_products' || $method_name == 'add_products') echo 'class="Select"'; ?> >Products</a></li>
          <li><a href="<?php echo base_url('manage-tools-categories'); ?>" <?php if($method_name == 'manage_tools_categories' || $method_name == 'edit_tools_categories' || $method_name == 'add_tools_categories') echo 'class="Select"'; ?>>Categories</a></li>
        </ul>
      </li>
      
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_products' || $method_name == 'edit_products' || $method_name == 'add_products' || $method_name == 'manage_categories' || $method_name == 'edit_categories' || $method_name == 'add_categories') echo 'class="Select"'; ?> >Accessories</a>
        <ul>
          <li><a href="<?php echo base_url('manage-products'); ?>" <?php if($method_name == 'manage_products' || $method_name == 'edit_products' || $method_name == 'add_products') echo 'class="Select"'; ?> >Products</a></li>
          <li><a href="<?php echo base_url('manage-categories'); ?>" <?php if($method_name == 'manage_categories' || $method_name == 'edit_tools_categories' || $method_name == 'add_tools_categories') echo 'class="Select"'; ?>>Categories</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url('manage-parts'); ?>" <?php if($method_name == 'manage_parts' || $method_name == 'add_parts' || $method_name == 'edit_parts' ) echo 'class="Select"'; ?> >Parts</a></li>
      
      <li><a href="<?php echo base_url('manage-service-centre'); ?>" <?php if($method_name == 'manage_service_centre' || $method_name == 'add_service_centre' || $method_name == 'edit_service_centre' ) echo 'class="Select"'; ?> >Service Centres</a></li>
      
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_country_contact' || $method_name == 'add_country_contact' || $method_name == 'edit_country_contact' || $method_name == 'manage_contact'|| $method_name == 'view_contact'|| $method_name == 'manage_tools_contact'|| $method_name == 'view_tools_contact'|| $method_name == 'manage_acc_contact'|| $method_name == 'view_acc_contact'|| $method_name == 'manage_registration'|| $method_name == 'view_registration' ) echo 'class="Select"'; ?> >Enquiries</a>
        <ul>
         <li><a href="<?php echo base_url('manage-country-contact'); ?>" <?php if($method_name == 'manage_country_contact' || $method_name == 'add_country_contact' || $method_name == 'edit_country_contact') echo 'class="Select"'; ?> >Contact Us Country</a></li>
         
          <li><a href="<?php echo base_url('manage-contact'); ?>" <?php if($method_name == 'manage_contact' || $method_name == 'view_contact' ) echo 'class="Select"'; ?> >Contact Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-tools-contact'); ?>" <?php if($method_name == 'manage_tools_contact' || $method_name == 'view_tools_contact' ) echo 'class="Select"'; ?> >Tools Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-acc-contact'); ?>" <?php if($method_name == 'manage_acc_contact' || $method_name == 'view_acc_contact' ) echo 'class="Select"'; ?> >Accessories Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-registration'); ?>" <?php if($method_name == 'manage_registration' || $method_name == 'view_registration' ) echo 'class="Select"'; ?> >Warranty Registration</a></li>
        </ul>
      </li>
      
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_cms' || $method_name == 'add_cms' || $method_name == 'edit_cms' || $method_name == 'manage_menu' || $method_name == 'manage_menu_list' || $method_name == 'add_menu_item' || $method_name == 'edit_menu_item' || $method_name == 'manage_banner' || $method_name == 'add_banner' || $method_name == 'edit_banner'|| $method_name == 'manage_information' || $method_name == 'add_information' || $method_name == 'edit_information') echo 'class="Select"'; ?> >CMS</a>
        <ul>
          <li><a href="<?php echo base_url('manage-cms'); ?>" <?php if($method_name == 'manage_cms' || $method_name == 'add_cms' || $method_name == 'edit_cms') echo 'class="Select"'; ?> >Content Management</a></li>
          <li><a href="<?php echo base_url('manage-menu'); ?>" <?php if($method_name == 'manage_menu' || $method_name == 'manage_menu_list' || $method_name == 'add_menu_item' || $method_name == 'edit_menu_item') echo 'class="Select"'; ?> >Menu</a></li>
          <li><a href="<?php echo base_url('manage-banner'); ?>" <?php if($method_name == 'manage_banner' || $method_name == 'add_banner' || $method_name == 'edit_banner') echo 'class="Select"'; ?> >Banners</a> </li>
          <li><a href="<?php echo base_url('manage-information'); ?>" <?php if($method_name == 'manage_information' || $method_name == 'add_information' || $method_name == 'edit_information') echo 'class="Select"'; ?> >Information</a> </li>
          
        </ul>
      </li>
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_country' || $method_name == 'add_country' || $method_name == 'edit_country' || $method_name == 'manage_dealer'|| $method_name == 'add_dealer'|| $method_name == 'edit_dealer' ) echo 'class="Select"'; ?> >Dealer</a>
        <ul>
          <li><a href="<?php echo base_url('manage-country'); ?>" <?php if($method_name == 'manage_country' || $method_name == 'add_country' || $method_name == 'edit_country') echo 'class="Select"'; ?> >Country</a></li>
          <li><a href="<?php echo base_url('manage-dealer'); ?>" <?php if($method_name == 'manage_dealer' || $method_name == 'add_dealer' || $method_name == 'edit_dealer') echo 'class="Select"'; ?> >Dealer Address</a></li>
        </ul>
      </li>
      
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_users' || $method_name == 'add_users' || $method_name == 'edit_profile' || $method_name == 'edit_user' || $method_name == 'login_details') echo 'class="Select"'; ?>>Users</a>
        <ul>
          <li><a href="<?php echo base_url('manage-users'); ?>" <?php if($method_name == 'manage_users') echo 'class="Select"'; ?> >Manage Users</a></li>
          <li><a href="<?php echo base_url('edit-profile').'/'.$user_id; ?>" <?php if($method_name == 'edit_profile') echo 'class="Select"'; ?> >Edit Profile</a></li>
          <!--<li><a href="<?php echo base_url('login-details'); ?>" <?php if($method_name == 'login_details') echo 'class="Select"'; ?> >Login Details</a></li>-->
        </ul>
      </li>
      <!--<li><a href="javascript:void(0)" <?php if($method_name == 'manage_member' || $method_name == 'add_member' || $method_name == 'edit_member' || $method_name == 'login_member_details') echo 'class="Select"'; ?>>Member</a>
        <ul>
          <li><a href="<?php echo base_url('manage-member'); ?>" <?php if($method_name == 'manage_member') echo 'class="Select"'; ?> >Manage Member</a></li>
          <li><a href="<?php echo base_url('login-member-details'); ?>" <?php if($method_name == 'login_member_details') echo 'class="Select"'; ?> >Login Member Details</a></li>
        </ul>
      </li>-->
      <li><a href="javascript:void(0)" <?php if($method_name == 'all_general' || $method_name == 'update_general' || $method_name == 'google_analytics' || $method_name == 'manage_email_templates' || $method_name == 'edit_email_templates' || $method_name == 'pre_email_templates' || $method_name == 'manage_logo' || $method_name == 'edit_logo') echo 'class="Select"'; ?>>Settings</a>
        <ul>
          <li><a href="<?php echo base_url('settings/general'); ?>" <?php if($method_name == 'all_general') echo 'class="Select"'; ?>>General Settings</a></li>
          <li><a href="<?php echo base_url('manage-email-templates'); ?>" <?php if($method_name == 'manage_email_templates' || $method_name == 'edit_email_templates' || $method_name == 'pre_email_templates') echo 'class="Select"'; ?> >Email Templates</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url('logout') ?>">Logout</a></li>
    </ul>
    </nav>
  </div>
</section>