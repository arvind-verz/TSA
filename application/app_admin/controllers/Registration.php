<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Registration_model', '', TRUE);
		$this->load->model('Member_model', '', TRUE);
    }
	public function manage_registration() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
				
		$permission='Y';
		
 		if($permission=='Y'){

        $data_msg = array();
		
		$data_msg['meta_title'] = "Manage Registration";
		 $data_msg['member_type'] = $this->Member_model->get_member_type();
		
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
			$data_msg['total'] = $total_items = $this->Registration_model->get_registration_num_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-registration'));
			$data_msg['display_result'] = $this->Registration_model->get_all_registration_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->Registration_model->delete_registration($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-registration'));
			  exit;
			  }else{redirect(base_url('manage-registration'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Registration_model->get_registration_num_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-registration'));
			  $data_msg['display_result'] = $this->Registration_model->get_all_registration_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
				'title'=>'',
				'user_name'=>'',							
				'first_name'=>'',
				'last_name'=>'',
				'email'=>'',
				'member_type_id'=>'',
				'is_paid'=>'',
				'payment_type'=>'',
				'booking_status'=>'',
				'create_date'=>''										
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Registration_model->get_registration_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-registration'));
        	$get_value = $this->Registration_model->get_all_registration($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('Exportregistration' => $sql_last[0] ));
        $this->view('registration/manage_registration', $data_msg);
		}
		if($permission=='N'){			
			 redirect(base_url('access-denied'));
             exit;			
		}
    }
	public function edit_registration($id) {
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
        $data_msg = array();		
		$data_msg['meta_title'] = "Edit Registration";	
        $get_value = $this->Registration_model->get_registration_details($id);		
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-registration"));
        }
		$data_msg['details'] = $details;	
        
        $this->load->library('form_validation');	
		if($details['payment_type']=='Offline'){	
			$config = array(    
               array(
                     'field'   => 'booking_status',
                     'label'   => 'Booking Status',
                     'rules'   => 'trim|required'
                  ),
			   array(
                     'field'   => 'is_paid',
                     'label'   => 'Payment Status',
                     'rules'   => 'trim|required'
                  )
			   
            );
		}else{
			$config = array(    
				array(
						 'field'   => 'booking_status',
						 'label'   => 'Booking Status',
						 'rules'   => 'trim|required'
					  )
            );
		}
		$this->form_validation->set_rules($config);
		
		if($_POST){	
			if ($this->form_validation->run() == FALSE){
				$data_msg['error_msg'] = $error_msg = strip_tags(validation_errors());
				$this->view('registration/edit_registration', $data_msg);
			}else { 
				if($details['payment_type']=='Offline'){
					$data = array(
						'booking_status' => $this->input->post('booking_status'),
						'is_paid' => $this->input->post('is_paid'),
						'status' =>'Y',
						'modified_date' => date('Y-m-d H:i:s')
					);
					
				}else{
					$data = array(
						'booking_status' => $this->input->post('booking_status'),
						'status' =>'Y',
						'modified_date' => date('Y-m-d H:i:s')
					);
				}
				$this->Registration_model->update_registration($data, $id);
				
				##
				$booking_status=$this->input->post('booking_status');
				$is_paid=$this->input->post('is_paid');
				if($booking_status=='Y')
				{
					$this->email_member_for_booking_approved($id);
				}
				elseif($booking_status=='R')
				{
					$this->email_member_for_booking_rejected($id);
					
				}
				if(isset($is_paid) && !empty($is_paid) && $is_paid=='Paid')
				{
					
				   $this->email_member_for_payment_paid($id);
				   	
				}elseif(isset($is_paid) && !empty($is_paid) && $is_paid=='Pending')
				{ 
					$this->email_member_for_payment_pending($id);
				}
				###
				$this->view('registration/edit_registration', $data_msg);	
				$this->session->set_flashdata('success_msg', 'Record has been updated successfully');	
				redirect(base_url("edit-registration/$id"));
        	}
		}else{
			
			$this->view('registration/edit_registration', $data_msg);
		}
    } 
	public function view_registration($id) {
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
        $data_msg = array();		
		$data_msg['meta_title'] = "View Registration";	
        $get_value = $this->Registration_model->get_registration_details($id);		
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-registration"));
        }
		$data_msg['details'] = $details;
		$data = array(
					'status' => 'Y'
                );
		$this->Registration_model->update_registration($data, $id);
        $this->view('registration/view_registration', $data_msg);
    }	
	
	public function del_registration($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
		if($permission=='Y'){

        $data_msg = array();

          $this->Registration_model->delete_registration($id);
								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');	
		  
		  redirect(base_url('manage-registration'));
		  
		  exit;
		  
		}if($permission=='N'){
			 redirect(base_url('access-denied'));
             exit;			
		}

    }	
	
	public function export_registration($pid=0) {		
        $data_msg = array();		        
        $data_msg['meta_title'] = "Manage registrations List"; 
		$ExportProducts = $this->session->userdata('Exportregistration');
		$get_value =  $this->db->query($ExportProducts)->result_array();
		//print_r($get_value);exit;
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);		 
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue('B1', 'registrations List');  //set C1 to current date
		$this->excel->getActiveSheet()->setCellValue('E1', 'On: '.date('Y-m-d',time()));  //set C1 to current date
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50); 
		$heading = array(
						'Sl No',
						'Name',
						'Email',
						'Address',
						'Date Of Purchase',
						'Mobile No',
						'Serial No',
						'Dealer Name',
						'Model',
						'Date'
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
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $val['name']);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $val['email']);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $val['address']);
				$this->excel->getActiveSheet()->setCellValue('E'.$i, $val['date_of_purchase']);
				$this->excel->getActiveSheet()->setCellValue('F'.$i, $val['mobile_no']);	
				$this->excel->getActiveSheet()->setCellValue('G'.$i, $val['serial_no']);
				$this->excel->getActiveSheet()->setCellValue('H'.$i, $val['dealer_name']);
				$this->excel->getActiveSheet()->setCellValue('I'.$i, $val['model']);
				$this->excel->getActiveSheet()->setCellValue('J'.$i,$val['create_date']);
				$no++;
				$i++;
            endforeach;
            
       // }
		
		//prepare download
		$filename='registrationList_'.mt_rand(1,100000).'.xls'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');

    } 
	
	
	function email_member_for_booking_approved($id)
	{
		$this->db->select('er.*,te.title,te.seo_url,te.start_date,te.end_date,te.event_time,te.venue,mt.name')
						  		   ->from(TBL_EVENT_REGISTRATION . ' as `er`')
								   ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
								   ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'er.member_type_id = mt.member_type_id','left')
								   ->where('er.id' , $id);
						  
                  $details = $this->db->get()->row_array();
				  $full_name=$details['first_name'].' '.$details['last_name'];
				  
				       $store_name = $this->all_function->get_site_options('site_name');
						
						//$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$auto_mail = $this->all_function->get_template(14);
						
						$body_auto = $auto_mail["body"];
		
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
						$body_auto			  = str_replace("{EVENT_NAME}", $details['title'], $body_auto);	
						$body_auto			  = str_replace("{START_DATE}", date("F d, Y", strtotime($details['start_date'])), $body_auto);
						$body_auto			  = str_replace("{END_DATE}", date("F d, Y", strtotime($details['end_date'])), $body_auto);
						$body_auto			  = str_replace("{EVENT_TIME}", $details['event_time'], $body_auto);
						$body_auto			  = str_replace("{VENUE}", $details['venue'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
	  
	  					$auto_subject = $auto_mail["subject"];
						//print_r($details);exit;
						//echo  $body_auto;exit;
						/*if(isset($details['user_name']) && !empty($details['user_name']))
						{
							if($details['company_email']==$details['email']){$user_bcc = '';}else{$user_bcc = $details['email'];}
							$this->all_function->batch_email($details['company_email'], $auto_from, $auto_from_name, $user_bcc, $auto_subject, $body_auto);
						}else{
							
							$this->all_function->batch_email($details['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
						}*/
						return;
				  
				  
				  
				  
	}
	####
	function email_member_for_booking_rejected($id)
	{
		$this->db->select('er.*,te.title,te.seo_url,te.start_date,te.end_date,te.event_time,te.venue,mt.name')
						  		   ->from(TBL_EVENT_REGISTRATION . ' as `er`')
								   ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
								   ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'er.member_type_id = mt.member_type_id','left')
								   ->where('er.id' , $id);
						  
                  $details = $this->db->get()->row_array();
				  $full_name=$details['first_name'].' '.$details['last_name'];
				  
				       $store_name = $this->all_function->get_site_options('site_name');
						
						//$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$auto_mail = $this->all_function->get_template(15);
						
						$body_auto = $auto_mail["body"];
		
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
						$body_auto			  = str_replace("{EVENT_NAME}", $details['title'], $body_auto);	
						$body_auto			  = str_replace("{START_DATE}", date("F d, Y", strtotime($details['start_date'])), $body_auto);
						$body_auto			  = str_replace("{END_DATE}", date("F d, Y", strtotime($details['end_date'])), $body_auto);
						$body_auto			  = str_replace("{EVENT_TIME}", $details['event_time'], $body_auto);
						$body_auto			  = str_replace("{VENUE}", $details['venue'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
	  
	  					$auto_subject = $auto_mail["subject"];
						//print_r($details);exit;
						//echo  $body_auto;exit;
						/*if(isset($details['user_name']) && !empty($details['user_name']))
						{
							if($details['company_email']==$details['email']){$user_bcc = '';}else{$user_bcc = $details['email'];}
							$this->all_function->batch_email($details['company_email'], $auto_from, $auto_from_name, $user_bcc, $auto_subject, $body_auto);
						}else{
							
							$this->all_function->batch_email($details['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
						}*/
						return;
	}
	
	####
	function email_member_for_payment_paid($id)
	{
		$this->db->select('er.*,te.title,te.seo_url,te.start_date,te.end_date,te.event_time,te.venue,mt.name')
						  		   ->from(TBL_EVENT_REGISTRATION . ' as `er`')
								   ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
								   ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'er.member_type_id = mt.member_type_id','left')
								   ->where('er.id' , $id);
						  
                  $details = $this->db->get()->row_array();
				  $full_name=$details['first_name'].' '.$details['last_name'];
				  
				       $store_name = $this->all_function->get_site_options('site_name');
						
						//$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$auto_mail = $this->all_function->get_template(16);
						
						$body_auto = $auto_mail["body"];
		
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
						$body_auto			  = str_replace("{EVENT_NAME}", $details['title'], $body_auto);	
						$body_auto			  = str_replace("{START_DATE}", date("F d, Y", strtotime($details['start_date'])), $body_auto);
						$body_auto			  = str_replace("{END_DATE}", date("F d, Y", strtotime($details['end_date'])), $body_auto);
						$body_auto			  = str_replace("{EVENT_TIME}", $details['event_time'], $body_auto);
						$body_auto			  = str_replace("{VENUE}", $details['venue'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
	  
	  					$auto_subject = $auto_mail["subject"];
						//print_r($details);exit;
						//echo  $body_auto;exit;
						if(isset($details['user_name']) && !empty($details['user_name']))
						{
							if($details['company_email']==$details['email']){$user_bcc = '';}else{$user_bcc = $details['email'];}
							$this->all_function->batch_email($details['company_email'], $auto_from, $auto_from_name, $user_bcc, $auto_subject, $body_auto);
						}else{
							
							$this->all_function->batch_email($details['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
						}
						return;
	}
	
	function email_member_for_payment_pending($id)
	{
		$this->db->select('er.*,te.title,te.seo_url,te.start_date,te.end_date,te.event_time,te.venue,mt.name')
						  		   ->from(TBL_EVENT_REGISTRATION . ' as `er`')
								   ->join(TBL_EVENTS . ' as `te`' , 'er.event_id = te.id')
								   ->join(TBL_MEMBER_TYPE . ' as `mt`' , 'er.member_type_id = mt.member_type_id','left')
								   ->where('er.id' , $id);
						  
                  $details = $this->db->get()->row_array();
				  $full_name=$details['first_name'].' '.$details['last_name'];
				  
				       $store_name = $this->all_function->get_site_options('site_name');
						
						//$to = $this->all_function->get_site_options('to_email_address');
						$domain = $this->all_function->get_site_options('domain_name');
						
						$auto_from = $this->all_function->get_site_options('from_email_address');
						$auto_from_name = $this->all_function->get_site_options('from_email_name');
						
						
						$auto_mail = $this->all_function->get_template(17);
						
						$body_auto = $auto_mail["body"];
		
						$body_auto			  = str_replace("{SITE_URL}", base_url('/'), $body_auto);
						$body_auto			  = str_replace("{SITE_LOGO}", '<img src="'.get_site_image('upload/logo/original').$this->all_function->get_site_options('logo').'" border="0"/>', $body_auto);		
						$body_auto			  = str_replace("{SITE_NAME}", $store_name, $body_auto);
						$body_auto			  = str_replace("{NAME}", $full_name, $body_auto);
						$body_auto			  = str_replace("{EVENT_NAME}", $details['title'], $body_auto);	
						$body_auto			  = str_replace("{START_DATE}", date("F d, Y", strtotime($details['start_date'])), $body_auto);
						$body_auto			  = str_replace("{END_DATE}", date("F d, Y", strtotime($details['end_date'])), $body_auto);
						$body_auto			  = str_replace("{EVENT_TIME}", $details['event_time'], $body_auto);
						$body_auto			  = str_replace("{VENUE}", $details['venue'], $body_auto);
						$body_auto			  = str_replace("{DOMAIN}", $domain, $body_auto);
	  
	  					$auto_subject = $auto_mail["subject"];
						//print_r($details);exit;
						//echo  $body_auto;exit;
						/*if(isset($details['user_name']) && !empty($details['user_name']))
						{
							if($details['company_email']==$details['email']){$user_bcc = '';}else{$user_bcc = $details['email'];}
							$this->all_function->batch_email($details['company_email'], $auto_from, $auto_from_name, $user_bcc, $auto_subject, $body_auto);
						}else{
							
							$this->all_function->batch_email($details['email'], $auto_from, $auto_from_name, '', $auto_subject, $body_auto);
						}*/
						return;
	}
	
}