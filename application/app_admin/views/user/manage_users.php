<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Users</a></li>
        <li>Manage Users</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Users <a href="<?php echo base_url('add-users'); ?>" class="button"><span>Add New User</span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-users'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
              	<th align="center"><input class="checkall" type="checkbox" /></th>
                <th align="center">SL No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th align="center">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[user_name]" value="<?php echo $FlterData['user_name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[email]" value="<?php echo $FlterData['email'];?>" /></td>
                <td><select name="FlterData[user_type]" class="select_option">
                      <option value="">All</option>
                      <option value="Super Administrator" <?php if($FlterData['user_type']=='Super Administrator'){echo 'selected';}?>>Super Administrator</option>
                      <option value="Administrator" <?php if($FlterData['user_type']=='Administrator'){echo 'selected';}?>>Administrator</option>
                      
                    </select></td>
                <td><select class="sr" name="FlterData[status]" >
                      <option value="">All</option>
                      <option value="Y" <?php if($FlterData['status']=='Y'){echo 'selected';}?>>Enable</option>
                      <option value="N" <?php if($FlterData['status']=='N'){echo 'selected';}?>>Disable</option>
                    </select></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              <?php 
					if(count($display_result)>0){ $c = 0;
					 foreach ($display_result as $key => $val): $c++;?>
              <tr>
                <td align="center">
                <?php if($val['admin_id']!='133FOZ'){?>
                <input type="checkbox" name="id[]"  value="<?php echo $val['admin_id'];?>" />
				<?php }?>
				</td>
                <td><?php echo $start_count;?></td>
                <td><?php echo $val['first_name'].' '.$val['last_name'] ?></td>
                <td><?php echo $val['email'] ?></td>
                <td><?php echo $val['user_type'] ?></td>
                <td align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
                <td align="center"><?php if($val['admin_id']=='133FOZ' || $val['admin_id']==$this->session->userdata[ADMIN_LOGIN_PREFIX.'admin_id'] ){}else{?>
                  <a href="<?php echo  base_url('edit-user/'.$val['admin_id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> &nbsp; <a onClick="return confirm('Are you sure want to delete.');" href="<?php echo  base_url('del-user/'.$val['admin_id']); ?>"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a>
                  <?php }?></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              <tr>
              <td colspan="7" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
                  <select name="action" id="action"  class="select_option" >
                    <option value="">Choose an action...</option>
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
            </table>
            <input type="hidden" name="user_display_submit" value="1" />
          </form>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>