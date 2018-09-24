<?php $user_id = $this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'];?>
<section class="top_nav">
  <div class="Nav_menu">
    <nav class="menu" id="menu">
    <ul>
      <li><a href="<?php echo base_url('dashboard'); ?>" <?php if($method_name == 'admin_home') echo 'class="Select"'; ?> >Dashboard </a></li>
      <li><a href="javascript:void(0)" <?php if($method_name == 'manage_blog' || $method_name == 'edit_blog' || $method_name == 'add_blog' || $method_name == 'manage_blog_categories' || $method_name == 'edit_blog_categories' || $method_name == 'add_blog_categories' || $method_name == 'manage_comments' || $method_name == 'edit_comments') echo 'class="Select"'; ?>>Blog</a>
        <ul>
          <li><a href="<?php echo base_url('manage-blog'); ?>" <?php if($method_name == 'manage_blog' || $method_name == 'edit_blog' || $method_name == 'add_blog') echo 'class="Select"'; ?>>Blog</a></li>
          <li><a href="<?php echo base_url('manage-blog-cat'); ?>" <?php if($method_name == 'manage_blog_categories' || $method_name == 'edit_blog_categories' || $method_name == 'add_blog_categories') echo 'class="Select"'; ?>>Categories</a></li>
          <li><a href="<?php echo base_url('manage-comments'); ?>" <?php if($method_name == 'manage_comments' || $method_name == 'edit_comments') echo 'class="Select"'; ?>>Comments</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url('logout') ?>">Logout</a></li>
    </ul>
    </nav>
  </div>
</section>