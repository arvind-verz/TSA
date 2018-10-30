<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permission extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }
	
	
	
	public function get_permissions()
	{
	
			$this->db->select('*');
			$this->db->from(DB_ROLE_TYPE);
	
			 
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query;	
	}
	
	public function get_users()
	{
	
			$this->db->select('*');
			$this->db->from(DB_ADMIN_USER);
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query;	
	}
	
	public function get_user_details($id)
	{
	
			$this->db->select('*');
			$this->db->from(DB_ADMIN_USER);
			$this->db->where('id',$id);	
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query[0];	
	}
	
	public function get_permission_details($id)
	{
	
			$this->db->select('name');
			$this->db->from(DB_ROLE_TYPE);
			$this->db->where('id',$id);	
			 
			$query = $this->db->get()->result_object();			
			//echo $this->db->last_query();	
			return $query[0];	
	}
	
	public function get_permission($id)
	{
	
			$this->db->select('*');
			$this->db->from(DB_ROLE_TYPE_ACCESS);
			$this->db->where('type_id',$id);
	
			 
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query;	
	}
	
	public function get_modules()
	{
	
			$this->db->select('*');
			$this->db->from(DB_MODULES);
	
			 
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query;	
	}
	
	public function get_modules_name($id)
	{
	
			$this->db->select('*');
			$this->db->from(DB_MODULES);
	        $this->db->where('id',$id);
			 
			$query = $this->db->get()->result_object();			
				//echo $this->db->last_query();	
			return $query[0];	
	}
	
	
	

	

    public function store()
    {
        
		 $data2 = array(
				'name'   => !empty($_POST['title']) ? $_POST['title'] : null,
				'created_at'   => $this->date,
				'updated_at'   => $this->date,
			);
	
			$this->db->trans_start();
			$this->db->insert(DB_ROLE_TYPE, $data2);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
		    
		foreach($_POST['module'] as $key=>$value):

		
			$data = array(
				'type_id'     => $insert_id,
				'module_id'     => $key,
				'view'   => !empty($_POST['module'][$key]['view'][0]) ? $_POST['module'][$key]['view'][0] : null,
				'create'     => !empty($_POST['module'][$key]['create'][0]) ? $_POST['module'][$key]['create'][0] : null,
				'edit'   => !empty($_POST['module'][$key]['edit'][0]) ? $_POST['module'][$key]['edit'][0] : null,
				'delete'    => !empty($_POST['module'][$key]['delete'][0]) ? $_POST['module'][$key]['delete'][0] : null,
				'created_at'   => $this->date,
				'updated_at'   => $this->date,
			);
	
			$this->db->trans_start();
			$this->db->insert(DB_ROLE_TYPE_ACCESS, $data);
			$this->db->trans_complete();
	   endforeach;
 
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/permission/create');
        } else {
            $this->session->set_flashdata('success', TUTOR . ' ' . MSG_CREATED);
            return redirect('admin/permission');
        }
    }
	
	public function store_user()
    {
        
		 $data = array(
				'first_name'   => !empty($_POST['first_name']) ? $_POST['first_name'] : null,
				'last_name'   => !empty($_POST['last_name']) ? $_POST['last_name'] : null,
				'email'   => !empty($_POST['email']) ? $_POST['email'] : null,
				'password'   => !empty($_POST['password']) ? md5($_POST['password']) : null,
				'role_type_id'   => !empty($_POST['role_type_id']) ? $_POST['role_type_id'] : null,
				'is_active'   => !empty($_POST['is_active']) ? $_POST['is_active'] : null,
				'created_at'   => $this->date,
				'updated_at'   => $this->date
			);
	
			$this->db->trans_start();
			$this->db->insert(DB_ADMIN_USER, $data);
			$this->db->trans_complete();
		    
		
 
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/permission/create');
        } else {
            $this->session->set_flashdata('success', ROLE . ' ' . MSG_UPDATED);
            return redirect('admin/permission');
        }
    }
	
	
	public function update_user($id)
    {
			if(!empty($_POST['password']))
			{
			 $data = array(
					'first_name'   => !empty($_POST['first_name']) ? $_POST['first_name'] : null,
					'last_name'   => !empty($_POST['last_name']) ? $_POST['last_name'] : null,
					'email'   => !empty($_POST['email']) ? $_POST['email'] : null,
					'password'   => !empty($_POST['password']) ? md5($_POST['password']) : null,
					'role_type_id'   => !empty($_POST['role_type_id']) ? $_POST['role_type_id'] : null,
					'is_active'   => !empty($_POST['is_active']) ? $_POST['is_active'] : null,
					'created_at'   => $this->date,
					'updated_at'   => $this->date
				);
			}
			else
			{
			$data = array(
					'first_name'   => !empty($_POST['first_name']) ? $_POST['first_name'] : null,
					'last_name'   => !empty($_POST['last_name']) ? $_POST['last_name'] : null,
					'email'   => !empty($_POST['email']) ? $_POST['email'] : null,
					'role_type_id'   => !empty($_POST['role_type_id']) ? $_POST['role_type_id'] : null,
					'is_active'   => !empty($_POST['is_active']) ? $_POST['is_active'] : null,
					'created_at'   => $this->date,
					'updated_at'   => $this->date
				);	
				
			}
			
		    $this->db->trans_start();
			$this->db->where('id', $id);
			$this->db->update(DB_ADMIN_USER,$data );
			$this->db->trans_complete();
		
 
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/role/edit/'.$id);
        } else {
            $this->session->set_flashdata('success', ROLE . ' ' . MSG_UPDATED);
            return redirect('admin/role/edit/'.$id);
        }
    }


    public function update($id)
    {
		$this->db->trans_start();
			$this->db->where('id', $id);
			$this->db->update(DB_ROLE_TYPE, array(
				'name'   => !empty($_POST['title']) ? $_POST['title'] : null,
				'updated_at'   => $this->date,
			));
			$this->db->trans_complete();
		
		foreach($_POST['module'] as $key=>$value):

		
			$data = array(
				'view'   => !empty($_POST['module'][$key]['view'][0]) ? $_POST['module'][$key]['view'][0] : null,
				'create'     => !empty($_POST['module'][$key]['create'][0]) ? $_POST['module'][$key]['create'][0] : null,
				'edit'   => !empty($_POST['module'][$key]['edit'][0]) ? $_POST['module'][$key]['edit'][0] : null,
				'delete'    => !empty($_POST['module'][$key]['delete'][0]) ? $_POST['module'][$key]['delete'][0] : null,
				'updated_at'   => $this->date
			);
	
			$this->db->trans_start();
			$this->db->where('module_id', $key);
			$this->db->update(DB_ROLE_TYPE_ACCESS, $data);
			$this->db->trans_complete();
	   endforeach;
 
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/permission');
        } else {
            $this->session->set_flashdata('success', PERMISSION . ' ' . MSG_UPDATED);
            return redirect('admin/permission/edit/'.$id);
        }
		
	}
	


    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete(DB_ROLE_TYPE);
        $this->db->trans_complete();
		
		$this->db->trans_start();
        $this->db->where('type_id', $id);
        $this->db->delete(DB_ROLE_TYPE_ACCESS);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/permission');
        } else {
            $this->session->set_flashdata('success', PERMISSION . ' ' . MSG_DELETED);
            return redirect('admin/permission');
        }
    }

}
