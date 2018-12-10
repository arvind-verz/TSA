</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->

<script src="<?php echo base_url('assets/plugins/select2/dist/js/select2.full.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/plugins/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/morris.js/morris.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/min/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/dist/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#datatable").DataTable({
			"ordering": false
		});
		$('.select2').select2();
		$('.datepicker').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
		})

		$('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
		    checkboxClass: 'icheckbox_flat-green',
		    radioClass: 'iradio_flat-green'
		})

		$('.date_range').daterangepicker();

        $(function () {
	        $.fn.datepicker.noConflict = function(){
   $.fn.datepicker = old;
   return this;
};
	    });
	});
</script>
</body>
</html>