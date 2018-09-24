<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>CMS</a></li>
        <li>Content Management</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Contents <a class="button" href="<?php echo base_url('add-cms'); ?>"><span>Create New Page</span></a> </h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-cms'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
              <tr>
                <th align="center"><input class="checkall" type="checkbox" /></th>
                <th align="center">Sl No</th>
                <th>Page Title</th>
                <th>Status</th>
                <th align="center" width="7%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" style="min-width:200px;" type="text" name="FlterData[page_heading]" value="<?php echo $FlterData['page_heading'];?>" /></td>
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
					foreach ($display_result as $key => $val):?>
              <tr>
                <td  align="center">
                <?php if($val['url_not_editable']==1){?>
                <input type="checkbox" name="id[]"  value="<?php echo $val['id'];?>" />
                <?php }?><input type="hidden" name="orderid[]"  value="<?php echo $val['id'];?>" />
                </td>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><?php echo $val['page_heading'] ?></td>
                <td align="center"><?php if($val['status']=='N'){?>
                  <img src="<?php echo image('icons/error.png'); ?>" alt="Delete" title="Inactive">
                  <?php }elseif($val['status']=='Y'){?>
                  <img src="<?php echo image('icons/success.png'); ?>" alt="Delete" title="Active">
                  <?php }?></td>
                <td align="center"><a href="<?php echo base_url('edit-cms/'.$val['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>
                <?php if($val['url_not_editable']==1){?>
                &nbsp;  &nbsp; <a href="<?php echo base_url('del-cms/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a>
                <?php }?>
                </td>
              </tr>
              <?php $start_count++; endforeach; ?>
              </tbody>
              <tfoot>
              <tr>
              <td colspan="7" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
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
                <td align="center" colspan="7" style="text-align:center; font-weight:bold;" >There is no record found.</td>
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