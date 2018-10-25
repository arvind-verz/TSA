<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class CmsController extends CI_Controller {

    function __construct() {		
        parent::__construct();
        $this->load->model('backend/Cms_model', 'Cms_model', TRUE);
        $this->load->model('backend/accounts', 'accounts');
        $this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
		$this->title = ADMINPANEL . ' | ' . TUTOR;
    }
	
	public function manage_menu() {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MENU', 'views'); 
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/manage-menu                              ');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MENU_MANAGE;
		$data['meta_title'] = MENU_MANAGE;
		//$get_value = $this->Cms_model->get_menu_position();
        $data['display_result'] = $this->Cms_model->get_menu_position();
		
		$this->load->view('backend/include/header', $data);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/cms/manage_menu_position');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function manage_menu_list($position) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MENU', 'views'); 		
        $data = array();
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MENU, 'admin/manage-menu');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title']       = $this->title;
        $data['page_title']  = MENU_MANAGE;
		$data['meta_title'] = MENU_MANAGE;
		$data['position'] = $position;
		$get_value = $this->Cms_model->get_custom_menu_page($position);
		$data['display_result'] = $get_value->result_array();
		$this->load->view('backend/include/header', $data);
		$this->load->view('backend/include/sidebar');
		$this->load->view('backend/cms/manage_menu');
		$this->load->view('backend/include/control-sidebar');
		$this->load->view('backend/include/footer');
    }
	
	public function add_menu_item($position) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MENU', 'creates'); 
        $data_msg = array();
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TUTOR, 'admin/tutors');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = MENU_MANAGE;
		$error = FALSE;

        $data_msg['meta_title'] = "Add Menu Item";
		
		$data_msg['menu_pos'] = $position;
		
		$data_msg['display_menu'] = $this->Cms_model->get_menu_position_info($position);
		
		$data_msg['parent_menu'] = $this->Cms_model->get_parent_menu($position)->result_array();
		
		$data_msg['pages'] = $this->Cms_model->get_pages()->result_array();
		
		$data_msg['position'] = $this->Cms_model->get_menu_position();
		
		$this->load->library('form_validation');

        $config = array(
               array(
                     'field'   => 'menu_title',
                     'label'   => 'Menu Title',
                     'rules'   => 'required'
                  ),  
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('cms/add_menu', $data_msg);
			}else{
            	$post_data = $_POST;
				
				$req_page_id	  = (isset($post_data['page_id']) && $post_data['page_id']!='')?$post_data['page_id']:0;
				$req_parent_id	= (isset($post_data['parent_id']) && $post_data['parent_id']!='')?$post_data['parent_id']:0;
				$req_menu_title   = (isset($post_data['menu_title']) && $post_data['menu_title']!='')?$post_data['menu_title']:0;
				$req_menu_pos	 = (isset($post_data['menu_position']) && $post_data['menu_position']!='')?$post_data['menu_position']:'';
				$req_ext_url	  = (isset($post_data['external_url']) && $post_data['external_url']!='')?$post_data['external_url']:0;
				$req_link_type	= (isset($post_data['link_type']) && $post_data['link_type']!='')?$post_data['link_type']:0;
				$req_link_target  = (isset($post_data['link_target']) && $post_data['link_target']!='')?$post_data['link_target']:0;
				$req_sort_order   = (isset($post_data['sort_order']) && $post_data['sort_order']!='')?$post_data['sort_order']:0;
            				
				$data = array(
					'page_id' => $req_page_id,
					'parent_id' => $req_parent_id,					
					'position' => $position,						
					'menu_title' => $req_menu_title,
					'menu_position' => $req_menu_pos,
					'external_url' => $req_ext_url,
					'link_type' => $req_link_type,
					'link_target' => $req_link_target,
					'sort_order' => $req_sort_order
				); 
				$this->Cms_model->add_menu_item($data);
                $this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(site_url("manage-menu-list/".$position));
            }
		}else{

		$this->load->view('backend/include/header', $data_msg);
		$this->load->view('backend/include/sidebar');
		$this->load->view('backend/cms/add_menu');
		$this->load->view('backend/include/control-sidebar');
		$this->load->view('backend/include/footer');
		}
    }
	
	public function del_menu_item($position,$id) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MENU', 'deletes'); 
        $data_msg = array();		
		$this->Cms_model->del_menu_item($id);						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		redirect(site_url("manage-menu-list/".$position));       
    }
	
	public function edit_menu_item($position,$id) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'MENU', 'edits'); 
        $data_msg = array();
		
		$error = FALSE;

        $get_result = $this->Cms_model->get_menu_item_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {
			redirect(site_url("manage-menu-list/".$position));
            exit;
        }

		$data_msg['details'] = $details;
		
		$data_msg['menu_pos'] = $position;
		$data_msg['menu_id'] = $id;
		
		$data_msg['display_menu'] = $this->Cms_model->get_menu_position_info($position);
		
		$data_msg['parent_menu'] = $this->Cms_model->get_parent_menu($position)->result_array();
		
		$data_msg['pages'] = $this->Cms_model->get_pages()->result_array();
		
		$data_msg['position'] = $this->Cms_model->get_menu_position();		
        
        $data_msg['meta_title'] = MENU_MANAGE;

		$this->load->library('form_validation');

        $config = array(
               array(
                     'field'   => 'menu_title',
                     'label'   => 'Menu Title',
                     'rules'   => 'required'
                  ),  
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			foreach($_POST as $Key => $Value){$this->session->set_flashdata($Key, $Value);}
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('cms/edit_menu', $data_msg);
			}else{
           
            $post_data = $_POST;
			
			$req_page_id	  = (isset($post_data['page_id']) && $post_data['page_id']!='')?$post_data['page_id']:0;
			$req_parent_id	= (isset($post_data['parent_id']) && $post_data['parent_id']!='')?$post_data['parent_id']:0;
			$req_menu_title   = (isset($post_data['menu_title']) && $post_data['menu_title']!='')?$post_data['menu_title']:0;
			$req_menu_pos	 = (isset($post_data['menu_position']) && $post_data['menu_position']!='')?$post_data['menu_position']:'';
			$req_ext_url	  = (isset($post_data['external_url']) && $post_data['external_url']!='')?$post_data['external_url']:0;
			$req_link_type	= (isset($post_data['link_type']) && $post_data['link_type']!='')?$post_data['link_type']:0;
			$req_link_target  = (isset($post_data['link_target']) && $post_data['link_target']!='')?$post_data['link_target']:0;
			$req_sort_order   = (isset($post_data['sort_order']) && $post_data['sort_order']!='')?$post_data['sort_order']:0;
						
			$data = array(
				'page_id' => $req_page_id,
				'parent_id' => $req_parent_id,					
				'position' => $position,						
				'menu_title' => $req_menu_title,
				'menu_position' => $req_menu_pos,
				'external_url' => $req_ext_url,
				'link_type' => $req_link_type,
				'link_target' => $req_link_target,
				'sort_order' => $req_sort_order
			);

			$this->Cms_model->update_menu_item($data,  $id);
			$this->session->set_flashdata('success_msg', 'Successfully updated.');		
			redirect(site_url("admin/edit-menu-item/$position/$id"));
        	}
		}else{	
  		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(MENU, 'admin/classes');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
		$data_msg['page_title']  = MENU_MANAGE;
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/cms/edit_menu');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
	
	public function add_cms() {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CMS', 'creates');
        $data_msg = array();

        $data_msg['meta_title'] = "Add Pages";
		
		$get_result = $this->Cms_model->get_cms_menu();
		$details = $get_result->result_array();		
		$data_msg['menu'] = $details;
		
		$this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'page_heading',
                     'label'   => 'Page Title',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'url_name',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_CMS.'.url_name]'
                  ), 
				  array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  )    
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
				$this->breadcrumbs->push(CMS_MANAGE, 'admin/classes');
				$data_msg['breadcrumbs'] = $this->breadcrumbs->show();
				$data_msg['title']       = $this->title;
				$data_msg['page_title']  = CMS;
				$this->load->view('backend/include/header', $data_msg);
				$this->load->view('backend/include/sidebar');
				$this->load->view('backend/cms/add_cms');
				$this->load->view('backend/include/control-sidebar');
				$this->load->view('backend/include/footer');
			}
			else {
              $post_data = $_POST; $error_msg = '';
			  if($_FILES['image_name']['tmp_name']!=''){				  
				  if (check_image_valid($_FILES['image_name']['tmp_name'])!=1){
					  $error_msg = "Invalid Banner Image.";  
				  }else{
					   $config = array(
						'source' => 'image_name', 
						'temp' => 'temp',
						'resize' => array(array('height' => 350, 'width' => 1400, 'save' => 'assets/upload/cms'))
						);						
						$image_name_name = $this->all_function->resize_image($config);
					}				  
				  }else{
					  $image_name_name = '';
				  }
				  
				  
				  
			  $data = array(
						'url_name' => preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '',$post_data['url_name']),					
						'template' => $post_data['template'],
						'image_name' => $image_name_name,	
						//'left_image' => $left_image,
						//'banner_heading' => $post_data['banner_heading'],					
						'page_heading' => $post_data['page_heading'],
						'page_content' => $post_data['page_content'],
						'seo_title' => $post_data['seo_title'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'sort_order' => $post_data['sort_order'],
						'modified_date' => date('Y-m-d H:i:s'),
						'status' => $post_data['status']
                    ); 
                    $page_id = $this->Cms_model->add_cms($data);
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
            	redirect(site_url("admin/manage-cms"));
        	}
		}else{		
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CMS, 'admin/classes');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
		$data_msg['page_title']  = CMS;
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/cms/add_cms');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
	
	public function del_cms($id) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CMS', 'deletes');
        $data_msg = array();
		$details = $this->Cms_model->get_cms_details($id)->result_array();
		$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/original/'.$details[0]['image_name'];
		if(is_file($file)){unlink($file);}
		$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/thumb/'.$details[0]['image_name'];
		if(is_file($file)){unlink($file);}
		
		/*$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/left_image/original/'.$details[0]['left_image'];
		if(is_file($file)){unlink($file);}
		$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/left_image/thumb/'.$details[0]['left_image'];
		if(is_file($file)){unlink($file);}*/
		
		
		$this->Cms_model->del_cms($id);			
		$this->Cms_model->del_menu_item($id);						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');		
		redirect(site_url("manage-cms"));
       
    }
	
	public function edit_cms($id) {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CMS', 'edits');
        $data_msg = array();

        $data_msg['meta_title'] = "Edit Page";
		$this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'page_heading',
                     'label'   => 'Page Title',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'url_name',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_CMS.'.url_name.'.$id.']'
                  ),
				  array(
                     'field'   => 'status',
                     'label'   => 'Status',
                     'rules'   => 'required'
                  ),
				array(
                     'field'   => 'sort_order',
                     'label'   => 'Sort Order',
                     'rules'   => 'numeric'
                  )    
			   
            );

		$this->form_validation->set_rules($config);
		
		$get_result = $this->Cms_model->get_cms_details($id);
		$details = $get_result->result_array();
        if (count($details) == 0) {			
				redirect(site_url("manage-cms"));
        }
		$data_msg['details'] = $details;
		
		/*$get_result_menu = $this->Cms_model->get_cms_menu();
		$details_menu = $get_result_menu->result_array();		
		$data_msg['menu'] = $details_menu;*/
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{	
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('cms/edit_cms', $data_msg);
			}else {           
             $post_data = $_POST;  
			 if(isset($_FILES['image_name']['tmp_name']) && $_FILES['image_name']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){
					   $error_msg = 'Invalid Banner Image.';
				  }else{
					  	$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/original/'.$details[0]['image_name'];
						if(is_file($file)){unlink($file);}
						$file = MAIN_SITE_AB_UPLOAD_PATH.'pagebanner/thumb/'.$details[0]['image_name'];
						if(is_file($file)){unlink($file);}
					    $config = array(
						'source' => 'image_name', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 350, 'width' => 1400, 'save' => 'pagebanner/original/'),
						array('height' => 45, 'width' => 200, 'save' => 'pagebanner/thumb/')
						)
						);						
						$image_name_name = $this->all_function->resize_image($config);
					}				  
				  }else{
					  $image_name_name = $details[0]['image_name'];
				  }
				
				  
				     
             $data = array(
					'url_name' => preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '',$post_data['url_name']),
					'image_name' => $image_name_name,
					//'left_image' => $left_image,
					'template' => $post_data['template'],	
					//'banner_heading' => isset($post_data['banner_heading'])?$post_data['banner_heading']:'',								
					'page_heading' => $post_data['page_heading'],
					'page_content' => isset($post_data['page_content'])?$post_data['page_content']:'',
					'seo_title' => $post_data['seo_title'],
					'seo_keyword' => $post_data['seo_keyword'],
					'seo_description' => $post_data['seo_description'],
					'sort_order' => $post_data['sort_order'],
					'modified_date' => date('Y-m-d H:i:s'),
					'status' => $post_data['status']
				); 
				
				$this->Cms_model->update_cms($data,  $id);
                $this->session->set_flashdata('success_msg', 'Successfully updated.');				
				redirect(site_url("admin/edit-cms/$id"));
        	}
		}else{
			
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CMS, 'admin/cms');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
		$data_msg['cms_id']       = $id;
		$data_msg['page_title']  = CMS_MANAGE;
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/cms/edit_cms');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }

    public function manage_cms() {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'CMS', 'views');
		$data_msg = array();		
        		
        $data_msg['page_title'] = "CMS Manager";
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(CMS, 'admin/cms');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = CMS_MANAGE;
        
        $current_page = (int) $this->input->get('page');
		


        $get_value = $this->Cms_model->get_cms();
		$data_msg['display_result'] = $get_value->result_array();
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/cms/manage_cms');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function generate_page_list(){
		
		$pages = $this->Cms_model->get_pages()->result_array();
		
		$page_sel_box_str = '';
		
		if( !empty($pages) ){
			$page_sel_box_str	.= '<label for="page_id">Select Page: </label>';
			$page_sel_box_str	.= '<select name="page_id" class="sf">';
			
			foreach ($pages as $key => $val):
				$selected = ($this->session->flashdata('page_id')==$val['id'])?' selected':'';
				
				$page_sel_box_str	.= '<option value="'.$val['id'].'" '.$selected.'>'.$val['page_heading'].'</option>';
			endforeach;
			
			$page_sel_box_str	.= '</select>';
		}
		
		echo $page_sel_box_str;
		exit;
	}
	
	public function generate_parent_id($menu_id){
		
		$parentArr = $this->Cms_model->get_menu_parent_id($menu_id);		
		$p_id = (isset($parentArr[0]['parent_id']) && $parentArr[0]['parent_id']!='')?trim($parentArr[0]['parent_id']):'';		
		echo $p_id;		
		exit;
	}
	
public function edit_unique($value, $params)
	{
		
		$this->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");
        list($table, $field, $current_id) = explode(".", $params);
		$query = $this->db->select()->from($table)->where($field, $value)->limit(1)->get();
		
		if ($query->row() && $query->row()->id!= $current_id)
		{
		return FALSE;
		} else {
		return TRUE;
		}
		
	}

}