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
	
	public function get_tutors()
	{
	
			$this->db->select('*');
			$this->db->from('tutor');
			$this->db->where('is_archive!=',1);	
			if(isset($_POST['search']) && $_POST['search']==1)
			{
				 if(isset($_POST['t_name']) && $_POST['t_name']!="")
				 $this->db->like('tutor_name',$_POST['t_name']);	
				 
				 if(isset($_POST['t_email']) && $_POST['t_email']!="")
				 $this->db->like('email',$_POST['t_email']);	
				 
				 if(isset($_POST['t_phone']) && $_POST['t_phone']!="")
				 $this->db->like('phone',$_POST['t_phone']);
				 
				 if(isset($_POST['class_code']) && $_POST['class_code']!="")
				 $this->db->like('class_code',$_POST['class_code']);
				 
				 if(isset($_POST['t_id']) && $_POST['t_id']!="")
				 $this->db->like('tutor_id',$_POST['t_id']);
				 
				 if(isset($_POST['t_scheme']) && $_POST['t_scheme']!="")
				 $this->db->where('salary_scheme',$_POST['t_scheme']);
			}			 
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query;	
	}
	
	public function get_tutor($id)
	{
	
			$this->db->select('*')
					 ->from('tutor')
					 ->where('tutor_id',$id);				 
				$query = $this->db->get()->row_object();
				//echo $this->db->last_query();					
				return $query;	
	}
	
	public function get_subjects()
	{
	
			$this->db->select('*')
					 ->from('subject');				 
			$query = $this->db->get()->result_object();
				//echo $this->db->last_query();					
			return $query;	
	}
	
	public function get_archived_tutors()
	{
	
			$this->db->select('*');
			$this->db->from('tutor');
			
			if(isset($_POST['search']) && $_POST['search']==1)
			{
				 if(isset($_POST['t_name']) && $_POST['t_name']!="")
				 $this->db->like('tutor_name',$_POST['t_name']);	
				 
				 if(isset($_POST['t_email']) && $_POST['t_email']!="")
				 $this->db->like('email',$_POST['t_email']);	
				 
				 if(isset($_POST['t_phone']) && $_POST['t_phone']!="")
				 $this->db->like('phone',$_POST['t_phone']);
				 
				 if(isset($_POST['class_code']) && $_POST['class_code']!="")
				 $this->db->like('class_code',$_POST['class_code']);
				 
				 if(isset($_POST['t_id']) && $_POST['t_id']!="")
				 $this->db->like('tutor_id',$_POST['t_id']);
				 
				 if(isset($_POST['t_scheme']) && $_POST['t_scheme']!="")
				 $this->db->where('salary_scheme',$_POST['t_scheme']);
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
    public function store()
    {
        //die(print_r($_POST));
		$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $data = array(
            'tutor_id'     => $this->uniq_id,
            'tutor_name'   => !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null,
            'email'     => !empty($_POST['email']) ? $_POST['email'] : null,
            'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : null,
            'address'    => !empty($_POST['address']) ? $_POST['address'] : null,
            'subject'   => !empty($_POST['subject']) ? $_POST['subject'] : null,
            'salary_scheme'    => !empty($_POST['salary_scheme']) ? $_POST['salary_scheme'] : null,
            'remark'  => !empty($_POST['remark']) ? $_POST['remark'] : null,
            'tutor_permission' => !empty($_POST['tutor_permission']) ? $_POST['tutor_permission'] : null,
            'password'   => !empty($_POST['password']) ? $password_h : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert('tutor', $data);
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
        //die(print_r($_POST));
		if(isset($_POST['password']) && $_POST['password']!="")
		{
			$password_h = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$data = array(
            'tutor_name'   => !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null,
            'email'     => !empty($_POST['email']) ? $_POST['email'] : null,
            'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : null,
            'address'    => !empty($_POST['address']) ? $_POST['address'] : null,
            'subject'   => !empty($_POST['subject']) ? $_POST['subject'] : null,
            'salary_scheme'    => !empty($_POST['salary_scheme']) ? $_POST['salary_scheme'] : null,
            'remark'  => !empty($_POST['remarks']) ? $_POST['remarks'] : null,
            'tutor_permission' => !empty($_POST['tutor_permission']) ? $_POST['tutor_permission'] : null,
            'password'   => !empty($_POST['password']) ? $password_h : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date);
		}
		else
		{
		$data = array(
            'tutor_name'   => !empty($_POST['tutor_name']) ? $_POST['tutor_name'] : null,
            'email'     => !empty($_POST['email']) ? $_POST['email'] : null,
            'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : null,
            'address'    => !empty($_POST['address']) ? $_POST['address'] : null,
            'subject'   => !empty($_POST['subject']) ? $_POST['subject'] : null,
            'salary_scheme'    => !empty($_POST['salary_scheme']) ? $_POST['salary_scheme'] : null,
            'remark'  => !empty($_POST['remarks']) ? $_POST['remarks'] : null,
            'tutor_permission' => !empty($_POST['tutor_permission']) ? $_POST['tutor_permission'] : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date);
		
		
		}

        $this->db->trans_start();
        $this->db->where('tutor_id', $id);
        $this->db->update('tutor', $data);
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
        $this->db->where('tutor_id', $id);
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
            return redirect('admin/tutors/archived');
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
