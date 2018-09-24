<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class All_function_model extends CI_Model {
	
	function get_template_details($id) {

        $this->db->select('*')
                ->from(TBL_EMAIL_TEMP)
                ->where('id', $id);
        $query = $this->db->get();
        return $query;
    }
	function get_menu_pid_Mposition($pid,$Mposition){
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id, m.external_url, m.link_type, m.link_target')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.parent_id', $pid)
				->where('m.position', $Mposition)
				->order_by('m.sort_order','ASC')
				->order_by('m.menu_position','ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
	function get_selected_menu_id($current_menu_id, $menu_id, $Mposition){
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.id', $current_menu_id)
				->where('m.position', $Mposition)
				->where('cms.status', 'Y')
				->order_by('m.menu_position','ASC')
				->order_by('m.sort_order','ASC');
        $query = $this->db->get()->row_array();
		if($query['id']==$menu_id){
			return 'Y';
		}elseif($query['id']!=$menu_id && $query['parent_id']==0){
			return 'N';
		}else{
			return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);	
		}
    }
	function get_parent_selected_menu_id($parent_id, $menu_id, $Mposition){

        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
                ->from(TBL_MENU. ' as m')
				->join(TBL_CMS. ' as cms', 'cms.id = m.page_id', 'LEFT')
				->where('m.id', $parent_id)
				->where('m.position', $Mposition)
				->order_by('m.menu_position','ASC')
				->order_by('m.sort_order','ASC');

        $query = $this->db->get()->row_array();

		if($query['id']==$menu_id){

			return 'Y';

		}elseif($query['id']!=$menu_id && $query['parent_id']==0){

			return 'N';

		}else{

			return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);	

		}  

    }
	function get_item_viewed($products_id){
				
				$this->db->select('*')
                          ->from(TBL_PRODUCTS)
						  ->where('id' , $products_id);

                  $query = $this->db->get()->row_array();
                  /*if(isset($query[0]['image_name'])){
						$val = $query[0]['image_name'];
					}else{
						$val = '';
					}
					return $val;*/
					
					return $query;
		 }
		 
		 function get_item_viewed_tools($products_id){
				
				$this->db->select('*')
                          ->from(TBL_TOOLS_PRODUCTS)
						  ->where('id' , $products_id);

                  $query = $this->db->get()->row_array();
                  /*if(isset($query[0]['image_name'])){
						$val = $query[0]['image_name'];
					}else{
						$val = '';
					}
					return $val;*/
					return $query;
		 }
		 
		 
	function get_top_categories($parent_id){
				
				$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('cat_id' , $parent_id);
						  //->where('status' , 'Y');

                  $query = $this->db->get()->result_array();
				  
                  if(isset($query[0]['parent_id'])){
						$val = $query[0]['parent_id'];
					}else{
						$val = '';
					}
					return $val;
		 }
	function get_products_options_values($products_options_id,$products_id) {

        $this->db->select('v.*')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES. ' as `v`')
				->join(TBL_PRODUCTS_ATTRIBUTES . ' as `a`' , 'a.options_values_id = v.products_options_values_id')
                ->where('a.options_id', $products_options_id)
				->where('a.products_id', $products_id)
				->order_by('products_options_values_name' , 'ASC');

        $query = $this->db->get();
        return $query;
    }
	function get_author_name($admin_id){
				
				$this->db->select('*')
                          ->from(TBL_ADMIN)
						  ->where('admin_id' , $admin_id);

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['first_name'])){
						$val = $query[0]['first_name'].' '.$query[0]['last_name'];
					}else{
						$val = '';
					}
					return $val;
		 }
		 
	function get_comments_no($blog_id){
				
				$this->db->select('count(id) as total')
                          ->from(TBL_BLOG_COMMENTS)
						  ->where('blog_id' , $blog_id)
						  ->where('status' , 'Y');

                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['total'])){
						$val = $query[0]['total'];
					}else{
						$val = 0;
					}
					return $val;
		 }
   
    function get_recommend($cat_id,$id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS)
                ->where('status', 'Y')
				->where('cat_id', $cat_id)
				->where('id !=', $id)
				->order_by('id', 'RANDOM')
				->limit(4, 0);

        $query = $this->db->get();
        return $query;
    }
	
	function get_recommend_tools($cat_id,$id) {

        $this->db->select('*')
                ->from(TBL_TOOLS_PRODUCTS)
                ->where('status', 'Y')
				->where('cat_id', $cat_id)
				->where('id !=', $id)
				->order_by('id', 'RANDOM')
				->limit(4, 0);

        $query = $this->db->get();
        return $query;
    }

	
	
	
	function get_sub_categories($cat_id){
				
				$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('parent_id' , $cat_id)
						  ->where('status' , 'Y');
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
		 }
	function get_sub_categories_tools($cat_id){
				
				$this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES)
						  ->where('parent_id' , $cat_id)
						  ->where('status' , 'Y');
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get();
                  return $query;
		 }	 
	 function get_cart_product($products_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS)
                ->where('id', $products_id);

        $query = $this->db->get();
        return $query;
    }
	function get_cart_product_option_name($products_options_id) {

        $this->db->select('products_options_name')
                ->from(TBL_PRODUCTS_OPTIONS)
                ->where('products_options_id', $products_options_id);

        $query = $this->db->get()->result_array();
        if(isset($query[0]['products_options_name'])){
			$val = $query[0]['products_options_name'];
		}else{
			$val = '';
		}
		return $val;
    }
	function get_cart_product_option_value($products_options_values_id) {

        $this->db->select('products_options_values_name')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES)
                ->where('products_options_values_id', $products_options_values_id);

        $query = $this->db->get()->result_array();
		//echo $sql = $this->db->last_query();
         if(isset($query[0]['products_options_values_name'])){
			$val = $query[0]['products_options_values_name'];
		}else{
			$val = '';
		}
		return $val;
    }
	function get_payment_details($agreement_id) {

        $this->db->select('*')
                ->from(TBL_PAYMENT_BALANCE)
                ->where('agreement_id', $agreement_id)
				->order_by('id');

        $query = $this->db->get();
        return $query;
    }
	function get_menu_pid($position,$url_name) {

        $this->db->select('cms.*, m.menu_title, cms.url_name, m.parent_id')
                ->from(TBL_CMS. ' as cms')
				->join(TBL_MENU . ' as m', 'm.page_id = cms.id')
                ->where('cms.status', 'Y')
				->where('cms.url_name', $url_name)
				->where('m.position', $position);

        $query = $this->db->get()->result_array();
		if(isset($query[0]['parent_id'])){
		$val = $query[0]['parent_id'];
		}else{ $val = 0;}
        return $val;
    }
	function get_menu_details($position,$id) {

        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
                ->from(TBL_CMS. ' as cms')
				->join(TBL_MENU . ' as m', 'cms.id = m.page_id')
                ->where('cms.status', 'Y')
				->where('m.parent_id', $id)
				->where('m.position', $position)
				->order_by('m.sort_order','ASC');

        $query = $this->db->get();
		//echo $sql = $this->db->last_query();
        return $query;
    }
	function get_sub_cat_details($store_cat_id) {

        $this->db->select('*')
                ->from(TBL_SUB_CATEGORIES)
                ->where('status', '1')
				->where('store_cat_id', $store_cat_id)
				->order_by('sort_order');

        $query = $this->db->get();
		//echo $sql = $this->db->last_query();
        return $query;
    }
	function get_store_sub_cat_details($store_id,$store_cat_id) {

        $this->db->select('*')
                ->from(TBL_SUB_CATEGORIES)
                ->where('status', '1')
				->where('store_cat_id', $store_cat_id)
				->order_by('sort_order');

        $query = $this->db->get();
		//echo $sql = $this->db->last_query();
        return $query;
    }
	function get_parent_menu_details($parent_id) {

        $this->db->select('*')
                ->from(TBL_CMS)
                ->where('status', 'Y')
				->where('id', $parent_id);

        $query = $this->db->get();
        return $query;
    }
	function get_store_details($store_id) {

        $this->db->select('*')
                ->from(TBL_STORE)
                ->where('status', '1')
				->where('store_id', $store_id);

        $query = $this->db->get();
        return $query;
    }
	function get_product_images($products_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS_IMAGES)
				->where('products_id', $products_id)
				->order_by('sort_order','ASC');

        $query = $this->db->get();
        return $query;
    }
	function get_product_images_tools($products_id) {

        $this->db->select('*')
                ->from(TBL_TOOLS_PRODUCTS_IMAGES)
				->where('products_id', $products_id)
				->order_by('sort_order','ASC');

        $query = $this->db->get();
        return $query;
    }
	
	
	
	
	function get_values($products_options_id) {

        $this->db->select('*')
                ->from(TBL_PRODUCTS_OPTIONS_VALUES)
				->where('products_options_id', $products_options_id)
				->order_by('products_options_values_name','ASC');

        $query = $this->db->get();
        return $query;
    }
	
	
	
	
	
	
	
	
	
	
	function get_seo($page_name) {

        $this->db->select('meta_title as `MetaTitle`, meta_desc as `MetaDesc`, meta_keyword as `MetaKeyword`')
                ->from(TBL_SEO_MASTER)
                ->where('page_name', $page_name);

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query;
    }


    function fetch_message($msg_index, $lang_id) {
        $this->db->select('message as `Content`')
                ->from(TBL_MESSAGE_MASTER)
                ->where('language_id', $lang_id)
                ->where('message_code', $msg_index);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }
    
    function fetch_email_content($email_code) {

        $this->db->select('subject AS `Subject`, body AS `Body`')
                ->from(TBL_EMAIL_NOTIFICATION)
                ->where('email_code', $email_code)                
                ->where('status', '1');

        $query = $this->db->get();
        return $query;
    }   

    function get_site_options($option_code) {
        $this->db->select('*')
                ->from(TBL_SITE_OPTIONS)
                ->where('option_name', $option_code);

        $query = $this->db->get();
        return $query;
    }     
    function get_cmstext_bypage($page_name) {

        $this->db->select('page_heading, content')
                ->from(TBL_CMS_PAGE)
                ->where('placeholder_id', $page_name)
                ->or_where('PageName', 'all')
                ->where('Status', '1');

        $query = $this->db->get();
        return $query;
    }

    function get_user_name($user_id) {
        $this->db->select('ud.FirstName , ud.LastName')
                ->from(TBL_PLAYER_DETAILS . ' as ud')
                ->join(TBL_PLAYER_MASTER . ' as um', 'um.PlayerId = ud.PlayerId')
                ->where('ud.PlayerId', $user_id)
                ->where('um.Status', '1');

        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }

    function get_user_status($user_id) {
        $this->db->select('Status as `Status`')
                ->from(TBL_USER)
                ->where('PlayerId', $user_id);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;
        return $query;
    }

    function get_user_first_name($user_id) {
        $this->db->select('FirstName as `FirstName`')
                ->from(TBL_USER_DETAIL)
                ->where('PlayerId', $user_id);

        $query = $this->db->get();
        return $query;
    }

    function get_user_email($user_id) {
        $this->db->select('Email as `UserEmail`')
                ->from(TBL_PLAYER_MASTER)
                ->where('PlayerId', $user_id)
                ->where('Status', '1');

        $query = $this->db->get();
        return $query;
    }

    function get_user_img($user_id) {

        $this->db->select('PlayerPicture as `PlayerPicture`')
                ->from(TBL_PLAYER_DETAILS)
                ->where('PlayerId', $user_id);

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            $query = $query->result_array();
            $val = $query[0]['PlayerPicture'];
        } else {
            $val = 'default-user.gif';
        }

        return $val;
    }

    function get_info_with_privacy($user_id) {
        $this->db->select('xp.*')
                ->from(TBL_USER_PRIVACY . ' as xp');

        $this->db->where('xp.PlayerId', $user_id);
        $query = $this->db->get();
        return $query;
    }

    function get_country_list() {
        $this->db->select('CountryID, CountryName_' . DEFAULT_LANGUAGE . ' as `CountryName`')
                ->from(TBL_COUNTRY)
                ->where('Status', '1');

        $query = $this->db->get();
        return $query;
    }

    function get_country_city($input, $selectcountry, $limit_from = 0, $total_row_display = 5) {

        $this->db->select('ud.CountryName_en as `CountryName`,ct.CityId as `CityId`,ct.City as `City`')
                ->from(TBL_COUNTRY . ' as `ud`')
                ->join(TBL_CITY . ' as `ct`', 'ct.CountryID=ud.CountryID')
                ->where('ct.Status', '1');
        if ($selectcountry != '') {
            $this->db->where('ct.CountryID', $selectcountry);
        }
        $this->db->like('ct.`City`', $input, 'after');
        $this->db->limit($total_row_display, $limit_from);
        //$this->db->distinct(); 
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query;
    }

    function get_teams($player_id = NULL) {
        $this->db->select('TeamId,Name')
                ->from(TBL_TEAM)
                ->where('Status <>', '3')
                ->order_by('Name');

        if ($player_id != NULL)
            $this->db->where('OwnerId', $player_id);

        $query = $this->db->get();
        return $query;
    }

    function get_user_connection_actual_num() {
        $user_id = $this->login_user_id;
        $this->db->select('count(xuc.FriendConId) as `Id`')
                ->from(TBL_FRIEND_LIST . ' as `xuc`')
                ->join(TBL_PLAYER_MASTER . ' as `xu1`', 'xuc.PlayerFriendId = xu1.PlayerId')
                ->where("(xuc.PlayerFriendId = '$user_id' OR xuc.PlayerId='$user_id')")
                ->where("xuc.Status", '1')
                ->where("xu1.Status", '1')
                ->where("xu1.ConfirmStatus", '1');
        $query = $this->db->get();
        //echo $this->db->last_query();

        return $query;
    }    

    function get_user_image($user_id) {
        $this->db->select('PlayerPicture')
                ->from(TBL_PLAYER_DETAILS)
                ->where('PlayerId', $user_id);

        $query = $this->db->get()->result_array();
        //log_message('error' , $this->db->last_query());
        $val = $query[0]['PlayerPicture'];

        return $val;
    }

    function get_all_team_list($player_id = NULL) {
        $this->load->model('Match_model', '', TRUE);
        $my_teams = $this->Match_model->get_teams($player_id);

        $this->db->select('t.*')
                ->from(TBL_TEAM . ' as t')
                ->where('t.Status', '1')
                ->where_not_in('t.TeamId', $my_teams)
                ->order_by('t.Name', 'ASC');

        $result = $this->db->get();

        return $result_arr = $result->num_rows() > 0 ? $result->result_array() : array();
    }

    function get_ground_list($ground_id = NULL) {
        $this->db->select('pg.*')
                ->from(TBL_PLAY_GROUND . ' as pg')
                ->where('pg.Status', '1');

        if ($ground_id != NULL)
            $this->db->where('pg.GroundId', $ground_id);

        $result = $this->db->get();

        return $result_arr = $result->num_rows() > 0 ? $result->result_array() : array();
    }

    function get_team_details_by_id($team_id, $field) {
        $val = '';
        $this->db->select("t.$field as Value")
                ->from(TBL_TEAM . ' as t')
                ->where('t.Status <>', '3')
                ->where('t.TeamId', $team_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $val = $result[0]['Value'];
        }

        return $val;
    }

    function get_user_fullname($user_id) {
        $this->db->select('*')
                ->from(TBL_USER_DETAILS)
                ->where('user_id', $user_id);

        return $this->db->get();
    }

    function item_exist_in_wishlist($item, $user_id) {
        $this->db->select('*')
                ->from(TBL_USER_WISHLIST)
                ->where('user_id', $user_id)
                ->where('wished_on_id', $item);

        return $this->db->get()->num_rows;
    }
	
################	
	function get_root_categories(){
				
				$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('parent_id' , 0)
						  ->where('status' , 'Y')
						  ->order_by('sort_order','ASC');

                  $query = $this->db->get()->result_array();
				  
                  
					return $query;
		 }
		 
		 
		 function get_subcategories($parent_id){
				
				$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('parent_id' , $parent_id)
						  ->where('status' , 'Y')
						  ->order_by('sort_order','ASC');

                  $query = $this->db->get()->result_array();
				  
                  
					return $query;
		 }
		 
		 
		 function get_parent_categories_id($cat_id)
		 {
			$this->db->select('*')
                          ->from(TBL_CATEGORIES)
						  ->where('cat_id' , $cat_id)
						  ->where('status' , 'Y')
						  ->order_by('sort_order','ASC');

                  $query = $this->db->get()->row_array();
				  
                  
					return $query['parent_id']; 
		 }
		 
		 ###
		 function get_root_categories_tools(){
				
				$this->db->select('*')
                          ->from(TBL_TOOLS_CATEGORIES)
						  ->where('parent_id' , 0)
						  ->where('status' , 'Y')
						  ->order_by('sort_order','ASC');

                  $query = $this->db->get()->result_array();
				  
                  
					return $query;
		 }
		 
		 function get_resource_directory()
		 {
			 $this->db->select('*')
					  ->from(TBL_RDIRECTORY)
					  ->where('status' , 'Y')
					  ->order_by('sort_order','ASC');
			$query = $this->db->get()->result_array();
			return $query;
		 }
		 
		function get_resource_publication()
		 {
			 $this->db->select('*')
					  ->from(TBL_PUBLICATIONS)
					  ->where('status' , 'Y')
					  ->order_by('sort_order','ASC');
			$query = $this->db->get()->result_array();
			return $query;
		 }
		 
		 function get_about_committee_cat()
		 {
			 $this->db->select('*')
					  ->from(TBL_COMMITTEE_CATEGORY)
					  ->where('status' , 'Y')
					  ->order_by('sort_order','ASC');
			$query = $this->db->get()->result_array();
			return $query;
		 }
}

