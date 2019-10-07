<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php print_r($breadcrumbs);?>
    </section>

    <?php $this->load->view('backend/include/messages') ?>
    <style>
      .form-inline .multiselect-container li.disabled label.checkbox {background: #262626; color: #fff;}
    </style>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <?php echo form_open('admin/order/store'); ?>
                    <div class="box-body">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for=""><?php echo CLASSES ?> Code</label>
                                <select name="class_code" class="form-control select2">
                                    <option value="">-- Select One --</option>
                                    <?php
                                    if(count($classes)) {
                                    foreach($classes as $class) {
                                    ?>
                                    <option value="<?php echo $class->class_code; ?>"><?php echo $class->class_code ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo SUBJECT ?></label>
                                <select name="subject[]" class="form-control select2 subject" multiple="multiple">
                                    <?php
                                    if(count($subjects)) {
                                    foreach($subjects as $subject) {
                                    ?>
                                    <option value="<?php echo $subject->id ?>"><?php echo $subject->subject_name; ?></option>
                                    <?php
                                    }}
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo STUDENT ?></label>
                                <select name="student[]" class="form-control selectpicker students" multiple="multiple" style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo BOOK ?> ID</label>
                                <select name="book_id" class="form-control select2 books">
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="<?php echo site_url('admin/order'); ?>" class="btn btn-default"><?php echo CANCEL ?></a>
                            <button type="submit" class="btn btn-info pull-right"><?php echo SUBMIT ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $("select[name=class_code]").on("change", function() {
            var class_code = $(this).val();
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/material/get_student_by_class_code'); ?>',
                data: 'class_code=' + class_code,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    //alert(data);
                    $(".students").html(data);
					$('.selectpicker').multiselect('rebuild');
                }
            })
        });

        $("select.subject").on("change", function() {
            var subject = $(this).val();
            
            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('admin/material/get_books_by_subject'); ?>',
                data: 'subject=' + subject,
                async: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $(".books").html(data);
                }
            })
        });

        $("select.students").on("change", function() {
			var ref = $(this);
            var student = ref.val();
				
            if(student.indexOf('all')>-1)
            {
				// Enable all checkboxes.
				ref.multiselect('deselectAll', true);
            	ref.multiselect('updateButtonText');

				ref.multiselect('select', ['all']);
				var nonSelectedOptions = $('select.students option').filter(function() {
					return !$(this).is(':selected');
				});

				nonSelectedOptions.each(function() {
					var input = $('input[value="' + $(this).val() + '"]');
					input.prop('disabled', true);
					
					input.parent('li').addClass('disabled');
				});
            }
			else {
				// Enable all checkboxes.
				$('select.students option').each(function() {
					var input = $('input[value="' + $(this).val() + '"]');
					input.prop('disabled', false);
					input.parent('li').addClass('disabled');
				});
			}
        });
    });
</script>
