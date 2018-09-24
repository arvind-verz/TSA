<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Member</a></li>
        <li>Manage Member</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Member <a href="<?php echo base_url('add-members'); ?>" class="button"><span>Add Member</span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-members'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
              	<th align="center"><input class="checkall" type="checkbox" /></th>
                <th align="center">SL No.</th>
                <th>Member ID</th>
                <th>Company Email</th>
                <th>Member Type</th>
                <th>Status</th>
                <th align="center">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[user_name]" value="<?php echo $FlterData['user_name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[company_email]" value="<?php echo $FlterData['company_email'];?>" /></td>
                <td><select name="FlterData[member_type_id]" class="select_option">
                      <option value="">All</option>
                      <?php foreach($member_type as $val){ ?>
                    <option value="<?php echo $val['member_type_id'];?>" <?php if($FlterData['member_type_id']== $val['member_type_id']){echo 'selected';}?>><?php echo $val['name'];?></option>
                    <?php } ?>
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
                <input type="checkbox" name="id[]"  value="<?php echo $val['member_id'];?>" />
				</td>
                <td><?php echo $start_count;?></td>
                <td><?php echo $val['user_name']; ?></td>
                <td><?php echo $val['company_email'] ?></td>
                <td><?php echo $val['name'] ?></td>
                <td align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
                <td align="center">
                  <a href="<?php echo  base_url('edit-members/'.$val['member_id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> &nbsp; <a onClick="return confirm('Are you sure want to delete.');" href="<?php echo  base_url('del-members/'.$val['member_id']); ?>"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              <tr>
              <td colspan="8" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
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
                <td align="center" colspan="8" style="text-align:center; font-weight:bold;" >There is no record found.</td>
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