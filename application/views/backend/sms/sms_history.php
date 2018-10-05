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
                    <div class="box-body">
                        <table class="table table-striped table-bordered text-center" id="datatable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <?php echo CLASSES ?> Code
                                    </th>
                                    <th>
                                        <?php echo STUDENT ?> Name
                                    </th>
                                    <th>
                                        <?php echo STUDENT ?> ID
                                    </th>
                                    <th>
                                        SMS Sent Date
                                    </th>
                                    <th>
                                        Pre-Condition
                                    </th>
                                    <th>
                                        <?php echo SMS_TEMPLATE ?> Used
                                    </th>
                                    <th>
                                        <?php echo ACTION ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>