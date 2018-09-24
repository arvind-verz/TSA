<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_function {

    private $CI = '';	
    function __construct() {
        $this->CI = & get_instance();
    }
	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}
	function get_menu_pid_Mposition($pid,$Mposition) {		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_menu_pid_Mposition($pid,$Mposition);		
    }
	function processURL($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
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
	function get_item_viewed($products_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_item_viewed($products_id);
		
    }
	
	function get_item_viewed_tools($products_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_item_viewed_tools($products_id);
		
    }

	
	
	
	function get_products_options_values($id,$products_id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_products_options_values($id,$products_id)->result_array();
        return $result_array;
    }
	function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        $time = time();
        $val = $time . $rand;

        return $val;
    }
	function get_author_name($admin_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_author_name($admin_id);
		
    }
	function get_comments_no($blog_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_comments_no($blog_id);
		
    }
	function get_top_categories($parent_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_top_categories($parent_id);
		
    }
	function get_sub_categories($cat_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_sub_categories($cat_id)->result_array();
		
    }
	function get_sub_categories_tools($cat_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);
        return $CI->All_function_model->get_sub_categories_tools($cat_id)->result_array();
		
    }
	
	
	function get_cart_product($products_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_cart_product($products_id)->result_array();
		
    }
	function get_recommend($cat_id,$id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_recommend($cat_id,$id)->result_array();
		
    }
	
	function get_recommend_tools($cat_id,$id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_recommend_tools($cat_id,$id)->result_array();
		
    }
	
	
	
	function get_cart_product_option_name($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_cart_product_option_name($id);
		
    }
	function get_cart_product_option_value($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_cart_product_option_value($id);
		
    }
	function get_menu($position,$id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_menu_details($position,$id)->result_array();
		
    }
	function get_sub_cat($store_cat_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_sub_cat_details($store_cat_id)->result_array();
		
    }
	function get_sub_cat_store($store_id,$id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_store_sub_cat_details($store_id,$id)->result_array();
		
    }
	function get_values($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_values($id)->result_array();
		
    }
	function get_store($store_id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_store_details($store_id)->result_array();
		
    }
	function get_product_images($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_product_images($id)->result_array();
		
    }
	
	function get_product_images_tools($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_product_images_tools($id)->result_array();
		
    }
	
	
	
	
	function get_menu_pid($position,$url_name) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_menu_pid($position,$url_name);
		
    }
	function get_parent_menu($id) {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_parent_menu_details($id)->result_array();
		
    }
	function get_site_options($option_code) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_site_options($option_code)->row_array();
        return $result_array['option_value'];
    }
	
	
	function get_categories() {
		
		$CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_cat()->result_array();
		
    }
		  
	

    function get_seo($page_name) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        return $CI->All_function_model->get_seo($page_name)->result_array();
    }

    function get_cmstext_bypage($page_name) {
        $CI = & get_instance();

        $CI->load->model('All_function_model', '', TRUE);

        $val = $CI->All_function_model->get_cmstext_bypage($page_name);

        if ($val->num_rows == 0) {
            return "none";
        } else {
            $result = $val->result_array();
            foreach ($result as $v) {
                $cms_data[$v['Title']] = $v['Content'];
            }

            return $cms_data;
        }
    }
function redirectBaseUrl() {
        $this->CI->config->config['base_url'] = str_replace('https://', 'http://', $this->CI->config->config['base_url']);
        if ($_SERVER['SERVER_PORT'] == 443) {
            redirect(base_url($this->CI->uri->uri_string));
        }
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
	
	function get_template($id) {
        $CI = & get_instance();
        $CI->load->model('All_function_model', '', TRUE);

        $result_array = $CI->All_function_model->get_template_details($id)->row_array();
        return $result_array;
    }

}

?>