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
                  <?php echo form_open('admin/subject/archive'); ?>
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/subject/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                                </i> <?php echo CREATE . ' ' . SUBJECT ?>
                            </a>
                            <a class="pull-right" href="<?php echo site_url('admin/subject/archived') ?>">
                                <i aria-hidden="true" class="fa fa-archive">
                                    </i> <?php echo ARCHIVED . ' ' . SUBJECT ?>
                                </a>
                                <button type="submit" class="btn btn-primary hide pull-right">Archive Selected <span class="badge"></span></button>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                                    <thead>
                                        <tr>
                                          <?php
                                              if (!(current_url() == site_url('admin/subject/archived'))) {
                                          ?>
                                          <th class="no-sort" width="15px">
                                              <input type="checkbox" name="select_all_subject">
                                          </th>
                                          <?php } ?>
                                            <th>
                                                <?php echo ACTION ?>
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?> Code
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?> Name
                                            </th>
                                            <?php
                                            if (!(current_url() == site_url('admin/subject/archived'))) {
                                                ?>
                                                <th>
                                                    <?php echo CREATED ?> At
                                                </th>
                                                <th>
                                                    <?php echo UPDATED ?> At
                                                </th>
                                                <?php
                                            } else {
                                                ?>
                                                <th>
                                                    <?php echo ARCHIVED ?> At
                                                </th>
                                                <?php
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(count($subjects)) {
                                            foreach($subjects as $subject) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if (!(current_url() == site_url('admin/subject/archived'))) {
                                                        ?>
                                                        <td>
                                                            <input type="checkbox" class="checkbox" name="subject_id[]" value="<?php echo $subject->id;?>"/>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/subject/edit/' . $subject->subject_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                                            <!-- <a href="<?php echo site_url('admin/subject/delete/' . $subject->subject_id) ?>" onclick="return confirm('Are you sure you want to archive this subject?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a> -->
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/subject/moveto_active_list/' . $subject->subject_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                                            <a href="<?php echo site_url('admin/subject/delete-archive/' . $subject->subject_id) ?>" title="Remove Data" onclick="return confirm('Are you sure, you will not be able to recover data?')"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td>
                                                        <?php echo isset($subject->subject_code) ? $subject->subject_code : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($subject->subject_name) ? $subject->subject_name : '-' ?>
                                                    </td>
                                                    <?php
                                                    if (!(current_url() == site_url('admin/subject/archived'))) {
                                                        ?>
                                                        <td>
                                                            <?php echo isset($subject->created_at) ? date('Y-m-d H:i A', strtotime($subject->created_at)) : '-' ?>
                                                        </td>
                                                        <td>
                                                            <?php echo isset($subject->updated_at) ? date('Y-m-d H:i A', strtotime($subject->updated_at)) : '-' ?>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <?php echo isset($subject->archive_at) ? date('Y-m-d H:i A', strtotime($subject->archive_at)) : '-' ?>
                                                        </td>
                                                        <?php
                                                    }
                                                    ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
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

                $("input[name='select_all_subject']").on("change", function() {

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
                        $("input[name='select_all_subject']").prop("checked", false);
                    }
                    else {
                        $("input[name='select_all_subject']").prop("checked", true);
                    }
                    is_checkbox_checked(count);
                });
              });
            </script>
