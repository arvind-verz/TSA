<?php
defined('BASEPATH') or exit('No direct script access allowed');

function upload_image_file($image_file, $image_placeholder, $do_resize)
{
    $ci = &get_instance();

    $config['file_name']     = uniqid() . '__' . $image_file;
    $config['upload_path']   = './assets/files/profile_picture/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size']      = 5000;

    $ci->load->library('upload', $config);
    $ci->upload->initialize($config);

    if ($ci->upload->do_upload($image_placeholder)) {
        if($do_resize==1) {
            upload_image_resize($config['file_name']);
        }
        return $ci->upload->data('file_name');
    }
}

function upload_image_resize($image_file)
{
    $ci = &get_instance();

    $config['image_library']  = 'gd2';
    $config['source_image']   = './assets/files/profile_picture/' . $image_file;
    $config['overwrite']      = true;
    $config['maintain_ratio'] = true;
    $config['width']          = 200;
    $config['height']         = 200;

    $ci->load->library('image_lib', $config);

    $ci->image_lib->initialize($config);

    $ci->image_lib->resize();
}
