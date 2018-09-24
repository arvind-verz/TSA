<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Tools_categories extends MY_Controller {

    function __construct() {
		
        parent::__construct();
		$this->load->model('Tools_categories_model', '', TRUE);
    }

    public function manage_tools_categories(){
		
		$data_msg = array();		
        
        $data_msg['meta_title'] = "Category Manager";
		
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array(); 
        
        $items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
		
		$current_page = (int) $this->input->get('page');
		
        $current_page = $current_page > 0 ? $current_page : 1;
		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);

        $limit_from = ($current_page - 1) * $items_per_page;

        if(!isset($_POST['OkFilter']) & !isset($_GET['page'])){
			$this->session->set_userdata(array('FlterData' => '' ));
		}		
		if(isset($_POST['OkFilter'])){
			$this->session->set_userdata(array('FlterData' => $_POST['FlterData'] ));
			$data_msg['FlterData'] = $FlterData = $_POST['FlterData'];
			$data_msg['total'] = $total_items = $this->Tools_categories_model->count_categories_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-tools-categories'));
			$data_msg['display_result'] = $this->Tools_categories_model->get_categories_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				$get_result = $this->Tools_categories_model->get_categories_details($del_id);				
				$details = $get_result->result_array();				
				$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/original/'.$details[0]['image_banner'];
				if(is_file($file)){unlink($file); } 
				$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/thumb/'.$details[0]['image_banner'];
				if(is_file($file)){unlink($file);} 
								  
				$this->Tools_categories_model->del_categories($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-tools-categories'));
			  exit;
			  }else{redirect(base_url('manage-tools-categories'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){				
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->Tools_categories_model->update_categories($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-tools-categories'));			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Tools_categories_model->update_categories($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-tools-categories'));
			  exit;
			  }else{redirect(base_url('manage-tools-categories'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Tools_categories_model->update_categories($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-tools-categories'));
			  exit;
			  }else{redirect(base_url('manage-tools-categories'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Tools_categories_model->count_categories_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-tools-categories'));
			  $data_msg['display_result'] = $this->Tools_categories_model->get_categories_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'cat_name'=>'',							
				'parent_id'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Tools_categories_model->count_categories();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-tools-categories'));
        	$get_value = $this->Tools_categories_model->get_categories($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
			
		}
		
        $this->view('tools_categories/manage_tools_categories', $data_msg);
    } 
	
	public function add_tools_categories() {
		
        $data_msg = array();

        $data_msg['meta_title'] = "Add Category";
		
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array();

        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'cat_name',
                     'label'   => 'Category Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_TOOLS_CATEGORIES.'.seo_url]'
                  ),
				array(
                     'field'   => 'parent_id',
                     'label'   => 'Parent Category',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  ),      
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  )
			   
            );

		$this->form_validation->set_rules($config);
		$data_msg['flag']=0;
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_categories/add_tools_categories', $data_msg);
			}else{
            $post_data = $_POST; $error_msg = '';$image_banner_name='';$flag=0;
			
			if($post_data['parent_id']>0)
			{  
					 	$flag=1; //subcat
						$data_msg['flag']=1;
							
			}

		if($flag==1)          
        {
           if ($_FILES['image_banner']['name'] == '') {
				  $error_msg .= ' Need Banner Image.';
                }
              elseif($_FILES['image_banner']['tmp_name']!=''){
				  
				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){
					 $error_msg .= ' Invalid Banner Image.';
				  }else{
					   $config = array(
						'source' => 'image_banner', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 251, 'width' => 1400, 'save' => 'tools_categories/banner/original/'),
						array('height' => 45, 'width' => 200, 'save' => 'tools_categories/banner/thumb/')
						)
						);
						
						$image_banner_name = $this->all_function->resize_image($config);
					}
				  
				  } 
		}
            if ($error_msg != '') {
				$data_msg['error_msg'] = $error_msg;       
                $this->view('tools_categories/add_tools_categories', $data_msg);
            }else { 
					
                    $data = array(
                        'cat_name' => $post_data['cat_name'],
						'image_banner' => $image_banner_name,
						'banner_heading' => $post_data['banner_heading'],
						'sort_order' => $post_data['sort_order'],
						'parent_id' => $post_data['parent_id'],
						'create_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status'],
						'seo_url' => $post_data['seo_url'],
						'seo_title' => $post_data['seo_title'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'modified_date' => date('Y-m-d H:i:s')
                    ); 
                    $this->Tools_categories_model->add_categories($data);

                $this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(base_url("manage-tools-categories"));
            }
        }
		}else{		
        	$this->view('tools_categories/add_tools_categories', $data_msg);
		}
    }// Validation
		
	public function edit_tools_categories($cat_id) {
		
        $data_msg = array();

        $get_result = $this->Tools_categories_model->get_categories_details($cat_id);
		
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array();

        $details = $get_result->result_array();
		
		if (count($details) == 0) {
            redirect(base_url('manage-tools-categories'));
        }
		
		//$data_msg['flag']=0;
		$data_msg['details'] = $details;     
        $data_msg['meta_title'] = "Edit Category";
        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'cat_name',
                     'label'   => 'Category Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_TOOLS_CATEGORIES.'.seo_url.'.$cat_id.']'
                  ),
				array(
                     'field'   => 'parent_id',
                     'label'   => 'Parent Category',
                     'rules'   => 'required'
                  ),
				
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  ),      
               array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_categories/edit_tools_categories', $data_msg);
			}else{
			$post_data = $_POST; $error_msg = '';$flag=0;
			$image_banner_name=$post_data['old_image_banner'];
			
			if($post_data['parent_id']>0)
			{  
					 	$flag=1; //subcat
							
			}
			
			if($flag==1)          
            {
			
			if($_FILES['image_banner']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){
					  $error_msg .= ' Invalid Banner Image.';  
				  }else{
					 
					    $file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/original/'.$details[0]['image_banner'];
						if(is_file($file)){
						unlink($file); 
						}
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/thumb/'.$details[0]['image_banner'];
						if(is_file($file)){
						unlink($file); 
						}
					 
					 	 $config = array(
						'source' => 'image_banner', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 251, 'width' => 1400, 'save' => 'tools_categories/banner/original/'),
						array('height' => 45, 'width' => 200, 'save' => 'tools_categories/banner/thumb/')
						)
						);
						
						$image_banner_name = $this->all_function->resize_image($config);
					}
				  
				  }
		   }
				     
            if ($error_msg != '') { 
				$data_msg['error_msg'] = $error_msg;      
                $this->view('tools_categories/edit_tools_categories', $data_msg);
            }else {
				
				    $data = array(
							'cat_name' => $post_data['cat_name'],
							'image_banner' => $image_banner_name,
							'banner_heading' => $post_data['banner_heading'],
							'sort_order' => $post_data['sort_order'],
							'parent_id' => $post_data['parent_id'],
							'modified_date' => date('Y-m-d H:m:s'),
							'status' => $post_data['status'],
							'seo_url' => $post_data['seo_url'],
							'seo_title' => $post_data['seo_title'],
							'seo_keyword' => $post_data['seo_keyword'],
							'seo_description' => $post_data['seo_description']
						);
					
                    $this->Tools_categories_model->update_categories($data,  $cat_id);

                $this->session->set_flashdata('success_msg', 'Successfully updated.');
				redirect(base_url("edit-tools-categories/$cat_id"));
            }
        }
		}else{
			$this->view('tools_categories/edit_tools_categories', $data_msg);
		}
    }// Validation
	
	public function del_tools_categories($cat_id) {
		
        $data_msg = array();
		
		        $get_result = $this->Tools_categories_model->get_categories_details($cat_id);				
				$details = $get_result->result_array();				
				$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/original/'.$details[0]['image_banner'];
				if(is_file($file)){unlink($file); } 
				$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_categories/banner/thumb/'.$details[0]['image_banner'];
				if(is_file($file)){unlink($file);} 		
		
		
		$this->Tools_categories_model->del_categories($cat_id);
						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');	

		redirect(base_url("manage-tools-categories")); 
       
    } // Not Need Validation
	
	
	function find_root_parent()
	{
		$arr_err=array();
		$cat_id=$this->input->post('id');
		$this->db->select('*')
                ->from(TBL_CATEGORIES)
				->where('cat_id', $cat_id);
	  $query = $this->db->get()->row_array();
	  if($query['parent_id'])
	  $arr['root']=1;//subcat
	  else
	  $arr['root']=0;//rootcat
	  echo json_encode($arr);
	}
	
	
	function root_cat($cat_id)
	{
		if($cat_id==0) return 'y';
		$this->db->select('*')
                ->from(TBL_CATEGORIES)
				->where('cat_id', $cat_id);
	   $query = $this->db->get()->row_array();
	   if($query['parent_id'])
	   return 'y'; //subcat
	   else
	   return 'n'; //rootcat
	}
	
	public function edit_unique($value, $params)
	{
		
		$this->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
        list($table, $field, $current_id) = explode(".", $params);
		$query = $this->db->select()->from($table)->where($field, $value)->limit(1)->get();
		
		if ($query->row() && $query->row()->cat_id!= $current_id)
		{
		return FALSE;
		} else {
		return TRUE;
		}
		
	} 
   
}