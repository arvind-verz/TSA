<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Users</a></li>
        <li><a href="<?php echo base_url('manage-users'); ?>">Manage Users</a></li>
        <li>Add Users</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Add Users</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" id="add_user_form" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="first_name" >First Name : <span>*</span></label>
                  <input type="text" name="first_name" required id="first_name" value="<?php echo set_value('first_name'); ?>" class="sf" />
                </p>
                <p>
                  <label for="last_name" >Last Name : <span>*</span></label>
                  <input type="text" name="last_name" required id="last_name" value="<?php echo set_value('last_name'); ?>" class="sf" />
                </p>
                <p>
                  <label for="user_type" >User Type : <span>*</span></label>
                  <select name="user_type" required class="sf">
                  	<option value=""> -- Select One -- </option>
                    <!--<option value="Blog"<?php if(set_value('user_type')=='Blog'){echo 'selected';}?>>Blog</option>-->
                    <option value="Administrator"<?php if(set_value('user_type')=='Administrator'){echo 'selected';}?>>Administrator</option>
                  </select>
                </p>
                <p>
                  <label for="email" >Email : <span>*</span></label>
                  <input type="email" name="email" required id="email" value="<?php echo set_value('email'); ?>" class="sf" />
                </p>
                <p>
                  <label for="password" >Password : <span>*</span></label>
                  <input type="password" name="password" required pattern="^\S{6,}$" onChange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.confirm_password.pattern = this.value;" id="password" value="" class="sf" />
                </p>
                <p>
                  <label for="confirm_password" >Confirm Password : <span>*</span></label>
                  <input type="password" name="confirm_password" required pattern="^\S{6,}$" onChange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"  id="confirm_password" value="" class="sf" />
                </p>
                <p>
                  <label for="status">Status : <span>*</span></label>
                  <label for="status" style="text-align:left;">Enable
                    <input type="radio" name="status" required value="Y" <?php if ((set_value('status') && set_value('status')=='Y') || (!set_value('status'))){echo 'checked="checked"';}?>>
                  </label>
                  <label for="status" style="text-align:left;">Disable
                    <input type="radio" name="status" required value="N" <?php if (set_value('status') && set_value('status')=='N'){echo 'checked="checked"';}?> >
                  </label>
                </p>
                <br/>
                <p>
                  <button type="reset" >Reset</button>
                  <button type="submit" value="add_user_form" name="add_user_form">Submit</button>
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