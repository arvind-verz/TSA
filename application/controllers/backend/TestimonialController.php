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
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial');

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
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial');
        $this->breadcrumbs->push(CREATE, 'admin/add-testimonial');
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
						$file_name_placeholder = array_keys($_FILES);
            $image_file = $_FILES['testimonial']['name'];

            $_POST['testimonial'] = upload_image_file($image_file, $file_name_placeholder[0], 200, 200);
            $post_data = $_POST;				
						$data = array(
							'title' => $post_data['title'],
							'image_name' => $post_data['testimonial'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						); 
						$this->Testimonial->add_testimonial($data);
						$this->session->set_flashdata('success', 'Testimonial ' . MSG_CREATED);		
					return redirect("admin/manage-testimonial");
				
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
        $this->breadcrumbs->push(TESTIMONIAL, 'admin/manage-testimonial');
        $this->breadcrumbs->push(EDIT, 'admin/edit-testimonial' . $id);
        $data_msg['breadcrumbs'] = $this->breadcrumbs->show();
        $data_msg['title']       = $this->title;
        $data_msg['page_title']  = TESTIMONIAL;
		$data_msg['meta_title'] = TESTIMONIAL;
        $get_result = $this->Testimonial->get_testimonial_details($id);
        $details = $get_result->result_array();
		
		if (count($details) == 0) { return redirect('admin/manage-testimonial');}
		
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
								$file_name_placeholder = array_keys($_FILES);
            $image_file = $_FILES['testimonial']['name'];
            if($image_file) {
                $_POST['testimonial'] = upload_image_file($image_file, $file_name_placeholder[0], 200, 200);
            }	 
            $post_data = $_POST;
						$data = array(
							'title' => $post_data['title'],
							'image_name' => isset($post_data['testimonial']) ? $post_data['testimonial'] : $post_data['testimonial_exists'],
							'sort_order' => $post_data['sort_order'],
							'date' => date('Y-m-d'),
							'status' => $post_data['status'],
							'content' => $post_data['content']
						);
						
					$this->Testimonial->update_page_cms($data,  $id);	
					$this->session->set_flashdata('success', 'Testimonial ' . MSG_UPDATED);
					return redirect("admin/manage-testimonial");
				
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
		$this->session->set_flashdata('success', 'Testimonial' . MSG_DELETED);
		return redirect("admin/manage-testimonial");
    }
	
	
	
 
}