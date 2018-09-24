<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Dealer</a></li>
        <li><a href="<?php echo base_url('manage-dealer'); ?>">Dealer Address</a></li>
        <li>Add Dealer</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Add Dealer</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
              <p>
              <label for="country_id" >Select Country : <span>*</span> </label>
              <select name="country_id" class="sf" required>
                <option value=""> -- Select One -- </option>
				<?php foreach ($country as $key => $val): ?>
                <option value="<?php echo $val['id'];?>" <?php if(set_value('country_id')==$val['id']){echo 'selected';} ?>><?php echo $val['name'];?></option>
                <?php endforeach; ?>
              </select>
            </p>
            
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo set_value('name'); ?>" class="sf" />
              </p>
               <p>
              <label for="product_description">Address : <span>*</span></label>
            <div class="body">
              <textarea name="address" rows="5" cols="40"><?php echo set_value('address'); ?></textarea>
            </div>
            </p>
            
            <p>
                <label for="office_name">Longitude:</label>
                <input type="text" name="longitude"  id="longitude" value="<?php echo set_value('longitude'); ?>" class="sf" />
              </p>
              
              <p>
                <label for="office_name" >Latitude:</label>
                <input type="text" name="latitude"  id="latitude" value="<?php echo set_value('latitude'); ?>" class="sf" />
              </p>
            
            
            
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo set_value('sort_order'); ?>" class="sf" />
              </p>
              <p>
                <label for="status">Status  : <span>*</span></label>
                <label for="status" style="text-align:left;">Enable
                  <input type="radio" name="status" required value="Y" <?php if ((set_value('status') && set_value('status')=='Y') || (!set_value('status'))){echo 'checked="checked"';}?>>
                </label>
                <label for="status" style="text-align:left;">Disable
                  <input type="radio" name="status" required value="N" <?php if (set_value('status') && set_value('status')=='N'){echo 'checked="checked"';}?> >
                </label>
              </p>
              <div class="clear"></div>
              <p>
                <button type="reset" >Cancel</button>
                <button type="submit" value="update_form" name="update_form" onClick="return cms_form_valid();">Submit</button>
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