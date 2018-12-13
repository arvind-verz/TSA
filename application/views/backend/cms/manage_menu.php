<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
        <?php //echo '<pre>'; print_r($classes); echo '</pre>';?>
    </section>
    <?php 
	$this->load->view('backend/include/messages');	?>
    <!-- Main content -->
    <section class="content">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/add-menu-item/'.$position) ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> Add Menu
                        </a>
                    </div>
           <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
            <thead>
              <tr>
                <th align="center">Sl No</th>
                <th>Menu Title</th>
                <th align="center" width="7%">Action</th>
              </tr>
              </thead>
              <tbody>
              <?php 
			  		$start_count=1;
					if(count($display_result)>0){ 
					foreach ($display_result as $key => $val):?>
              		<tr>
                <td class='priority'><?php echo $start_count;?> <input type="hidden" name="sort_order[]" value="<?php echo $val['sort_order'];?>" /></td>
                <td><?php echo $val['menu_title'] ?></td>
                <td align="center"><a href="<?php echo site_url('admin/edit-menu-item/'.$position.'/'.$val['id']); ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;  &nbsp; <a href="<?php echo site_url('admin/del-menu-item/'.$position.'/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><span class="glyphicon glyphicon-trash"></span></a></td>
              </tr>
              		<?php $submenu = $this->Cms_model->get_sub_menus($position, $val['id']);
					if(count($submenu)>0){ $c=0;
						foreach ($submenu as $key => $valm){ $c++;?>
                    		<tr>
                            	
                				<td><?php echo $start_count.'.'.$c; ?></td>
                                <td><?php echo $val['menu_title'] ?> &gt;&gt; <?php echo $valm['menu_title'] ?></td>
                                <td align="center"><a href="<?php echo site_url('admin/edit-menu-item/'.$position.'/'.$valm['id']); ?>"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;  &nbsp; 
                                <a href="<?php echo site_url('admin/del-menu-item/'.$position.'/'.$valm['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><span class="glyphicon glyphicon-trash"></span></a></td>
              				</tr>
                            
							
                        
                    	<?php } }?>
              			
              <?php $start_count++; 
			  endforeach; ?>
              </tbody>
              <tfoot>
              
              <?php }else{?>
              <tr>
                <td align="center" colspan="7" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
              </tfoot>
            </table>
</div>
            </div>
        </div>
    </section>
</div>