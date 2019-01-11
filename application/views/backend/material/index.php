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
                    <?php echo form_open('admin/material/archive'); ?>
                    <div class="box-header">
                        <a class="btn btn-info" href="<?php echo site_url('admin/material/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                                </i> <?php echo CREATE . ' ' . BOOK ?>
                            </a>
                            <a class="pull-right" href="<?php echo site_url('admin/material/archived') ?>">
                                <i aria-hidden="true" class="fa fa-archive">
                                    </i> <?php echo ARCHIVED . ' ' . MATERIAL ?>
                                </a>
                                <?php
                                if (!(current_url() == site_url('admin/material/archived'))) {
                                    ?>
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Book Min Price</label>
                                                <input type="text" name="price_from" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Book Max Price</label>
                                                <input type="text" name="price_to" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">

                                            <button type="submit" class="btn btn-primary hide" disabled>Archive Selected <span class="badge"></span></button>

                                    </div>
                                <?php } ?>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped table-bordered text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <?php
                                                if (!(current_url() == site_url('admin/material/archived'))) {
                                            ?>
                                            <th class="no-sort" width="15px">
                                                <input type="checkbox" name="select_all_material">
                                            </th>
                                            <?php } ?>
                                            <th>
                                                <?php echo ACTION ?>
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> ID
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Name
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?>
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Price
                                            </th>
                                            <?php
                                            if (current_url() == site_url('admin/material/archived')) {
                                                ?>
                                                <th>
                                                    <?php echo ARCHIVED ?> At
                                                </th>
                                                <?php
                                            }
                                            ?>

                                        </tr>
                                    </thead>
                                    <tbody class="display_data">
                                        <?php
                                        if (count($books)) {
                                            foreach ($books as $book) {
                                                ?>
                                                <tr>
                                                    <?php
                                                    if (current_url() == site_url('admin/material/archived')) {
                                                        ?>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/material/moveto_active_list/' . $book->material_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                                            <a href="<?php echo site_url('admin/material/delete-archive/' . $book->material_id) ?>" title="Remove Data" onclick="return confirm('Are you sure, you will not be able to recover data?')"><i class="fa fa-trash btn btn-danger" aria-hidden="true"></i></a>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <input type="checkbox" class="checkbox" name="material_id[]" value="<?php echo $book->id;?>"/>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/material/edit/' . $book->id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                                            <!-- <a href="<?php echo site_url('admin/material/delete/' . $book->material_id) ?>" onclick="return confirm('Are you sure you want to archive this book?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a> -->
                                                        </td>
                                                    <?php }?>
                                                    <td>
                                                        <?php echo isset($book->material_id) ? $book->material_id : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->book_name) ? $book->book_name : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->subject) ? get_subject_classes($book->subject) : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->book_price) ? get_currency('SGD').$book->book_price : '-' ?>
                                                    </td>
                                                    <?php
                                                    if (current_url() == site_url('admin/material/archived')) {
                                                        ?>
                                                        <td>
                                                            <?php echo isset($book->archive_at) ? date('d-m-Y H:i A', strtotime($book->archive_at)) : '-' ?>
                                                        </td>
                                                        <?php
                                                    } ?>
                                                </tr>
                                                <?php
                                            }}
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th><button type="button" class="btn btn-default clearall">Clear All</button></th>
                                            <?php
                                                if (!(current_url() == site_url('admin/material/archived'))) {
                                            ?>
                                            <th>Action</th>
                                            <?php } ?>
                                            <th>
                                                <?php echo BOOK ?> ID
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Name
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?>
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Price
                                            </th>
                                            <?php
                                            if (current_url() == site_url('admin/material/archived')) {
                                                ?>
                                                <th>
                                                    <?php echo ARCHIVED ?> At
                                                </th>
                                                <?php
                                            }
                                            ?>

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
                $(document).ready(function(e) {
                    function is_checkbox_checked(count) {
                        $("button[type='submit']").find("span").text(count);
                        if(count>0) {
                            $("button[type='submit']").removeClass('hide').attr("disabled", false);
                        }
                        else {
                            $("button[type='submit']").addClass('hide').attr("disabled", true);
                        }
                    }

                    $("input[name='select_all_material']").on("change", function() {

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
                            $("input[name='select_all_material']").prop("checked", false);
                        }
                        else {
                            $("input[name='select_all_material']").prop("checked", true);
                        }
                        is_checkbox_checked(count);
                    });

                    $('table tfoot tr th:gt(0)').each( function () {
                        var title = $(this).text().trim();
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                    } );

                    // DataTable
                    var table = $('table').DataTable({
                        columnDefs: [
                          { targets: 'no-sort', orderable: false }
                        ]
                    });

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

                    $("input[name='price_from'], input[name='price_to']").on("change", function() {
                        var price_from = $("input[name='price_from']").val();
                        var price_to = $("input[name='price_to']").val();

                        $.ajax({
                            type: 'GET',
                            url: '<?php echo site_url('admin/material/get_book_price_range'); ?>',
                            data: 'price_from=' + price_from + '&price_to=' + price_to,
                            async: false,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                    //alert(data);
                                $("tbody.display_data").html(data);
                                $('table tfoot th').each( function () {
                                    var title = $(this).text().trim();
                                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                                } );


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
                            }
                        })
                    });
                });
            </script>
