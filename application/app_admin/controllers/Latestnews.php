<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Latestnews extends MY_Controller {



    function __construct() {		

        parent::__construct();

		$this->load->model('Latestnews_model', '', TRUE);

		$this->load->helper("file");

		

		$this->load->library('upload');

		$this->load->library('image_lib');

    }



    public function manage_latestnews(){

		

		$data_msg = array();		

        

        $data_msg['meta_title'] = "Latestnews Manager";

		

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

			$data_msg['total'] = $total_items = $this->Latestnews_model->count_latestnews_filter($FlterData);			

			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-latestnews'));

			$data_msg['display_result'] = $this->Latestnews_model->get_latestnews_filter($items_per_page, $limit_from, $FlterData)->result_array();

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				$get_result = $this->Latestnews_model->get_latestnews_details($del_id);				

				$details = $get_result->result_array();			

				

				

				$file = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/original/'.$details[0]['image_banner'];				

				if(is_file($file)){ unlink($file); }

				$file = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/thumb/'.$details[0]['image_banner'];

				if(is_file($file)){unlink($file); }

				 				  

				$this->Latestnews_model->del_latestnews($del_id);

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');

			  redirect(base_url('manage-latestnews'));

			  exit;

			  }else{redirect(base_url('manage-latestnews'));}			

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				  $data = array('status' => 'Y');

                  $this->Latestnews_model->update_latestnews($data,  $del_id);

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');

			  redirect(base_url('manage-latestnews'));

			  exit;

			  }else{redirect(base_url('manage-latestnews'));}			

		}

		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				

			$checkbox_arr = $this->input->post('id');

			if(count($checkbox_arr) !== 0){

			  foreach ($checkbox_arr as $del_id){

				 $data = array('status' => 'N');

                 $this->Latestnews_model->update_latestnews($data,  $del_id);

			  }

			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');

			  redirect(base_url('manage-latestnews'));

			  exit;

			  }else{redirect(base_url('manage-latestnews'));}			

		}

		elseif($this->session->userdata('FlterData')){

			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');

			  $data_msg['total'] = $total_items = $this->Latestnews_model->count_latestnews_filter($FlterData);

			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-latestnews'));

			  $data_msg['display_result'] = $this->Latestnews_model->get_latestnews_filter($items_per_page, $limit_from, $FlterData)->result_array();

		}else{

		  $this->session->set_userdata(array('FlterData' => '' ));					

		  $FlterData = array(

				'title'=>'',							

				'post_date'=>'',

				'status'=>''											

				);

			$data_msg['FlterData'] = $FlterData;

			$total_items = $this->Latestnews_model->count_latestnews();

			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-latestnews'));

			$get_value = $this->Latestnews_model->get_latestnews($items_per_page, $limit_from);

			$data_msg['display_result'] = $get_value->result_array();

		}		

        $this->view('latestnews/manage_latestnews', $data_msg);

    } //Validation

	

	public function add_latestnews() {

		

        $data_msg = array();



        $data_msg['meta_title'] = "Add latestnews";



        $this->load->library('form_validation');

		

		$config = array(

               array(

                     'field'   => 'title',

                     'label'   => 'Title',

                     'rules'   => 'required'

                  ),

				array(

                     'field'   => 'seo_url',

                     'label'   => 'Url',

                     'rules'   => 'trim|required|is_unique['.TBL_LATESTNEWS.'.seo_url]'

                  ),

				array(

                     'field'   => 'description',

                     'label'   => 'Description',

                     'rules'   => 'required'

                  ),

				array(

                     'field'   => 'post_date',

                     'label'   => 'Post Date',

                     'rules'   => 'required'

                  ),      

               array(

                     'field'   => 'status',

                     'label'   => 'Status',

                     'rules'   => 'required'

                  )

			   

            );



		$this->form_validation->set_rules($config);

		

		if($_POST){				

			if ($this->form_validation->run() == FALSE)

			{

				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());

				$this->view('latestnews/add_latestnews', $data_msg);

			}

			else{



            $post_data = $_POST; $error_msg = "";$image_banner='';$image_name='';

            

				 

				 ###

			  if($_FILES['image_banner']['tmp_name']!=''){

				  

				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){

					  $error_msg = "Invalid  Banner Image.";  

				  }else{

					        $config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/original/';

							$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';

							$config['remove_spaces'] = TRUE;

							$this->upload->initialize($config);

								if ($this->upload->do_upload('image_banner'))

								{ 

									$upload_data = $this->upload->data();

									$image_banner=$upload_data['file_name'];

									

									$config['image_library'] = 'gd2';

									$config['source_image'] = $upload_data['full_path'];

									$config['create_thumb'] = false;

									$config['maintain_ratio'] = false;

									$config['new_image'] =MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/thumb/'.$upload_data['file_name'];

									$config['width']         = 1400;

									$config['height']       = 350;

								

									$this->image_lib->initialize($config);

									$this->image_lib->resize();

									$this->image_lib->clear();

								}else{

									$upload_error= array('error' => $this->upload->display_errors()); 

									$error_msg=$upload_error['error'];

									

								}

					}

				  

				  }else{$image_banner = '';}

				  ### 

				  

				   

			

            if ($error_msg != '') {    

                $data_msg['error_msg'] = $error_msg;

				$this->view('latestnews/add_latestnews', $data_msg);

            }else { 

					$post_date = str_replace("/", "-", $post_data['post_date']); 

					$post_date = date("Y-m-d", strtotime($post_date));

			

                    $data = array(

                        'title' => $post_data['title'],

						'description' => $post_data['description'],

						'image_banner' => $image_banner,

						//'image_name' => $image_name,

						'post_date' => $post_date,

						'status' => $post_data['status'],

						'seo_url' => $post_data['seo_url'],

						'seo_title' => $post_data['seo_title'],

						'seo_keyword' => $post_data['seo_keyword'],

						'seo_description' => $post_data['seo_description'],

						'create_date' => date('Y-m-d H:i:s'),

						'modified_date' => date('Y-m-d H:i:s')

                    ); 

                    $this->Latestnews_model->add_latestnews($data);

                $this->session->set_flashdata('success_msg', 'Successfully added');

				redirect(base_url("manage-latestnews"));

            }



            

        	}

		}else{

        	$this->view('latestnews/add_latestnews', $data_msg);

		}

    } //Validation

		

	public function edit_latestnews($id) {

		

        $data_msg = array();

        $get_result = $this->Latestnews_model->get_latestnews_details($id);		

        $details = $get_result->result_array();

		

		if (count($details) == 0) {

            redirect(base_url('manage-latestnews'));

            exit;

        }

		

		$data_msg['details'] = $details;

        $data_msg['meta_title'] = "Edit latestnews";

        $this->load->library('form_validation');

		

		$config = array(

               array(

                     'field'   => 'title',

                     'label'   => 'Title',

                     'rules'   => 'required'

                  ),

				array(

                     'field'   => 'seo_url',

                     'label'   => 'Url',

                     'rules'   => 'trim|required|callback_edit_unique['.TBL_LATESTNEWS.'.seo_url.'.$id.']'

                  ),

				array(

                     'field'   => 'description',

                     'label'   => 'Description',

                     'rules'   => 'required'

                  ),

				array(

                     'field'   => 'post_date',

                     'label'   => 'Post Date',

                     'rules'   => 'required'

                  ),      

               array(

                     'field'   => 'status',

                     'label'   => 'Status',

                     'rules'   => 'required'

                  )

			   

            );



		$this->form_validation->set_rules($config);

		

		if($_POST){				

			if ($this->form_validation->run() == FALSE)

			{

				$error_msg = strip_tags(validation_errors());

				$data_msg['error_msg'] = $error_msg;

				$this->view('latestnews/edit_latestnews', $data_msg);

			}else {           

				$post_data = $_POST; $error_msg = '';

				

				$image_banner=$this->input->post('image_banner_old');

			   

				

				

				$post_date = str_replace("/", "-", $post_data['post_date']); 

				$post_date = date("Y-m-d", strtotime($post_date));

				  

				

					

					

				 

					

				 /*============================== */

				 if($_FILES['image_banner']['tmp_name']!=''){

				  if ($this->all_function->check_image_valid($_FILES['image_banner']['tmp_name'])!=1){

					 $error_msg .= 'Invalid Banner Image.'; 

				  }else{

						

						$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/original/';

                		$config['allowed_types']        = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';

						$config['remove_spaces'] = TRUE;

						//$config['overwrite'] = TRUE;

						$this->upload->initialize($config);

						if ($this->upload->do_upload('image_banner'))

				        {

							

							//@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'latestnews/banner/' .$this->input->post('image_banner_old'));

	  						@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'latestnews/banner/original/' .$this->input->post('image_banner_old'));

							@unlink(MAIN_SITE_AB_UPLOAD_PATH . 'latestnews/banner/thumb/' .$this->input->post('image_banner_old'));

							

							$upload_data = $this->upload->data();

							$image_banner=$upload_data['file_name'];

							

							$config['image_library'] = 'gd2';

							$config['source_image'] = $upload_data['full_path'];

							$config['create_thumb'] = false;

							$config['maintain_ratio'] = FALSE;

							$config['new_image']=MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/thumb/'.$upload_data['file_name'];

							$config['width']         = 1400;

							$config['height']       = 350;

							

							$this->image_lib->initialize($config);

							

							$this->image_lib->resize();

							if (!$this->image_lib->resize()) {

								echo $this->image_lib->display_errors();

						    }

							$this->image_lib->clear();

							

							

							

						

						}

						

						

						

					}

				  

				  }	

				  

				  

			  if ($error_msg != '') { 

				$data_msg['error_msg'] = $error_msg;      

                $this->view('latestnews/edit_latestnews', $data_msg);

               }else {

				   

				 $data = array(

							'title' => $post_data['title'],

							'description' => $post_data['description'],

							//'image_name' => $image_name,

							'image_banner' => $image_banner,

							'post_date' => $post_date,

							'status' => $post_data['status'],

							'seo_url' => $post_data['seo_url'],

							'seo_title' => $post_data['seo_title'],

							'seo_keyword' => $post_data['seo_keyword'],

							'seo_description' => $post_data['seo_description'],

							'modified_date' => date('Y-m-d H:i:s')

						);  

				  

			   }

				##

				  

				  

					

					

            	$this->Latestnews_model->update_latestnews($data,  $id);



            	$this->session->set_flashdata('success_msg', 'Successfully updated.');

				redirect(base_url("edit-latestnews/$id"));

        	}

		}else{

			$this->view('latestnews/edit_latestnews', $data_msg);

		}

    } //Validation

	

	public function del_latestnews($id) {		

        $data_msg = array();	

        $details = $this->Latestnews_model->get_latestnews_details($id)->result_array();

		$file = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/original/'.$details[0]['image_banner'];

		if(is_file($file)){unlink($file);}

		$file = MAIN_SITE_AB_UPLOAD_PATH.'latestnews/banner/thumb/'.$details[0]['image_banner'];

		if(is_file($file)){unlink($file);}

		

		

		

		$this->Latestnews_model->del_latestnews($id);						

		$this->session->set_flashdata('success_msg', 'Successfully Removed');		

		redirect(base_url("manage-latestnews"));

    } //Validation

	

	

	

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