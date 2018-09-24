<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Member login details <a class="button" id="action_delete"><span><?php echo lang('buttons.delete'); ?></span> </a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center">Sl No.</th>
                <th>Member ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>IP</th>
              </tr>
              <?php 
				if(count($display_result)>0){ 
				 foreach ($display_result as $key => $val): ?>
              <tr>
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['login_id'] ?>"></td>
                <td><?php echo $start_count;?></td>
                <td><?php echo $val['member_id']; ?></td>
                <td><?php echo $val['first_name']; ?> <?php echo $val['last_name']; ?></td>
                <td><?php echo $val['user_type']; ?></td>
                <td><?php echo date('jS F Y h:i:s A', strtotime($val['login_time'])); ?></td>
                <td><?php if($val['logout_time']!='' && $val['logout_time']!='0000-00-00 00:00:00'){ echo date('jS F Y h:i:s A', strtotime($val['logout_time']));} ?></td>
                <td><?php echo $val['ip_address']; ?></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              <?php }else{?>
              <tr>
                <td align="center" colspan="8" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
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