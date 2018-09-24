<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_function {

    function __construct() {
        $this->CI = &get_instance();
    }
	function ellipsis($text, $max=100, $append='&hellip;') 
    {
		if (strlen($text) <= $max) return $text;
	
		$replacements = array(
			'|<br /><br />|' => ' ',
			'|&nbsp;|' => ' ',
			'|&rsquo;|' => '\'',
			'|&lsquo;|' => '\'',
			'|&ldquo;|' => '"',
			'|&rdquo;|' => '"',
		);
	
		$patterns = array_keys($replacements);
		$replacements = array_values($replacements);
	
	
		$text = preg_replace($patterns, $replacements, $text); // convert double newlines to spaces
		$text = strip_tags($text); // remove any html.  we *only* want text
		$out = substr($text, 0, $max);
		if (strpos($text, ' ') === false) return $out.$append;
		
		return preg_replace('/(\W)&(\W)/', '$1&amp;$2', (preg_replace('/\W+$/', ' ', preg_replace('/\w+$/', '', $out)))) . $append;
    }
	function get_category_name_row($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_category_name($id)->row_array();
        return $get_result;
    }
	function get_category_name($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_category_name($id)->result_array();
        if(isset($get_result[0]['cat_name'])){
		$result = $get_result[0]['cat_name'];
		}else{
			$result = '';
		}
        return $result;
    }
	function get_blog_category_name($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_blog_category_name($id)->result_array();
        if(isset($get_result[0]['cat_name'])){
		$result = $get_result[0]['cat_name'];
		}else{
			$result = '';
		}
        return $result;
    }
	
	function get_brand_name($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_brand_name($id)->result_array();
        if(isset($get_result[0]['brands_name'])){
		$result = $get_result[0]['brands_name'];
		}else{
			$result = '';
		}
        return $result;
    }
	function get_site_logo($option_code, $field_name) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_site_logo($option_code)->row_array();
        return $result_array[$field_name];
    }
	function get_products_visualise_info($visualise_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_products_visualise_info($visualise_id)->row_array();
        return $result_array;
    }
	function get_products_info($products_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_products_info($products_id)->row_array();
        return $result_array;
    }
	function get_cart_products_details($cart_id,$item_id,$products_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_cart_products_details($cart_id,$item_id,$products_id)->result_array();
        return $result_array;
    }
	function get_products_option_info($products_options_id,$products_options_values_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_products_option_info($products_options_id,$products_options_values_id)->row_array();
        return $result_array;
    }
	
	
	function get_slot_member($unit_no,$slots) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_slot_member($unit_no,$slots)->result_array();
        $result = $get_result;

        return $result;
    }
	
	
	function get_due_date($nric, $slot_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_due_date_details($nric, $slot_id)->result_array();
		//var_dump($get_result);
		if(isset($get_result[0]['id'])){$result = 1;}else{$result =0;}
        return $result;
    }
	function get_template($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_template_details($id)->row_array();
        return $result_array;
    }
	function get_options_values($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_options_values($id)->result_array();
        return $result_array;
    }
	function get_products_options_values($id,$products_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_products_options_values($id,$products_id)->result_array();
        return $result_array;
    }	
	function get_products_attributes_selected($products_id, $options_id, $options_values_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
		
        $result_array = $CI->All_function_model->get_products_attributes_selected($products_id, $options_id, $options_values_id);
        return $result_array;
    }
	function get_products_options_selected($products_id, $options_id, $options_values_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
		
        $result_array = $CI->All_function_model->get_products_options_selected($products_id, $options_id, $options_values_id);
        return $result_array;
    }
	function get_glossary_products_selected($glossary_id,$products_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
		
        $result_array = $CI->All_function_model->get_glossary_products_selected($glossary_id,$products_id);
        return $result_array;
    }
	function get_blog_title($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_blog_title($id)->result_array();
        if(isset($get_result[0]['title'])){
		$result = $get_result[0]['title'];
		}else{
			$result = '';
		}
        return $result;
    }
	function get_parent_category($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_parent_category($id)->result_array();
        if(isset($get_result[0]['cat_name'])){
		$result = $get_result[0]['cat_name'];
		}else{
			$result = 'Root';
		}
        return $result;
    }
	function get_parent_menu($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_parent_menu($id)->result_array();
		//var_dump($get_result);
        if(isset($get_result[0]['menu_title'])){
		$result = $get_result[0]['menu_title'];
		}else{
			$result = 'Root';
		}
        return $result;
    }
	function get_menu_position_display($position) {
        $CI = & get_instance();
        $CI->load->model('Cms_model', '', TRUE);

        $get_result = $CI->Cms_model->get_menu_position_display($position)->result_array();
        if(isset($get_result[0]['display_name'])){
		$result = $get_result[0]['display_name'];
		}else{
			$result = 'Others';
		}
        return $result;
    }
	function get_last_login_details($member_id) {
        $CI = & get_instance();
        $CI->load->model('user_model', '', TRUE);

        $get_result = $CI->user_model->get_last_login($member_id)->result_array();
        
		if(isset($get_result[0]['login_time'])){
			$result = $get_result[0]['login_time'];
		}else{
			$result = '';
			}
        return $result;
    }

	function get_last_login_ip($user_id) {
        $CI = & get_instance();
        $CI->load->model('user_model', '', TRUE);

        $get_result = $CI->user_model->get_last_login_ip($user_id)->result_array();
		if(isset($get_result[0]['ip_address'])){
        $result = $get_result[0]['ip_address'];
		}else{ $result = 0;}

        return $result;
    }
	function get_user_role($user_type) {
        $CI = & get_instance();
        $CI->load->model('user_model', '', TRUE);

        $get_result = $CI->user_model->get_role($user_type)->result_array();
        $result = $get_result[0]['role_name'];

        return $result;
    }

 	 function get_messages_no($user_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        $get_result = $CI->All_function_model->get_count_messages($user_id);
        return $get_result;
    }
	

    function resize_image($config = array(), $index = NULL) {
        $product_image_name = $this->rand_string(6); // generate new name for the profile

        $temp_image_with_path = ABSOLUTE_PATH . 'assets/upload/' . $config['temp'] . $product_image_name; 
		
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
        $this->CI->load->library('resize_image');

        $image_resize = $this->CI->resize_image;
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
            $image_resize->save_folder = ABSOLUTE_PATH . 'assets/upload/' . $save;
            $process = $image_resize->resize();
        }
        if (is_file($temp_image_with_path)) {
            @unlink($temp_image_with_path);
        }
        return $process['file_new_name'];
    }
	

    function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        $time = time();
        $val = $time . $rand;

        return $val;
    }
	

    function fetch_email_content($email_code) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->fetch_email_content($email_code)->result_array();
        return $result_array[0];
    }

    function rand_string_pass($digits) {
        $alphanum = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);

        return $rand;
    }

    function valid_numeric_stock($stock) {
        if (!preg_match("/^[0-9]+$/", $stock)) {
            return false;
        } else {
            return true;
        }
    }

    /*
     * fetch messages
     */

    function fetch_message($msg_index, $lang = 'es') {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->fetch_message($msg_index, $lang)->result_array();
        if (!isset($result_array[0]['Content'])) {
            log_message('error', $msg_index);
        }
        return $result_array[0]['Content'];
    }

    function get_site_value_by_name($option_name) {
        $CI = & get_instance();
        $CI->load->model('Siteoptionsdb', '', TRUE);

        $get_result = $CI->Siteoptionsdb->get_site_value_by_name($option_name)->result_array();
        $result = $get_result[0]['OptionValue'];

        return $result;
    }

    /*
     * Get email template
     */

    function get_email_template($option_name) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $get_result = $CI->All_function_model->get_email_template_by_name($option_name)->result_array();
        //$result = $get_result[0]['Body'];

        return $get_result[0];
    }

    function get_country_list($selected, $single = false) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $val = array();

        $get_country_list = $CI->All_function_model->get_country_list();
        $get_country_list = $get_country_list->result_array();

        if ($single) {
            if ($selected != '' && isset($get_country_list[$selected])) {

                return $get_country_list[$selected];
            } else {
                return '';
            }
        }
        $html = '<option value="" >Select country</option>';
        foreach ($get_country_list as $key => $val) {
            if ($selected != '') {
                if ($selected == $key) {
                    $html .='<option value="' . $val['country_id'] . '" selected="selected">' . $val['country_name'] . '</option>';
                } else {
                    $html .='<option value="' . $val['country_id'] . '" >' . $val['country_name'] . '</option>';
                }
            } else {
                $html .='<option value="' . $val['country_id'] . '" >' . $val['country_name'] . '</option>';
            }
        }
        return $html;
    }

    function get_country_name_by_id($code) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $val = '';
        $result = $CI->All_function_model->get_country_name_by_id($code);

        if ($result->num_rows() > 0) {
            $result_array = $result->result_array();
            $val = $result_array[0]['country_name'];
        }
        return $val;
    }

    function get_site_options($option_code) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_site_options($option_code)->row_array();
        return $result_array['option_value'];
    }

    public function get_file_extension($file) {
        $val = '';
        if ($file != '') {
            $extension = explode('.', $file);
            $count_ext = count($extension);
            $extention = strtolower($extension[$count_ext - 1]);
            if ($extention != '')
                $val = $extention;
        }

        return $val;
    }

    public function check_valid_file_extension($ext, $valid_ext = NULL) {
        if ($valid_ext == NULL)
            $valid_ext = array('jpg', 'jpeg', 'gif', 'png');

        $val = in_array($ext, $valid_ext) ? TRUE : FALSE;

        return $val;
    }

    function check_image_valid($image) {
        $mime = array(
            'image/gif',
            'image/jpeg',
            'image/png'
        );
        $file_info = getimagesize($image);

        if (empty($file_info)) { // No Image?
            return false;
        } else { // An Image?
            $file_mime = $file_info['mime'];
            if (in_array($file_mime, $mime))
                return true;
            else
                return false;
        }
    }

    
    
    function send_email($to, $subject, $body, $attachment = NULL) {
        $CI = & get_instance();
        $support_email = $this->get_site_options('support_email');
        $support_name = $this->get_site_options('support_name');


        $CI->load->library('email');

        $CI->email->clear()
                ->to($to)
                ->from($support_email, $support_name)
                ->subject($subject)
                ->message($body);

        if ($attachment != NULL) {
            $CI->email->attach($attachment);
        }

        $CI->email->send();
    }

    function check_image_extension($image) {
        $imagelower = strtolower($image);
        $img_arr = explode('.', $imagelower);
        $img_ext = $img_arr[count($img_arr) - 1];
        $ext_arr = array('jpeg', 'jpg', 'gif', 'png');
        if (in_array($img_ext, $ext_arr))
            return true;
        else
            return false;
    }

    // max size mention in digit only (MB)
    function check_image_size($image_org_size, $max_size = 2, $unit = 'MB') {
        switch ($unit) {
            case 'MB':
                $image_max_size = $max_size * pow(1024, 2);
                break;
            case 'KB':
                $image_max_size = $max_size * pow(1024, 1);
                break;
        }

        if ($image_org_size <= $image_max_size)
            return true;
        else
            return true;
    }

    //================= 4.1 prasen start ==============//
        
    function get_country() {
        $CI = & get_instance();
        $country = $CI->db->select('*')->from(TBL_COUNTRY)->get()->result_array();
        $country_array = array();
        $country_array[''] = lang('global:select-pick');
        foreach ($country as $key => $val) {
            $country_array[$val['country_id']] = $val['country_name'];
        }
        return $country_array;
    }

    function get_country_name($id) {
        $CI = & get_instance();
        $country = $CI->db->select('*')->from(TBL_COUNTRY)->where('country_id', $id)->get()->row_array();
        $country_name = $country['country_name'];

        return $provience_name;
    }

    function get_provience() {
        $CI = & get_instance();
        $provience = $CI->db->select('*')->from(TBL_PROVINCE)->get()->result_array();

        $provience_array = array();
        $provience_array[''] = lang('global:select-pick');
        foreach ($provience as $key => $val) {
            $provience_array[$val['prov_code']] = $val['province_name'];
        }
        return $provience_array;
    }

    function get_provience_name_by_id($id) {
        $CI = & get_instance();
        $provience = $CI->db->select('*')->from(TBL_PROVINCE)->where('prov_code', $id)->get()->row_array();
        $provience_name = $provience['province_name'];

        return $provience_name;
    }

    function get_user_fullName($user_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result = $CI->All_function_model->get_user_fullname($user_id)->result_array();
        $full_name = $result[0]['first_name'] . ' ' . $result[0]['name'];

        return $full_name;
    }
    
    function get_user_info($user_id) {
        $CI = & get_instance();
        $CI->db->select('um.*,ud.*')
                ->from(TBL_USER_MASTER . ' as um')
                ->join(TBL_USER_DETAIL . ' as ud', 'ud.uid = um.id')
                ->where('um.id', $user_id)
                ->where('um.status', '1');

        return $CI->db->get()->row_array();
    }

  
    function activity_list() {

        $this->CI->db->select('*')->from(TBL_ACTIVITY_DATA)
                ->where('status', 'A')
                ->order_by('title', 'DESC');

        $accm_data = $this->CI->db->get()->result_array();
        $drop_down = array();

        $drop_down[''] = lang('global:select-pick');

        foreach ($accm_data as $key => $val) {
            $drop_down[$val['activity_id']] = $val['title'];
        }
        return $drop_down;
    }

    function all_country($select_country) {
        $CI = & get_instance();
        $country = $CI->db->select('country_id, country_name')
                        ->from(TBL_COUNTRY)->where('status', '1')->get()->result_array();
        $country_array = array();
        $country_array[''] = $select_country;

        foreach ($country as $key => $val) {
            $country_array[$val['country_id']] = $val['country_name'];
        }
        return $country_array;
    }

    function get_country_by_id($country_id) {
        $CI = & get_instance();
        $provience = $CI->db->select('*')->from(TBL_COUNTRY)->where('country_id', $country_id)->where('status', '1')->get()->row_array();
        $country_name = $country['country_name'];

        return $country_name;
    }

   
    function count_tot_user($status) {
        $CI = & get_instance();   
        
        $CI->db->select('count(um.id) as `TotalNum`');
       
        $CI->db->from(TBL_USER_DETAIL . ' as ud')
                    ->join(TBL_USER_MASTER . ' as um', "ud.uid=um.id");
       
        
        $CI->db->where('um.status', $status);       
        
        $query = $CI->db->get()->result_array();
        //$CI->db->last_query();
        $val = $query[0]['TotalNum'];

        return $val;
    }
    
    function count_tot_job($status) {
        $CI = & get_instance();   
        
        $CI->db->select('count(id) as `TotalNum`');       
        $CI->db->from(TBL_JOB_MASTER);        
        $CI->db->where('job_status', $status);       
        
        $query = $CI->db->get()->result_array();
        //$CI->db->last_query();
        $val = $query[0]['TotalNum'];

        return $val;
    }
    
    function clean($str) {
        if ($str) {
            $str = strip_tags(addslashes(stripslashes(htmlspecialchars($str))));
            return $str;
        } else {
            return FALSE;
        }
    }
    
    
    function get_parent_job_category_dropdown($selected_id = null) {

        $option = '<option value="">Select Category</option>';
        $category = array();
        $this->CI->db->select('id,name')
                ->from(TBL_JOB_CATEGORY)
                ->where('pid', '')
                ->where('status', '1')
                ->order_by('order', 'DESC');
        $result = $this->CI->db->get();
        if ($result->num_rows()) {
            $category = $result->result_array();
        }
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['id']) {
                $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
            } else {
                $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
            }
        }
        return $option;
    }

    function get_child_job_category_dropdown($p_id = null, $selected_id = null) {

        $option = '<option value="">Select Sub Category</option>';
        if ($p_id != null) {
            $sub_category = array();
            $this->CI->db->select('id,name')
                    ->from(TBL_JOB_CATEGORY)
                    ->where('pid', $p_id)
                    ->where('status', '1')
                    ->order_by('order', 'DESC');
            $result = $this->CI->db->get();
            // echo $this->CI->db->last_query();
            if ($result->num_rows()) {
                $sub_category = $result->result_array();
            } else {
                $option = '<option value="">Select Sub Category</option>';
            }

            foreach ($sub_category as $k => $v) {
                if ($selected_id != '' && $selected_id == $v['id']) {
                    $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
                } else {
                    $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
                }
            }
        } else {
            $option = '<option value="">Select Sub Category</option>';
        }
        return $option;
    }
       
    function get_budget_dropdown($selected_id = null) {

        $option = '';
                  
        $category = array(
            0 => array(
                'id' => '1',
                'name' => 'Fixed'
            ),
            1 => array(
                'id' => '2',
                'name' => 'Variable'
            ),
        );
        
        
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['id']) {
                $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
            } else {
                $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
            }
        }
        return $option;
    }
    
    function get_job_currency_dropdown($selected_id = null) {

        $option = '';
        $category = array();
        $this->CI->db->select('pk_c_code,s_description')
                ->from(TBL_JOB_CURRENCY)               
                ->where('b_enabled', '1')
                ->order_by('s_description', 'DESC');
        $result = $this->CI->db->get();
        if ($result->num_rows()) {
            $category = $result->result_array();
        }
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['pk_c_code']) {
                $option .= '<option value="' . $v['pk_c_code'] . '" selected="selected">' . $v['s_description'] . '</option>';
            } else {
                $option .= '<option value="' . $v['pk_c_code'] . '">' . $v['s_description'] . '</option>';
            }
        }
        return $option;
    }
    
    function get_job_variable_type_dropdown($selected_id = null) {

        $option = '';
                  
        $category = array(
            0 => array(
                'id' => '1',
                'name' => 'Hourly'
            ),
            1 => array(
                'id' => '2',
                'name' => 'Weekly'
            ),
        );
        
        
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['id']) {
                $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
            } else {
                $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
            }
        }
        return $option;
    }
    
    function get_country_dropdown($selected_id = null) {

        $option = '<option value="">-Select Country-</option>';
        $category = array();
        $this->CI->db->select('countries_iso_code_2,countries_name')
                ->from(TBL_COUNTRIES)                
                ->where('status', 'Y')
                ->order_by('countries_name', 'ASC');
        $result = $this->CI->db->get();
        if ($result->num_rows()) {
            $category = $result->result_array();
        }
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['countries_iso_code_2']) {
                $option .= '<option value="' . $v['countries_iso_code_2'] . '" selected="selected">' . $v['countries_name'] . '</option>';
            } else {
                $option .= '<option value="' . $v['countries_iso_code_2'] . '">' . $v['countries_name'] . '</option>';
            }
        }
        return $option;
    }
    
    function get_parent_job_location_dropdown($selected_id = null) {

        $option = '<option value="">-Select Location-</option>';
        $category = array();
        $this->CI->db->select('id,name')
                ->from(TBL_JOB_LOCATION)
                ->where('pid', '')
                ->where('status', '1')
                ->order_by('order', 'DESC');
        $result = $this->CI->db->get();
        if ($result->num_rows()) {
            $category = $result->result_array();
        }
        foreach ($category as $k => $v) {
            if ($selected_id != '' && $selected_id == $v['id']) {
                $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
            } else {
                $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
            }
        }
        return $option;
    }

    function get_child_job_location_dropdown($p_id = null, $selected_id = null) {

        $option = '<option value="">-Select Sub Location-</option>';
        if ($p_id != null) {
            $sub_category = array();
            $this->CI->db->select('id,name')
                    ->from(TBL_JOB_LOCATION)
                    ->where('pid', $p_id)
                    ->where('status', '1')
                    ->where('label', '1')
                    ->order_by('order', 'DESC');
            $result = $this->CI->db->get();
            // echo $this->CI->db->last_query();
            if ($result->num_rows()) {
                $sub_category = $result->result_array();
            } else {
                $option = '<option value="">-Select Sub Location-</option>';
            }

            foreach ($sub_category as $k => $v) {
                if ($selected_id != '' && $selected_id == $v['id']) {
                    $option .= '<option value="' . $v['id'] . '" selected="selected">' . $v['name'] . '</option>';
                } else {
                    $option .= '<option value="' . $v['id'] . '">' . $v['name'] . '</option>';
                }
            }
        } else {
            $option = '<option value="">-Select Sub Location-</option>';
        }
        return $option;
    }
    public function batch_email($to, $from, $formname, $recipients, $subject, $message) 
	{
	   $config = Array(
			      'protocol' => $this->get_site_options('protocol'),
			      'smtp_host' => $this->get_site_options('smtp_host'),
			      'smtp_port' => $this->get_site_options('smtp_port'),
			      'smtp_user' => $this->get_site_options('smtp_user'),
			      'smtp_pass' => $this->get_site_options('smtp_pass'),
				  'mailtype' => $this->get_site_options('mailtype'), 
        		  'charset'   => $this->get_site_options('charset')
			);
	  $this->CI->load->library('email', $config);
	  $this->CI->email->clear(TRUE);
	  $this->CI->email->from($from, $formname); 
	  $this->CI->email->to($to);
	  $this->CI->email->bcc($recipients);
	  $this->CI->email->subject($subject);
	  $this->CI->email->message($message);  
	
	  $this->CI->email->send();
	  
	  //echo $this->CI->email->print_debugger(); die();
	  return TRUE;
	
	}
	
	public function batch_email_attach($to, $from, $formname, $recipients, $subject, $message, $attachFile) 
	{
	   $config = Array(
			      'protocol' => $this->get_site_options('protocol'),
			      'smtp_host' => $this->get_site_options('smtp_host'),
			      'smtp_port' => $this->get_site_options('smtp_port'),
			      'smtp_user' => $this->get_site_options('smtp_user'),
			      'smtp_pass' => $this->get_site_options('smtp_pass'),
				  'mailtype' => $this->get_site_options('mailtype'), 
        		  'charset'   => $this->get_site_options('charset')
			);
	  $this->CI->load->library('email', $config);
	  $this->CI->email->clear(TRUE);
	  $this->CI->email->from($from, $formname); 
	  $this->CI->email->to($to);
	  $this->CI->email->bcc($recipients);
	  $this->CI->email->subject($subject);
	  $this->CI->email->message($message); 
	  $this->CI->email->attach($attachFile); 
	
	  $this->CI->email->send();
	  //echo $this->CI->email->print_debugger(); die();
	  return TRUE;
	
	}
    
    
}

?>