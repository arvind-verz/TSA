<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Dealer</a></li>
        <li><a href="<?php echo base_url('manage-dealer'); ?>">Dealer Address</a></li>
        <li>Edit Dealer</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Edit Dealer</h1>
        <div class="From_wrap">
          <?php $this->load->view('include/message'); ?>
          <form method="post" action="" name="cms" id="update_form" enctype="multipart/form-data">
            <div class="form_default">
               
            <p>
              <label for="country_id" >Select Country : <span>*</span> </label>
              <select name="country_id" required class="sf">
                <option value=""> -- Select One -- </option>
				<?php foreach ($country as $key => $val): ?>
                <option value="<?php echo $val['id'];?>" <?php if($details[0]['country_id']==$val['id']){echo 'selected';}?>><?php echo $val['name'];?></option>
                <?php endforeach; ?>
              </select>
            </p>
              <p>
                <label for="office_name" >Name  : <span>*</span></label>
                <input type="text" name="name" required id="name" value="<?php echo $details[0]['name'];?>" class="sf" />
              </p>
              
             <p>
              <label for="address">Address : <span>*</span></label>
            <div class="body">
              <textarea name="address" id="bodyContent5" rows="5" cols="40"><?php echo $details[0]['address'];?></textarea>
            </div>
            </p>
              
            <p>
                <label for="office_name" >Longitude  : </label>
                <input type="text" name="longitude"  id="longitude" value="<?php echo $details[0]['longitude'];?>" class="sf" />
              </p>
              
              <p>
                <label for="office_name" >Latitude  : </label>
                <input type="text" name="latitude"  id="latitude" value="<?php echo $details[0]['latitude'];?>" class="sf" />
              </p>  
              
              
              <p>
                <label for="sort_order" >Sort Order: </label>
                <input type="text" name="sort_order"  id="sort_order" value="<?php echo $details[0]['sort_order'];?>" class="sf" />
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
                <button type="submit" value="update_form" name="update_form" >Submit</button>
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