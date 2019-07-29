<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class GalleryController extends CI_Controller {

    function __construct() {		
        parent::__construct();
		$this->title = ADMINPANEL . ' | ' . GALLERY;
        $this->load->model('backend/Gallery', '', TRUE);
		$this->load->model('backend/Allfunction', '', TRUE);
		$this->load->model('backend/accounts', 'accounts');
		$this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
    }

    public function manage_gallery() {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'GALLERY', 'views');
		$data_msg = array();	        
        $data_msg['meta_title'] = "Gallery Manager";		
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(GALLERY, 'admin/manage-gallery                              ');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = GALLERY;
		$data_msg['meta_title'] = GALLERY;
		
        	$get_value = $this->Gallery->get_gallery();
       		$data_msg['display_result'] = $get_value->result_array();
		
		

		
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/gallery/manage_gallery');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function add_gallery() {
		
        $data_msg = array();
	
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(GALLERY, 'admin/manage-gallery                              ');
        $this->breadcrumbs->push(CREATE, 'admin/add-gallery');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = GALLERY;
		$data_msg['meta_title'] = GALLERY;	
        $this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
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
                  ),
			   
			  array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => ''
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->load->view('backend/include/header', $data_msg);
				$this->load->view('backend/include/sidebar');
				$this->load->view('backend/gallery/add_gallery');
				$this->load->view('backend/include/control-sidebar');
				$this->load->view('backend/include/footer');
			}else{
				$post_data = $_POST;
				$error = FALSE;	
				$file_name_placeholder = array_keys($_FILES);
            	$image_file = $_FILES['gallery']['name'];

            	$_POST['gallery'] = upload_image_file($image_file, $file_name_placeholder[0], 340, 550);
            	$post_data = $_POST;
						$data = array(
							'title' => ($post_data['title']!="") ? $post_data['title'] : "",
							'image_name' => $post_data['gallery'],
							'sort_order' => ($post_data['sort_order']!="") ? $post_data['sort_order'] : 0,
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => ($post_data['content']!="") ? $post_data['content'] : ""
						); 
					$this->Gallery->add_gallery($data);	
					return redirect("admin/manage-gallery");
				
			}
		}else{
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/gallery/add_gallery');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
		
	public function edit_gallery($id) {
		
        $data_msg = array();
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(GALLERY, 'admin/manage-gallery                              ');
        $this->breadcrumbs->push(EDIT, 'admin/edit-gallery');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = GALLERY;
		$data_msg['meta_title'] = GALLERY;
        $get_result = $this->Gallery->get_gallery_details($id);
        $details = $get_result->result_array();
		
		if (count($details) == 0) { return redirect('admin/manage-gallery');}
		
		$data_msg['details'] = $details;        
		$data_msg['meta_title'] = "Edit Gallery";
		$this->load->library('form_validation');
		
		$config = array(
              array(
                     'field'   => 'title',
                     'label'   => 'Title',
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
                  ),
				array(
                     'field'   => 'content',
                     'label'   => 'Content',
                     'rules'   => 'required'
                  )
			   
            );

		$this->form_validation->set_rules($config); 
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/gallery/edit_gallery');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');			
			}else{	
				$post_data = $_POST;
				$error = FALSE;
				$file_name_placeholder = array_keys($_FILES);
	            $image_file = $_FILES['gallery']['name'];
	            if($image_file) {
	                $_POST['gallery'] = upload_image_file($image_file, $file_name_placeholder[0], 340, 550);
	            } 
	            $post_data = $_POST;											 
						$data = array(
							'title' => ($post_data['title']!="") ? $post_data['title'] : "",
							'image_name' => isset($post_data['gallery']) ? $post_data['gallery'] : $post_data['gallery_exist'],
							'sort_order' => ($post_data['sort_order']!="") ? $post_data['sort_order'] : 0,
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => ($post_data['content']!="") ? $post_data['content'] : ""
						);
					$this->Gallery->update_page_cms($data,  $id);	
					$this->session->set_flashdata('success', 'Gallery ' . MSG_UPDATED);
					return redirect("admin/manage-gallery");
				
			}
		}else{
		
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/gallery/edit_gallery');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
	
	public function del_gallery($id) {
		
        $data_msg = array();		
		$this->Gallery->del_gallery($id);						
		$this->session->set_flashdata('success', 'Gallery' . MSG_DELETED);
		return redirect("admin/manage-gallery");
    }
	
	
	
 
}