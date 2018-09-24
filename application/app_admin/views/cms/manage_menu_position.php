<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>CMS</a></li>
        <li>Menu</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Menu (Position) </h1>
          <?php $this->load->view('include/message'); ?>
          <form id="frm_display" method="post" action="" >
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <th>Menu Name</th>
                <th>Menu Position</th>
                <th align="center" width="150"><?php echo lang('global:action') ?></th>
              </tr>
              <?php if(count($display_result)>0){ 
					$c=0; foreach ($display_result as $key => $val): $c++;?>
              <tr>
                <td><?php echo $val['display_name'] ?></td>
                <td><?php echo $val['position'] ?></td>
                <td align="center"><a class="buttonred" href="manage-menu-list/<?php echo $val['position'] ?>">View Menu Pages</a></td>
              </tr>
              <?php endforeach; ?>
              <?php }else{?>
              <tr>
                <td align="center" colspan="3" style="text-align:center; font-weight:bold;" >There is no record found.</td>
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