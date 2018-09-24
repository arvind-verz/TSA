<?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>

<section class="top_nav">
  <div class="Nav_menu">
    <nav class="menu" id="menu">
      <ul>
        <li><a href="<?php echo base_url('dashboard'); ?>" <?php if($method_name == 'admin_home') echo 'class="Select"'; ?> >Dashboard </a></li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_committee_categtory' || $method_name == 'edit_committee_categtory' || $method_name == 'add_committee_categtory' || $method_name == 'manage_committee_member' || $method_name == 'add_committee_member' || $method_name == 'edit_committee_member' || $method_name == 'manage_secretariat' || $method_name == 'add_secretariat' || $method_name == 'edit_secretariat') echo 'class="Select"'; ?>>About Us</a>
          <ul>
            <li><a href="<?php echo base_url('manage-committee-categtory'); ?>" <?php if($method_name == 'manage_committee_categtory' || $method_name == 'add_committee_categtory' || $method_name == 'edit_committee_categtory') echo 'class="Select"'; ?> >Committee Category </a></li>
            <li><a href="<?php echo base_url('manage-committee-member'); ?>" <?php if($method_name == 'manage_committee_member' || $method_name == 'add_committee_member' || $method_name == 'edit_committee_member') echo 'class="Select"'; ?>>Committee Member</a></li>
            <li><a href="<?php echo base_url('manage-secretariat'); ?>" <?php if($method_name == 'manage_secretariat' || $method_name == 'add_secretariat' || $method_name == 'edit_secretariat') echo 'class="Select"'; ?>>Secretariat</a></li>
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_rdirectory' || $method_name == 'add_rdirectory' || $method_name == 'edit_rdirectory' || $method_name == 'manage_toolkit' || $method_name == 'add_toolkit' || $method_name == 'edit_toolkit' || $method_name == 'manage_publications' || $method_name == 'add_publications' || $method_name == 'edit_publications' || $method_name == 'edit_our_network') echo 'class="Select"'; ?> >Resources</a>
          <ul>
            <li><a href="<?php echo base_url('manage-rdirectory'); ?>" <?php if($method_name == 'manage_rdirectory' || $method_name == 'add_rdirectory' || $method_name == 'edit_rdirectory') echo 'class="Select"'; ?> >Directory</a></li>
            <li><a href="<?php echo base_url('manage-toolkit'); ?>" <?php if($method_name == 'manage_toolkit' || $method_name == 'add_toolkit' || $method_name == 'edit_toolkit') echo 'class="Select"'; ?>>Toolkit</a></li>
            <li><a href="<?php echo base_url('manage-publications'); ?>" <?php if($method_name == 'manage_publications' || $method_name == 'add_publications' || $method_name == 'edit_publications') echo 'class="Select"'; ?>>Publications</a></li>
            <li><a href="<?php echo base_url('manage-our-network'); ?>" <?php if($method_name == 'edit_our_network') echo 'class="Select"'; ?>>Our Network</a></li>
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'edit_join_us_member' || $method_name == 'edit_membership_type') echo 'class="Select"'; ?> > Join Us</a>
          <ul>
            <li><a href="<?php echo base_url('manage-our-member'); ?>" <?php if($method_name == 'edit_join_us_member') echo 'class="Select"'; ?> >Our Members</a></li>
            <li><a href="<?php echo base_url('manage-membership-type'); ?>" <?php if($method_name == 'edit_membership_type') echo 'class="Select"'; ?> >Membership Type</a></li>
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_newsletter' || $method_name == 'add_newsletter'|| $method_name == 'edit_newsletter' ||$method_name == 'manage_latestnews' || $method_name == 'add_latestnews'|| $method_name == 'edit_latestnews') echo 'class="Select"'; ?> >News</a>
          <ul>
            <li><a href="<?php echo base_url('manage-newsletter'); ?>" <?php if($method_name == 'manage_newsletter' || $method_name == 'edit_newsletter' || $method_name == 'add_newsletter') echo 'class="Select"'; ?> >Newsletter</a> </li>
            <li><a href="<?php echo base_url('manage-latestnews'); ?>" <?php if($method_name == 'manage_latestnews' || $method_name == 'add_latestnews' || $method_name == 'edit_latestnews') echo 'class="Select"'; ?> >Latest News</a> </li>
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_otherevent' || $method_name == 'add_otherevent'|| $method_name == 'edit_otherevent' ||$method_name == 'manage_svcaevent' || $method_name == 'add_svcaevent'|| $method_name == 'edit_svcaevent'|| $method_name == 'manage_registration'|| $method_name == 'view_registration') echo 'class="Select"'; ?> >Events</a>
          <ul>
            <li><a href="<?php echo base_url('manage-svcaevent'); ?>" <?php if($method_name == 'manage_svcaevent' || $method_name == 'edit_svcaevent' || $method_name == 'add_svcaevent') echo 'class="Select"'; ?>>SVCA Events</a></li>
            <li><a href="<?php echo base_url('manage-supportedevents'); ?>" <?php if($method_name == 'manage_otherevent' || $method_name == 'add_otherevent' || $method_name == 'edit_otherevent') echo 'class="Select"'; ?> >Supported Events</a> </li>
            <li><a href="<?php echo base_url('manage-registration'); ?>" <?php if($method_name == 'manage_registration' || $method_name == 'view_registration' || $method_name == 'edit_otherevent') echo 'class="Select"'; ?> >Event Registration</a> </li>
          </ul>
        </li>
        <li><a href="<?php echo base_url('manage-contact'); ?>" <?php if($method_name == 'manage_contact'|| $method_name == 'view_contact') echo 'class="Select"'; ?> >Contact</a> 
          <!--<ul>
         <li><a href="<?php echo base_url('manage-country-contact'); ?>" <?php if($method_name == 'manage_country_contact' || $method_name == 'add_country_contact' || $method_name == 'edit_country_contact') echo 'class="Select"'; ?> >Contact Us Country</a></li>
         
          <li><a href="<?php echo base_url('manage-contact'); ?>" <?php if($method_name == 'manage_contact' || $method_name == 'view_contact' ) echo 'class="Select"'; ?> >Contact Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-tools-contact'); ?>" <?php if($method_name == 'manage_tools_contact' || $method_name == 'view_tools_contact' ) echo 'class="Select"'; ?> >Tools Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-acc-contact'); ?>" <?php if($method_name == 'manage_acc_contact' || $method_name == 'view_acc_contact' ) echo 'class="Select"'; ?> >Accessories Enquiries</a></li>
          <li><a href="<?php echo base_url('manage-registration'); ?>" <?php if($method_name == 'manage_registration' || $method_name == 'view_registration' ) echo 'class="Select"'; ?> >Warranty Registration</a></li>
        </ul>--> 
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_cms' || $method_name == 'add_cms' || $method_name == 'edit_cms' || $method_name == 'manage_menu' || $method_name == 'manage_menu_list' || $method_name == 'add_menu_item' || $method_name == 'edit_menu_item' || $method_name == 'manage_banner' || $method_name == 'add_banner' || $method_name == 'edit_banner'|| $method_name == 'manage_advertise' || $method_name == 'add_advertise' || $method_name == 'edit_advertise' || $method_name == 'manage_faq' || $method_name == 'add_faq' || $method_name == 'edit_faq') echo 'class="Select"'; ?> >CMS</a>
          <ul>
            <li><a href="<?php echo base_url('manage-cms'); ?>" <?php if($method_name == 'manage_cms' || $method_name == 'add_cms' || $method_name == 'edit_cms') echo 'class="Select"'; ?> >Content Management</a></li>
            <li><a href="<?php echo base_url('manage-menu'); ?>" <?php if($method_name == 'manage_menu' || $method_name == 'manage_menu_list' || $method_name == 'add_menu_item' || $method_name == 'edit_menu_item') echo 'class="Select"'; ?> >Menu</a></li>
            <li><a href="<?php echo base_url('manage-banner'); ?>" <?php if($method_name == 'manage_banner' || $method_name == 'add_banner' || $method_name == 'edit_banner') echo 'class="Select"'; ?> >Banners</a> </li>
            <li><a href="<?php echo base_url('manage-advertise'); ?>" <?php if($method_name == 'manage_advertise' || $method_name == 'add_advertise' || $method_name == 'edit_advertise') echo 'class="Select"'; ?> >Advertise</a> </li>
            <li><a href="<?php echo base_url('manage-faq'); ?>" <?php if($method_name == 'manage_faq' || $method_name == 'add_faq' || $method_name == 'edit_faq') echo 'class="Select"'; ?> >FAQ</a> </li>
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_users' || $method_name == 'add_users' || $method_name == 'edit_profile' || $method_name == 'edit_user' || $method_name == 'login_details') echo 'class="Select"'; ?>>Users</a>
          <ul>
            <li><a href="<?php echo base_url('manage-users'); ?>" <?php if($method_name == 'manage_users') echo 'class="Select"'; ?> >Manage Users</a></li>
            <li><a href="<?php echo base_url('edit-profile').'/'.$user_id; ?>" <?php if($method_name == 'edit_profile') echo 'class="Select"'; ?> >Edit Profile</a></li>
            <!--<li><a href="<?php echo base_url('login-details'); ?>" <?php if($method_name == 'login_details') echo 'class="Select"'; ?> >Login Details</a></li>-->
          </ul>
        </li>
        <li><a href="javascript:void(0)" <?php if($method_name == 'manage_members' || $method_name == 'add_members' || $method_name == 'edit_members' || $method_name == 'login_member_details') echo 'class="Select"'; ?>>Member</a>
          <ul>
            <li><a href="<?php echo base_url('manage-members'); ?>" <?php if($method_name == 'manage_members' || $method_name == 'add_members' || $method_name == 'edit_members') echo 'class="Select"'; ?> >Manage Member</a></li>
            <!--<li><a href="<?php echo base_url('login-member-details'); ?>" <?php if($method_name == 'login_member_details') echo 'class="Select"'; ?> >Login Member Details</a></li>-->
          </ul>
        </li>
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
