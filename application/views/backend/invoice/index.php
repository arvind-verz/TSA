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
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for=""><?php echo CLASSES ?> Code</label>
                                <select name="class_code" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if (count($classes)) {
                                    foreach ($classes as $class) {
                                    ?>
                                    <option value="<?php echo $class->class_code ?>"><?php echo $class->class_code ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group pull-right">
                                <select name="status" class="select2">
                                    <option value="">-- Select One --</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Partial</option>
                                    <option value="3">Overdue</option>
                                </select>
                                <select name="payment_method" class="select2">
                                    <option value="">-- Select One --</option>
                                    <option value="1">Cash</option>
									<option value="2">Cheque</option>
									<option value="3">Paynow</option>
                                </select>
                                <button type="button" class="btn btn-info payment_status">Submit</button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="no-sort"><input type="checkbox" name="payment_status_all" value=""></th>
                                        <th>Student ID</th>
                                        <th>Invoice No</th>
                                        <th>Invoice Date</th>
                                        <th>View/Download</th>
                                        <th>Status</th>
										<th>Method of Payment</th>
										<th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody class="display_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $("body").on("change", "select[name='class_code']", function() {
        var class_code = $("select[name='class_code']").val();
        get_payment_status_sheet(class_code);
    });

    function get_payment_status_sheet(class_code) {
        $('table').DataTable().clear().destroy();
        if (class_code != '') {
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/invoice/get_invoice_sheet'); ?>',
                data: 'class_code=' + class_code,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    //alert(data);
                    $("tbody.display_data").html(data);
                    $("table").dataTable({
						'order': [2, 'asc'],
                        columnDefs: [
                          { targets: 'no-sort', orderable: false }
                        ]
                    });
                }
            })
        } else {
            $("tbody.display_data").html('');
        }
        $("select[name='status'], select[name='payment_method']").val('').trigger('change');
        $("input[name='payment_status_all']").prop("checked", false);
    }

    $("input[name='payment_status_all']").on("change", function() {
        var storage = [];
        $("tbody tr td input[name='payment_status']").each(function() {
            if($("input[name='payment_status_all']").is(":checked")) {
                $(this).prop("checked", true);
            }
            else {
                $(this).prop("checked", false);
                storage.pop($(this).val());
            }
        });
    });

    $("body").on("click", "button.payment_status", function() {
        var class_code = $("select[name='class_code']").val();
        var storage = [];
        $("input[name='payment_status']:checked").each(function() {
            storage.push($(this).val());
        });
        var status = $("select[name='status']").val();
        var payment_method = $("select[name='payment_method']").val();
        if((storage != '') && (status!='' || payment_method != '')) {
            update_payment_status(status, payment_method, storage, class_code);
        }
        else {
            alert("Please select option to proceed.");
        }
    });

    function update_payment_status(status, payment_method, storage, class_code) {
        $.get("<?php echo site_url('admin/invoice/payment_status_update'); ?>", {status : status, payment_method : payment_method, invoice_id : storage}, function(data) {
                get_payment_status_sheet(class_code);
        })
    }

	$("body").on("keyup", "textarea[name='remark']", function() {
		$(this).parent("td").find("button").removeClass("hide");
	});

	$("body").on("click", "button.save_remark", function() {
		var ref = $(this);
		var id = ref.parent("td").find("input[name='id']").val();
		var remark = ref.parent("td").find("textarea[name='remark']").val();
		if(id)
		{
			$.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/invoice/invoice_remark'); ?>',
                data: 'remark=' + remark + '&id=' + id,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
					if(data.trim()=='success')
					{
						ref.parent("td").find("button").addClass("hide");
					}
                }
            });
		}
		else
		{
			alert("Error! Something went wrong.");
		}
	});

});
</script>
