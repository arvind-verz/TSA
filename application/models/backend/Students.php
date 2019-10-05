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
				$this->db->like('parent_first_name',$_POST['p_name']);
				$this->db->like('parent_last_name',$_POST['p_name']);

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

	public function update_enrollment()
	{
		$student_id = !empty($_POST['student_id']) ? $_POST['student_id'] : '';
		$class_id = !empty($_POST['class_id']) ? $_POST['class_id'] : '';
		$enrollment_date = !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '';
		$deposit_collected = !empty($_POST['deposit_collected']) ? $_POST['deposit_collected'] : '';
		$remarks_deposit = !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : '';
		$previous_month_payment = !empty($_POST['previous_month_payment']) ? $_POST['previous_month_payment'] : '';
		$extra_charges = !empty($_POST['extra_charges']) ? $_POST['extra_charges'] : '';
		$remarks = !empty($_POST['remarks']) ? $_POST['remarks'] : '';

		if($student_id && $class_id && $enrollment_date)
		{
			$data = [
				'enrollment_date'	=>	$enrollment_date,
				'deposit_collected'	=>	$deposit_collected,
				'remarks_deposit'	=>	$remarks_deposit,
				'previous_month_payment'	=>	$previous_month_payment,
				'extra_charges'	=>	$extra_charges,
				'remarks'			=>	$remarks,
			];
			$this->db->trans_start();
			$this->db->where('student_id', $student_id);
			$this->db->where('class_id', $class_id);
			$this->db->update('student_enrollment', $data);
			$this->db->trans_complete();

			if ($this->db->trans_status() === false) {
				$this->session->set_flashdata('error', MSG_ERROR);
				return redirect('admin/students/create');
			} else {
				$this->session->set_flashdata('success', STUDENT . ' details ' . MSG_UPDATED);
				return redirect('admin/students');
			}
		}
		$this->session->set_flashdata('error', MSG_ERROR);
		return redirect('admin/students/create');
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
			$this->db->like('parent_first_name',$_POST['p_name']);
			$this->db->like('parent_last_name',$_POST['p_name']);

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
		$nric = !empty($_POST['nric']) ? url_title($_POST['nric']) : '';
		$username = !empty($_POST['username']) ? url_title($_POST['username']) : null;
		$query = $this->db->get_where(DB_STUDENT, ['username'	=>	$username]);
        if($query->num_rows()>0)
        {
        	$this->session->set_flashdata('error', 'Username exists in our system.');
			return redirect('admin/students/create');
        }
        $query = $this->db->get_where(DB_STUDENT, ['nric'	=>	$nric]);
        if($query->num_rows()>0)
        {
        	$this->session->set_flashdata('error', 'Nric exists in our system.');
			return redirect('admin/students/create');
        }
		$firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : '';
		$lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : '';
		$username = $username;
		$email = !empty($_POST['email']) ? $_POST['email'] : '';
		$parent_email = !empty($_POST['parent_email']) ? $_POST['parent_email'] : '';
		$password = $_POST['password'];
		$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$login_link = site_url('login');
		$email_to = [$email, $parent_email];
		$data = array(
			'student_id'     => $this->uniq_id,
			'profile_picture'	=>	!empty($_POST['profile_picture']) ? $_POST['profile_picture'] : null,
			'firstname'   => !empty($_POST['firstname']) ? $_POST['firstname'] : '',
			'lastname'   => !empty($_POST['lastname']) ? $_POST['lastname'] : '',
			'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
			'nric'        => $nric,
			'username'      => $username,
			'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
			'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
			'gender'   => $_POST['gender'],
			'salutation'    => !empty($_POST['salutation']) ? $_POST['salutation'] : '',
			'parent_first_name'    => !empty($_POST['parent_first_name']) ? $_POST['parent_first_name'] : '',
			'parent_last_name'    => !empty($_POST['parent_last_name']) ? $_POST['parent_last_name'] : '',
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
		$message = student_registration_template($firstname, $username, $email, $password, $login_link);
		send_mail($email_to, false, false, false, false, $subject, $message);
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
		$old_status = !empty($_POST['enrollment_status']) ? $_POST['enrollment_status'] : '';
		$student_id = !empty($_POST['student_id']) ? $_POST['student_id'] : '';
		$class_id = !empty($_POST['class_code']) ? $_POST['class_code'] : '';
		$old_class_id = !empty($_POST['old_class_id']) ? $_POST['old_class_id'] : '';
		$store_type = $_POST['store_type'];
		$class_code = get_class_code_by_class($class_id);

		if(!($student_id && $enrollment_type)) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		}

		if($store_type=='update')
		{
			$this->db->trans_start();
			if($enrollment_type==3)
			{
				$enrollment_date = !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '';
				$deposit = !empty($_POST['deposit']) ? $_POST['deposit'] : '';
				$deposit_collected = !empty($_POST['deposit_collected']) ? $_POST['deposit_collected'] : '';
				$remarks_deposit = !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : '';
				$previous_month_payment = !empty($_POST['previous_month_payment']) ? $_POST['previous_month_payment'] : '';
				$extra_charges = !empty($_POST['extra_charges']) ? $_POST['extra_charges'] : '';
				$remarks = !empty($_POST['remarks']) ? $_POST['remarks'] : '';

//die(print_r($extra_charges));
				$data = [
					'student_id'	=>	$student_id,
					'class_id'	=>	$class_id,
					'enrollment_date'	=>	$enrollment_date,
					'deposit'	=>	$deposit,
					'deposit_collected'	=>	$deposit_collected,
					'remarks_deposit'	=>	$remarks_deposit,
					'previous_month_payment'	=>	$previous_month_payment,
					'extra_charges'	=>	$extra_charges,
					'remarks'	=>	$remarks,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];
				$this->db->insert('student_enrollment', $data);
			}

			$reservation_date = !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '';

			if($enrollment_type==2) {
				$data2 = [
					'student_id'	=>	$student_id,
					'class_id'	=>	$class_id,
					'status'	=>	$enrollment_type,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];
			}
			else {
				$data2 = [
					'student_id'	=>	$student_id,
					'class_id'	=>	$class_id,
					'reservation_date'	=>	$reservation_date,
					'status'	=>	$enrollment_type,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];
			}
			if($old_status==2)
			{
				$this->db->where('student_id', $student_id);
				$this->db->where('status', $old_status);
				$this->db->update('student_to_class', $data2);
				$this->db->trans_complete();
			}
			else {
				$this->db->where('student_id', $student_id);
				$this->db->where('class_id', $old_class_id);
				$this->db->update('student_to_class', $data2);
				$this->db->trans_complete();
			}


			if ($this->db->trans_status() === false) {
				$this->session->set_flashdata('error', MSG_ERROR);
				return redirect('admin/students');
			} else {
				$this->session->set_flashdata('success', STUDENT . ' details has been updated successfully.');
				return redirect('admin/students');
			}
		}

		$student_id = explode(',', $student_id);
		$student_exist_array = [];
		foreach($student_id as $student)
		{
			$query = $this->db->get_where('student_to_class', ['student_id'	=>	$student, 'class_id'	=>	$class_id]);
			if($query->num_rows()>0)
			{
				$student_exist_array[] = get_student_name_by_student_id($student);
			}
		}
		if(count($student_exist_array)>0)
		{
			$student_exist_array = array_unique($student_exist_array);
			$student_names = implode(',', $student_exist_array);
			$this->session->set_flashdata('error', $student_names . ' already exist in class ' . $class_code);
			return redirect('admin/students');
		}
		$this->db->trans_start();
		foreach($student_id as $student) {
			if($enrollment_type==3)
			{
				$enrollment_date = !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '';
				$deposit = !empty($_POST['deposit']) ? $_POST['deposit'] : '';
				$deposit_collected = !empty($_POST['deposit_collected']) ? $_POST['deposit_collected'] : '';
				$remarks_deposit = !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : '';
				$previous_month_payment = !empty($_POST['previous_month_payment']) ? $_POST['previous_month_payment'] : '';
				$extra_charges = !empty($_POST['extra_charges']) ? $_POST['extra_charges'] : '';
				$remarks = !empty($_POST['remarks']) ? $_POST['remarks'] : '';

				$data = [
					'student_id'	=>	$student,
					'class_id'	=>	$class_id,
					'enrollment_date'	=>	$enrollment_date,
					'deposit'	=>	$deposit,
					'deposit_collected'	=>	$deposit_collected,
					'remarks_deposit'	=>	$remarks_deposit,
					'previous_month_payment'	=>	$previous_month_payment,
					'extra_charges'	=>	$extra_charges,
					'remarks'	=>	$remarks,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];

				$this->db->insert('student_enrollment', $data);
			}

			$reservation_date = !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '';

			if($enrollment_type==2) {

				$data2 = [
					'student_id'	=>	$student,
					'class_id'	=>	$class_id,
					'status'	=>	$enrollment_type,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];
			}
			else {
				$data2 = [
					'student_id'	=>	$student,
					'class_id'	=>	$class_id,
					'reservation_date'	=>	$reservation_date,
					'status'	=>	$enrollment_type,
					'created_at'	=>	$this->date,
					'updated_at'	=>	$this->date,
				];
			}
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
		$email = !empty($_POST['email']) ? $_POST['email'] : '';
		$nric = !empty($_POST['nric']) ? url_title($_POST['nric']) : '';
		$username = !empty($_POST['username']) ? url_title($_POST['username']) : null;

        // $query = $this->db->get_where(DB_STUDENT, ['email'	=>	$email, 'student_id !='	=>	$id]);
        // if($query->num_rows()>0)
        // {
        // 	$this->session->set_flashdata('error', 'Email ID exists in our system.');
		// 	return redirect('admin/students/edit/'.$id);
        // }
        $query = $this->db->get_where(DB_STUDENT, ['username'	=>	$username, 'student_id !='	=>	$id]);
        if($query->num_rows()>0)
        {
        	$this->session->set_flashdata('error', 'Username exists in our system.');
			return redirect('admin/students/edit/'.$id);
        }
        $query = $this->db->get_where(DB_STUDENT, ['nric'	=>	$nric, 'student_id !='	=>	$id]);
        if($query->num_rows()>0)
        {
        	$this->session->set_flashdata('error', 'Nric exists in our system.');
			return redirect('admin/students/edit/'.$id);
        }
		if(isset($_POST['password']) && $_POST['password']!="")
		{

			$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$data = array(
				'profile_picture'	=>	!empty($_POST['profile_picture']) ? $_POST['profile_picture'] : $_POST['profile_picture_exist'],
				'firstname'   => !empty($_POST['firstname']) ? $_POST['firstname'] : '',
				'lastname'   => !empty($_POST['lastname']) ? $_POST['lastname'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => $nric,
				'username'      => $username,
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => $_POST['gender'],
				'salutation'    => !empty($_POST['salutation']) ? $_POST['salutation'] : '',
				'parent_first_name'    => !empty($_POST['parent_first_name']) ? $_POST['parent_first_name'] : '',
				'parent_last_name'    => !empty($_POST['parent_last_name']) ? $_POST['parent_last_name'] : '',
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
				'firstname'   => !empty($_POST['firstname']) ? $_POST['firstname'] : '',
				'lastname'   => !empty($_POST['lastname']) ? $_POST['lastname'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => $nric,
				'username'      => $username,
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => !empty($_POST['gender']) ? $_POST['gender'] : '',
				'salutation'    => !empty($_POST['salutation']) ? $_POST['salutation'] : '',
				'parent_first_name'    => !empty($_POST['parent_first_name']) ? $_POST['parent_first_name'] : '',
				'parent_last_name'    => !empty($_POST['parent_last_name']) ? $_POST['parent_last_name'] : '',
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
			return redirect('admin/students');
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
		send_archived_invoice($id);
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

	public function final_settlement($student_id, $class_id)
	{

		//return "Hello";
		$data = array(
			'status'   => 4,
			'updated_at'   => date('Y-m-d H:i:s'),
		);
		send_final_settlement_invoice($student_id, $class_id);
		//return "hello";
		$this->db->trans_start();

		$this->db->where('student_id', $student_id);
		$this->db->where('class_id', $class_id);
		$this->db->update('student_to_class', $data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students');
		} else {
			$this->session->set_flashdata('success','Student Final Settlement done successfully.');
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

	public function delete_archive($student_id)
    {
    	$this->db->trans_start();
    	$query = $this->db->get_where(DB_STUDENT, ['student_id'	=>	$student_id]);
    	$result = $query->row();
        $this->db->delete('student_enrollment', ['student_id' =>  $student_id]);
        $this->db->delete('student_to_class', ['student_id' =>  $student_id]);
        $this->db->delete(DB_STUDENT, ['student_id' =>  $student_id]);
        $this->db->trans_complete();

		if ($this->db->trans_status() === false) {
			$this->session->set_flashdata('error', MSG_ERROR);
			return redirect('admin/students/archived');
		}
		else {
        	$this->session->set_flashdata('success', STUDENT . ' ' . MSG_DELETED);
        	return redirect('admin/students/archived');
        }
    }


	public function archive()
    {
		//die(print_r($_POST));
        $student_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';
        if ($student_id) {
            $this->db->trans_start();
            foreach ($student_id as $id) {
				send_archived_invoice($id);
                $this->db->where('student_id', $id);
                $this->db->update(DB_STUDENT, ['is_archive' => 1, 'updated_at' => $this->date]);

            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('error', MSG_ERROR);
                return redirect('admin/students');
            } else {
                $this->session->set_flashdata('success', STUDENT . ' ' . MSG_ARCHIVED);
                return redirect('admin/students');
            }
        }
        $this->session->set_flashdata('error', MSG_ERROR);
        return false;
	}
	
	public function generate_invoice() {
		// DEFINE VARIABLES
		$student_id = $_POST['student_id'] ?? '';
		$class_id = $_POST['class_id'] ?? '';
		$deposit = $_POST['deposit'] ?? '';
		$lesson_fees = $_POST['lesson_fees'] ?? '';
		$material_fees = $_POST['material_fees'] ?? '';
		$extra_charges = $_POST['extra_charges'] ?? '';
		$previous_month_payment = $_POST['previous_month_payment'] ?? '';
		$previous_month_balance = $_POST['previous_month_balance'] ?? '';
		$returned_deposit = $_POST['returned_deposit'] ?? '';

		// ACTIVE STUDENT DATA
		$this->db->select('*, student.id as sid');
		$this->db->from(DB_CLASSES);
		$this->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
		$this->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
		$this->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
		$this->db->limit(1);
		$query1 = $this->db->get();
		$result1 = $query1->row();
		if($result1)
		{
			$type = 'first_month_invoice';
		
			// DEFINE VARIABLES
		
			// $invoice_id = uniqid();
			// $invoice_no = get_invoice_no();
			// $date = date('Y-m-d H:i:s');
			// $invoice_file = $invoice_id . '__invoice_pdf-' . $date . '.pdf';
			// $file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
		
			// $emailto = [$result1->email, $result1->parent_email];

			// $invoice_data = ['class_code' => $class_code, 'lesson_fee' => number_format($lesson_fees, 2), 'material_fees' => number_format($book_charges, 2), 'extra_charges' => number_format($extra_charges, 2), 'previous_month_payment' => number_format($previous_month_payment, 2), 'previous_month_balance' => number_format($previous_month_balance, 2), 'returned_deposit'	=>	number_format($returned_deposit, 2)];

			// $invoice = ['invoice_id' => $invoice_id, 'invoice_no' => $invoice_no, 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data), 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];

			// $query = $this->db->insert(DB_INVOICE, $invoice);
			// if ($query) {
			// 	$this->load->library('M_pdf');
			// 	$this->m_pdf->download_my_mPDF($invoice_file);
			// 	$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
			// 	echo "<br> Invoice has been generated.";
			// 	if ($mail == true) {
			// 		echo "<br> Email Sent.";
			// 	}
			// }
		}
	}

}
