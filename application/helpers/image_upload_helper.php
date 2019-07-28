<?php
defined('BASEPATH') or exit('No direct script access allowed');

function upload_image_file($image_file, $image_placeholder, $width, $height)
{
    $ci = &get_instance();

    $config['file_name'] =$file_name    = uniqid() . '__' . $image_file;
    $config['upload_path']   = './assets/files/' . $image_placeholder . '/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 10000;
	
	

    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);

    if ($ci->upload->do_upload($image_placeholder)) {
		$width=363;
		$height=242;
        upload_image_resize($config['file_name'], $width, $height, $image_placeholder,$file_name);
        return $ci->upload->data('file_name');
    }
}

function upload_image_resize($image_file, $width, $height, $image_placeholder,$file_name)
{
    $ci = &get_instance();
	
    $config['image_library']  = 'gd2';
    $config['source_image']   = './assets/files/'. $image_placeholder .'/' . $image_file;
	$config['new_image']   = './assets/files/'. $image_placeholder .'/thumb-' . $image_file;
    $config['overwrite']      = true;
    $config['maintain_ratio'] = true;
    $config['width']          = $width;
    $config['height']         = $height;

    $ci->load->library('image_lib', $config);
    $ci->image_lib->initialize($config);
	if ( ! $ci->image_lib->resize())
	{
	echo $ci->image_lib->display_errors();die;
	}
}
