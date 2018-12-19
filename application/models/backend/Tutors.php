<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tutors extends CI_Model
{

	public function __construct()
	{
		$this->uniq_id = uniqid();
		$this->date    = date('Y-m-d H:i:s');
	}
	
	public function get_enrollment($id)
	{
		$this->db->select('*')
		->from('student_enrollment')
		->where('student_id',$id);				 
		$query = $this->db->get()->row_object();				
		return $query;	
	}
	
	public function get_class_name($id)
	{
		$this->db->select('*')
		->from('class')
		->where('class_id',$id);				 
		$query = $this->db->get()->row_object();				
		return $query;	
	}

	public function get_subjects()
	{
		$this->db->get('*')
		->from(DB_SUBJECT);
		$query = $this->db->get();
		$result = $query->result();
		if($result) {
			return $query;
		} 
	}
	
	public function get_tutors($id = false)
	{

		$this->db->select('*');
		$this->db->from('tutor');
		$this->db->join('aauth_users', 'tutor.user_id = aauth_users.id');
		if($id) {
			$this->db->join('aauth_perm_to_user', 'aauth_perm_to_user.user_id = aauth_users.id');
			$this->db->where(['tutor.user_id'	=>	$id]);
		}
		$this->db->where('tutor.is_archive', 0);
		$query = $this->db->get();
		if($id) {
			$result = $query->row();
		}
		else {
			$result =	$query->result();
		}
		return $result;	
	}
	
	public function get_archived_tutors()
	{

		$this->db->select('*, tutor.updated_at as updated_at');
		$this->db->from('tutor');
		$this->db->join('aauth_users', 'tutor.user_id = aauth_users.id');
		$this->db->where('tutor.is_archive',1);				 
		$query = $this->db->get()->result_object();	
		return $query;	
	}
	
	public function search()
	{

		$this->db->select('*')
		->from('student')
		->where('is_archive',1);				 
		$query = $this->db->get()->result_object();				
		return $query;	
	}
	public function store()
	{
    	//die(print_r($_POST));
		$name = !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		$tutor_name = isset($_POST['tutor_name']) ? $_POST['tutor_name'] : '';
		$perm_id = isset($_POST['tutor_permission']) ? $_POST['tutor_permission'] : '';
		$login_link = site_url('admin/login');
		$this->db->trans_start();
		$result = $this->aauth->create_user($email, $password, false, 3);
		if(!$result) {
			$this->session->set_flashdata('error', 'Email ID exist within system.');
			return false;
		}
		$this->aauth->allow_user($result, $perm_id);
		$data = array(
			'user_id'	=>	$result,
			'tutor_id'     => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
			'tutor_name'   => !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null,
			'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : null,
			'address'    => !empty($_POST['address']) ? $_POST['address'] : null,
			'subject'   => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
			'salary_scheme'    => !empty($_POST['salary_scheme']) ? $_POST['salary_scheme'] : null,
			'remark'  => !empty($_POST['remark']) ? $_POST['remark'] : null,
			'created_at'   => $this->date,
			'updated_at'   => $this->date,
		);

		$this->db->insert('tutor', $data);
		$subject = "Welcome to The Science Academy";
		$message = tutor_registration_template($name, $email, $password, $login_link);
		send_mail($email, false, false, false, false, $subject, $message);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/tutors/create');
		} else {
			$this->session->set_flashdata('success', TUTOR . ' ' . MSG_CREATED);
			return redirect('admin/tutors');
		}
	}
	
	public function store_2()
	{
        //die(print_r($_POST));
		$student_code=explode(',',$_POST['student_code']);
		if($_POST['student_status']==0)
		{
			foreach($student_code as $student)
			{

				$data = array(
					'student_id'     => $student,
					'enrollment_date'     => !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : null,
					'collected'      => !empty($_POST['depo_collected']) ? $_POST['depo_collected'] : null,
					'remarks_deposit'   => !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : null,
					'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : null,
					'ex_charges'   => !empty($_POST['ex_charges']) ? $_POST['ex_charges'] : null,
					'remarks'    => !empty($_POST['remarks']) ? $_POST['remarks'] : null,
					'created_at'   => $this->date,
					'updated_at'   => $this->date
				);

				$this->db->trans_start();
				$this->db->insert('student_enrollment', $data);
				$this->db->trans_complete();


				$data2 = array(
					'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : null,
					'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : null
				);

				$this->db->trans_start();
				$this->db->where('student_id', $student);
				$this->db->update('student', $data2);
				$this->db->trans_complete();
			//echo $this->db->last_query();die;
			}
		}
		else if($_POST['student_status']==1)
		{
			foreach($student_code as $student)
			{
				$data2 = array(
					'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : null,
					'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : null,
					'class_id'   => $_POST['class_code']!="" ? $_POST['class_code'] : null
				);
				
				$this->db->trans_start();
				$this->db->where('student_id', $student);
				$this->db->update('student', $data2);
				$this->db->trans_complete();
			}
		}
		else
		{
			foreach($student_code as $student)
			{
				$data2 = array(
					'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : null
				);
				
				$this->db->trans_start();
				$this->db->where('student_id', $student);
				$this->db->update('student', $data2);
				$this->db->trans_complete();
			}
		}
		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		} else {
			$this->session->set_flashdata('success', TUTOR . ' ' . MSG_CREATED);
			return redirect('admin/students');
		}
	}

	public function update($id)
	{

		$user_id = !empty($_POST['user_id']) ? $_POST['user_id'] : null;
		
		$name = !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$tutor_name = isset($_POST['tutor_name']) ? $_POST['tutor_name'] : '';
		$perm_id = isset($_POST['tutor_permission']) ? $_POST['tutor_permission'] : '';

		$this->db->select('*');
		$this->db->from(DB_TUTOR);
		$this->db->join('aauth_users', 'tutor.user_id = aauth_users.id');
		$this->db->where(['aauth_users.email'	=>	$email, 'tutor.user_id !='	=>	$id]);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$this->session->set_flashdata('error', 'Email ID exists in our system.');
			return redirect('admin/tutors/edit/'.$id);
		}

		if(isset($_POST['password']) && $_POST['password']!="")
		{
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			$result = $this->aauth->update_user($user_id, $email, $password, $name, $this->date, false);
		}
		else {
			$result = $this->aauth->update_user($user_id, $email, false, $name, $this->date, false);
		}

		$data = array(
			'tutor_id'   => !empty($_POST['tutor_id']) ? $_POST['tutor_id'] : null,
			'tutor_name'   => !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null,
			'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : null,
			'address'    => !empty($_POST['address']) ? $_POST['address'] : null,
			'subject'   => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
			'salary_scheme'    => !empty($_POST['salary_scheme']) ? $_POST['salary_scheme'] : null,
			'remark'  => !empty($_POST['remarks']) ? $_POST['remarks'] : null,
			'updated_at'   => $this->date,
		);
//die(print_r($data));
		$this->db->trans_start();
		$this->db->where('user_id', $id);
		$this->db->update('tutor', $data);

		$query = $this->db->get_where('tutor', ['user_id'	=>	$id]);
		$result = $query->row();

		$this->db->where('user_id', $result->user_id);
		$this->db->update('aauth_perm_to_user', ['perm_id'	=>	$perm_id]);

		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/tutors/edit/'.$id);
		} else {
			$this->session->set_flashdata('success', TUTOR . ' ' . MSG_UPDATED);
			return redirect('admin/tutors/edit/'.$id);
		}
	}

	public function update_archive($id,$data)
	{
        //die(print_r($_POST));


		$this->db->trans_start();
		$this->db->where('user_id', $id);
		$this->db->update('tutor', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/tutors');
		} else {
			$this->session->set_flashdata('success','Tutor archived successfully.');
			return redirect('admin/tutors');
		}
	}

	public function update_archive2($id,$data)
	{
        //die(print_r($_POST));


		$this->db->trans_start();
		$this->db->where('tutor_id', $id);
		$this->db->update('tutor', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/tutors/archived');
		} else {
			$this->session->set_flashdata('success','Tutor back to active list successfully.');
			return redirect('admin/tutors');
		}
	}

	public function delete($id)
	{
		$this->db->trans_start();
		$this->db->where('class_id', $id);
		$this->db->update('student');
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/classes/update');
		} else {
			$this->session->set_flashdata('success', CLASSES . ' ' . MSG_ARCHIVED);
			return redirect('admin/classes');
		}
	}

}
