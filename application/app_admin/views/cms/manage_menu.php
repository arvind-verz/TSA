<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>CMS</a></li>
        <li><a href="<?php echo base_url('manage-menu'); ?>">Menu</a></li>
        <li>View Menu Pages</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Menu Manage :: <?php echo $display_menu;?> <a class="button" href="<?php echo base_url('add-menu-item/'.$position); ?>"><span>Add Menu</span></a> <a class="button" href="<?php echo base_url('manage-menu'); ?>">
          <span style="margin-right:10px;">Back</span></a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="" >
            <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center">Sl No</th>
                <th>Menu Title</th>
                <th align="center" width="7%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[menu_title]" value="<?php echo $FlterData['menu_title'];?>" /></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              </thead>
              <tbody>
              <?php if(count($display_result)>0){ 
					foreach ($display_result as $key => $val):?>
              		<tr>
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['id'] ?>"><input type="hidden" name="orderid[]"  value="<?php echo $val['id'];?>" /></td>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><?php echo $val['menu_title'] ?></td>
                <td align="center"><a href="<?php echo base_url('edit-menu-item/'.$position.'/'.$val['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>&nbsp;  &nbsp; <a href="<?php echo base_url('del-menu-item/'.$position.'/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              </tr>
              		<?php $submenu = $this->Cms_model->get_sub_menus($position, $val['id']);
					if(count($submenu)>0){ $c=0;
						foreach ($submenu as $key => $valm){ $c++;?>
                    		<tr>
                            	<td align="center"><input type="checkbox" name="id[]" value="<?php echo $valm['id'] ?>"></td>
                				<td><?php echo $start_count.'.'.$c; ?></td>
                                <td><?php echo $val['menu_title'] ?> &gt;&gt; <?php echo $valm['menu_title'] ?></td>
                                <td align="center"><a href="<?php echo base_url('edit-menu-item/'.$position.'/'.$valm['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>&nbsp;  &nbsp; 
                                <a href="<?php echo base_url('del-menu-item/'.$position.'/'.$valm['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              				</tr>
                            
							<?php $subsubmenu = $this->Cms_model->get_sub_menus($position, $valm['id']);
							if(count($subsubmenu)>0){ $cc = 0;
							foreach ($subsubmenu as $key => $valsm){ $cc++;?>
                    		<tr>
                                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $valsm['id'] ?>"></td>
                				<td><?php echo $start_count.'.'.$c.'.'.$cc; ?></td>
                                <td><?php echo $val['menu_title'] ?> &gt;&gt; <?php echo $valm['menu_title'] ?> &gt;&gt; <?php echo $valsm['menu_title'] ?></td>
                                <td align="center"><a href="<?php echo base_url('edit-menu-item/'.$position.'/'.$valsm['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>&nbsp;  &nbsp; 
                                <a href="<?php echo base_url('del-menu-item/'.$position.'/'.$valsm['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              				</tr>
                            
                            <?php $subsubsubmenu = $this->Cms_model->get_sub_menus($position, $valsm['id']);
							if(count($subsubsubmenu)>0){$ccc = 0;
							foreach ($subsubsubmenu as $key => $valsms){ $ccc++;?>
                    		<tr>
                                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $valsms['id'] ?>"></td>
                				<td><?php echo $start_count.'.'.$c.'.'.$cc.'.'.$ccc; ?></td>
                                <td><?php echo $val['menu_title'] ?> &gt;&gt; <?php echo $valm['menu_title'] ?> &gt;&gt; <?php echo $valsm['menu_title'] ?> &gt;&gt; <?php echo $valsms['menu_title'] ?></td>
                                <td align="center"><a href="<?php echo base_url('edit-menu-item/'.$position.'/'.$valsms['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>&nbsp;  &nbsp; 
                                <a href="<?php echo base_url('del-menu-item/'.$position.'/'.$valsms['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              				</tr>
                    	<?php } }?>
                            
                            
                    	<?php } }?>
                        
                    	<?php } }?>
              			
              <?php $start_count++; endforeach; ?>
              </tbody>
              <tfoot>
              <tr>
              <td colspan="7" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
                  <select name="action" id="action"  class="select_option" >
                    <option value="">Choose an action...</option>
                    <!--<option value="SortOrder">Sort Order</option>-->
                    <option value="Delete">Delete</option>
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