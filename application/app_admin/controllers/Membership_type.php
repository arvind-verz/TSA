<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Membership_type extends MY_Controller {

    function __construct() {		
        parent::__construct();
		
    }
		
	public function edit_membership_type() {
		
		$id = 1;
        $data_msg = array();
       
		
		$this->db->select('*')
			  ->from(TBL_MEMBERSHIP_TYPE)
			  ->where('id', 1);	
		 $details=$this->db->get()->result_array();
		
		//print_r($details);exit;
		
				
		$data_msg['details'] = $details;
        $data_msg['meta_title'] = "Edit Membership Types";
        $this->load->library('form_validation');
		
		$config = array(
              
				array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'trim|required'
                  ),
				array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'trim|required'
                  )
				
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = strip_tags(validation_errors());
				$data_msg['error_msg'] = $error_msg;
				$this->view('membership_type/edit_membership_type', $data_msg);
			}else {           
				$post_data = $_POST; $error_msg = '';
				$registration_form=$post_data['old_registration_form'];
			    $full_corporate_form=$post_data['old_full_corporate_form'];
				$associate_corporate_form=$post_data['old_associate_corporate_form'];
				  
						    $this->load->library('upload');
							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'form/';
							$config['allowed_types']        = 'pdf|doc|docx|PDF|DOC|DOCX';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('registration_form'))
								{
									$file = MAIN_SITE_AB_UPLOAD_PATH.'form/'.$registration_form;
		 				   			if(is_file($file)){unlink($file); } 
									$upload_data = $this->upload->data();
									$registration_form=$upload_data['file_name'];
									
									
								}
						/*===============================================*/
						    $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'form/';
							$config['allowed_types']        = 'pdf|doc|docx|PDF|DOC|DOCX';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('full_corporate_form'))
								{
									$file = MAIN_SITE_AB_UPLOAD_PATH.'form/'.$full_corporate_form;
		 				   			if(is_file($file)){unlink($file); }
									 
									$upload_data = $this->upload->data();
									$full_corporate_form=$upload_data['file_name'];
									
									
								}
					/*========================================================*/
					        $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'form/';
							$config['allowed_types']        = 'pdf|doc|docx|PDF|DOC|DOCX';
							$config['remove_spaces'] = TRUE;
							$this->upload->initialize($config);
								if ($this->upload->do_upload('associate_corporate_form'))
								{
									$file = MAIN_SITE_AB_UPLOAD_PATH.'form/'.$associate_corporate_form;
		 				   			if(is_file($file)){unlink($file); }
									 
									$upload_data = $this->upload->data();
									$associate_corporate_form=$upload_data['file_name'];
									
									
								}			
						
						if ($error_msg != '') {       
                		$data_msg['error_msg'] = $error_msg;
						$this->view('membership_type/edit_membership_type', $data_msg);
            			}else{
						
											 
				 		$data = array(
						     'title' =>$post_data['title'],
							 'description'=>$post_data['description'],
							 'registration_form' =>$registration_form,
							 'full_corporate_form'=>$full_corporate_form,
							 'associate_corporate_form' =>$associate_corporate_form
						); 
				
				     $this->db->where('id' , $id);
		             $this->db->update(TBL_MEMBERSHIP_TYPE , $data);

            	    $this->session->set_flashdata('success_msg', 'Successfully updated.');
				    redirect(base_url("manage-membership-type"));
			}
        	}
		}else{
			$this->view('membership_type/edit_membership_type', $data_msg);
		}
    } 
	
}