<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Resgister_model extends CI_Model
    {
	    function update_event_resgistration($data , $id) {			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_EVENT_REGISTRATION , $data);
       }
	   function add_event_resgistration($data){				
			$this->db->insert(TBL_EVENT_REGISTRATION , $data);	
			return $this->db->insert_id();		
		}
	   function get_events_reg_payment_type($member_type_id,$event_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  ->where('id', $event_id);
			$query = $this->db->get()->row_array();
			if($member_type_id == 1){
            	$payment_type = $query['epayment_allowed_full'];	
			}elseif($member_type_id == 2){
            	$payment_type = $query['epayment_allowed_associate'];	
			}elseif($member_type_id == 3){
            	$payment_type = $query['epayment_allowed_individual'];	
			}elseif($member_type_id == 4){
            	$payment_type = $query['epayment_allowed_partner'];	
			}elseif($member_type_id == 5){
            	$payment_type = $query['epayment_allowed_visitor'];	
			}
			return $payment_type;
	   }
	   function count_reg_this_member_type($member_type_id,$event_id)
	   {
		   $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION)
						  ->where('member_type_id', $member_type_id)
						  ->where('event_id', $event_id)
						  ->where('booking_status != "R"');
			$query = $this->db->get()->result_array();
			  if(isset($query[0]['TotalNum'])){
				  $val = $query[0]['TotalNum'];
			  }else{
				  $val = 0;
			  }
			  return $val;			  
	   }
	   function get_events_reg_limit_checking($member_type_id,$event_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  ->where('id', $event_id);
			$query = $this->db->get()->row_array();
			if($member_type_id == 1){
            	$reg_this_member_type = $query['max_no_registrant_full'];	
			}elseif($member_type_id == 2){
            	$reg_this_member_type = $query['max_no_registrant_associate'];	
			}elseif($member_type_id == 3){
            	$reg_this_member_type = $query['max_no_registrant_individual'];	
			}elseif($member_type_id == 4){
            	$reg_this_member_type = $query['max_no_registrant_partner'];	
			}elseif($member_type_id == 5){
            	$reg_this_member_type = $query['max_no_registrant_visitor'];	
			}
			return $reg_this_member_type;
	   }
	   function count_reg_this_company($member_type_id,$event_id,$member_id)
	   {
		   $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION)
						  ->where('member_type_id', $member_type_id)
						  ->where('event_id', $event_id)
						  ->where('member_id', $member_id)
						  ->where('booking_status != "R"');
			$query = $this->db->get()->result_array();
			  if(isset($query[0]['TotalNum'])){
				  $val = $query[0]['TotalNum'];
			  }else{
				  $val = 0;
			  }
			  return $val;			  
	   }
	   function get_reg_per_company($member_type_id,$event_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  ->where('id', $event_id);
			$query = $this->db->get()->row_array();
			if($member_type_id == 1){
            	$per_company = $query['max_no_registrant_company_full'];	
			}elseif($member_type_id == 2){
            	$per_company = $query['max_no_registrant_company_associate'];	
			}elseif($member_type_id == 3){
            	$per_company = $query['max_no_registrant_company_individual'];	
			}
			return $per_company;
	   }
	  
	   function get_event_price1($event_id,$member_type_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  ->where('id', $event_id);
			$query = $this->db->get()->row_array();			
			if($member_type_id == 1){
            	$price = $query['fee_ist_registrant_full'];	
			}elseif($member_type_id == 2){
            	$price = $query['fee_ist_registrant_associate'];	
			}elseif($member_type_id == 3){
            	$price = $query['fee_ist_registrant_individual'];	
			}elseif($member_type_id == 4){
            	$price = $query['fee_ist_registrant_partner'];	
			}elseif($member_type_id == 5){
            	$price = $query['fee_ist_registrant_visitor'];	
			}
			return $price;
	   }
	   function get_event_price2($event_id,$member_type_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')->where('id', $event_id);
			$query = $this->db->get()->row_array();
			if($member_type_id == 1){
            	$price = $query['fee_subsequent_registrant_full'];	
			}elseif($member_type_id == 2){
            	$price = $query['fee_subsequent_registrant_associate'];	
			}elseif($member_type_id == 3){
            	$price = $query['fee_subsequent_registrant_individual'];	
			}elseif($member_type_id == 4){
            	$price = $query['fee_subsequent_registrant_partner'];	
			}elseif($member_type_id == 5){
            	$price = $query['fee_subsequent_registrant_visitor'];	
			}
			return $price;
	   }
	   function count_register($member_type_id,$event_id)
	   {
		   $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION)
						  ->where('member_type_id', $member_type_id)
						  ->where('event_id', $event_id)
						  ->where('booking_status != "R"');
			$query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;			  
	   }
	   
	   function count_register_per_company($member_id,$event_id)
	   {
		   $this->db->select('count(id) as `TotalNum`')
                          ->from(TBL_EVENT_REGISTRATION)
						  ->where('booking_status', 'Y')
						  ->where('member_id', $member_id)
						  ->where('id', $event_id);
			$query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;			  
	   }
	   function get_event_promo_code_details($event_id)
	   {
		   $this->db->select('*')
                          ->from(TBL_EVENTS)
						  ->where('status', 'Y')
						  ->where('id', $event_id);
			$query = $this->db->get()->row_array();
			return $query['promo_code'];
	   }
	   
	   function get_event_registration_detail($id)	   {
		             $this->db->select('*')
                          ->from(TBL_EVENT_REGISTRATION)
						  ->where('id', $id);
					$query = $this->db->get()->row_array();	  
		            return $query;
	   }
	   function get_transaction_details_by_id($order_transaction_id)
	   {
		             $this->db->select('*')
                          ->from(TBL_PAYPAL_TRANSACTION)
						  ->where('id', $order_transaction_id);
					$query = $this->db->get()->row_array();	  
		            return $query;
	   }
	   function get_event_details_by_id($id)
			{
				$this->db->select('*')
					 ->from(TBL_EVENTS)
					 ->where('status', 'Y')
					 ->where('id', $id)
					 ->order_by('sort_order', 'ASC');
					 
					 $query = $this->db->get()->row_array();
				
			       return $query;	
			}

    }