<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Allfunction extends CI_Model
    {
		
				  function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        $time = time();
        $val = $time . $rand;

        return $val;
    }	
		function resize_image($config = array(), $index = NULL) {
        $product_image_name = $this->rand_string(6); // generate new name for the profile

        $temp_image_with_path = MAIN_SITE_PATH . 'assets/upload/' . $config['temp'] . $product_image_name; 
		
        if (isset($config['source'])) {
            if (!is_null($index)) {
                $temporary_image = $_FILES[$config['source']]['tmp_name'][$index]; // temporary image file
            } else {
                $temporary_image = $_FILES[$config['source']]['tmp_name']; // temporary image file
            }
            move_uploaded_file($temporary_image, $temp_image_with_path);
        } elseif ($config['source2']) {
            $temp_image_with_path = $config['source2'];
            copy($temp_image_with_path, $temp_image_with_path);
        }
        $this->load->library('resize_image');

        $image_resize = $this->resize_image;
        $image_resize->image_to_resize = $temp_image_with_path;
        $image_resize->image_size(); // set orginal image size
        foreach ($config['resize'] as $val) {
            $width = isset($val['width']) ? $val['width'] : $image_resize->orginal_width;
            $height = isset($val['height']) ? $val['height'] : $image_resize->orginal_height;
            $save = $val['save'];
            //------------------------- start procession ----------------------------//
            $image_resize->new_width = $width;
            $image_resize->new_height = $height;
            $image_resize->ratio = (bool) isset($val['ratio']) ? $val['ratio'] : TRUE; // Keep Aspect Ratio?
            $image_resize->dynamic_ratio = (bool) isset($val['dynamic_ratio']) ? $val['dynamic_ratio'] : FALSE; // Keep Aspect Ratio?
            // Name of the new image (optional) - If it's not set a new will be added automatically
            $image_resize->new_image_name = $product_image_name;

            // Path where the new image should be saved. If it's not set the script will output the image without saving it
            $image_resize->save_folder = MAIN_SITE_PATH . 'assets/upload/' . $save;
            $process = $image_resize->resize();
        }
        if (is_file($temp_image_with_path)) {
            @unlink($temp_image_with_path);
        }
        return $process['file_new_name'];
    }	
	}
		
		
		