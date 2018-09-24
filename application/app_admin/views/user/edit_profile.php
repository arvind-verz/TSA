<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
window.onload = function(){
 document.getElementById("password").value = "";
 document.getElementById("confirm_password").value = "";
}
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Users</a></li>
        <li><a href="<?php echo base_url('manage-users'); ?>">Manage Users</a></li>
        <li>Edit Profile</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Edit Profile</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" id="edit_user_form" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="first_name" >First Name : <span>*</span></label>
                  <input type="text" name="first_name" required id="first_name" value="<?php echo $first_name;?>" class="sf" />
                </p>
                <p>
                  <label for="last_name" >Last Name : <span>*</span></label>
                  <input type="text" name="last_name" required id="last_name" value="<?php echo $last_name;?>" class="sf" />
                </p>
                <p>
                  <label for="email" >Email : <span>*</span></label>
                  <input type="email" name="email" required id="email" value="<?php echo $email;?>" class="sf" />
                </p>
                <input type="hidden" value="<?php echo $user_type;?>" name="user_type">
                <p>
                  <label for="password" >Password</label>
                  <input type="password" name="password" id="password" class="sf" />
                </p>
                <p>
                  <label for="confirm_password" >Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="sf" />
                </p>
                <p>
                  <button type="reset" >Reset</button>
                  <button value="edit_user_form" name="edit_user_form">Submit</button>
                </p>
              </div>
            </form>
          </div>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>