<?php $this->load->view('include/header_tag'); ?>
<body>
<div id="MainDiv" class="outer">
  <?php $this->load->view('include/header'); ?>
  <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>
        <li><a>Tools</a></li>
        <li><a href="<?php echo base_url('manage-tools-products'); ?>">Product</a></li>
        <li>Manage Video</li>
  </ul>
  <div class="gridMainbodyDiv"> 
    <?php $this->load->view('include/leftmenu'); ?>
    <div class="MainDiv">
        <div class="leftPanel">
          <h1 class="pageTitle">Manage Product Video <a class="button" href="<?php echo base_url('add-video/'.$product_id); ?>"><span>Add Video</span></a></h1>
          <?php $this->load->view('include/message'); ?>
          <?php echo $pagi; ?>
          <form id="frm_display" method="post" action="" >
            <table width="100%" cellspacing="0" cellpadding="0" id="diagnosis_list">
            <thead>
              <tr>
                <th align="center"><input class="checkall" type="checkbox"></th>
                <th align="center">Sl No</th>
                <th>Video Name</th>
                <th>Video Url</th>
                <th align="center" width="7%">Action</th>
              </tr>
              <tr>
              	<td align="center"></td>
                <td align="center"></td>
                <td><input class="sr" type="text" name="FlterData[title]" value="<?php echo $FlterData['title'];?>" /></td>
                <td><input class="sr" type="text" name="FlterData[video_url]" value="<?php echo $FlterData['video_url'];?>" /></td>
                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>
              </tr>
              </thead>
              <tbody>
              <?php if(count($display_result)>0){
					foreach ($display_result as $key => $val): ?>
              <tr>
                <td align="center"><input type="checkbox" name="id[]" value="<?php echo $val['id'] ?>">
                <input type="hidden" name="orderid[]"  value="<?php echo $val['products_id'];?>" /></td>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><?php echo $val['title'] ?></td>
                <td><?php echo $val['video_url'] ?></td>
                <td align="center"><a href="<?php echo base_url('edit-video/'.$val['products_id'].'/'.$val['id']); ?>"> <img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> &nbsp; <a href="<?php echo base_url('del-video/'.$val['products_id'].'/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete.');"> <img src="<?php echo image('icons/small/black/delete.png'); ?>" alt="Delete" title="Delete"></a></td>
              </tr>
              <?php $start_count++; endforeach; ?>
              </tbody>
              <tfoot>
              <tr>
              <td colspan="5" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">
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
                <td align="center" colspan="5" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
              </tfoot>
            </table>
            <input type="hidden" name="faq_display_submit" value="1" />
          </form>
        </div>
        <div class="clear"></div>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>