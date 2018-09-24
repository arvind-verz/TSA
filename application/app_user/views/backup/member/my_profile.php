<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
function readURL(input) { 
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            jQuery('#profileImg').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
jQuery(function(){ 
	jQuery("#image_name").change(function(){ 
		readURL(this);
	});
});
</script>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"><a href="<?php echo base_url('/'); ?>" class="home"></a><a class="diable">My Profile</a></div>
        <div class="clear"></div>
        <div class="listing_wrap">
          <?php $this->load->view('member/member_left'); ?>
          <div class="col_right">
            <div class="contact_form">
              <h1 class="page_title">My Profile</h1>
              <div class="comment_form">
                <form class="form-horizontal" role="form" action="" method="post"  enctype="multipart/form-data">
                  <div class="form"> <span class="field_name">First Name <span class="req">*</span></span>
                    <input type="text" name="first_name" required value="<?php echo $member_info['first_name']; ?>" id="first_name">
                  </div>
                  <div class="form"> <span class="field_name">Last Name <span class="req">*</span></span>
                    <input type="text" name="last_name" required value="<?php echo $member_info['last_name']; ?>" id="last_name">
                  </div>
                  <div class="form">
                    <div class="upload-image">
                      <?php 
			  if($member_info['image_name']!='' && file_exists(ABSOLUTE_PATH.'assets/upload/member/original/'.$member_info['image_name'])){?>
                      <img src="<?php echo base_url('assets/upload/member/original').'/'.$member_info['image_name']; ?>" alt="image" id="profileImg" style="max-width:150px; max-height:150px;" />
                      <?php }else{?>
                      <img src="<?php echo image('no-image.jpg'); ?>" alt="image" id="profileImg" style="max-width:150px; max-height:150px;" />
                      <?php }?>
                    </div>
                  </div>
                  <div class="form"> <span class="field_name">Profile Image</span>
                    <input type="file" name="image_name" id="image_name" />
                  </div>
                  <div class="form">
                    <button type="submit" name="member_login" onClick="return profile_update_valid();">submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>