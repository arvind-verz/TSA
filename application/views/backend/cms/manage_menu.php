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
					<div class="box-body">
						<table class="table table-striped table-bordered" id="datatable" style="width:100%">
							<thead>
							<tr>
								<th>Menu Title</th>
								<th>Sort Order</th>
								<th class="text-center">Action</th>
							</tr>
							</thead>
							<tbody>
								<?php if(count($display_result)) { print_r(getPageList($display_result, $position, $parent_id = 0)); } ?>
							</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
    </section>
</div>
