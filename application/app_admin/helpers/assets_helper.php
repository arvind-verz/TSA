<?php


  if(!defined('BASEPATH'))
          exit('No direct script access allowed');

  if(!function_exists('image'))
  {


          function image($image = '') {
                  $CI = &get_instance();
                  return $CI->config->base_url("assets/images/{$image}");
          }


  }


  if(!function_exists('icon'))
  {


          function icon($icon = '') {
                  $CI = &get_instance();
                  return $CI->config->base_url("assets/images/icons/{$icon}");
          }


  }



  if(!function_exists('loader'))
  {


          function loader($loader = '') {
                  $CI = &get_instance();
                  return $CI->config->base_url("assets/images/loaders/{$loader}");
          }


  }

  if(!function_exists('css'))
  {


          function css($file = '') {
                  $CI = &get_instance();
                  $file = $CI->config->base_url("assets/css/{$file}.css");
                  return '<link rel="stylesheet" media="screen" href="' . $file . '" />';
          }


  }




  if(!function_exists('js'))
  {


          function js($file = '') {
                  $CI = &get_instance();
                  $file = $CI->config->base_url("assets/js/{$file}.js");
                  return '<script type="text/javascript" src="' . $file . '"></script>';
          }


  }


  if(!function_exists('js_plugin'))
  {


          function js_plugin($file = '') {
                  $CI = &get_instance();
                  $file = $CI->config->base_url("assets/js/plugins/{$file}.js");
                  return '<script type="text/javascript" src="' . $file . '"></script>';
          }


  }


  if(!function_exists('js_custom'))
  {


          function js_custom($file = '') {
                  $CI = &get_instance();
                  $file = $CI->config->base_url("assets/js/custom/{$file}.js");
                  return '<script type="text/javascript" src="' . $file . '"></script>';
          }


  }


  if(!function_exists('js_wysiwyg'))
  {


          function js_wysiwyg() {
                  $CI = &get_instance();
                  $file1 = $CI->config->base_url("assets/js/plugins/wysiwyg/jquery.wysiwyg.js");
                  $file2 = $CI->config->base_url("assets/js/plugins/wysiwyg/wysiwyg.image.js");
                  $file3 = $CI->config->base_url("assets/js/plugins/wysiwyg/wysiwyg.link.js");
                  $file4 = $CI->config->base_url("assets/js/plugins/wysiwyg/wysiwyg.table.js");

                  $js = '<script type = "text/javascript" src = "' . $file1 . '"></script>';
                  $js .= '<script type = "text/javascript" src = "' . $file2 . '"></script>';
                  $js .= '<script type = "text/javascript" src = "' . $file3 . '"></script>';
                  $js .= '<script type = "text/javascript" src = "' . $file4 . '"></script>';

                  return $js;
          }


  }
  
  
  if (!function_exists('get_full_image')) {


    function get_full_image($path = '', $image = '') {
        return MAIN_SITE_URL . "assets/{$path}/{$image}";
//              $CI = &get_instance();
//                  return $CI->base_url("assets/{$path}/{$image}");
    }
	function get_site_image($path = '', $image = '') {
        return SITE_URL . "assets/{$path}/{$image}";

    }
	

}
