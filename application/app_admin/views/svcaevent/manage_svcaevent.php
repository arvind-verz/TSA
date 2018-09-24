<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
    <li><a>Events</a></li>
    <li><a href="<?php echo base_url('manage-svcaevent'); ?>">SVCA Event </a></li>
    <li>Manage SVCA Event</li>
  </ul>
  <div class="gridMainbodyDiv">
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
      <div class="leftPanel">
               
        <h1 class="pageTitle">Manage SVCA Event<a href="<?php echo base_url('add-svcaevent'); ?>" class="button"><span style="margin-right:10px;">Add New</span> </a></h1>
        <?php $this->load->view('include/message'); ?>
        <?php echo $pagi; ?>
        <form id="frm_display" method="post" action="<?php echo base_url('manage-svcaevent'); ?>" >
          <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
            <tr>
              <th align="center"><input class="checkall" type="checkbox" /></th>
              <th align="center">Sl No.</th>
              <th>Image</th>
              <th>Event Names</th>
              <th>Registration End Date</th>
              <th>Start Date</th>
              <th>Promo Code</th>
              <th>Status</th>
              <th align="center"><?php echo lang('global:action') ?></th>
            </tr>
            <tr>
              <td align="center"></td>
              <td></td>
              <td></td>
              <td><input class="sr" type="text" name="FlterData[title]" value="<?php echo $FlterData['title'];?>" /></td>
              <td><input class="sr datepicker" type="text" name="FlterData[registration_date]" value="<?php echo $FlterData['registration_date'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[start_date]" value="<?php echo $FlterData['start_date'];?>" id="datepicker" /></td>
              <td><input class="sr" type="text" name="FlterData[promo_code]" value="<?php echo $FlterData['promo_code'];?>" /> </td>
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
              <?php if (file_exists(ABSOLUTE_PATH.'assets/upload/svcaevent/listing/'.$val['image_name']) && $val['image_name']!='') {?>
                <img src="<?php echo get_site_image('upload/svcaevent/listing').$val['image_name']; ?>" width="30" />
                <?php }?>
              </td>
              <td><?php echo $val['title'] ?></td>
              <td><?php echo date("d/m/Y", strtotime($val['registration_date'])); ?></td>
              <td><?php echo date("d/m/Y", strtotime($val['start_date'])); ?></td>
              <td><?php echo $val['promo_code'] ?></td>
              
              <td align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>
              <td align="center"><a href="<?php echo base_url('edit-svcaevent/'.$val['id']); ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a>
              <a href="<?php echo base_url('svcareport/'.$val['id']); ?>" target="_blank"><img src="<?php echo image('icons/small/black/people.png'); ?>"  alt="Report" title="Report"></a>
              
               <a href="<?php echo base_url('del-svcaevent/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete.');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a>
              <!--<a  href="javascript:void(0);" onClick="show_report('<?php echo $val['id'];?>');">Event</a>-->
              
              
              
              </td>
            </tr>
            <?php $start_count++; endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
              <td colspan="10" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
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
<script>
function show_report(id) {
    //event.preventDefault();
	//alert(id);
    window.open('<?php echo base_url('svcareport')?>/'+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=900,height=300");
}
</script>