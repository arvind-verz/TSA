<?php $this->load->view('include/header_tag'); ?>
<body>
<script>
$(function() {
	$('#title').change(function() {
		var title = $.trim($('#title').val()).toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
		$('#seo_url').val(title);
	});
});
</script>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>News</a></li>
        <li><a href="<?php echo base_url('manage-latestnews'); ?>">Latest News</a></li>
        <li>Edit Latest News</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Edit Latest News</h1>
          <div class="From_wrap">
            <?php $this->load->view('include/message'); ?>
            <form method="post" action="" name="banner" id="update_form" enctype="multipart/form-data">
              <div class="form_default">
                <p>
                  <label for="title">Title : <span>*</span></label>
                  <input type="text" name="title" required id="title" value="<?php echo $details[0]['title'];?>" class="sf" />
                </p>
                <p>
                <label for="seo_url" >URL : <span>*</span></label>
                <input type="text" name="seo_url" required readonly id="seo_url" value="<?php echo $details[0]['seo_url'];?>" class="sf" />
                </p>
                <label for="description" >Description : <span>*</span></label>
                <div class="body">
                  <textarea name="description"  id="bodyContent"><?php echo $details[0]['description'];?></textarea>
                </div>
                <p>
                  <label for="post_date">Post Date : <span>*</span></label>
                  <input type="text" name="post_date" required id="post_date" value="<?php echo date("d/m/Y", strtotime($details[0]['post_date']));?>" class="sf" />
                </p>
                
               
                <?php if($details[0]['image_banner']!=''){ ?>
                <p><img src="<?php echo get_site_image('upload/latestnews/banner/thumb').$details[0]['image_banner']; ?>" width="200" /></p>
                <?php } ?>
                <p>
                  <label for="image_banner">Banner Image (1400 X 350) :</label>
                  <input type="file" name="image_banner" id="image_banner">
                  <input type="hidden" name="image_banner_old" value="<?=$details[0]['image_banner']?>">
                </p>
                <p>
                  <label for="status">Status : <span>*</span></label>
                  <label for="status" style="text-align:left;">Enable
                    <input type="radio" required name="status" value="Y" <?php if($details[0]['status']=='Y'){ echo 'checked="checked"';}?>>
                  </label>
                  <label for="status" style="text-align:left;">Disable
                    <input type="radio" required name="status" value="N" <?php if($details[0]['status']=='N'){ echo 'checked="checked"';}?>>
                  </label>
                </p>
                <br/>
                <h3>SEO Details</h3>
                <p>
                  <label for="seo_title" >Title </label>
                  <input type="text" name="seo_title"  id="seo_title" value="<?php echo $details[0]['seo_title'];?>" class="sf" />
                </p>
                <p>
                  <label for="seo_keyword" >Keyword </label>
                  <textarea name="seo_keyword" id="seo_keyword"><?php echo $details[0]['seo_keyword'];?></textarea>
                </p>
                <p>
                  <label for="seo_description" >Description</label>
                  <textarea name="seo_description" id="seo_description"><?php echo $details[0]['seo_description'];?></textarea>
                </p>
                <p>
                  <button type="reset">Reset</button>
                  <button type="submit" value="update_form" name="update_form">Submit</button>
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