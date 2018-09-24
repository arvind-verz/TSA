<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>CMS</a></li>
    <li><a href="<?php echo base_url('manage-faq'); ?>">FAQ</a></li>
    <li>Manage FAQ</li>
 </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage FAQ<a href="<?php echo base_url('add-faq'); ?>" class="button"><span>Add New</span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-faq'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center" width="5%">SL No.</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Status</th>
                <th align="center" width="8%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[name]" value="<?php echo $FlterData['name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[content]" value="<?php echo $FlterData['content'];?>" /></td>
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
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['id'] ?>">
                <input type="hidden" name="orderid[]"  value="<?php echo $val['id'];?>" /></td>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><?php echo $val['name']; ?></td>
                <td><?php echo $val['content'] ?></td>
                <td align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
                <td align="center"><a href="edit-faq/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> <a onClick="return confirm('Are you sure want to delete.');" href="del-faq/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              </tbody>
              <tfoot>
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
              </tfoot>
            </table>
            <input type="hidden" name="user_display_submit" value="1" />
          </form>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>