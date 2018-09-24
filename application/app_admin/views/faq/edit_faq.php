<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>CMS</a></li>
    <li><a href="<?php echo base_url('manage-faq'); ?>">FAQ</a></li>
    <li>Edit FAQ</li>
 </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="">
        <div class="leftPanel">
          <h1 class="pageTitle">Edit FAQ</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" id="edit_user_form">
              <div class="form_default">
                <p>
                  <label for="first_name" >Question  : <span>*</span> </label>
                  <input type="text" name="name" required id="name" value="<?php echo $details[0]['name'];?>" class="sf" />
                </p>
                <label for="from_email" >Answer  : <span>*</span></label>
                <div class="body">
                  <textarea name="content" id="bodyContent"><?php echo $details[0]['content']; ?></textarea>
                </div>
                <p>
                  <label for="name">Sort Order </label>
                  <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order']; ?>" class="sf" />
                </p>
                <p>
                <?php $status = $details[0]['status'];?>
                <label for="status">Status </label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" value="Y" <?php if($status=='Y'){ echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" value="N" <?php if($status=='N'){ echo 'checked="checked"';}?>>
                </label>
              </p>
              <div class="clear"></div>   
                <p>
                  <button type="reset" >Cancel</button>
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
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>