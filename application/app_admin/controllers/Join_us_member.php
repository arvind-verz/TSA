<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Join_us_member extends MY_Controller {



    function __construct() {		

        parent::__construct();

		//$this->load->model('Homeboxes_model', '', TRUE);

		//$this->load->helper("file");

    }

		

	public function edit_join_us_member() {

		

		$id = 1;

        $data_msg = array();

       

		

		$this->db->select('*')

			  ->from(TBL_JOIN_US_MEMBER)

			  ->where('id', 1);	

		 $details=$this->db->get()->result_array();

		

		//print_r($details);exit;

		

				

		$data_msg['details'] = $details;

        $data_msg['meta_title'] = "Edit Our Member";

        $this->load->library('form_validation');

		

		$config = array(

              

				array(

                     'field'   => 'full_corporate1',

                     'label'   => 'Full Corporate(A-L)',

                     'rules'   => 'trim|required'

                  ),

				array(

                     'field'   => 'full_corporate2',

                     'label'   => 'Full Corporate(M-Z)',

                     'rules'   => 'trim|required'

                  ),

				  array(

                     'field'   => 'associate_corporate1',

                     'label'   => 'Associate Corporate(A-L)',

                     'rules'   => 'trim|required'

                  ),

				array(

                     'field'   => 'associate_corporate2',

                     'label'   => 'Associate Corporate(M-Z)',

                     'rules'   => 'trim|required'

                  ),

				  array(

                     'field'   => 'associate_individual',

                     'label'   => 'Associate Individual',

                     'rules'   => 'trim|required'

                  ),

				array(

                     'field'   => 'others',

                     'label'   => 'Others',

                     'rules'   => 'trim|required'

                  )

				  

				  

				

            );



		$this->form_validation->set_rules($config);

		

		if($_POST){				

			if ($this->form_validation->run() == FALSE)

			{

				$error_msg = strip_tags(validation_errors());

				$data_msg['error_msg'] = $error_msg;

				$this->view('join_us_member/edit_join_us_member', $data_msg);

			}else {           

				$post_data = $_POST; $error_msg = '';

				  

											 

				 		$data = array(

						     'full_corporate1' =>$post_data['full_corporate1'],

							 'full_corporate2'=>$post_data['full_corporate2'],

							 'associate_corporate1' =>$post_data['associate_corporate1'],

							 'associate_corporate2'=>$post_data['associate_corporate2'],

							 'associate_individual' =>$post_data['associate_individual'],

							 'others'=>$post_data['others'],

							'create_date' => date('Y-m-d H:i:s')

						); 

					

				

				$this->db->where('id' , $id);

		       $this->db->update(TBL_JOIN_US_MEMBER , $data);



            	$this->session->set_flashdata('success_msg', 'Successfully updated.');

				redirect(base_url("manage-our-member"));

        	}

		}else{

			$this->view('join_us_member/edit_join_us_member', $data_msg);

		}

    } 

	

}