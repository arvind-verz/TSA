<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>
    <div class="MainDiv">
      <div class="leftPanel">
        <div class="clear"></div>
        <div class="articleBox">
          <h3 class="Box_title">About Us</h3>
          <div class="leftImg"><img src="<?php echo image('ico_p.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-committee-categtory'); ?>">Committee Category</a></li>
              <li><a href="<?php echo base_url('manage-committee-member'); ?>">Committee Member</a>
              <li><a href="<?php echo base_url('manage-secretariat'); ?>">Secretariat</a></li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">Resources</h3>
          <div class="leftImg"><img src="<?php echo image('ico_p.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-rdirectory'); ?>">Directory</a></li>
              <li><a href="<?php echo base_url('manage-toolkit'); ?>">Toolkit</a>
              <li><a href="<?php echo base_url('manage-publications'); ?>">Publications</a></li>
              <li><a href="<?php echo base_url('manage-our-network'); ?>">Our Network</a></li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">CMS</h3>
          <div class="leftImg"><img src="<?php echo image('ico_05.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-cms'); ?>" >Content Management</a></li>
              <li><a href="<?php echo base_url('manage-menu'); ?>">Menu</a></li>
              <li><a href="<?php echo base_url('manage-banner'); ?>" >Banners</a> </li>
              <li><a href="<?php echo base_url('manage-advertise'); ?>" >Advertise</a> </li>
              <li><a href="<?php echo base_url('manage-faq'); ?>" >FAQ</a> </li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">News</h3>
          <div class="leftImg"><img src="<?php echo image('ico_05.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-newsletter'); ?>" >Newsletter</a></li>
              <li><a href="<?php echo base_url('manage-latestnews'); ?>" >Latest News</a></li>
              
              <!--<li><a href="<?php echo base_url('manage-blog'); ?>" >Blog</a></li>

              <li><a href="<?php echo base_url('manage-blog-cat'); ?>" >Categories</a></li>

              <li><a href="<?php echo base_url('manage-comments'); ?>" >Comments</a></li>-->
              
            </ul>
          </div>
        </div>
        
        <!--<div class="articleBox">

          <h3 class="Box_title">Newsletter Subscription</h3>

          <div class="leftImg"><img src="<?php echo image('ico_08.png'); ?>"/></div>

          <div class="rightMenu">

            <ul>

              <li <?php if($method_name == 'list_subscriber') echo 'class="current"'; ?>> <a href="<?php echo base_url('list-subscriber'); ?>" class="home">Subscribed Users</a> </li>

              <li <?php if($method_name == 'news_template') echo 'class="current"'; ?>> <a href="<?php echo base_url('news-template'); ?>" class="home">Add Email Template</a> </li>

              <li <?php if($method_name == 'send_news_letter') echo 'class="current"'; ?>> <a href="<?php echo base_url('send-news'); ?>" class="home">Send Newsletter</a> </li>

              <li <?php if($method_name == 'news_letter_status') echo 'class="current"'; ?>> <a href="<?php echo base_url('send-news-status'); ?>" class="home">Sent Mail Status</a> </li>

            </ul>

          </div>

        </div>-->
        
        <div class="articleBox">
          <h3 class="Box_title">Events</h3>
          <div class="leftImg"><img src="<?php echo image('ChangeEmail.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-svcaevent'); ?>">SVCA Events</a></li>
              <li><a href="<?php echo base_url('manage-supportedevents'); ?>" >Supported Events</a></li>
              <li><a href="<?php echo base_url('manage-registration'); ?>" >Event Registration</a></li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">Manage Users</h3>
          <div class="leftImg"><img src="<?php echo image('ico_02.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-users'); ?>">Manage Users</a></li>
              <li><a href="<?php echo base_url('add-users'); ?>">Add Users</a></li>
              <li><a href="<?php echo base_url('edit-profile').'/'.$user_id; ?>">Edit Profile</a></li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">General Settings</h3>
          <div class="leftImg"><img src="<?php echo image('ico_10.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('settings/general'); ?>">Settings</a></li>
              <li><a href="<?php echo base_url('manage-email-templates'); ?>" >Email Templates</a></li>
            </ul>
          </div>
        </div>
        <div class="articleBox">
          <h3 class="Box_title">Manage Member</h3>
          <div class="leftImg"><img src="<?php echo image('ico_02.png'); ?>"/></div>
          <div class="rightMenu">
            <ul>
              <li><a href="<?php echo base_url('manage-members'); ?>">Manage Member</a></li>
              <li><a href="<?php echo base_url('add-members'); ?>">Add Member</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>