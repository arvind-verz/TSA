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

                                <?php } ?>
                            </div>
                            <div class="box-body">
                                <table class="table table-striped table-bordered text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo BOOK ?> Name
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?>
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Price
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Version
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
                                            <th>
                                                <?php echo ACTION ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="display_data">
                                        <?php
                                        if (count($books)) {
                                            foreach ($books as $book) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo isset($book->book_name) ? $book->book_name : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->subject) ? get_subject_classes($book->subject) : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->book_price) ? $book->book_price : '-' ?>
                                                    </td>
                                                    <td>
                                                        <?php echo isset($book->book_version) ? $book->book_version : '-' ?>
                                                    </td>
                                                    <?php
                                                    if (current_url() == site_url('admin/material/archived')) {
                                                        ?>
                                                        <td>
                                                            <?php echo isset($book->archive_at) ? date('d-m-Y H:i A', strtotime($book->archive_at)) : '-' ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/material/moveto_active_list/' . $book->material_id) ?>" title="Move to active list"><i class="fa fa-reply btn btn-warning" aria-hidden="true"></i></a>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <a href="<?php echo site_url('admin/material/edit/' . $book->material_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                                                            <a href="<?php echo site_url('admin/material/delete/' . $book->material_id) ?>" onclick="return confirm('Are you sure you want to archive this book?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a>
                                                        </td>
                                                    <?php }?>
                                                </tr>
                                                <?php
                                            }}
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>
                                                <?php echo BOOK ?> Name
                                            </th>
                                            <th>
                                                <?php echo SUBJECT ?>
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Price
                                            </th>
                                            <th>
                                                <?php echo BOOK ?> Version
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
                                            <th>
                                                <?php echo ACTION ?>
                                            </th>
                                        </tr>
                                    </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('table tfoot th').each( function () {
                        var title = $(this).text().trim();
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
                    $(".display_data").html(data);
                    $('table tfoot th').each( function () {
                        var title = $(this).text().trim();
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
                }
            })
                    });
                });
            </script>