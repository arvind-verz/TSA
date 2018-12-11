<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends CI_Model
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
	
	public function get_students()
	{

		$this->db->select('*');
		$this->db->from('student');
		$this->db->where('is_archive!=',1);	
		if(isset($_POST['search']) && $_POST['search']==1)
		{
			if(isset($_POST['s_name']) && $_POST['s_name']!="")
				$this->db->like('name',$_POST['s_name']);	

			if(isset($_POST['s_email']) && $_POST['s_email']!="")
				$this->db->like('email',$_POST['s_email']);	

			if(isset($_POST['s_phone']) && $_POST['s_phone']!="")
				$this->db->like('phone',$_POST['s_phone']);

			if(isset($_POST['p_name']) && $_POST['p_name']!="")
				$this->db->like('parent_name',$_POST['p_name']);

			if(isset($_POST['p_email']) && $_POST['p_email']!="")
				$this->db->like('parent_email',$_POST['p_email']);

			if(isset($_POST['p_phone']) && $_POST['p_phone']!="")
				$this->db->like('parents_phone',$_POST['p_phone']);
		}			 
		$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
		return $query;	
	}
	
	public function get_student($id)
	{

		$this->db->select('*')
		->from('student')
		->join('student_to_class', 'student.student_id=student_to_class.student_id')
		->where('student.student_id',$id);			 
		$query = $this->db->get()->row_object();
				//echo $this->db->last_query();				
		return $query;	
	}
	
	public function get_archived_classes()
	{

		$this->db->select('*');
		$this->db->from('student');

		if(isset($_POST['search']) && $_POST['search']==1)
		{
			if(isset($_POST['s_name']) && $_POST['s_name']!="")
				$this->db->like('name',$_POST['s_name']);	

			if(isset($_POST['s_email']) && $_POST['s_email']!="")
				$this->db->like('email',$_POST['s_email']);	

			if(isset($_POST['s_phone']) && $_POST['s_phone']!="")
				$this->db->like('phone',$_POST['s_phone']);

			if(isset($_POST['p_name']) && $_POST['p_name']!="")
				$this->db->like('parent_name',$_POST['p_name']);

			if(isset($_POST['p_email']) && $_POST['p_email']!="")
				$this->db->like('parent_email',$_POST['p_email']);

			if(isset($_POST['p_phone']) && $_POST['p_phone']!="")
				$this->db->like('parents_phone',$_POST['p_phone']);
		}	
		$this->db->where('is_archive',1);				 
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
	
	public function get_classes($id)
	{

		$this->db->select('*')
		->from(DB_STUDENT_CLASS)
		->where('student_id',$id);				 
		$query = $this->db->get()->result_array();				
		return $query;	
	}
	
	public function store()
	{
		$name = !empty($_POST['name']) ? $_POST['name'] : '';
		$username = !empty($_POST['username']) ? url_title($_POST['username']) : '';
		$email = !empty($_POST['email']) ? $_POST['email'] : '';
		$password = $_POST['password'];
		$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$login_link = site_url('login');

		$data = array(
			'student_id'     => $this->uniq_id,
			'profile_picture'	=>	!empty($_POST['profile_picture']) ? $_POST['profile_picture'] : null,
			'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
			'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
			'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
			'username'      => !empty($_POST['username']) ? url_title($_POST['username']) : '',
			'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
			'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
			'gender'   => $_POST['gender'],
			'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
			'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
			'siblings' => !empty($_POST['siblings']) ? json_encode($_POST['siblings']) : '',
			'parents_phone' => !empty($_POST['parents_phone']) ? $_POST['parents_phone'] : '',
			'password'   => !empty($_POST['password']) ? $password_h : '',
			'is_active'   => 1,
			'created_at'   => $this->date,
			'updated_at'   => $this->date,
		);

		$this->db->trans_start();
		$this->db->insert('student', $data);
		$subject = "Welcome to The Science Academy";
		$message = student_registration_template($name, $username, $email, $password, $login_link);
		send_mail($email, false, false, false, false, $subject, $message);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students/create');
		} else {
			$this->session->set_flashdata('success', STUDENT . ' ' . MSG_CREATED);
			return redirect('admin/students');
		}
	}
	
	public function enroll()
	{
		//die(print_r($_POST));
		$enrollment_type = !empty($_POST['enrollment_type']) ? $_POST['enrollment_type'] : '';
		$student_id = !empty($_POST['student_id']) ? $_POST['student_id'] : '';
		$class_id = !empty($_POST['class_code']) ? $_POST['class_code'] : '';
		if(!($student_id && $class_id)) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		}
		$this->db->trans_start();
		if($enrollment_type==3)
		{
			$enrollment_date = !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '';
			$deposit = !empty($_POST['deposit']) ? $_POST['deposit'] : '';
			$deposit_collected = !empty($_POST['deposit_collected']) ? $_POST['deposit_collected'] : '';
			$remarks_deposit = !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : '';
			$credit_value = !empty($_POST['credit_value']) ? $_POST['credit_value'] : '';
			$extra_charges = !empty($_POST['extra_charges']) ? $_POST['extra_charges'] : '';
			$remarks = !empty($_POST['remarks']) ? $_POST['remarks'] : '';

			$data = [
				'student_id'	=>	$student_id,
				'class_id'	=>	$class_id,
				'enrollment_date'	=>	$enrollment_date,
				'deposit'	=>	$deposit,
				'deposit_collected'	=>	$deposit_collected,
				'remarks_deposit'	=>	$remarks_deposit,
				'credit_value'	=>	$credit_value,
				'extra_charges'	=>	$extra_charges,
				'remarks'	=>	$remarks,
				'created_at'	=>	$this->date,
				'updated_at'	=>	$this->date,
			];

			$this->db->insert('student_enrollment', $data);
		}

		$reservation_date = !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '';

		if($enrollment_type==1) {
			
			$data1 = [
				'reservation_date'	=>	$reservation_date,
				'status'	=>	$enrollment_type,
				'updated_at'	=>	$this->date,
			];
		}
		else {
			$data1 = [
				'status'	=>	$enrollment_type,
				'updated_at'	=>	$this->date,
			];
		}

		$data2 = [
			'student_id'	=>	$student_id,
			'class_id'	=>	$class_id,
			'reservation_date'	=>	$reservation_date,
			'status'	=>	$enrollment_type,
			'created_at'	=>	$this->date,
			'updated_at'	=>	$this->date,
		];


		$query = $this->db->get_where('student_to_class', ['student_id'	=>	$student_id, 'class_id'	=>	$class_id, 'status !='	=>	3]);
		if($query->num_rows()>0) {
			$this->db->where('student_id', $student_id);
			$this->db->where('class_id', $class_id);
			$this->db->update('student_to_class', $data1);
		}
		else {
			$this->db->insert('student_to_class', $data2);
		}
		$this->db->trans_complete();

		$enrollment_array = get_enrollment_type();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		} else {
			$this->session->set_flashdata('success', STUDENT . ' has been ' . strtolower($enrollment_array[($enrollment_type-1)]) . ' successfully.');
			return redirect('admin/students');
		}

	}

	public function update($id)
	{
        //die(print_r($_POST));
		if(isset($_POST['password']) && $_POST['password']!="")
		{

			$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$data = array(
				'profile_picture'	=>	!empty($_POST['profile_picture']) ? $_POST['profile_picture'] : $_POST['profile_picture_exist'],
				'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
				'username'      => !empty($_POST['username']) ? $_POST['username'] : '',
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => $_POST['gender'],
				'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
				'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
				'siblings' => !empty($_POST['siblings']) ? json_encode($_POST['siblings']) : '',
				'parents_phone' => !empty($_POST['parents_phone']) ? $_POST['parents_phone'] : '',
				'password'   => !empty($_POST['password']) ? $password_h : '',
				'created_at'   => $this->date,
				'updated_at'   => $this->date
			);
		}
		else
		{
			$data = array(
				'profile_picture'	=>	!empty($_POST['profile_picture']) ? $_POST['profile_picture'] : $_POST['profile_picture_exist'],
				'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
				'username'      => !empty($_POST['username']) ? $_POST['username'] : '',
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => !empty($_POST['gender']) ? $_POST['gender'] : '',
				'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
				'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
				'siblings' => !empty($_POST['siblings']) ? json_encode($_POST['siblings']) : '',
				'parents_phone' => !empty($_POST['parents_phone']) ? $_POST['parents_phone'] : '',
				'created_at'   => $this->date,
				'updated_at'   => $this->date
			);	


		}

		$this->db->trans_start();
		$this->db->where('student_id', $id);
		$this->db->update('student', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students/edit/'.$id);
		} else {
			$this->session->set_flashdata('success', STUDENT . ' ' . MSG_UPDATED);
			return redirect('admin/students/edit/'.$id);
		}
	}

	public function update_archive($id)
	{
        //die(print_r($_POST));
		$data = array(
			'is_archive'   => 1,
			'updated_at'   => date('Y-m-d H:i:s'),
		);

		$this->db->trans_start();
		$this->db->where('student_id', $id);
		$this->db->update('student', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		} else {
			$this->session->set_flashdata('success','Student archived successfully.');
			return redirect('admin/students');
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

	public function moveto_active_list($id)
	{
		$this->db->trans_start();
		$this->db->where('student_id', $id);
		$this->db->update(DB_STUDENT, array('is_archive' => 0, 'updated_at' => $this->date));
		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students/archived');
		} else {
			$this->session->set_flashdata('success', STUDENT . ' ' . MSG_MOVED);
			return redirect('admin/students');
		}
	}

}
