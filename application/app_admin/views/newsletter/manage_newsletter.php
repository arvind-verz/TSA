<?php $this->load->view('include/header_tag'); ?>

<body>

<div id="MainDiv" class="outer">

  <?php $this->load->view('include/header'); ?>

  <ul class="breadcrumb">

        <li><a href="<?php echo base_url('/'); ?>">Dashboard</a></li>

        <li><a>News</a></li>

        <li><a href="<?php echo base_url('manage-newsletter'); ?>">Newsletter</a></li>

        <li>Manage Newsletter</li>

  </ul>

  <div class="gridMainbodyDiv"> 

    <?php $this->load->view('include/leftmenu'); ?>

    <div class="MainDiv">

        <div class="leftPanel">

          <h1 class="pageTitle">Manage Newsletter <a href="<?php echo base_url('add-newsletter'); ?>" class="button"><span>Add New</span> </a></h1>

          <?php $this->load->view('include/message'); ?>

          <?php echo $pagi; ?>

          <form id="frm_display" method="post" action="<?php echo base_url('manage-newsletter'); ?>" >

            <table width="100%" cellspacing="0" cellpadding="0">

            <thead>

              <tr>

                <th align="center"><input class="checkall" type="checkbox" /></th>

                <th align="center">Sl No</th>

                <th>Newsletter Image</th>

                <th align="left">Title</th>

                <th align="left">Post Date</th>

                <th>Status</th>

                <th align="center" width="7%">Action</th>

              </tr>

              <tr>

              	<td align="center"></td>

                <td align="center"></td>

                <td></td>

                <td><input class="sr" type="text" name="FlterData[title]" value="<?php echo $FlterData['title'];?>" /></td>

                <td><input class="sr" type="text" name="FlterData[post_date]" value="<?php echo $FlterData['post_date'];?>" id="datepicker" /></td>

                <td align="center"><select class="sr" name="FlterData[status]" >

                      <option value="">All</option>

                      <option value="Y" <?php if($FlterData['status']=='Y'){echo 'selected';}?>>Enable</option>

                      <option value="N" <?php if($FlterData['status']=='N'){echo 'selected';}?>>Disable</option>

                    </select></td>

                <td align="center"><input type="submit" value="Filter" name="OkFilter" id="OkFilter" class="buttonNew"></td>

              </tr>

              </thead>

              <?php 

					if(count($display_result)>0){ 

					 foreach ($display_result as $key => $val): ?>

              <tr>

                <td  align="center"><input type="checkbox" name="id[]"  value="<?php echo $val['id'];?>" /></td>

                <td class='priority'><?php echo $start_count;?></td>

                <td  align="center"><img src="<?php echo get_site_image('upload/newsletter/thumb/').$val['image_name']; ?>" width="100" /></td>

                <td><?php echo $val['title']; ?></td>

                <td><?php echo date("d/m/Y", strtotime($val['post_date']));?></td>

                <td  align="center"><?php if($val['status']=='N'){echo '<img alt="" src="'.image('icons/error.png').'">';}elseif ($val['status']=='Y'){echo '<img alt="" src="'.image('icons/success.png').'">';} ?></td>

                <td align="center"><a href="edit-newsletter/<?php echo $val['id'] ?>"><img src="<?php echo image('icons/small/black/edit.png'); ?>"  alt="Edit" title="Edit"></a> <a href="del-newsletter/<?php echo $val['id'] ?>" onClick="return confirm('Are you sure want to delete.');"><img src="<?php echo image('icons/small/black/delete.png'); ?>"  alt="Delete" title="Delete"></a></td>

              </tr>

              <?php $start_count++; endforeach; ?>

              <tr>

              <td colspan="9" style="padding-top:10px; padding-bottom:10px;"><div style="float:left">

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

                <td align="center" colspan="9" style="text-align:center; font-weight:bold;" >There is no record found.</td>

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