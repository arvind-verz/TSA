<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Member</a></li>
        <li><a href="<?php echo base_url('manage-members'); ?>">Manage Member</a></li>
        <li>Edit Member</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Edit Member</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" id="edit_user_form" enctype="multipart/form-data">
              <div class="form_default">
               <p>
                  <label for="first_name" >Member Id : </label>
                  <?php echo $details['user_name']; ?>
                </p>
              <p>
                  <label for="user_type" >Member Type : <span>*</span></label>
                  <select name="member_type_id" required class="sf">
                  	<option value=""> -- Select One -- </option>
                    <?php foreach($member_type as $val){ ?>
                    <option value="<?php echo $val['member_type_id'];?>" <?php if($details['member_type_id']== $val['member_type_id']){echo 'selected';}?>><?php echo $val['name'];?></option>
                    <?php } ?>
                  </select>
                </p>
                 
               <p>
                  <label for="first_name" >Company Name : <span>*</span></label>
                  <input type="text" name="company_name" required id="company_name" value="<?php echo $details['company_name']; ?>" class="sf" />
                </p>
                <p>
                  <label for="last_name" >Company Type : <span>*</span></label>
                  <input type="text" name="company_type" required id="company_type" value="<?php echo $details['company_type']; ?>" class="sf" />
                </p>
                
                <p>
                  <label for="email" >Company Email  : <span>*</span></label>
                  <input type="email" name="company_email" required id="company_email" value="<?php echo $details['company_email']; ?>" class="sf" />
                </p>
                
                <p>
              <?php $status = $details['status'];?>
              <label for="status">Status : <span>*</span></label>
              <label for="status" style="text-align:left;">Enable
                <input type="radio" name="status" value="Y" <?php if($status=='Y'){ echo 'checked="checked"';}?>>
              </label>
              <label for="status" style="text-align:left;">Disable
                <input type="radio" name="status" value="N" <?php if($status=='N'){ echo 'checked="checked"';}?>>
              </label>
            </p>
            <div class="clear"></div>
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