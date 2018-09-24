<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Enquiries</a></li>
        <li>Warranty Registration</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Warranty Registration<a href="<?php echo base_url('export-registration'); ?>" class="button"><span>Export Contacts</span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="<?php echo base_url('manage-registration'); ?>" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center">Sl No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Date</th>
                <th align="center" width="7%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[name]" value="<?php echo $FlterData['name'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[mobile_no]" value="<?php echo $FlterData['mobile_no'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[email]" value="<?php echo $FlterData['email'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[create_date]" value="<?php echo $FlterData['create_date'];?>" id="datepicker" /></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              <?php 
				if(count($display_result)>0){
				foreach ($display_result as $key => $val):?>
              <tr <?php if($val['status']=='N'){echo 'class="unread"';}?>>
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['id'] ?>"></td>
                <td><?php echo $start_count; ?></td>
                <td><?php echo $val['name'] ?></td>
                <td><?php echo $val['mobile_no']; ?></td>
                <td><?php echo $val['email']; ?></td>
                <td><?php echo date("d/m/Y h:i:s A", strtotime($val['create_date'])); ?></td>
                <td align="center"><a href="view-registration/<?php echo $val['id'] ?>"> <img src="<?php echo image('icons/small/black/search.png'); ?>" alt="View" title="View"></a> &nbsp; <a onClick="return confirm('Are you sure want to delete.');" href="del-registration/<?php echo $val['id'] ?>"> <img src="<?php echo image('icons/small/black/delete.png'); ?>" alt="Delete" title="Delete"></a></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              <tr>
              <td colspan="8" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
                  <select name="action" id="action"  class="select_option" >
                    <option value="">Choose an action...</option>
                    <option value="Delete">Delete</option>
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
            <input type="hidden" name="contact_display_submit" value="1" />
          </form>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>