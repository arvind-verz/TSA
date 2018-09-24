<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon" />
<link rel="icon" type="image/gif" href="<?php echo base_url(); ?>favicon.png"/>
<?php if(isset($page)){ 
	$seo_title = $page[0]['seo_title'];
	$seo_keywords = $page[0]['seo_keyword'];
	$seo_description = $page[0]['seo_description'];	
}else{
	$seo_title = '';
	$seo_keywords = '';
	$seo_description = '';
}?>
<title><?php if(isset($seo_title)) {echo $seo_title;}else {echo $meta_title." | ".$this->all_function->get_site_options('site_name');} ?></title>
<meta name="description" content="<?php if(isset($seo_description)) {echo $seo_description;}?>" />
<meta name="keywords" content="<?php if(isset($seo_keywords)) {echo $seo_keywords;}?>" />
<meta name="viewport" content="width=device-width; initial-scale=1.0;">