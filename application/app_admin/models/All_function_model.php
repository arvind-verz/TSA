<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_function_model extends CI_Model {

    function get_cart_products_list($cart_id) {
                  $this->db->select('p.*')
                          ->from(TBL_PRODUCTS . ' as `p`')
						  ->join(TBL_CART_PRODUCTS . ' as `cp`' , 'p.id = cp.products_id')
                          ->where('cp.cart_id' , $cart_id);
                  $query = $this->db->get()->result_array();
                  return $query;
          } 
	function get_parent_menu($id) {
                  $this->db->select('*')
                          ->from(TBL_MENU)
                          ->where('id' , $id);

                   $query = $this->db->get();
				  
				  //echo $this->db->last_query();
				  return $query;
    }
	function get_cart_products_details($cart_id,$products_id) {
                  $this->db->select('*')
                          ->from(TBL_CART_PRODUCTS)
                          ->where('cart_id' , $cart_id)
						  ->where('products_id' , $products_id)
						  ->order_by('enquiry_cart_id');
                  $query = $this->db->get();
                  return $query;
          } 
	function get_blog_category_name($bcat_id) {
		  $this->db->select('*')
				  ->from(TBL_BLOG_CAT)
				  ->where('bcat_id' , $bcat_id);
		  return $this->db->get();
    }
	function get_category_name($cat_id) {
		  $this->db->select('*')
				  ->from(TBL_CATEGORIES)
				  ->where('cat_id' , $cat_id);
		  return $this->db->get();
    }
	
	function get_tools_category_name($cat_id) {
		  $this->db->select('*')
				  ->from(TBL_TOOLS_CATEGORIES)
				  ->where('cat_id' , $cat_id);
		  return $this->db->get();
    }
	
	
	
	function get_brand_name($id) {
		  $this->db->select('*')
				  ->from(TBL_PRODUCTS_BRANDS)
				  ->where('id' , $id);
		  return $this->db->get();
    }
	function get_blog_title($id) {
		  $this->db->select('*')
				  ->from(TBL_BLOG)
				  ->where('id' , $id);
		  return $this->db->get();
    }
	function get_parent_category($parent_id) {
		  $this->db->select('*')
				  ->from(TBL_CATEGORIES)
				  ->where('cat_id' , $parent_id);
		  return $this->db->get();
    }
	
	function get_parent_tools_category($parent_id) {
		  $this->db->select('*')
				  ->from(TBL_TOOLS_CATEGORIES)
				  ->where('cat_id' , $parent_id);
		  return $this->db->get();
    }
	
	
	function get_site_logo($option_code) {
        $this->db->select('*')
                ->from(TBL_LOGO)
                ->where('option_name', $option_code);

        $query = $this->db->get();
        return $query;
    }
	function get_products_visualise_info($visualise_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS_VISUALISE)
                ->where('visualise_id', $visualise_id);

        $query = $this->db->get();
        return $query;
    }
	function get_products_info($products_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS)
                ->where('id', $products_id);

        $query = $this->db->get();
        return $query;
    }
	function get_products_option_info($products_options_id,$products_options_values_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES)
                ->where('products_options_id', $products_options_id)
				->where('products_options_values_id', $products_options_values_id);

        $query = $this->db->get();
        return $query;
    }
	
	
	function get_country_list() {
        $this->db->select('*')
                ->from(TBL_COUNTRY)
                ->where('status', 'Y');
        $query = $this->db->get();
        return $query;
    }
	 function get_slot_member($units,$slot) {
                  $this->db->select('*')
                          ->from(TBL_MEMBERS_SLOTS)
                          ->where('slot' , $slot)
						  ->where('units' , $units);

                  return $this->db->get();
          }
		  
	function get_due_date_details($nric, $slot_id) {
         $this->db->select('p.id, pb.due_date')
				  ->from(TBL_PAYMENT . ' as `p`' )
				  ->join(TBL_PAYMENT_BALANCE . ' as `pb`' , 'p.id = pb.agreement_id')
				  ->where('p.nric' , $nric)
				  ->where('p.slot_id' , $slot_id)
				  ->where('pb.due_date < NOW()')
				  ->where('pb.outstanding_amount > 0 ');
		  $query = $this->db->get();
		  //echo $this->db->last_query(); 
		  return $query;
    }
	
	function get_template_details($id) {

        $this->db->select('*')
                ->from(TBL_EMAIL_TEMP)
                ->where('id', $id);

        $query = $this->db->get();
        return $query;
    }
	function get_options_values($products_options_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES)
                ->where('products_options_id', $products_options_id);

        $query = $this->db->get();
        return $query;
    }
	function get_products_options_values($products_options_id,$products_id) {

        $this->db->select('v.*')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES. ' as `v`')
				->join(TBL_PRODUCTS_ATTRIBUTES . ' as `a`' , 'a.options_values_id = v.products_options_values_id')
                ->where('a.options_id', $products_options_id)
				->where('a.products_id', $products_id);

        $query = $this->db->get();
        return $query;
    }

				  
				  
	function get_products_options_selected($products_id, $options_id, $options_values_id) {
		 $val = 0;
         $this->db->select('count(visualise_id) as `TotalNum`')
                          ->from(TBL_PRODUCTS_VISUALISE)
						  ->where('products_id ', $products_id)
						  ->where('option_'.$options_id, $options_values_id);

         $query = $this->db->get()->result_array();
		 //echo $this->db->last_query(); 
         return $query[0]['TotalNum'];
    }
	function get_products_attributes_selected($products_id, $options_id, $options_values_id) {
		 $val = 0;
         $this->db->select('count(products_attributes_id) as `TotalNum`')
                          ->from(TBL_PRODUCTS_ATTRIBUTES)
						  ->where('products_id ', $products_id)
						  ->where('options_id', $options_id)
						  ->where('options_values_id ', $options_values_id);

         $query = $this->db->get()->result_array();
		 //echo $this->db->last_query(); 
         return $query[0]['TotalNum'];
    }
	function get_glossary_products_selected($glossary_id,$products_id) {
		 $val = 0;
         $this->db->select('count(gp_id) as `TotalNum`')
                          ->from(TBL_GLOSSARY_PRODUCTS)
						  ->where('products_id ', $products_id)
						  ->where('glossary_id ', $glossary_id);

         $query = $this->db->get()->result_array();
		 //echo $this->db->last_query(); 
         return $query[0]['TotalNum'];
    }
	function get_count_messages($admin_username) {
         $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_MESSAGES)
						  ->where('read ', 'N')
						  ->where('trash', 'N')
						  ->where('to_username ', $admin_username);

         $query = $this->db->get()->result_array();
         if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }

         return $val;
    }
	

    function fetch_email_content($email_code) {

        $this->db->select('subject AS `Subject`, body AS `Body`')
                ->from(TBL_EMAIL_NOTIFICATION)
                ->where('email_code', $email_code)
                ->where('status', '1');

        $query = $this->db->get();
        return $query;
    }

    public function get_country_name_by_id($code) {
        $this->db->select('country_name')
                ->from(TBL_COUNTRY)
                ->where('country_id', $code)
                ->where('status', '1');

        $query = $this->db->get();
        return $query;
    }

    /*
     * this function fetches the email subject and body.
     */

    function get_site_options($option_code) {

        $this->db->select('*')
                ->from(TBL_SITE_OPTIONS)
                ->where('option_name', $option_code);

        $query = $this->db->get();
        return $query;
    }

    /*
     * this function fetches the email subject and body.
     */

    function get_email_template_by_name($option_name) {
        $this->db->select('*')
                ->from(TBL_EMAIL_NOTIFICATION)
                ->where('email_code', $option_name);
        $query = $this->db->get();

        return $query;
    }

    function get_all_countries() {
        $this->db->select('Code as `country_id`, Name as `countryname_en`')
                ->from(TBL_COUNTRY);

        $query = $this->db->get();
        return $query;
    }

    /*
     * get all state corresponding to a country
     */

    function get_state($CountryCode) {
        $this->db->select('District')
                ->from(TBL_STATE)
                ->where('CountryCode', $CountryCode)
                ->group_by('District')
                ->order_by('District', 'ASC');
        $result = $this->db->get();

        return $result;
    }

    function fetch_message($msg_index,$lang) {

        $this->db->select('message as `Content`')
                ->from(TBL_MESSAGE_MASTER)
                ->where('language_id',$lang)
                ->where('message_code', $msg_index);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }

    public function matchuser($username) {
        $this->db->select('hs_adminid as `HsAdminId`, admin_name as `AdminName`, admin_email as `AdminEmail`, admin_password as `AdminPassword`, status as `Status`')
                ->from(TBL_ADMIN)
                ->where('admin_name', $username)
                ->where('status', '1');

        $query = $this->db->get();
        return $query;
    }

    //================= 4.1 prasen start ==============//

    public function get_all_province() {
        $this->db->select('*')
                ->from(TBL_PROVINCE);

        return $this->db->get();
    }

    public function get_all_municipality($Prov_id) {
        $this->db->select('*')
                ->from(TBL_MUNICIPALITY)
                ->where('prov_code', $Prov_id)
                ->group_by('municipality_name');

        return $this->db->get();
    }

    public function get_postal_code($muni_id) {
        $this->db->select('postal_code')
                ->from(TBL_MUNICIPALITY)
                ->where('municipality_id', $muni_id);

        return $this->db->get()->result_array();
    }

    function get_user_fullname($user_id) {
        $this->db->select('*')
                ->from(TBL_USER_DETAILS)
                ->where('user_id', $user_id);

        return $this->db->get();
    }
    

}

?>