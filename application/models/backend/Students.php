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
					 ->where('student_id',$id);				 
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
       // die(print_r($_POST));
        $data = array(
            'student_id'     => $this->uniq_id,
            'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
            'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
            'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
            'username'      => !empty($_POST['username']) ? $_POST['username'] : '',
            'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
            'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
            'gender'   => $_POST['gender'],
            'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
            'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
            'siblings' => !empty($_POST['siblings']) ? $_POST['siblings'] : '',
            'parents_phone' => !empty($_POST['parents_phone']) ? $_POST['parents_phone'] : '',
            'password'   => !empty($_POST['password']) ? md5($_POST['password']) : '',
            'created_at'   => $this->date,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert('student', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/students/create');
        } else {
            $this->session->set_flashdata('success', STUDENT . ' ' . MSG_CREATED);
            return redirect('admin/students');
        }
    }
	
	 public function store_2()
    {
        //die(print_r($_POST));
		$student_code=explode(',',$_POST['student_code']);
		$msg='';
		if($_POST['student_status']==0)
		{
		foreach($student_code as $student)
		{
			
				$data = array(
					'student_id'     => $student,
					'enrollment_date'     => !empty($_POST['enrollment_date']) ? $_POST['enrollment_date'] : '',
					'collected'      => !empty($_POST['depo_collected']) ? $_POST['depo_collected'] : '',
					'deposit'   => !empty($_POST['deposit']) ? $_POST['deposit'] : '',
					'remarks_deposit'   => !empty($_POST['remarks_deposit']) ? $_POST['remarks_deposit'] : '',
					'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '',
					'ex_charges'   => !empty($_POST['ex_charges']) ? $_POST['ex_charges'] : '',
					'credit_value'   => !empty($_POST['credit_value']) ? $_POST['credit_value'] : '',
					'remarks'    => !empty($_POST['remarks']) ? $_POST['remarks'] : '',
					'created_at'   => $this->date,
					'updated_at'   => $this->date
				);
		
				$this->db->trans_start();
				$this->db->insert('student_enrollment', $data);
				$this->db->trans_complete();
			
			
			$data2 = array(
			'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '',
			'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : ''
			);
			
			$this->db->trans_start();
			$this->db->where('student_id', $student);
			$this->db->update('student', $data2);
			$this->db->trans_complete();
			$msg='Enrolled successfully';
			//echo $this->db->last_query();die;
		}
		}
		else if($_POST['student_status']==1)
		{
			foreach($student_code as $student)
			{
				$data2 = array(
				'reservation_date'    => !empty($_POST['reservation_date']) ? $_POST['reservation_date'] : '',
				'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : ''
				);
					foreach($_POST['class_code'] as $class):
					if($student!="all")
					{
						$data3 = array(
						'student_id'    => $student,
						'class_id'   => $class
						);
						
						$this->db->trans_start();
						$this->db->insert('student_to_class', $data3);
						$this->db->trans_complete();
					}
					endforeach;
				$this->db->trans_start();
				$this->db->where('student_id', $student);
				$this->db->update('student', $data2);
				$this->db->trans_complete();
			}
		$msg='Reserved successfully';
		}
		else
		{
			foreach($student_code as $student)
			{
				$data2 = array(
				'status'   => $_POST['student_status']!="" ? $_POST['student_status'] : ''
				);
				
				$this->db->trans_start();
				$this->db->where('student_id', $student);
				$this->db->update('student', $data2);
				$this->db->trans_complete();
			}
		$msg='Updated successfully';
		}
		if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/students');
        } else {
            $this->session->set_flashdata('success', STUDENT . ' ' . $msg);
            return redirect('admin/students');
        }
    }

    public function update($id)
    {
        //die(print_r($_POST));
		if(isset($_POST['password']) && $_POST['password']!="")
		{
			$data = array(
				'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
				'username'      => !empty($_POST['username']) ? $_POST['username'] : '',
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => $_POST['gender'],
				'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
				'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
				'siblings' => !empty($_POST['siblings']) ? $_POST['siblings'] : '',
				'parents_phone' => !empty($_POST['parents_phone']) ? $_POST['parents_phone'] : '',
				'password'   => !empty($_POST['password']) ? md5($_POST['password']) : '',
				'created_at'   => $this->date,
				'updated_at'   => $this->date
			);
		}
		else
		{
		$data = array(
				'name'   => !empty($_POST['name']) ? $_POST['name'] : '',
				'email'     => !empty($_POST['email']) ? $_POST['email'] : '',
				'nric'        => !empty($_POST['nric']) ? $_POST['nric'] : '',
				'username'      => !empty($_POST['username']) ? $_POST['username'] : '',
				'phone'   => !empty($_POST['phone']) ? $_POST['phone'] : '',
				'age'    => !empty($_POST['age']) ? $_POST['age'] : '',
				'gender'   => !empty($_POST['gender']) ? $_POST['gender'] : '',
				'parent_name'    => !empty($_POST['parent_name']) ? $_POST['parent_name'] : '',
				'parent_email'  => !empty($_POST['parent_email']) ? $_POST['parent_email'] : '',
				'siblings' => !empty($_POST['siblings']) ? $_POST['siblings'] : '',
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
			'updated_at'   => 1
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
