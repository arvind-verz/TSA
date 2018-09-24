<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>Accessories</a></li>
    <li><a href="<?php echo base_url('manage-products'); ?>">Products </a></li>
    <li>Manage Products</li>
  </ul>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
        <h1 class="pageTitle">Products Import : </h1>
        <div class="From_wrap">
          <form method="post" action="<?php echo base_url('import-products'); ?>" name="product" id="update_form" enctype="multipart/form-data">
            <div class="form_default" style="margin-bottom:15px;" >
              <p>
                <input type="file" name="product_file" class="sf" id="my_file_field" accept="xls,xlsx" required>
                <button type="submit" value="search_form" name="search_form" style="float:left; margin-right:15px;" id="xyz1">Upload</button>
              </p>
            </div>
          </form>
          
          <script>
				$('INPUT[type="file"]').change(function() {
				var ext = $('#my_file_field').val().split('.').pop().toLowerCase();
				  if($.inArray(ext, ['xls','xlsx']) == -1) {
				     alert('Invalid extension! Please upload required excel format');
					 $('#xyz1').attr('disabled', true);
					 return false;
				   }else{
					    $('#xyz1').attr('disabled', false);
				   }
				});
				
		  </script>
        </div>
        <h1 class="pageTitle">Manage Accessories Products<a href="<?php echo base_url('export-products'); ?>" class="button"><span >Export Product</span> </a><a href="<?php echo base_url('add-products'); ?>" class="button"><span style="margin-right:10px;">Add Product</span> </a></h1>
        <?php $this->load->view('include/message'); ?>
        <?php echo $pagi; ?>
        <form id="frm_display" method="post" action="<?php echo base_url('manage-products'); ?>" >
          <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
            <tr>
              <th align="center"><input class="checkall" type="checkbox" /></th>
              <th align="center">Sl No.</th>
              <th>Image</th>
              <th>Product Names</th>
              <th>Category</th>
              <th>Status</th>
              <th align="center"><?php echo lang('global:action') ?></th>
            </tr>
            <tr>
              <td align="center"></td>
              <td></td>
              <td></td>
              <td><input class="sr" type="text" name="FlterData[product_name]" value="<?php echo $FlterData['product_name'];?>" /></td>
              <td>
                  <select name="FlterData[cat_id]" class="select_option">
                  <option value="">All</option>
                  <?php foreach ($category as $key => $val): ?>
                  <!--<option value="<?php echo $val['cat_id'];?>" <?php if($FlterData['cat_id']==$val['cat_id']){echo 'selected';} ?>><?php echo $val['cat_name'];?></option>-->
                  <optgroup label="<?php echo $val['cat_name'];?>">
                  <?php $sub_categories = $this->Categories_model->get_sub_categories($val['cat_id']);
						if(count($sub_categories)>0){
						foreach ($sub_categories as $key => $val){?>
                  <option value="<?php echo $val['cat_id'];?>" <?php if($FlterData['cat_id']==$val['cat_id']){echo 'selected';} ?>>&nbsp; &gt;&gt; <?php echo $val['cat_name'];?></option>
                  <?php $sub_sub_categories = $this->Categories_model->get_sub_categories($val['cat_id']);
						if(count($sub_sub_categories)>0){
						foreach ($sub_sub_categories as $key => $val){?>
                  <option value="<?php echo $val['cat_id'];?>" <?php if($FlterData['cat_id']==$val['cat_id']){echo 'selected';} ?>>&nbsp;&nbsp;&nbsp; &gt;&gt;&gt; <?php echo $val['cat_name'];?></option>
                  <?php } } ?>
                  <?php } } ?>
                  </optgroup>
                  <?php endforeach; ?>
                </select>
                </td>
              <td align="center"><select class="sr" name="FlterData[status]" >
                  <option value="">All</option>
                  <option value="Y" <?php if($FlterData['status']=='Y'){echo 'selected';}?>>Enable</option>
                  <option value="N" <?php if($FlterData['status']=='N'){echo 'selected';}?>>Disable</option>
                </select></td>
              <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
            </tr>
            </thead>
            <tbody>
            <?php if(count($display_result)>0){
				  foreach ($display_result as $key => $val): ?>
            <tr>
              <td align="center"><input type="checkbox" name="id[]"  value="<?php echo $val['id'];?>" />
              <input type="hidden" name="orderid[]"  value="<?php echo $val['id'];?>" /></td>
              <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
              <td align="center">
              <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/products/thumb/'.$val['image_name']) && $val['image_name']!='') {?>
                <img src="<?php echo get_site_image('upload/products/thumb').$val['image_name']; ?>" width="30" />
                <?php }?>
              </td>
              <td><?php echo $val['product_name'] ?></td>
              <td><?php $arr=array();
						$arr[]=$val['cat_name'];
						if($val['parent_id']!=0)
						{
						   $row=$this->all_function->get_category_name_row($val['parent_id']);
						   if($row['parent_id']!=0)
						   {
							 $row2=$this->all_function->get_category_name_row($row['parent_id']); 
							 $arr[]=$row2['cat_name']; 
						   }else{
								$arr[]=$row['cat_name']; 
						   }
						}
					echo implode('&nbsp;>>&nbsp;',array_reverse($arr));?></td>
              
              <td align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
              <td align="center"><a href="<?php echo base_url('edit-products/'.$val['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> <a href="<?php echo base_url('del-products/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete.');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
            </tr>
            <?php $start_count++; endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
              <td colspan="10" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
                  <select name="action" id="action"  class="select_option" >
                    <option value="">Choose an action...</option>
                    <!--<option value="SortOrder">Sort Order</option>-->
                    <option value="Delete">Delete</option>
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disable</option>
                  </select>
                  <input type="submit" value="Apply to selected" name="OkDelete" id="OkDelete" class="buttonNew" align="absmiddle">
                </div></td>
            </tr>
            <?php }else{?>
            <tr>
              <td align="center" colspan="8" style="text-align:center; font-weight:bold;" >There is no record found.</td>
            </tr>
            <?php }?>
            </tfoot>
          </table>
          <input type="hidden" name="frm_display_submit" value="1" />
        </form>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>