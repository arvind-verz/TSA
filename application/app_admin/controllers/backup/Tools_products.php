<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tools_products extends MY_Controller {

    function __construct() {
		
        parent::__construct();
        $this->load->model('Tools_products_model', '', TRUE);
		$this->load->model('Tools_categories_model', '', TRUE);
    }

    public function manage_tools_products() {
		
		$data_msg = array();		
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array(); 		
        $data_msg['meta_title'] = "Products Manager";		
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
			$data_msg['total'] = $total_items = $this->Tools_products_model->count_products_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-tools-products'));
			$data_msg['display_result'] = $this->Tools_products_model->get_products_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
		if(count($checkbox_arr) !== 0){
		  foreach ($checkbox_arr as $del_id){
			  $get_result = $this->Tools_products_model->get_products_details($del_id);				
			  $details = $get_result->result_array();				
			  
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/home/'.$details[0]['image_name'];
			if(is_file($file)){unlink($file); }
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/details/'.$details[0]['image_name'];
			if(is_file($file)){unlink($file); }
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/viwed/'.$details[0]['image_name'];
			if(is_file($file)){unlink($file); }
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/thumb/'.$details[0]['image_name'];
			if(is_file($file)){unlink($file); }
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/original/'.$details[0]['image_name'];
			if(is_file($file)){unlink($file); }
			
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/listing/'.$details[0]['image_listing'];
			if(is_file($file)){unlink($file); }
			 
			   
			  $this->Tools_products_model->del_product_pdf($del_id);
		     $this->Tools_products_model->del_product_video($del_id);			
			 $this->Tools_products_model->del_products($del_id);
		  }
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
		  redirect(base_url('manage-tools-products'));
		  }else{redirect(base_url('manage-tools-products'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='SortOrder'){			
			$checkbox_arr = $this->input->post('orderid');
			$order_arr = $this->input->post('sort_order');
			$c = 0;
			foreach ($checkbox_arr as $del_id){
			  $data = array('sort_order' => $order_arr[$c]);
			  $this->Tools_products_model->update_page_cms($data,  $del_id);
			  $c++;
			}
			$this->session->set_flashdata('success_msg', 'Records have been sorted successfully');
			redirect(base_url('manage-products'));			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Enable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				  $data = array('status' => 'Y');
                  $this->Tools_products_model->update_page_cms($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-tools-products'));
			  }else{redirect(base_url('manage-tools-products'));}			
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Disable'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $data = array('status' => 'N');
                 $this->Tools_products_model->update_page_cms($data,  $del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been updated successfully');
			  redirect(base_url('manage-tools-products'));
			  }else{redirect(base_url('manage-tools-products'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Tools_products_model->count_products_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-tools-products'));
			  $data_msg['display_result'] = $this->Tools_products_model->get_products_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		  $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'product_name'=>'',							
				'cat_id'=>'',
				'status'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Tools_products_model->count_products();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-tools-products'));
        	$get_value = $this->Tools_products_model->get_products($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('ExportProducts' => $sql_last[0] ));
        $this->view('tools_products/manage_tools_products', $data_msg);
    }
	
	public function add_tools_products() {
		
        $data_msg = array();		
        $data_msg['meta_title'] = "Add Products";				
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array();		
		$this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'product_name',
                     'label'   => 'Product Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|is_unique['.TBL_TOOLS_PRODUCTS.'.seo_url]'
                  ),
				array(
                     'field'   => 'product_short_description',
                     'label'   => 'Product Short Descriptions',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'about_product',
                     'label'   => 'About The Product',
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
                  )
			   
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){				
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_products/add_tools_products', $data_msg);
			}else{
            	$post_data = $_POST; $error_msg = '';$image_listing='';
				
				if ($_FILES['image_listing']['name'] == '') {$error_msg = 'Need Product Listing Image.';}
				elseif($_FILES['image_listing']['tmp_name']!=''){				  
				  if ($this->all_function->check_image_valid($_FILES['image_listing']['tmp_name'])!=1){
					 $error_msg = 'Invalid Product Listing Image.'; 
				  }else{
					  $config = array(
						'source' => 'image_listing', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 209, 'width' => 266, 'save' => 'tools_products/listing/')
						/*array('height' => 363, 'width' => 462, 'save' => 'products/big/'),
						array('height' => 70, 'width' => 90, 'save' => 'products/thumb/'),
						array('save' => 'products/original/')*/
						)
						);						
						$image_listing = $this->all_function->resize_image($config); // return the file anme
					}				  
				}
				
				
				
			    if ($_FILES['image_name']['name'] == '') {$error_msg = 'Need Product Main Image.';}
                elseif($_FILES['image_name']['tmp_name']!=''){				  
				  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){
					 $error_msg = 'Invalid Product Main Image.'; 
				  }else{
					  $config = array(
						'source' => 'image_name', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 360, 'width' => 380, 'save' => 'tools_products/home/'),
						array('height' => 427, 'width' => 453, 'save' => 'tools_products/details/'),
						array('height' => 67, 'width' => 67, 'save' => 'tools_products/viwed/'),
						array('height' => 81, 'width' => 81, 'save' => 'tools_products/thumb/'),
						array('save' => 'tools_products/original/')
						)
						);						
						$image_name_name = $this->all_function->resize_image($config); // return the file anme
					}				  
				}        
                if ($error_msg != '') {       
					$data_msg['error_msg'] = $error_msg;
					$this->view('tools_products/add_tools_products', $data_msg);
                }else { 					
                    $data = array(
                        'product_name' => $post_data['product_name'],
						'featured_product'=>isset($post_data['featured_product'])?$post_data['featured_product']:'N',
						'product_short_description' => $post_data['product_short_description'],
						'about_product' => $post_data['about_product'],
						'standard_equipment' => $post_data['standard_equipment'],
						'it' => $post_data['it'],
						'specification' => $post_data['specification'],
						'spare_parts' => $post_data['spare_parts'],
						'cat_id' => $post_data['cat_id'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'image_name' => $image_name_name,
						'image_listing' => $image_listing,
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status'],
						'create_date' => date('Y-m-d H:i:s'),
						'modified_date' => date('Y-m-d H:i:s')
                    ); 
					
                    $products_id =  $this->Tools_products_model->add_products($data);					
					$c=0;					
					$img = count($_FILES["file"]["tmp_name"]);					
					for ($i=0;$i<$img;$i++) {
						if($_FILES["file"]["tmp_name"][$i]!=''){
								  $config = array(
									'source' => 'file', 
									'temp' => 'tmp_name', 
									'resize' => array(
									array('height' => 427, 'width' => 453, 'save' => 'tools_products/details/'),
									array('height' => 81, 'width' => 81, 'save' => 'tools_products/thumb/'),
									array('save' => 'tools_products/original/')
									)
									);
									
						$image_name_name = $this->all_function->resize_image($config,$i); // return the file anme
							$c++;
							$data = array(
								'products_id' => $products_id,
								'image_name' => $image_name_name,					
								'sort_order' => $c
              				  );
							$this->Tools_products_model->add_additional_images_file($data);
						}

					}
					
					##
					$this->load->library('upload');
					$im_nm='';$cnt=0;
					$pdf_title=$this->input->post('pdf_title');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/pdf/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
					$number_of_files = sizeof($_FILES['pdf_name']['tmp_name']);
					$files = $_FILES['pdf_name'];
					for ($k = 0; $k < $number_of_files; $k++)
				    {
						$_FILES['pdf_name']['name'] = $files['name'][$k];
						$_FILES['pdf_name']['type'] = $files['type'][$k];
						$_FILES['pdf_name']['tmp_name'] = $files['tmp_name'][$k];
						$_FILES['pdf_name']['error'] = $files['error'][$k];
						$_FILES['pdf_name']['size'] = $files['size'][$k];
						
						if ($this->upload->do_upload('pdf_name'))
				        { $cnt++;
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
							$path_parts = pathinfo($im_nm);

							
								$data_to_store = array(
								'products_id' => $products_id,
								'title' => !empty($pdf_title[$k])?$pdf_title[$k]:$path_parts['filename'],
								'pdf_name' => $im_nm,
								'sort_order' => $cnt
								);
								$this->db->insert(TBL_TOOLS_PRODUCTS_PDF, $data_to_store);
							
							
					    }
						
					}
					##
					
					
										
					
                $this->session->set_flashdata('success_msg', 'Successfully added');
				redirect(base_url("manage-tools-products"));
            }

            
        	}
		}else{
			$this->view('tools_products/add_tools_products', $data_msg);
		}
    }
		
	public function edit_tools_products($id) {
		
        $data_msg = array();		 
        $get_result = $this->Tools_products_model->get_products_details($id);
        $details = $get_result->result_array();		
		if (count($details) == 0) {redirect(base_url('manage-tools-products'));}
		
		$data_msg['details'] = $details;		
		$data_msg['category'] = $this->Tools_categories_model->get_root_categories()->result_array();		
        $data_msg['additional_images'] = $this->Tools_products_model->get_additional_images_file($id)->result_array();		
		$data_msg['pdf'] = $this->Tools_products_model->get_additional_pdf_file($id)->result_array();
		        
		$data_msg['meta_title'] = "Edit Products";				
		$this->load->library('form_validation');
		
		$config = array(
               array(
                     'field'   => 'product_name',
                     'label'   => 'Product Name',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'seo_url',
                     'label'   => 'Url',
                     'rules'   => 'trim|required|callback_edit_unique['.TBL_TOOLS_PRODUCTS.'.seo_url.'.$id.']'
                  ),
				array(
                     'field'   => 'product_short_description',
                     'label'   => 'Product Short Descriptions',
                     'rules'   => 'required'
                  ), 
				array(
                     'field'   => 'about_product',
                     'label'   => 'About The Product',
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
                  )
            );

		$this->form_validation->set_rules($config);
		
		if($_POST){	
			
			if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_products/edit_tools_products', $data_msg);
			}else {           
            $post_data = $_POST; $error_msg = '';
			$image_name_name=$post_data['old_image_name'];
			$image_listing=$post_data['image_listing_old'];
			
			if($_FILES['image_listing']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_listing']['tmp_name'])!=1){
					 $error_msg = 'Invalid Product Listing Image.'; 
				  }else{
					  $config = array(
						'source' => 'image_listing', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 209, 'width' => 266, 'save' => 'tools_products/listing/')
						)
						);
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/listing/'.$image_listing;
						if(is_file($file)){unlink($file); }						
						$image_listing = $this->all_function->resize_image($config); 
						
						
					}				  
		     }
			
			
						
			if($_FILES['image_name']['tmp_name']!=''){
				  if ($this->all_function->check_image_valid($_FILES['image_name']['tmp_name'])!=1){
					 $error_msg = 'Invalid Product Main Image.'; 
				  }else{
					  $config = array(
						'source' => 'image_name', 
						'temp' => 'temp',
						'resize' => array(
						array('height' => 360, 'width' => 380, 'save' => 'tools_products/home/'),
						array('height' => 427, 'width' => 453, 'save' => 'tools_products/details/'),
						array('height' => 67, 'width' => 67, 'save' => 'tools_products/viwed/'),
						array('height' => 81, 'width' => 81, 'save' => 'tools_products/thumb/'),
						array('save' => 'tools_products/original/')
						)
						);
						
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/home/'.$image_name_name;
						if(is_file($file)){unlink($file); }
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/details/'.$image_name_name;
						if(is_file($file)){unlink($file); }
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/viwed/'.$image_name_name;
						if(is_file($file)){unlink($file); }
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/thumb/'.$image_name_name;
						if(is_file($file)){unlink($file); }
						$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/original/'.$image_name_name;
						if(is_file($file)){unlink($file); }						
						$image_name_name = $this->all_function->resize_image($config); 
					}				  
		    }      
            if ($error_msg != '') {       
                $data_msg['error_msg'] = $error_msg;
				$this->view('tools_products/edit_tools_products', $data_msg);
            }else { 
                    $data = array(
                        'product_name' => $post_data['product_name'],
						'featured_product'=>isset($post_data['featured_product'])?$post_data['featured_product']:'N',
						'product_short_description' => $post_data['product_short_description'],
						'about_product' => $post_data['about_product'],
						'standard_equipment' => $post_data['standard_equipment'],
						'it' => $post_data['it'],
						'specification' => $post_data['specification'],
						'spare_parts' => $post_data['spare_parts'],
						'cat_id' => $post_data['cat_id'],
						'seo_url' => $post_data['seo_url'],
						'seo_keyword' => $post_data['seo_keyword'],
						'seo_description' => $post_data['seo_description'],
						'seo_title' => $post_data['seo_title'],
						'image_name' => $image_name_name,
						'image_listing' => $image_listing,
						'sort_order' => $post_data['sort_order'],
						'status' => $post_data['status'],
						'modified_date' => date('Y-m-d H:i:s')
                    );
					
                    $this->Tools_products_model->update_page_cms($data,  $id);
					$products_id = $id;
					$c=0;					
					$img = count($_FILES["file"]["tmp_name"]);
					
					for ($i=0;$i<$img;$i++) {
						if($_FILES["file"]["tmp_name"][$i]!=''){
								  $config = array(
									'source' => 'file', 
									'temp' => 'tmp_name', 
									'resize' => array(
									array('height' => 427, 'width' => 453, 'save' => 'tools_products/details/'),
									array('height' => 81, 'width' => 81, 'save' => 'tools_products/thumb/'),
									array('save' => 'tools_products/original/')
									)
									);
									
							$image_name_name = $this->all_function->resize_image($config,$i); // return the file anme
							$c++;
							$data = array(
								'products_id' => $products_id,
								'image_name' => $image_name_name,					
								'sort_order' => $c
              				  );
							$this->Tools_products_model->add_additional_images_file($data);
						}

					}
					
					##
					$this->load->library('upload');
					$im_nm='';$cnt=0;
					$pdf_title=$this->input->post('pdf_title');
					$config['upload_path']          = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/pdf/';
                	$config['allowed_types']        = 'pdf|PDF';
					$config['remove_spaces'] = TRUE;
					$this->upload->initialize($config);
					$number_of_files = sizeof($_FILES['pdf_name']['tmp_name']);
					$files = $_FILES['pdf_name'];
					for ($k = 0; $k < $number_of_files; $k++)
				    {
						$_FILES['pdf_name']['name'] = $files['name'][$k];
						$_FILES['pdf_name']['type'] = $files['type'][$k];
						$_FILES['pdf_name']['tmp_name'] = $files['tmp_name'][$k];
						$_FILES['pdf_name']['error'] = $files['error'][$k];
						$_FILES['pdf_name']['size'] = $files['size'][$k];
						
						if ($this->upload->do_upload('pdf_name'))
				        { $cnt++;
							$upload_data = $this->upload->data();
							$im_nm=$upload_data['file_name'];
							$path_parts = pathinfo($im_nm);
							
								$data_to_store = array(
								'products_id' => $products_id,
								'title' => !empty($pdf_title[$k])?$pdf_title[$k]:$path_parts['filename'],
								'pdf_name' => $im_nm,
								'sort_order' => $cnt
								);
								$this->db->insert(TBL_TOOLS_PRODUCTS_PDF, $data_to_store);
							
							
					    }
						
					}
					##
					
					
                $this->session->set_flashdata('success_msg', 'Successfully updated.');
				redirect(base_url("edit-tools-products/$id"));
            }
        	}
		}
		else{
        	$this->view('tools_products/edit_tools_products', $data_msg);
		}
    }

    public function del_tools_products($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];			
		$permission='Y';		
		if($permission=='Y'){
		$data_msg = array();
		$this->Tools_products_model->del_product_pdf($id);
		$this->Tools_products_model->del_product_video($id);					
		$this->Tools_products_model->del_products($id);							  
		$this->session->set_flashdata('success_msg', 'Record has been deleted successfully');			
		redirect(base_url('manage-tools-products'));		
		}if($permission=='N'){redirect(base_url('access-denied'));	}
    }
	
	public function manage_video($product_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
 		if($permission=='Y'){
        $data_msg = array();		
		$data_msg['meta_title'] = "Manage Video";		 
		$items_per_page = $this->all_function->get_site_options('admin_listing_per_page');
        $current_page = (int) $this->input->get('page');
        $current_page = $current_page > 0 ? $current_page : 1;		
		$data_msg['start_count'] = ($current_page * $items_per_page - $items_per_page + 1);
        $limit_from = ($current_page - 1) * $items_per_page;

        if(!isset($_POST['OkFilter']) & !isset($_GET['page'])){
			$this->session->set_userdata(array('FlterData' => ''));
		}		
		if(isset($_POST['OkFilter'])){
			$this->session->set_userdata(array('FlterData' => $_POST['FlterData']));
			$data_msg['FlterData'] = $FlterData = $_POST['FlterData'];
			$data_msg['total'] = $total_items = $this->Tools_products_model->get_video_num_filter($product_id,$FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-video/'.$product_id));
			$data_msg['display_result'] = $this->Tools_products_model->get_all_video_filter($product_id, $items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->Tools_products_model->delete_video($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-video/'.$product_id));
			  exit;
			  }else{redirect(base_url('manage-video/'.$product_id));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Tools_products_model->get_video_num_filter($product_id,$FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-video/'.$product_id));
			  $data_msg['display_result'] = $this->Tools_products_model->get_all_video_filter($product_id,$items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'title'=>'',
				'video_url'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Tools_products_model->get_video_num($product_id);
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-video/'.$product_id));
        	$get_value = $this->Tools_products_model->get_all_video($product_id,$items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		
		$data_msg['product_id'] = $product_id;

        $this->view('tools_products/manage_video', $data_msg);
	}
		if($permission=='N'){ redirect(base_url('access-denied'));}

    }
	
	public function add_video($product_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
		if($permission=='Y'){
			
        $data_msg = array();
		
		$data_msg['product_id'] = $product_id;
		
		$data_msg['meta_title'] = "Add Product Video";
		 $this->load->library('form_validation');
		 
		        
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ), 
				
				array(
                     'field'   => 'url',
                     'label'   => 'URL',
                     'rules'   => 'required'
                  )
				
            );

		$this->form_validation->set_rules($config);
	    if ($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_products/add_video', $data_msg);
			}else{		
					 $data = array(
						'title' => $this->input->post('title'),
						'video_url' => $this->input->post('url'),
						'products_id' => $product_id
					);					
					$this->Tools_products_model->add_video($data);	
					$this->session->set_flashdata('success_msg', 'Record has been added successfully');
					redirect(base_url("manage-video/".$product_id));					
				
			}
        }else{
        	$this->view('tools_products/add_video', $data_msg);
		}
		}if($permission=='N'){redirect(base_url('access-denied'));}
    }
	
	public function edit_video($product_id,$video_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){
			
        $data_msg = array();		
		$data_msg['meta_title'] = "Edit Product Video";		
		$data_msg['product_id'] = $product_id;		
		$data_msg['video_id'] = $video_id;		
        $get_value = $this->Tools_products_model->get_video_details($video_id);		
        $details = $get_value->row_array();
        if (empty($details)) { redirect(base_url("manage-video/".$product_id));}

        $data_msg['details'] =  $details;		
		$this->load->library('form_validation');	
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			
			$config = array(
               array(
                     'field'   => 'title',
                     'label'   => 'Title',
                     'rules'   => 'required'
                  ), 
				
				array(
                     'field'   => 'url',
                     'label'   => 'URL',
                     'rules'   => 'required'
                  )
            );
			$this->form_validation->set_rules($config);
			 if($this->form_validation->run() == FALSE)
			{
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('tools_products/edit_video', $data_msg);
			}else{
				$data = array(
						'title' => $this->input->post('title'),
						'video_url' => $this->input->post('url')						
					);
					
				$this->Tools_products_model->update_video($data, $video_id);
				$this->session->set_flashdata('success_msg', 'Record has been updated successfully');
				redirect(base_url("edit-video/$product_id/$video_id"));	
			}
			
			
            
        }
		else{
		$this->view('tools_products/edit_video', $data_msg);
		}
		}if($permission=='N'){ redirect(base_url('access-denied'));}

    }
	
	public function del_video($product_id,$video_id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];				
		$permission='Y';		
		if($permission=='Y'){

          $data_msg = array();
          $this->Tools_products_model->delete_video($video_id);								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');		  
		  redirect(base_url('manage-video/'.$product_id));
		  
		}if($permission=='N'){ redirect(base_url('access-denied'));}

    }	
	
	
	
	public function remove_file($id) {
		
		  $admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		  $data_msg = array();
		  
		  $details = $this->Tools_products_model->get_delete_products_file($id)->result_array();
		  
		   $file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/original/'.$details[0]['image_name'];
			if(is_file($file)){
			unlink($file); 
			} 
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/thumb/'.$details[0]['image_name'];
			if(is_file($file)){
			unlink($file); 
			} 
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/home/'.$details[0]['image_name'];
			if(is_file($file)){
			unlink($file); 
			} 
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/details/'.$details[0]['image_name'];
			if(is_file($file)){
			unlink($file); 
			} 
			
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/viwed/'.$details[0]['image_name'];
			if(is_file($file)){
			unlink($file); 
			} 
			 
		
		  $this->Tools_products_model->delete_products_file($id);
								  
		  //$msg = $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');	
		  echo '<div class="notification msgsuccess">
                  <a class="close"></a>
                  <p>Record has been deleted successfully</p>
          </div>';
	
		  exit;
		  
		

    }
	
    public function export_products($pid=0) {		
        $data_msg = array();		        
        $data_msg['meta_title'] = "Products Manager"; 
		$ExportProducts = $this->session->userdata('ExportProducts');
		$get_value =  $this->db->query($ExportProducts)->result_array();
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);		 
		$this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue('I1', 'Product Details');  //set C1 to current date
		$this->excel->getActiveSheet()->setCellValue('K1', 'On: '.date('Y-m-d',time()));  //set C1 to current date
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50); 
		$heading = array(
						'Sl No',
						//'Brand',
						'Category ID',
						'Product Name',
						'Product Short Description',
						'About Product',
						'Standard Equipment',
						'Information & Technology',
						'Technical Specifications',
						'Spare Parts',
						'Product image File name',
						//'Product Features',
						//'sku No',
						//'Price',
						'SEO URL',
						'SEO Keyword',
						'SEO Description',
						'SEO Title',
						'Sort Order',
						'Created on',
						'Last Modified on'
					);
		$rowNumberH = 2;
		$colH = 'A';
		foreach($heading as $h){
			$this->excel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			$colH++;    
		}
		$no=1;
		$i=3;
		//for($i=3;$i<=count($get_value)+2;$i++){
            foreach($get_value as $k=>$val):
                $this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $val['cat_name']);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $val['product_name']);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $val['product_short_description']);
				//$this->excel->getActiveSheet()->getStyle('D'.$i)->getAlignment()->setWrapText(true);
				
				$this->excel->getActiveSheet()->setCellValue('E'.$i,$val['about_product']);
				$this->excel->getActiveSheet()->setCellValue('F'.$i,$val['standard_equipment']);
				//$this->excel->getActiveSheet()->getStyle('G'.$i)->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->setCellValue('G'.$i,$val['it']);
				$this->excel->getActiveSheet()->setCellValue('H'.$i,$val['specification']);
				$this->excel->getActiveSheet()->setCellValue('I'.$i,$val['spare_parts']);
				$this->excel->getActiveSheet()->setCellValue('J'.$i,$val['image_name']);
				
				$this->excel->getActiveSheet()->setCellValue('K'.$i,$val['seo_url']);
				$this->excel->getActiveSheet()->setCellValue('L'.$i,$val['seo_keyword']);
				$this->excel->getActiveSheet()->setCellValue('M'.$i,$val['seo_description']);
				//$this->excel->getActiveSheet()->getStyle('K'.$i)->getAlignment()->setWrapText(true);
				$this->excel->getActiveSheet()->setCellValue('N'.$i,$val['seo_title']);
				$this->excel->getActiveSheet()->setCellValue('O'.$i,$val['sort_order']);
				$this->excel->getActiveSheet()->setCellValue('P'.$i,$val['create_date']);
				$this->excel->getActiveSheet()->setCellValue('Q'.$i,$val['modified_date']);
				$no++;
				$i++;
            endforeach;
            
       // }
		
		//prepare download
		$filename='Productlist_'.mt_rand(1,100000).'.xls'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');

    } 
	
	public function import_products() {
		
		$data = array();
		$error =array();
		
		if(isset( $_FILES["product_file"]) && $_FILES["product_file"]["error"]=='0')
		{
			$this->load->library('excel');
			$file = $_FILES['product_file'];
			$cats = $this->Tools_products_model->populate_cat();
			$cats_flip = array_flip($cats);
			
			$prodcts = $this->Tools_products_model->populate_products();
			//$brands = $this->Tools_products_model->populate_brands(); 
			//$brands_flip = array_flip($brands); 
			$objPHPExcel = PHPExcel_IOFactory::load($file['tmp_name']);
			
			
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			
			foreach ($cell_collection as $cell) {
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
				
				if($row>2)
				{
					$arr_data[$row][$column] = $data_value;
				}
			}
			
			
			if(!empty($arr_data))
			{
				$today = date('Y-m-d H:i:s',time());
				foreach($arr_data as $k=>$vl)
				{ 
				 $this->db->trans_start();
					if(!empty($vl['B']) && !empty($vl['C'])  && !in_array($vl['C'],$prodcts) && in_array($vl['B'],$cats))					
					{ 
						if(in_array($vl['B'],$cats))
						{
							$arr['cat_id'] =$cats_flip[$vl['B']];
						}
						
						//$arr['brands_id'] 				 = (!empty($vl['B']))?$vl['B']:0;
						//$arr['cat_id'] 					= (!empty($vl['C']))?$vl['C']:0;
						$arr['product_name'] 			  = (!empty($vl['C']))?$vl['C']:'';
						$arr['product_short_description'] 	   = (!empty($vl['D']))?$vl['D']:'';
						$arr['about_product'] 	= (!empty($vl['E']))?$vl['E']:'';
						$arr['standard_equipment'] 	= (!empty($vl['F']))?$vl['F']:'';
						$arr['it'] 	= (!empty($vl['G']))?$vl['G']:'';
						$arr['specification'] 	= (!empty($vl['H']))?$vl['H']:'';
						$arr['spare_parts'] 	= (!empty($vl['I']))?$vl['I']:'';
						
						$arr['image_name'] 	   			= (!empty($vl['J']))?$vl['J']:'';
						//$arr['sku'] 					   = (!empty($vl['H']))?$vl['H']:'';
						//$arr['price'] 				  = (!empty($vl['I']))?$vl['I']:0;
						$arr['seo_url'] 				   = (!empty($vl['K']))?$vl['K']:preg_replace("/^'|[^A-Za-z0-9\'-]|'$/", '',$vl['C']);
						$arr['seo_keyword']		 	   = (!empty($vl['L']))?$vl['L']:'';
						$arr['seo_description'] 		   = (!empty($vl['M']))?$vl['M']:'';
						$arr['seo_title'] 				 = (!empty($vl['N']))?$vl['N']:'';
						$arr['sort_order'] 			    = (!empty($vl['O']))?$vl['O']:0;
						$arr['create_date'] 			   = $today;
						$arr['modified_date'] 			 = $today;
						
						$products_id =0;						
						$products_id =  $this->Tools_products_model->add_products($arr);
						if(!$products_id)
						{
							$error[] =(!empty($vl['D']))?$vl['D']:' Row: '. $k;
						}
					}
				}
			}
		}
		
		if(empty($error))
		{
		  //	echo "<pre>";print_r($error);echo "</pre>";
		  $this->session->set_flashdata('success_msg', 'Successfully producrt uploaded.');
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'All products not uploaded successfully.');
		}		
		redirect(base_url("manage-tools-products"));
       
    }
	
	
	public function deletepdf(){
        $id = $this->input->post('id');
		
        $cms=$this->Tools_products_model->get_product_pdf($id);
		$img=$cms['pdf_name'];
		
			$file = MAIN_SITE_AB_UPLOAD_PATH.'tools_products/pdf/'.$img;
			if(is_file($file)){
			unlink($file); 
			} 
			
		
		$this->db->where('id', $id);
		$this->db->delete(TBL_TOOLS_PRODUCTS_PDF); 
		echo json_encode(array('id' =>$id));
		
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