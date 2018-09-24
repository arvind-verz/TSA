<!DOCTYPE html>
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="http://localhost/CodeIgniter/verzpackages/favicon.ico" type="image/x-icon" />
<title>Page Not Found |<?php echo $this->all_function->get_site_options('site_name');?></title>
<meta name="description" content="<?php echo $this->all_function->get_site_options('site_name');?>" />
<meta name="keywords" content="<?php echo $this->all_function->get_site_options('site_name');?>" />
<link rel="SHORTCUT ICON" href="<?php echo image('favicon.ico'); ?>" type="image/x-icon" />
<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><!--<![endif]-->
<?php echo css('style') ?><?php echo css('fonts') ?><?php echo css('responsive') ?><?php echo css('reset') ?><?php echo css('menu') ?><?php echo css('all.min') ?><?php echo css('detail') ?><?php echo css('fontello') ?><?php echo js('jquery.min') ?><?php echo js('jquery.magnific-popup.min') ?><?php echo js('menu') ?><?php echo js('jquery.marquee') ?><?php echo js('news') ?><?php echo js('jquery.infieldlabel.min') ?><?php echo js('jquery_01') ?>
<script type="text/javascript">
       $(function(){ $("label").inFieldLabels(); });
</script>
<?php echo js("validation"); ?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <section class="banner_wrap">
    <div class="center">
      <div class="inner_caption">
        <h2>Page not found </h2>
      </div>
      <img src="<?php echo image('banner_03.jpg'); ?>" alt=""> </div>
  </section>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <h1 class="page_title">Page not found</h1>
        <div class="about_content">
          <article> Error 404 - Page Not Found<br>
            Something broke - please try again! </article>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/brands'); ?>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>
