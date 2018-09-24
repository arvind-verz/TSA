<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Settings</a></li>
        <li>Email Templates</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Email Templates</h1>
          <?php $this->load->view('include/message'); ?>
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <th align="center">S/N</th>
              <th>Email Subject</th>
              <th>Template</th>
              <th align="center"><?php echo lang('global:action') ?></th>
            </tr>
            <?php 
				if(count($display_result)>0){$cnt=0; 
				foreach ($display_result as $key => $val):
				$cnt++; 
				?>
            <tr>
              <td align="center"><?php echo $cnt; ?></td>
              <td><?php echo $val['subject'] ?></td>
              <td><?php echo $val['template_name']; ?></td>
              <td align="center"><a href="pre-email-templates/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/search.png'); ?>" alt="View" title="View"></a> &nbsp; <a href="email-templates/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a></td>
            </tr>
            <?php endforeach; ?>
            <?php }else{?>
            <tr>
              <td align="center" colspan="4" style="text-align:center; font-weight:bold;" >There is no record found.</td>
            </tr>
            <?php }?>
          </table>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>