<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Settings</a></li>
        <li>General Settings</li>
    </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">General Settings </h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <th align="center">Sl No.</th>
              <th align="center"><?php echo lang('label.option_name') ?></th>
              <th><?php echo lang('label.option_value') ?></th>
              <th align="center"><?php echo lang('global:action') ?></th>
            </tr>
            <?php if(count($display_result)>0){ 
				  foreach ($display_result as $key => $val): ?>
            <tr>
              <td><?php echo $start_count;?></td>
              <td><?php echo $val['option_display'] ?></td>
              <td><?php if($val['field_type']=='Image'){?>
                <img src="<?php echo get_site_image('upload/logo/thumb').$val['option_value']; ?>" style="max-width:256px; max-height:54px;" />
                <?php }elseif($val['field_type']=='PDF'){?>
                <a href="<?php echo BASE_URL.'pdf/'.$val['option_value']; ?>" target="_blank">View</a>
                <?php }elseif($val['field_type']=='DOC'){?>
                <a href="<?php echo BASE_URL.'pdf/'.$val['option_value']; ?>" target="_blank">View</a>
                <?php }elseif($val['field_type']=='XML'){?>
                <a href="<?php echo BASE_URL.$val['option_value']; ?>" target="_blank">View</a>
                <?php }elseif($val['field_type']=='radio'){?>
                <?php if($val['option_value']==1){echo 'On';}if($val['option_value']==0){echo 'Off';} ?>
				<?php }else{?>
                <?php echo $val['option_value'] ?>
                <?php }?>
                </td>
              <td align="center"><a class="iconlink2" href="update-general/<?php echo $val['option_id'] ?>"><img alt="" src="<?php echo image('icons/small/black/edit.png'); ?>"></a></td>
            </tr>
            <?php $start_count++; endforeach; ?>
            <?php }else{?>
            <tr>
              <td align="center" colspan="3" style="text-align:center; font-weight:bold;" >There is no record found.</td>
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