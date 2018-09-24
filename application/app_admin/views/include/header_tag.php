<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $this->load->view('include/meta'); ?>
<!--[if IE 9]>
<?php echo css('ie9') ?>
<![endif]-->
<!--[if IE 8]>
<?php echo css('ie8') ?>
<![endif]-->
<!--[if IE 7]>
<?php echo css('ie7') ?>
<![endif]-->
<?php echo js('jquery-1.11.1.min') ?>
<?php echo js('jquery.min') ?>
<?php echo js('menu') ?>
<?php echo css('menu') ?>
<script type="text/javascript" src="<?php echo SITE_URL;?>editor/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>editor/fancybox/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_URL;?>editor/fancybox/jquery.fancybox.js"></script>
<script>
tinymce.init({
    selector: "textarea#bodyContent",
    theme: "modern",
    width: "auto",
    height: 500,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager,emoticons"
   ],
   content_css: "css/content.css",  
   extended_valid_elements: 'span[style|id|nam|class|lang]', 
   relative_urls: false,
   remove_script_host: false,
   document_base_url: '<?php echo SITE_URL;?>',
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | edit  tools, emoticons",
   browser_spellcheck: true,
   contextmenu: false,
   image_advtab: true ,   
   external_filemanager_path:"<?php echo SITE_URL;?>editor/filemanager/",
   filemanager_title:"Filemanager" ,
   filemanager_access_key:'<?php echo SESS_COOKIE_NAME_ADMIN;?>',
   external_plugins: { "filemanager" : "<?php echo SITE_URL;?>editor/filemanager/plugin.min.js"}
 }); 
 tinymce.init({
    selector: "textarea#bodyContent2",
    theme: "modern",
    width: "auto",
    height: 500,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager,emoticons"
   ],
   content_css: "css/content.css",  
   extended_valid_elements: 'span[style|id|nam|class|lang]', 
   relative_urls: false,
   remove_script_host: false,
   document_base_url: '<?php echo SITE_URL;?>',
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | edit  tools, emoticons",
   browser_spellcheck: true,
   contextmenu: false,
   image_advtab: true ,   
   external_filemanager_path:"<?php echo SITE_URL;?>editor/filemanager/",
   filemanager_title:"Filemanager" ,
   filemanager_access_key:'<?php echo SESS_COOKIE_NAME_ADMIN;?>',
   external_plugins: { "filemanager" : "<?php echo SITE_URL;?>editor/filemanager/plugin.min.js"}
 }); 
</script>
<script>
function addImage_file() {
	 var getallfile = 1;
	 jQuery('input[name^="file"]').each(function() {
		if(jQuery(this).val()==''){
			alert('Please add a Image after that press this button for add more file.');	
			getallfile = 0;
			return false;
			}
		});
		if(getallfile == 1){
		var addControl;
		addControl = ' <br/><br/><input type="file" name="file[]" class="cf">';
		jQuery('p#display').append(addControl); 
		}
}
function remove_file(id) {
if (!confirm('Are you sure want to delete?')) return false;
jQuery( '.'+id ).append( '<img src="<?php echo base_url('assets/img/1loading.gif'); ?>"/>' );

	jQuery.ajax({
				type: "POST",
				dataType: "text",
				url: "<?php echo base_url('remove-file'); ?>/"+id,
				data: "{'id':'" + id + "'}",
				success: function(data) { 
				///jQuery('.message_ajax').html('').append(data); 
				jQuery( '.'+id ).fadeOut( "slow" );
				 },
				error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
			});				   
}

function remove_file2(id) {
if (!confirm('Are you sure want to delete?')) return false;
jQuery( '.'+id ).append( '<img src="<?php echo base_url('assets/img/1loading.gif'); ?>"/>' );

	jQuery.ajax({
				type: "POST",
				dataType: "text",
				url: "<?php echo base_url('remove-file2'); ?>/"+id,
				data: "{'id':'" + id + "'}",
				success: function(data) { 
				///jQuery('.message_ajax').html('').append(data); 
				jQuery( '.'+id ).fadeOut( "slow" );
				 },
				error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
			});				   
}



function remove_pro_file(id) {
if (!confirm('Are you sure want to delete?')) return false;
jQuery( '.'+id ).append( '<img src="<?php echo base_url('assets/img/1loading.gif'); ?>"/>' );
jQuery.ajax({
			type: "POST",
			dataType: "text",
			url: "<?php echo base_url('write-up-remove-file'); ?>/"+id,
			data: "{'id':'" + id + "'}",
			success: function(data) { 
			///jQuery('.message_ajax').html('').append(data); 
			jQuery( '.'+id ).fadeOut( "slow" );
			 },
			error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
		});				   
}
</script>
<?php echo js_custom('general'); ?>
<style>
.label {
		background-color: #999999;
		border-radius: 3px 3px 3px 3px;
		color: #FFFFFF;
		font-size: 11.05px;
		font-weight: bold;
		padding: 2px 4px 3px;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}
.label-success {
		background-color: #468847;
}
.label-warning {
		background-color: #F89406;
}
.label-important {
		background-color: #B94A48;
}
.label-info {
		background-color: #3A87AD;
}
</style>
<script>
var confirm_msg = '<?php echo lang('dialog.confirm'); ?>';
var no_item = '<?php echo lang('dialog.noitem'); ?>';
var required_msg = '<?php echo lang('label.required'); ?>';
jQuery(document).ready(function() {
	jQuery("a.prevent-default").click(function(event){
		event.preventDefault();
	});
});
var full_path = '<?php echo base_url(); ?>';
</script>

<?php echo css('reset') ?>
<?php echo css('admin_style') ?>
<?php echo css('detail') ?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php echo js('jquery.ui.core') ?>
<?php echo js('jquery.ui.widget') ?>
<?php echo js('jquery.ui.datepicker') ?>
<?php echo css('plugins') ?>
<script>
jQuery(function() {
jQuery( "#start_date" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
jQuery( "#end_date" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
jQuery( "#dob" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-70:-1",
	buttonImageOnly: true
});
jQuery( "#expiring_date" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
jQuery( "#datepicker" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
jQuery( ".datepicker" ).datepicker({
	showOn: "button",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
jQuery( "#post_date" ).datepicker({
	showOn: "both",
	buttonImage: "<?php echo image('calendar.png'); ?>",
	buttonText : 'Calendar',
	changeYear: true,
	yearRange: "-10:+0",
	buttonImageOnly: true
});
});
</script>
<script>
	jQuery(document).ready(function(){
	jQuery('.checkall').click(function(){
        if(!jQuery(this).is(':checked')) {
            jQuery('.leftPanel input[type=checkbox]').each(function(){
                jQuery(this).attr('checked',false);
            });
        } else {
            jQuery('.leftPanel input[type=checkbox]').each(function(){
                jQuery(this).attr('checked',true);
            });
        }
    });
	});
</script>
<script>
jQuery(document).ready(function(){
	jQuery('#action_delete').click(function(){
		var empt = true;
        jQuery('.leftPanel input[type=checkbox]').each(function(){
            if(jQuery(this).is(':checked')) {
                empt = false;
            }
        });
        if(empt == true) {
            alert(no_item);
        } else {
            var c = confirm(confirm_msg);
            if(c) {
                jQuery('.leftPanel input[type=checkbox]').each(function(){
                    if(jQuery(this).is(':checked')) {
						jQuery("#frm_display").submit();
                    }
                });
            }
        }
		
		
	});
	
	jQuery('#export_cat_now').click(function(){
		jQuery.ajax({
					type: "POST",
					dataType: "text",
					url: "<?php echo base_url('exportCat'); ?>",
					data: "{'id':'5'}",
					success: function(data) { 
					
					 },
					error: function(xhr, ajaxOptions, thrownError) {alert(thrownError);}
				});				   
	});
	


});
</script>
<?php echo css('popup') ?>
<?php echo js('script') ?>
<?php echo js("validation"); ?>
<script>
jQuery(document).ready(function(){
    //*******************************************************************//
	$('input:radio[name=link_type]').click(function(){
		radio_val = $(this).val();
		
		link_target_str = '';
		
		link_target_str += '<label for="link_target">Page Target: </label>';
		link_target_str += '<select name="link_target" class="sf">';
		link_target_str += '<option value="self">Same Tab</option>';
		link_target_str += '<option value="new_tab">New Tab</option>';
		link_target_str += '</select>';
		
		if(radio_val=='external'){
			$('#select_page_box').html('<label for="external_box">External URL</label> <input type="text" placeholder="http://" name="external_url"  id="external_url" required class="sf" />').show('slow');
			$('#link_target').html(link_target_str).show('slow');
		}
		else if(radio_val=='internal'){
			$.ajax({
				type: "POST",
				dataType: "text",
				url: "<?php echo base_url('generate-page-list'); ?>",
				success: function(data) { 
					$('#select_page_box').html(data).show('slow');
					$('#link_target').html(link_target_str).show('slow');
				}
			});
		}
		else{
			$('#select_page_box').hide('slow');
			$('#link_target').hide('slow');
		}
	});	
	//*******************************************************************//
});
</script>
<!--  Sorting   -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index)
		{
		  $(this).width($originals.eq(index).width())
		});
		return $helper;
	};
	
	$("#diagnosis_list tbody").sortable({
    	helper: fixHelperModified,
		stop: function(event,ui) {renumber_table('#diagnosis_list')}
	}).disableSelection();
});
function renumber_table(tableID) {
	$(tableID + " tr").each(function() {
		count = $(this).parent().children().index($(this)) + 1;
		var myhtml = count+'<input type="hidden" name="sort_order[]" value="'+count+'" />';
		$(this).find('.priority').html(myhtml);
	});
}
</script>
-->
<style type="text/css">
.ui-sortable tr {
	cursor: pointer;
}
.ui-sortable tr:hover {
	background-color: #E9E9E9;
}
</style>
<!--  Sorting   -->
</head>