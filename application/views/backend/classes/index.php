<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php print_r($page_title); ?>
        </h1>
        <?php print_r($breadcrumbs); ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header text-right">
                        <a class="btn btn-info" href="<?php echo site_url('admin/classes/create') ?>">
                            <i aria-hidden="true" class="fa fa-plus-circle">
                            </i> <?php echo CREATE . ' ' . CLASSES ?>
                        </a>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Class Name
                                    </th>
                                    <th>
                                        Class Code
                                    </th>
                                    <th>
                                        Tutor ID
                                    </th>
                                    <th>
                                        Subject
                                    </th>
                                    <th>
                                        Time
                                    </th>
                                    <th>
                                        Frequency
                                    </th>
                                    <th>
                                        Day
                                    </th>
                                    <th>
                                        Monthly Fees(S$)
                                    </th>
                                    <th>
                                        Level
                                    </th>
                                    <th>
                                        Session ID
                                    </th>
                                    <th>
                                        Class Size
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Maths
                                    </td>
                                    <td>
                                        01200
                                    </td>
                                    <td>
                                        111
                                    </td>
                                    <td>
                                        Maths
                                    </td>
                                    <td>
                                        4:00pm - 6:00pm
                                    </td>
                                    <td>
                                        Monthly
                                    </td>
                                    <td>
                                        Monday
                                    </td>
                                    <td>
                                        100$
                                    </td>
                                    <td>
                                        II
                                    </td>
                                    <td>
                                        A
                                    </td>
                                    <td>
                                        8/10
                                    </td>
                                    <td>
                                        Action
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>