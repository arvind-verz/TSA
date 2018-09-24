<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Our_network extends MY_Controller {

    function __construct() {		
        parent::__construct();
		//$this->load->model('Homeboxes_model', '', TRUE);
		//$this->load->helper("file");
    }
		
	public function edit_our_network() {
		
		$id = 1;
        $data_msg = array();
       
		
		$this->db->select('*')
			  ->from(TBL_OUR_NETWORK)
			  ->where('id', 1);	
		 $details=$this->db->get()->result_array();
		
		//print_r($details);exit;
		
				
		$data_msg['details'] = $details;
        $data_msg['meta_title'] = "Edit Our Network";
        $this->load->library('form_validation');
		
		$config = array(
              
				array(
                     'field'   => 'name',
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
				$this->view('our_network/edit_our_network', $data_msg);
			}else {           
				$post_data = $_POST; $error_msg = '';
				  
											 
				 		$data = array(
						     'name' =>$post_data['name'],
							 'description'=>$post_data['description'],
							'create_date' => date('Y-m-d H:i:s')
						); 
					
				
				$this->db->where('id' , $id);
		       $this->db->update(TBL_OUR_NETWORK , $data);

            	$this->session->set_flashdata('success_msg', 'Successfully updated.');
				redirect(base_url("manage-our-network"));
        	}
		}else{
			$this->view('our_network/edit_our_network', $data_msg);
		}
    } 
	
}