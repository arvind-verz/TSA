<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <title>
        <?php echo $title; ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/plugins/Ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css'); ?>">
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/dist/css/AdminLTE.css'); ?>" rel="stylesheet">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet">
        <!-- Morris chart -->
        <link href="<?php echo base_url('assets/plugins/morris.js/morris.css'); ?>" rel="stylesheet">
        <!-- jvectormap -->
        <link href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap.css'); ?>" rel="stylesheet">
        <!-- Date Picker -->
        <link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- Daterange picker -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/iCheck/all.css'); ?>" rel="stylesheet">
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" rel="stylesheet">

        <script src="<?php echo base_url('assets/plugins/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
        
        <script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/moment-with-locales.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url();?>editor/tinymce/tinymce.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>editor/fancybox/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>editor/fancybox/jquery.fancybox.js"></script>
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
   document_base_url: '<?php echo base_url();?>',
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | edit  tools, emoticons",
   browser_spellcheck: true,
   contextmenu: false,
   image_advtab: true ,   
   external_filemanager_path:"<?php echo base_url();?>editor/filemanager/",
   filemanager_title:"Filemanager" ,
   filemanager_access_key:'',
   external_plugins: { "filemanager" : "<?php echo  base_url();?>editor/filemanager/plugin.min.js"}
 }); 

</script>
<script>
jQuery(document).ready(function(){
    //*******************************************************************//
	$('input:radio[name=link_type]').click(function(){
		radio_val = $(this).val();
		
		link_target_str = '';
		
		link_target_str += '<label for="link_target">Page Target: </label>';
		link_target_str += '<select name="link_target" class="form-control">';
		link_target_str += '<option value="self">Same Tab</option>';
		link_target_str += '<option value="new_tab">New Tab</option>';
		link_target_str += '</select>';
		
		if(radio_val=='external'){
			$('#select_page_box').html('<label for="external_box">External URL</label> <input type="text" placeholder="http://" name="external_url"  id="external_url" required class="sf" />').show('slow');
			$('#link_target').html(link_target_str).show('slow');
		}
		else if(radio_val=='internal'){
			$.ajax({
				type: "GET",
				dataType: "text",
				url: "<?php echo site_url('admin/generate-page-list');?>",
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
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a class="logo" href="<?php echo site_url('admin/dashboard'); ?>">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">
                        <b>
                        TSA
                        </b>
                    </span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">
                        <b>
                        TSA
                        </b>
                        Panel
                    </span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a class="sidebar-toggle" data-toggle="push-menu" href="#" role="button">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <img alt="User Image" class="user-image" src="<?php echo base_url('assets/images/user.png'); ?>">
                                    <span class="hidden-xs">
                                        <?php
                                        $result = $this->session->userdata('user_credentials');
                                        echo $result['username'];
                                        ?>
                                    </span>
                                    </img>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img alt="User Image" class="img-circle" src="<?php echo base_url('assets/images/user.png'); ?>">
                                        <p>
                                            <?php
                                            $result = $this->session->userdata('user_credentials');
                                            echo $result['username'];
                                            ?>
                                        </p>
                                        </img>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a class="btn btn-default btn-flat" href="<?php echo site_url('admin/users/profile'); ?>">
                                                Profile
                                            </a>
                                        </div>
                                        <div class="pull-right">
                                            <a class="btn btn-default btn-flat" href="<?php echo site_url('admin/logout'); ?>">
                                                Sign out
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
                                <a data-toggle="control-sidebar" href="#">
                                    <i class="fa fa-gears">
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>