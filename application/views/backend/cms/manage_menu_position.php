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
                    

             <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
              <tr>
                <th>Menu Name</th>
                <th>Menu Position</th>
                <th align="center" width="150"></th>
              </tr>
              <?php if(count($display_result)>0){ 
					$c=0; foreach ($display_result as $key => $val): $c++;?>
              <tr>
                <td><?php echo $val['display_name'] ?></td>
                <td><?php echo $val['position'] ?></td>
                <td align="center"><a class="buttonred" href="manage-menu-list/<?php echo $val['position'] ?>"><span class="glyphicon glyphicon-list"></span></a></td>
              </tr>
              <?php endforeach; ?>
              <?php }else{?>
              <tr>
                <td align="center" colspan="3" style="text-align:center; font-weight:bold;" >There is no record found.</td>
              </tr>
              <?php }?>
            </table>

</div>
            </div>
        </div>
    </section>
</div>