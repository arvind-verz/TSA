<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Sitesettingdb', '', TRUE);
		$this->load->model('user_model', '', TRUE);
    }

    public function all_general() {
				
		$data_msg = array();		
		$data_msg['meta_title'] = "General Settings";		
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        $current_page = (int) $this->input->get('page');
        $current_page = $current_page > 0 ? $current_page : 1;		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
        $limit_from = ($current_page - 1) * $items_per_page;
        $total_items = $this->Sitesettingdb->get_tot_num();
        $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3);
        $get_value = $this->Sitesettingdb->get_all_details($items_per_page, $limit_from);
        $get_result = $get_value->result_array();
        $data_msg['display_result'] = $get_result;
        $this->view('settings/general/all_general', $data_msg);        
    }

    public function update_general($id) {
						
		$data_msg['meta_title'] = "Edit Setting";
        $data_msg = array();
        $get_value = $this->Sitesettingdb->get_details($id);
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("settings/general"));
        }
		$data_msg['option_display'] = $details['option_display'];
        $data_msg['option_value'] = $details['option_value'];
        $data_msg['modified_date'] = $details['modified_date'];
        $data_msg['option_name'] = $details['option_name'];
		$data_msg['field_type'] = $details['field_type'];
		
		$this->load->library('form_validation');
		if($details['field_type']=='Image'){
			$config = array(
				   array(
						 'field'   => 'option_value',
						 'label'   => 'Option value',
						 'rules'   => 'trim|xss_clean'
					  )			   
				);
		}else{
			$config = array(
				   array(
						 'field'   => 'option_value',
						 'label'   => 'Option value',
						 'rules'   => 'required'
					  )			   
				);

		}
		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE)
			{
				$error_msg = validation_errors();
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('settings/general/update_general', $data_msg);				
			}
			else{
				$error_msg = '';
				if($details['field_type']=='Image'){  
					if($_FILES['option_value']['tmp_name']!=''){
					  if ($this->all_function->check_image_valid($_FILES['option_value']['tmp_name'])!=1){
						 $error_msg = 'Invalid Image';
					  }else{
						  
						  if($details['option_name']=='logo')
						  {
							  
							$time = time();
							$thumb_name = $time.basename( $_FILES['option_value']['name']);
							$target_path = MAIN_SITE_AB_UPLOAD_PATH.'logo/original/'.$thumb_name;
							$target_thumb2_path = MAIN_SITE_AB_UPLOAD_PATH.'logo/thumb/'.$thumb_name;
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $_FILES['option_value']['tmp_name'];
							$config['new_image'] = $target_path;
							$config['maintain_ratio'] = TRUE;
							$config['width']    = 406;
							$config['height']   = 47;
							
							$this->load->library('image_lib', $config); //For Thumb
							$this->image_lib->resize();
							$this->image_lib->clear();
							$file = MAIN_SITE_AB_UPLOAD_PATH.'logo/original/'.$details['option_value'];
							if(is_file($file)){	unlink($file); }
							
							$option_value = $thumb_name;
							
							$configSize2['image_library'] = 'gd2';
							$configSize2['source_image'] = $_FILES['option_value']['tmp_name'];
							$configSize2['new_image'] = $target_thumb2_path;
							$configSize2['maintain_ratio'] = TRUE;
							$configSize2['width']    = 406;
							$configSize2['height']   = 47;	
							$this->image_lib->initialize($configSize2);
							$this->image_lib->resize();
							$this->image_lib->clear();
							$file1 = MAIN_SITE_AB_UPLOAD_PATH.'logo/thumb/'.$details['option_value'];
							if(is_file($file1)){unlink($file1); }
							
							
					      }elseif($details['option_name']=='footer_logo'){
							  
							  
							  $time = time();
							$thumb_name = $time.basename( $_FILES['option_value']['name']);
							$target_path = MAIN_SITE_AB_UPLOAD_PATH.'logo/original/'.$thumb_name;
							$target_thumb2_path = MAIN_SITE_AB_UPLOAD_PATH.'logo/thumb/'.$thumb_name;
							
							$config['image_library'] = 'gd2';
							$config['source_image'] = $_FILES['option_value']['tmp_name'];
							$config['new_image'] = $target_path;
							$config['maintain_ratio'] = TRUE;
							$config['width']    = 259;
							$config['height']   = 29;
							
							$this->load->library('image_lib', $config); //For Thumb
							$this->image_lib->resize();
							$this->image_lib->clear();
							$file = MAIN_SITE_AB_UPLOAD_PATH.'logo/original/'.$details['option_value'];
							if(is_file($file)){	unlink($file); }
							
							$option_value = $thumb_name;
							
							$configSize2['image_library'] = 'gd2';
							$configSize2['source_image'] = $_FILES['option_value']['tmp_name'];
							$configSize2['new_image'] = $target_thumb2_path;
							$configSize2['maintain_ratio'] = TRUE;
							$configSize2['width']    = 259;
							$configSize2['height']   = 29;	
							$this->image_lib->initialize($configSize2);
							$this->image_lib->resize();
							$this->image_lib->clear();
							$file1 = MAIN_SITE_AB_UPLOAD_PATH.'logo/thumb/'.$details['option_value'];
							if(is_file($file1)){unlink($file1); }
							  
							  
						
						  }
						
							
						}
					  } 
				}else{
					$option_value = $this->input->post('option_value');
				}
				if($error_msg == ''){
					$data = array(
							'option_value' => $option_value,
							'modified_date' => date('Y-m-d H:i:s')
						);
					$this->Sitesettingdb->update_general($data, $id);
					$this->session->set_flashdata('success_msg', 'General settings updated successfully');
					redirect(base_url("settings/update-general/$id"));
				}else{
					$data_msg['error_msg'] = $error_msg;
					$this->view('settings/general/update_general', $data_msg);
				}
            }
        }else{
        	$this->view('settings/general/update_general', $data_msg);
		}
    }
}