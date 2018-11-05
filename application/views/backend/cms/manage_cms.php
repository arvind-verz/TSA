<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
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
                        <a class="btn btn-info" href="<?php echo site_url('admin/add-cms') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . PAGE ?>
                        </a>
                        
                    </div>
           <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
            <thead>
              <tr>
                <th align="center">Sl No</th>
                <th>Page Title</th>
                <th>Status</th>
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
                <td><?php echo $val['page_heading'] ?></td>
                <td align="center"><?php if($val['status']=='N'){?>
                  <span class="glyphicon glyphicon-remove"></span>
                  <?php }elseif($val['status']=='Y'){?>
                 <span class="glyphicon glyphicon-ok"></span>
                  <?php }?></td>
                <td align="center"><a href="<?php echo site_url('admin/edit-cms/'.$val['id']); ?>"> <span class="glyphicon glyphicon-edit"></span></a>
                <?php if($val['url_not_editable']==1){?>
                &nbsp;  &nbsp; <a href="<?php echo site_url('admin/del-cms/'.$val['id']); ?>" onClick="return confirm('Are you sure want to delete?');"><span class="glyphicon glyphicon-trash"></span></a>
                <?php }?>
                </td>
              </tr>
              <?php $start_count++; endforeach; ?>
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