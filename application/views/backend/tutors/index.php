<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>
    <?php $this->load->view('backend/include/messages');?>
    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                  <?php echo form_open('admin/tutors/archive'); ?>
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/tutors/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                                </i> <?php echo CREATE . ' ' . TUTOR ?>
                            </a>
                            <a class="pull-right" href="<?php echo site_url('admin/tutors/archived') ?>">
                                <i aria-hidden="true" class="fa fa-archive">
                                    </i> <?php echo ARCHIVED . ' ' . TUTOR ?>
                                </a>
                                <button type="submit" class="btn btn-primary hide pull-right">Archive Selected <span class="badge"></span></button>
                            </div>

                            <div class="box-body table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                          <?php
                                              if (!(current_url() == site_url('admin/tutors/archived'))) {
                                          ?>
                                          <th class="no-sort" width="15px">
                                              <input type="checkbox" name="select_all_tutor">
                                          </th>
                                          <?php } ?>
                                            <th>
                                                Action
                                            </th>
                                            <th>Tutor ID</th>
                                            <th>
                                                Tutor Name
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>Class Code</th>
                                            <th>
                                                Subject
                                            </th>
                                            <th>
                                                Phone Number
                                            </th>
                                            <th>Salary Scheme</th>
                                            <?php
                                            if (current_url() == site_url('admin/tutors/archived')) {
                                                ?>
                                                <th>Archived At</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($tutors) {
                                            //die(print_r($tutors));
                                            foreach ($tutors as $tutor) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if (current_url() == site_url('admin/tutors/archived')) {
                                                        ?>
                                                        <td><a title="Move to active list" href="<?php echo site_url('admin/tutors/moveto_active_list/'.$tutor->tutor_id) ?>"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                                        <a href="<?php echo site_url('admin/tutors/delete-archive/' . $tutor->tutor_id) ?>" title="Remove Data" onclick="return confirm('Are you sure, you will not be able to recover data?')"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                                        </td>
                                                    <?php }else { ?>
                                                      <td>
                                                          <input type="checkbox" class="checkbox" name="tutor_id[]" value="<?php echo $tutor->user_id;?>"/>
                                                      </td>
                                                        <td>
                                                            <a title="Edit" href="<?php echo site_url('admin/tutors/edit/' . $tutor->id) ?>"><i aria-hidden="true" class="fa fa-pencil-square-o btn btn-warning"></i></a>
                                                            <!-- <a title="Archive" href="<?php echo site_url('admin/tutors/archive/' . $tutor->id) ?>" onclick="return confirm('Are you sure you want to archive this tutor?');"><i aria-hidden="true" class="fa fa-archive btn btn-danger"></i></a> -->
                                                        </td>
                                                    <?php } ?>
                                                    <td><?php echo isset($tutor->tutor_id) ? $tutor->tutor_id : '-'; ?></td>
                                                    <td><?php echo isset($tutor->firstname) ? $tutor->firstname.' '.$tutor->lastname : '-'; ?></td>
                                                    <td><?php echo isset($tutor->email) ? $tutor->email : '-'; ?></td>
                                                    <td><?php echo get_class_code_by_tutor($tutor->tutor_id); ?></td>
                                                    <td><?php echo isset($tutor->subject) ? get_subject_by_subject_code(json_decode($tutor->subject)) : '-'; ?></td>
                                                    <td><?php echo isset($tutor->phone) ? $tutor->phone : '-' ?></td>
                                                    <td><?php echo get_salary_scheme($tutor->salary_scheme); ?></td>
                                                    <?php
                                                    if (current_url() == site_url('admin/tutors/archived')) {
                                                        ?>
                                                        <td><?php echo isset($tutor->updated_at) ? date('Y-m-d H:i A', strtotime($tutor->updated_at)) : '-'; ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <?php
                                            }}
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th><button type="button" class="btn btn-default clearall">Clear All</button></th>
                                              <?php
                                                  if (!(current_url() == site_url('admin/tutors/archived'))) {
                                              ?>
                                                  <th>Action</th>
                                              <?php } ?>
                                                <th>Tutor ID</th>
                                                <th>
                                                    First Name
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>Class Code</th>
                                                <th>
                                                    Subject
                                                </th>
                                                <th>
                                                    Phone Number
                                                </th>
                                                <th>Salary Scheme</th>
                                                <?php
                                                if (current_url() == site_url('admin/tutors/archived')) {
                                                    ?>
                                                    <th>Archived At</th>
                                                <?php } ?>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                  function is_checkbox_checked(count) {
                      $("button[type='submit']").find("span").text(count);
                      if(count>0) {
                          $("button[type='submit']").removeClass('hide');
                      }
                      else {
                          $("button[type='submit']").addClass('hide');
                      }
                  }

                  $("input[name='select_all_tutor']").on("change", function() {

                      if($(this).is(":checked")) {
                          $(".checkbox").prop("checked", true);
                      }
                      else {
                          $(".checkbox").prop("checked", false);
                      }
                      var count = $(".checkbox:checked").length;
                      is_checkbox_checked(count);
                  });

                  $(".checkbox").on("change", function() {
                      var count = $(".checkbox:checked").length;
                      if($(".checkbox").length!=count)
                      {
                          $("input[name='select_all_tutor']").prop("checked", false);
                      }
                      else {
                          $("input[name='select_all_tutor']").prop("checked", true);
                      }
                      is_checkbox_checked(count);
                  });

                    // Setup - add a text input to each footer cell
                    $('table tfoot tr th:gt(0)').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                    } );

                    // DataTable
                    var table = $('table').DataTable();

                    // Apply the search
                    table.columns().every( function () {
                        var that = this;

                        $( 'input', this.footer() ).on( 'keyup change', function () {
                            if ( that.search() !== this.value ) {
                                that
                                    .search( this.value )
                                    .draw();
                            }
                        } );
                    } );

                    $("body").on("click", "button.clearall", function() {
                        $("tfoot input").val('');
                        table.search( '' )
                             .columns().search( '' )
                             .draw();
                    })
                } );


            </script>
