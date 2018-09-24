<?php if (!defined('BASEPATH'))exit('No direct script access allowed');



class Otherevent extends MY_Controller {



    function __construct() {		

        parent::__construct();

        $this->load->model('Otherevent_model', '', TRUE);

    }

	

	 public function manage_otherevent() {

		

		$data_msg = array();		

        		

        $data_msg['meta_title'] = "Supported Event Manager";

		

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

			$data_msg['total'] = $total_items = $this->Otherevent_model->count_otherevent_filter($FlterData);			

			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-supportedevents'));

			$data_msg['display_result'] = $this->Otherevent_model->get_otherevent_filter($items_per_page, $limit_from, $FlterData)->result_array();

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				  $details = $this->Otherevent_model->get_otherevent_details($del_id)->result_array();

				         

						 

						 

		 

		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/original/'.$details[0]['image_name'];

		 				if(is_file($file)){unlink($file); } 

		 				$file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/thumb/'.$details[0]['image_name'];

		 				if(is_file($file)){unlink($file); }

						 

						 

						  

				$this->Otherevent_model->del_otherevent($del_id);	

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');

			  redirect(base_url('manage-supportedevents'));

			  exit;

			  }else{redirect(base_url('manage-supportedevents'));exit;}			

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				  $data = array('status' => 'Y');

                  $this->Otherevent_model->update_otherevent($data,  $del_id);

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');

			  redirect(base_url('manage-supportedevents'));

			  exit;

			  }else{redirect(base_url('manage-supportedevents'));exit;}			

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				 $data = array('status' => 'N');

                 $this->Otherevent_model->update_otherevent($data,  $del_id);

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');

			  redirect(base_url('manage-supportedevents'));

			  exit;

			  }else{redirect(base_url('manage-supportedevents'));exit;}			

		}

		elseif($this->session->userdata('FlterData')){

			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');

			  $data_msg['total'] = $total_items = $this->Otherevent_model->count_otherevent_filter($FlterData);

			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-supportedevents'));

			  $data_msg['display_result'] = $this->Otherevent_model->get_otherevent_filter($items_per_page, $limit_from, $FlterData)->result_array();

		}else{

		 $this->session->set_userdata(array('FlterData' => '' ));					

		  $FlterData = array(

				'url'=>'',

				'status'=>''											

				);

		    $data_msg['FlterData'] = $FlterData;

        	$total_items = $this->Otherevent_model->count_otherevent();

        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-supportedevents'));

        	$get_value = $this->Otherevent_model->get_otherevent($items_per_page, $limit_from);

       		$data_msg['display_result'] = $get_value->result_array();

		}

		

        $this->view('otherevent/manage_otherevent', $data_msg);

    }

	public function add_otherevent() {

		

        $data_msg = array();



        $data_msg['meta_title'] = "Add Supported Event";

		

		$this->load->library('form_validation');

		

		$config = array(

               array(

				 'field'   => 'url',

				 'label'   => 'Url',

				 'rules'   => 'required'

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

				$this->view('otherevent/add_otherevent', $data_msg);

			}

			else {

              $post_data = $_POST; $error_msg = '';$im_nm='';

					##

					if ($_FILES['image_name']['name'] == '') {$error_msg = 'Need Image.';}

					else{

							$this->load->library('upload');

							$this->load->library('image_lib');

							$im_nm='';

							$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/original/';

							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';

							$config['remove_spaces'] = TRUE;

							$this->upload->initialize($config);

								if ($this->upload->do_upload('image_name'))

								{ 

									$upload_data = $this->upload->data();

									$im_nm=$upload_data['file_name'];

									

									$config['image_library'] = 'gd2';

									$config['source_image'] = $upload_data['full_path'];

									$config['create_thumb'] = false;

									$config['maintain_ratio'] = false;

									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'otherevent/thumb/'.$upload_data['file_name'];

									$config['width']         = 293;

									$config['height']       = 186;

								

									$this->image_lib->initialize($config);

									$this->image_lib->resize();

									$this->image_lib->clear();

								}else{

									$upload_error= array('error' => $this->upload->display_errors()); 

									$error_msg=$upload_error['error'];

									

								}

					}

					##

					

			  if ($error_msg != '') {       

					$data_msg['error_msg'] = $error_msg;

					$this->view('otherevent/add_otherevent', $data_msg);

                }else {

			  

			  $data = array(					

						'url' => $post_data['url'],

						'image_name' => $im_nm,

						'sort_order' => $post_data['sort_order'],

						'create_date' => date('Y-m-d H:i:s'),

						'status' => $post_data['status']

                    ); 

                    $page_id = $this->Otherevent_model->add_otherevent($data);

					

                $this->session->set_flashdata('success_msg', 'Successfully added');

            	redirect(base_url("manage-supportedevents"));

				}

        	}

		}else{		

        	$this->view('otherevent/add_otherevent', $data_msg);

		}

    }

	

	public function del_otherevent($id) {

		

        $data_msg = array();

		

		$details = $this->Otherevent_model->get_otherevent_details($id)->result_array();

		 

		 

		 $file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/original/'.$details[0]['image_name'];

		 if(is_file($file)){unlink($file); } 

		 $file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/thumb/'.$details[0]['image_name'];

		 if(is_file($file)){unlink($file); }

		 

		  

		

		$this->Otherevent_model->del_otherevent($id);			

						

		$this->session->set_flashdata('success_msg', 'Successfully Removed');

		

		redirect(base_url("manage-supportedevents"));

       

    }

	

	public function edit_otherevent($id){

		

        $data_msg = array();



        $data_msg['meta_title'] = "Edit Supported Event";

		

		$this->load->library('form_validation');

		

		$config = array(

               array(

				 'field'   => 'url',

				 'label'   => 'URL',

				 'rules'   => 'required'

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

		

		$get_result = $this->Otherevent_model->get_otherevent_details($id);

		$details = $get_result->result_array();

        if (count($details) == 0) {			

				redirect(base_url("manage-supportedevents"));

        }

		$data_msg['details'] = $details;

		if($_POST){	

			if ($this->form_validation->run() == FALSE)

			{	

				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());

				$this->view('otherevent/edit_otherevent', $data_msg);

			}else {           

             $post_data = $_POST;$error_msg = '';

			  $image_name=$post_data['old_image_name'];

			  

					##

					$this->load->library('upload');

					$this->load->library('image_lib');

					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/original/';

                	$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';

					$config['remove_spaces'] = TRUE;

					$this->upload->initialize($config);

						if($this->upload->do_upload('image_name'))

				        { 

						

						   $file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/original/'.$image_name;

		 				   if(is_file($file)){unlink($file); } 

		 				   $file = MAIN_SITE_AB_UPLOAD_PATH.'otherevent/thumb/'.$image_name;

		                   if(is_file($file)){unlink($file); }

						

							$upload_data = $this->upload->data();

							$image_name=$upload_data['file_name'];

							

							$config['image_library'] = 'gd2';

							$config['source_image'] = $upload_data['full_path'];

							$config['create_thumb'] = false;

							$config['maintain_ratio'] = false;

							$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'otherevent/thumb/'.$upload_data['file_name'];

							$config['width']         = 293;

							$config['height']       = 186;

						

							$this->image_lib->initialize($config);

							$this->image_lib->resize();

							$this->image_lib->clear();

					    }

					##

			 if ($error_msg != '') {       

                $data_msg['error_msg'] = $error_msg;

				$this->view('otherevent/edit_otherevent', $data_msg);

            }else{

			  $data = array(					

						'url' => $post_data['url'],

						'image_name' => $image_name,

						'sort_order' => $post_data['sort_order'],

						'status' => $post_data['status']

                    );		

				

				$this->Otherevent_model->update_otherevent($data,  $id);

                $this->session->set_flashdata('success_msg', 'Successfully updated.');				

				redirect(base_url("edit-supportedevents/$id")); 

			 

			 

			 

			}

        	}

		}else{

			$this->view('otherevent/edit_otherevent', $data_msg);

		}

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