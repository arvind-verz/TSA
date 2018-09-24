<?php if (!defined('BASEPATH'))exit('No direct script access allowed');
class Templates extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('templates_model', '', TRUE);
    }
	
	public function access_denied() {
		
		$data_msg = array();
        $data_msg['meta_title'] = "Access Denied";		
		$this->view('user/access_denied', $data_msg);		
	}
	
	public function manage_email_templates() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
 		if($permission=='Y'){
			$data_msg = array();		
			$data_msg['meta_title'] = "Manage Email Templates";		 
			$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
			$current_page = (int) $this->input->get('page');
			$current_page = $current_page > 0 ? $current_page : 1;		
			$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
			$limit_from = ($current_page - 1) * $items_per_page;
			$total_items = $this->templates_model->get_email_temp_num();
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3);
			$get_value = $this->templates_model->get_all_email_temp($items_per_page, $limit_from);
			$get_result = $get_value;
			$data_msg['display_result'] = $get_result;
			$this->view('templates/manage_email_templates', $data_msg);
		}
		if($permission=='N'){redirect(base_url('access-denied'));}
    }
	
	public function edit_email_templates($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){			
        $data_msg = array();
		$data_msg['meta_title'] = "Edit email template";
        $get_value = $this->templates_model->get_enquiries_temp($id);
        $details = $get_value->row_array();
        if (empty($details)) { redirect(base_url("manage-email-templates")); }

        $data_msg['subject'] = $details['subject'];
		$data_msg['template_name'] = $details['template_name'];
        $data_msg['body'] = $details['body'];
		$data_msg['parameter_desc'] = $details['parameter_desc'];
		$data_msg['id'] = $id;        
        if ($this->input->post('edit_email_templates')) {
            $subject = trim(strip_tags($this->input->post('subject')));
			$body = $this->input->post('body');
			$parameter_desc = $this->input->post('parameter_desc');
            $error_msg = "";
            if ($subject == '') { $error_msg = "Please enter subject."; }			
			if ($body == '') { $error_msg = "Please enter body."; }			
            if ($error_msg == "") {										
				 $data = array(
					'subject' => $subject,
					'body' => $body,
                    'modified_date' => date('Y-m-d H:i:s')
                );				
                $this->templates_model->update_enquiries_temp($data, $id);
                $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
            }else{
				$this->session->set_flashdata('error_msg', $error_msg);
			}			
            redirect(base_url("email-templates/$id"));
        }
        $this->view('templates/edit_email_templates', $data_msg);
		
		}if($permission=='N'){ redirect(base_url('access-denied'));}
    }	
	
	public function pre_email_templates($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];		
		$permission='Y';		
		if($permission=='Y'){			
        $data_msg = array();		
		$data_msg['meta_title'] = "Edit email template";		
		
        $get_value = $this->templates_model->get_enquiries_temp($id);
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-email-templates"));
        }
		
        $data_msg['subject'] = $details['subject'];
		$data_msg['template_name'] = $details['template_name'];
        $data_msg['body'] = $details['body'];
		$data_msg['parameter_desc'] = $details['parameter_desc'];
		$data_msg['id'] = $id;
        $this->view('templates/pre_email_templates', $data_msg);
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }	
}