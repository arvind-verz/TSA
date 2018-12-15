<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages')?>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/add-testimonial') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . TESTIMONIAL ?>
                        </a>
                        <!--<a class="pull-right" href="<?php echo site_url('admin/subject/archived') ?>">
                            <i aria-hidden="true" class="fa fa-archive">
                            </i> <?php echo ARCHIVED . ' ' . SUBJECT ?>
                        </a>-->
                    </div>
                    <div class="box-body">

              <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
            <thead>
              <tr>
                <th align="center">Sl No</th>
                <th>Banner</th>
                <th>Heading</th>
                <th width="40%">Description</th>
                <!--<th>Url</th>-->
                <th align="center">Status</th>
                <th align="center" width="7%">Action</th>
              </tr>
              
              </thead>
              <tbody>
              <?php 
				if(count($display_result)>0){ $c=0;
				 foreach ($display_result as $key => $val): $c++; ?>
              <tr>

                <td class='priority'><?php echo $val['sort_order'];?></td>
                <td><img src="<?php echo base_url('assets/files/testimonial/').$val['image_name']; ?>" height="50px" /></td>
                <td><?php echo $val['title'] ?></td>
                <td><?php echo $val['content'] ?></td>
                <!--<td><?php echo $val['url'] ?></td>-->
                <td align="center"><?php if($val['status']==0){echo '<span class="glyphicon glyphicon-remove"></span>';}elseif ($val['status']==1){echo '<span class="glyphicon glyphicon-ok"></span>';} ?></td>
                <td align="center"><a href="edit-testimonial/<?php echo $val['id'] ?>"><i aria-hidden="true" class="fa fa-pencil-square-o btn btn-warning"></i></a> <a href="del-testimonial/<?php echo $val['id'] ?>" onClick="return confirm('Are you sure want to delete.');"><i aria-hidden="true" class="fa fa-archive btn btn-danger"></i></a></td>
              </tr>
              <?php endforeach; ?>
              </tbody>
              <tfoot>
              
              <?php }else{?>
              <tr>
                <td align="center" colspan="9" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
              </tfoot>
            </table>
            
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>