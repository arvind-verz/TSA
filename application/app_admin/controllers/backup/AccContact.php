<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AccContact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Acc_contact_model', '', TRUE);

    }
	public function manage_acc_contact() {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
				
		$permission='Y';
		
 		if($permission=='Y'){

        $data_msg = array();
		
		$data_msg['meta_title'] = "Manage Contact";
		 
  		$type = $data_msg['form_type'] = 'Contact';
		
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
			$data_msg['total'] = $total_items = $this->Acc_contact_model->get_contact_num_filter($FlterData);			
			$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-acc-contact'));
			$data_msg['display_result'] = $this->Acc_contact_model->get_all_contact_filter($items_per_page, $limit_from, $FlterData)->result_array();
			//echo $this->db->last_query();
		}
		elseif( isset($_POST['action']) && $_POST['action']=='Delete'){				
			$checkbox_arr = $this->input->post('id');
			if(count($checkbox_arr) !== 0){
			  foreach ($checkbox_arr as $del_id){
				 $this->Acc_contact_model->delete_contact($del_id);
			  }
			  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');
			  redirect(base_url('manage-acc-contact'));
			  exit;
			  }else{redirect(base_url('manage-acc-contact'));}			
		}
		elseif($this->session->userdata('FlterData')){
			  $data_msg['FlterData'] = $FlterData = $this->session->userdata('FlterData');
			  $data_msg['total'] = $total_items = $this->Acc_contact_model->get_contact_num_filter($FlterData);
			  $data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3, base_url('manage-acc-contact'));
			  $data_msg['display_result'] = $this->Acc_contact_model->get_all_contact_filter($items_per_page, $limit_from, $FlterData)->result_array();
		}else{
		 $this->session->set_userdata(array('FlterData' => '' ));					
		  $FlterData = array(
		        'product_name'=>'',	
				'name'=>'',							
				'mobile_no'=>'',
				'email'=>'',
				'create_date'=>''											
				);
		    $data_msg['FlterData'] = $FlterData;
        	$total_items = $this->Acc_contact_model->get_contact_num();
        	$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $items_per_page, $current_page, 3,base_url('manage-acc-contact'));
        	$get_value = $this->Acc_contact_model->get_all_contact($items_per_page, $limit_from);
       		$data_msg['display_result'] = $get_value->result_array();
		}
		$sql_last = $this->db->last_query();
		$sql_last = explode('LIMIT',$sql_last);
		$this->session->set_userdata(array('ExportContact' => $sql_last[0] ));
        $this->view('acc_contact/manage_contact', $data_msg);
		}
		if($permission=='N'){			
			 redirect(base_url('access-denied'));
             exit;			
		}
    }
	
	public function view_acc_contact($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
		if($permission=='Y'){
			
        $data_msg = array();
		
		$data_msg['meta_title'] = "View Contact";
		
		$type = $data_msg['form_type'] = 'Contact';
		
        $get_value = $this->Acc_contact_model->get_contact_details($id);
        $details = $get_value->row_array();
        if (empty($details)) {
            redirect(base_url("manage-acc-contact"));
            exit;
        }
        //print_r($details);
		$data_msg['details'] = $details;
		
		$data = array(
					'status' => 'Y',
                    'modified_date' => date('Y-m-d H:i:s')
                );
		
		$this->Acc_contact_model->update_contact($data, $id);

        $this->view('acc_contact/view_contact', $data_msg);
		
		}if($permission=='N'){
			
			 redirect(base_url('access-denied'));
             exit;
			
		}

    }	
	
	public function del_acc_contact($id) {
		
		$admin_type = $this->session->userdata[ADMIN_LOGIN_PREFIX.'user_type'];
		
		$permission='Y';
		
		if($permission=='Y'){

        $data_msg = array();

          $this->Acc_contact_model->delete_contact($id);
								  
		  $this->session->set_flashdata('success_msg', 'Record has been deleted successfully');	
		  
		  redirect(base_url('manage-acc-contact'));
		  
		  exit;
		  
		}if($permission=='N'){
			 redirect(base_url('access-denied'));
             exit;			
		}

    }	
	
	public function export_acc_contact($pid=0) {		
        $data_msg = array();		        
        $data_msg['meta_title'] = "Manage Contacts List"; 
		$ExportProducts = $this->session->userdata('ExportContact');
		$get_value =  $this->db->query($ExportProducts)->result_array();
		//print_r($get_value);exit;
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);		 
		$this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->setCellValue('B1', 'Contacts List');  //set C1 to current date
		$this->excel->getActiveSheet()->setCellValue('E1', 'On: '.date('Y-m-d',time()));  //set C1 to current date
		$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50); 
		$heading = array(
						'Sl No',
						'Product',
						'Salutation',
						'Name',
						'Country',
						'Email',
						'Telephone',
						'Mobile',
						'Subject',
						'Comments',
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
			$country_name=$this->Acc_contact_model->get_country_name($val['contact_country_id']);
			if(count($country_name)>0)
			{
				$country_name=$country_name['name'];
			}else{$country_name='';}
			
                $this->excel->getActiveSheet()->setCellValue('A'.$i,$no);
				$this->excel->getActiveSheet()->setCellValue('B'.$i, $val['product_name']);
				$this->excel->getActiveSheet()->setCellValue('C'.$i, $val['salutation']);
				$this->excel->getActiveSheet()->setCellValue('D'.$i, $val['name']);
				$this->excel->getActiveSheet()->setCellValue('E'.$i, $country_name);
				$this->excel->getActiveSheet()->setCellValue('F'.$i, $val['email']);
				$this->excel->getActiveSheet()->setCellValue('G'.$i, $val['telephone']);	
				$this->excel->getActiveSheet()->setCellValue('H'.$i, $val['mobile_no']);
				$this->excel->getActiveSheet()->setCellValue('I'.$i, $val['subject']);
				$this->excel->getActiveSheet()->setCellValue('J'.$i, $val['message']);
				$this->excel->getActiveSheet()->setCellValue('K'.$i,$val['create_date']);
				$no++;
				$i++;
            endforeach;
            
       // }
		
		//prepare download
		$filename='ContactList_'.mt_rand(1,100000).'.xls'; //just some random filename
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		 
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');

    } 
	
}