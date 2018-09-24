<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>CMS</a></li>
    <li><a href="<?php echo base_url('manage-banner'); ?>">Banners</a></li>
    <li>Manage Banners</li>
 </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Home Banners <a href="<?php echo base_url('add-banner'); ?>" class="button"><span>Add New</span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-banner'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center">Sl No</th>
                <th>Banner</th>
                <th>Heading</th>
                <th>Description</th>
                <!--<th>Url</th>-->
                <th align="center">Status</th>
                <th align="center" width="7%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[title]" value="<?php echo $FlterData['title'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[content]" value="<?php echo $FlterData['content'];?>" /></td>
                <!--<td><input class="sr" type="text" name="FlterData[url]" value="<?php echo $FlterData['url'];?>" /></td>-->
                <td align="center"><select class="sr" name="FlterData[status]" >
                      <option value="">All</option>
                      <option value="1" <?php if($FlterData['status']=='1'){echo 'selected';}?>>Enable</option>
                      <option value="0" <?php if($FlterData['status']=='0'){echo 'selected';}?>>Disable</option>
                    </select></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              </thead>
              <tbody>
              <?php 
				if(count($display_result)>0){ $c=0;
				 foreach ($display_result as $key => $val): $c++; ?>
              <tr>
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['id'] ?>">
                <input type="hidden" name="orderid[]"  value="<?php echo $val['id'];?>" /></td>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><img src="<?php echo get_site_image('upload/banner/thumb').$val['image_name']; ?>" height="50px" /></td>
                <td><?php echo $val['title'] ?></td>
                <td><?php echo $val['content'] ?></td>
                <!--<td><?php echo $val['url'] ?></td>-->
                <td align="center"><?php if($val['status']==0){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']==1){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
                <td align="center"><a href="edit-banner/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> <a href="del-banner/<?php echo $val['id'] ?>" onClick="return confirm('Are you sure want to delete.');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              </tbody>
              <tfoot>
              <tr>
              <td colspan="9" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
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
                <td align="center" colspan="9" style="text-align:center; font-weight:bold;" >There is no record found.</td>
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