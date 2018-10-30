<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>CMS</a></li>
    <li><a href="<?php echo base_url('manage-banner'); ?>">Banners</a></li>
    <li>Add Banner</li>
 </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Add Home Banner</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" name="banner" id="update_form" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="name">Title : <span>*</span></label>
                  <input type="text" name="title" required id="title" value="<?php echo set_value('title'); ?>" class="sf" />
                </p>
                <p>
                  <label for="location">Content :</label>
                  <textarea rows="4" cols="60" name="content" id="smallBody" ><?php echo set_value('content'); ?></textarea>
                </p>
                <p>
                  <label for="location">Banner (1400 X 500) : <span>*</span></label>
                  <input type="file" name="image_name" required id="image_name">
                </p>
                <p>
                  <label for="name">Page Url :</label>
                  <input type="text" name="url"  id="url" value="<?php echo set_value('url'); ?>" class="sf" />
                </p>
                <p>
                  <label for="name">Sort Order :</label>
                  <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="sf" />
                </p>
                <p>
                  <label for="status">Status : <span>*</span></label>
                  <label for="status" style="text-align:left;">Enable
                    <input type="radio" name="status" required value="1" <?php if ((set_value('status') && set_value('status')==1) || (!set_value('status'))){echo 'checked="checked"';}?>>
                  </label>
                  <label for="status" style="text-align:left;">Disable
                    <input type="radio" name="status" required <?php if (set_value('status') && set_value('status')==0){echo 'checked="checked"';}?> value="0" >
                  </label>
                </p>
                <br/>
                <p>
                  <button type="reset" >Cancel</button>
                  <button type="submit" value="update_form" name="update_form" onClick="return banner_form_valid();">Submit</button>
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