<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class TestimonialController extends CI_Controller {

    function __construct() {		
        parent::__construct();
		$this->title = ADMINPANEL . ' | ' . TESTIMONIAL;
        $this->load->model('backend/Testimonial', '', TRUE);
		$this->load->model('backend/Allfunction', '', TRUE);
		$this->load->model('backend/accounts', 'accounts');
		$this->accounts->is_logged_in();
        $this->result = $this->accounts->get_login_user_id();
    }

    public function manage_testimonial() {
		$this->accounts->is_permission_allowed($this->result['user_id'], $this->result['perm_id'], 'TESTIMONIAL', 'views');
		$data_msg = array();	        
        $data_msg['meta_title'] = "Banner Manager";		
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial                              ');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = TESTIMONIAL;
		$data_msg['meta_title'] = TESTIMONIAL;
		
        	$get_value = $this->Testimonial->get_testimonial();
       		$data_msg['display_result'] = $get_value->result_array();
		
		

		
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/testimonial/manage_testimonial');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
    }
	
	public function add_testimonial() {
		
        $data_msg = array();
	
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial                              ');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = TESTIMONIAL;
		$data_msg['meta_title'] = TESTIMONIAL;	
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
				$this->view('testimonial/add_testimonial', $data_msg);
			}else{
				$post_data = $_POST;
				$error = FALSE;	
				if ($_FILES['image_name']['name'] == '') {$error = TRUE;}
				elseif($_FILES['image_name']['tmp_name']!=''){					  
					  if (check_image_valid($_FILES['image_name']['tmp_name'])!=1){						  
						 $error = TRUE;  
					  }else{
						  list($width, $height) = getimagesize($_FILES['image_name']['tmp_name']);
						  $config = array(
							'source' => 'image_name', 
							'temp' => 'temp',
							'resize' => array(
							array('height' => 80, 'width' => 150, 'save' => 'testimonial/thumb/'),
							array('height' => $height, 'width' => $width,'save' => 'testimonial/original/')
							)
							);							
							$image_name_name = $this->Allfunction->resize_image($config); // return the file anme
						}					  
					  }  
				$error_msg = "";				
				if ($error) {
					$error_msg = "Invalid Image.";
				}			   
				if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('testimonial/add_testimonial', $data_msg);
				}
				else { 						
						$data = array(
							'title' => $post_data['title'],
							'image_name' => $image_name_name,
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						); 
						$this->Testimonial->add_testimonial($data);	
					redirect(site_url("admin/manage-testimonial"));
				}
			}
		}else{
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/testimonial/add_testimonial');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
		
	public function edit_testimonial($id) {
		
        $data_msg = array();
		$this->breadcrumbs->push(DASHBOARD, 'admin/dashboard');
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial                              ');
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = TESTIMONIAL;
		$data_msg['meta_title'] = TESTIMONIAL;
        $get_result = $this->Testimonial->get_testimonial_details($id);
        $details = $get_result->result_array();
		
		if (count($details) == 0) { redirect(site_url('admin/manage-testimonial'));}
		
		$data_msg['details'] = $details;        
		$data_msg['meta_title'] = "Edit Testimonial";
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
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/testimonial/edit_testimonial');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');			
			}else{	
				$post_data = $_POST;
				$error = FALSE;
				
				if($_FILES['image_name']['tmp_name']!=''){
					  if (check_image_valid($_FILES['image_name']['tmp_name'])!=1){						  
						 $error = TRUE;  
					  }else{
						   list($width, $height) = getimagesize($_FILES['image_name']['tmp_name']);

     					  $config = array(
							'source' => 'image_name', 
							'temp' => 'temp',
							'resize' => array(
							array('height' => 80, 'width' => 80, 'save' => 'testimonial/thumb/'),
							array('height' => $height, 'width' => $width, 'save' => 'testimonial/original/')
							)
							);
							
							$image_name_name = $this->Allfunction->resize_image($config); // return the file anme
						}
					  }      
				$error_msg = "";
				if ($error) {
					$error_msg = "Invalid Image.";
				}
				if ($error_msg != '') {   
					$data_msg['error_msg'] = $error_msg;
					$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/testimonial/edit_testimonial');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
				}else { 
						 if ($_FILES['image_name']['name'] == '') {
							$data = array(
							'title' => $post_data['title'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						);
						}else{							
					$file = MAIN_SITE_AB_UPLOAD_PATH.'testimonial/original/'.$details[0]['image_name'];
					if(is_file($file)){unlink($file); } 
					$file = MAIN_SITE_AB_UPLOAD_PATH.'testimonial/thumb/'.$details[0]['image_name'];
					if(is_file($file)){unlink($file); } 					 
						$data = array(
							'title' => $post_data['title'],
							'image_name' => $image_name_name,
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						);
						}
					$this->Testimonial->update_page_cms($data,  $id);	
					$this->session->set_flashdata('success_msg', 'Successfully updated.');
					redirect(site_url("admin/edit-testimonial/".$id));
				}
			}
		}else{
		
		$this->load->view('backend/include/header', $data_msg);
        $this->load->view('backend/include/sidebar');
        $this->load->view('backend/testimonial/edit_testimonial');
        $this->load->view('backend/include/control-sidebar');
        $this->load->view('backend/include/footer');
		}
    }
	
	public function del_testimonial($id) {
		
        $data_msg = array();		
		$this->Testimonial->del_testimonial($id);						
		$this->session->set_flashdata('success_msg', 'Successfully Removed');
		redirect(site_url("admin/manage-testimonial"));
    }
	
	
	
 
}