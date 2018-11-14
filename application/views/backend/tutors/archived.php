<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs); ?>
    </section>
    <?php 
	$this->load->view('backend/include/messages'); ?>
    <!-- Main content -->
    <section class="content">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/tutors/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . TUTOR ?>
                        </a>
                    </div>
                   
                    <div class="box-body table-responsive">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                       Subject 
                                    </th>
                                    <th>
                                       Phone 
                                    </th>
                                    <th>
                                       Archive <br />Date
                                    </th>
                                    
                                    <th>
                                       Action 
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                if (count($tutors)) {
                                foreach ($tutors as $tutor) {
								?>
                                <tr>
                                <td><?php echo $tutor->tutor_id;?></td>
                                <td><?php echo $tutor->tutor_name;?></td>
                                <td><?php echo $tutor->email;?></td>
                                <td></td>
                                <td><?php echo isset($tutor->subject) ? $tutor->subject : '-' ?></td>
                                <td><?php echo isset($tutor->phone) ? $tutor->phone : '-' ?></td>
                                <td><a onclick="return confirm('Are you sure you want to back this tutor?');" title="Archive" href="<?php echo site_url('admin/tutors/moveto_active_list/'.$tutor->tutor_id) ?>">Move to<br />Active list</a> </td>
                               
                                </tr>
                                <?php
                                }} else {
                                ?>
                                <tr>
                                    <td colspan="18" class="text-center">No data found.</td>
                                </tr>
                                <?php
                                }
								?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>