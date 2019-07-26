<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends CI_Model
{
    public function is_logged_in()
    {
        if($this->aauth->is_loggedin()==false)
        {
            redirect('safelogin/login');
        }
    }

    public function process()
    {
    	$email = isset($_POST['email']) ? $_POST['email'] : '';
    	$password = isset($_POST['password']) ? $_POST['password'] : '';
    	$remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;
    	if($this->aauth->login($email, $password)==false) {
            redirect('safelogin/login');
        }
        if(empty($remember_me)) {
            if($this->aauth->login($email, $password)) {
                redirect('admin/dashboard');
            }
        }
        else {
            if($this->aauth->login($email, $password, true)) {
                redirect('admin/dashboard');
            }
        }
    }

    public function logout() {
        $this->aauth->logout();
        redirect('safelogin/login');
    }

    public function permission_store() {
        //print_r($_POST);
        $title = isset($_POST['name']) ? $_POST['name'] : '';
        $modules = isset($_POST['module']) ? $_POST['module'] : '';

        $result = $this->aauth->create_perm($title);
        if($result) {
            foreach($modules as $module) {
                $this->aauth->permission_access($result, $module['name'][0], $module['view'][0], $module['create'][0], $module['edit'][0], $module['delete'][0]);
            }
        }
        $this->session->set_flashdata('success', PERMISSION . ' ' . MSG_CREATED);
        return redirect('admin/users');
    }

    public function permission_update($id) {
        //print_r($_POST);
        $title = isset($_POST['name']) ? $_POST['name'] : '';
        $modules = isset($_POST['module']) ? $_POST['module'] : '';

        $result = $this->aauth->update_perm($id, $title);
        if($result) {
            foreach($modules as $module) {
                $query = $this->db->get_where('aauth_permission_access', ['module'  => $module['name'][0], 'perm_id'   =>  $id]);
                
                if($query->num_rows()<1) {
                    $this->aauth->permission_access($result, $module['name'][0], $module['view'][0], $module['create'][0], $module['edit'][0], $module['delete'][0]);
                }
                else {
                    $this->aauth->update_permission_access($id, $module['name'][0], $module['view'][0], $module['create'][0], $module['edit'][0], $module['delete'][0]);
                }
            }
        }
        $this->session->set_flashdata('success', PERMISSION . ' ' . MSG_UPDATED);
        return redirect('admin/users');
    }

    public function users_store() {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $perm_id = isset($_POST['perm_id']) ? $_POST['perm_id'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        if($email && $password && $username && $perm_id && strlen($password)>=6) {
            $result = $this->aauth->create_user($email, $password, $username, 2);
            if($result) {
                if($status==1) {
                    $this->aauth->ban_user($result);
                }
                $this->aauth->allow_user($result, $perm_id);
                $this->session->set_flashdata('success', USERS . ' ' . MSG_CREATED);
                return redirect('admin/users');
            }
        }
        return false;
    }

    public function users_update($id) {

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $perm_id = isset($_POST['perm_id']) ? $_POST['perm_id'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $update_at = date('Y-m-d H:i:s');
        if($email && $username && $perm_id) {
            $this->db->where('id', $id);
            $this->db->update('aauth_users', ['user_type'   => $perm_id]);
            $result = $this->aauth->update_user($id, $email, false, $username, $update_at, null);
            if($status==1) {
                    $this->aauth->ban_user($id);
                }
                else {
                    $this->aauth->unban_user($id);
                }
                //die(print_r($id));
            $this->aauth->update_allow_user($id, $perm_id);
            $this->session->set_flashdata('success', USERS . ' ' . MSG_UPDATED);
            return redirect('admin/users');
        }
        return false;
    }

    public function is_permission_allowed($user_id, $perm_id, $module, $type) {
        $this->db->select('*');
        $this->db->from('aauth_permission_access');
        $this->db->join('aauth_perm_to_user', 'aauth_permission_access.perm_id = aauth_perm_to_user.perm_id');
        $this->db->where(['aauth_perm_to_user.user_id' =>  $user_id, 'aauth_permission_access.perm_id' => $perm_id, 'aauth_permission_access.module' => $module, 'aauth_permission_access.' . $type => 1]);
        $query = $this->db->get();
        if($query->num_rows()<1 && $user_id!=1) {
            return redirect('admin/denied-access-control');
        }
    }

    public function get_login_user_id() {
        $result = $this->session->userdata('user_credentials');
        if($result['id']==1) {
            return [
                'user_id'   =>  $result['id'],
                'perm_id'   =>  '',
            ];
        }
        $query = $this->db->get_where('aauth_perm_to_user', ['user_id' => $result['id']]);
        $result1 = $query->row();
        if($result1) {
            return [
                'user_id'   =>  $result['id'],
                'perm_id'   =>  $result1->perm_id,
            ];
        }
    }

    public function profileUpdate() {
        $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';

        if($old_password && $new_password) {
            $user_credentials = $this->session->userdata('user_credentials');
            $query = $this->db->get_where('aauth_users', ['id'    =>  $user_credentials['id']]);
            $result = $query->row();
            if($query->num_rows()<1) {
                $this->session->set_flashdata('error', PROFILE . ' ' . MSG_UPD_FAILED);
                return false;
            }
            if(!(password_verify($old_password, $result->pass))) {
                $this->session->set_flashdata('error', 'Old Password does not match.');
                return false;
            }
            $this->aauth->update_user($user_credentials['id'], false, $new_password, false);
            $this->session->set_flashdata('success', PROFILE . ' ' . MSG_UPDATED);
            return redirect('admin/users/profile');
        }
        return false;
    }

    public function userDetailsUpdate() {
        $user_data = $this->session->userdata('user_credentials');

        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        if($email && $username) {
            $user_update = $this->aauth->update_user($user_data['id'], $email, false, $username);
            if($user_update) {
                $this->session->set_flashdata('success', PROFILE . ' ' . MSG_UPDATED);
                return redirect('admin/users/profile');
            }
        }
        return false;
    }

    public function users_delete($id)
    {
        $deleted_at = date('Y-m-d H:i:s');
        $this->aauth->update_user($id, false, false, false, $deleted_at, $deleted_at);
        $this->session->set_flashdata('success', 'Role ' . MSG_DELETED);
        return redirect('admin/users');
    }

    public function permission_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('aauth_perms');
        $this->db->where('perm_id', $id);
        $this->db->delete('aauth_permission_access');
        $this->session->set_flashdata('success', PERMISSION . ' ' . MSG_DELETED);
        return redirect('admin/users');
    }
    
    public function check_email_exist($post)
   {
	        $sql = $this->db->get_where('aauth_users', ['email'    =>  $post['email']]);

            $item = $sql->row();
			
			 $to_email = $post['email'];
			 
		
			//count($result);die;
            if($sql->num_rows()>0)   
			{
				
				$query = $this->db->get_where('aauth_users', ['id' => 1]);

       		    $result   = $query->row();
		
                $admin_email = $result->email;
				//echo $message;die;
				$subject="Reset Password: The Science Academy";
		$message = '<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
      <tr>
        <td align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; word-break: break-word;">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
           
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">
                  
                  <tr>
                    <td class="content-cell" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                      <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Dear '.$item->username .'!</h1>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Please click <a href="'.base_url().'safelogin/login/reset_password?email='.base64_encode($post['email']).'">here</a> to reset your password.</p>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks,
                        <br /> The Science Academy Pte Ltd </p>
                      
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; word-break: break-word;">
                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                  <tr>
                    <td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">Copyright &copy; <script>// <![CDATA[
document.write( new Date().getFullYear() );
// ]]></script>2019 The Science Academy Pte Ltd <br> All rights reserved.</div></p>
                      
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>';
				 $res=send_mail_to_user($admin_email, $to_email, $subject, $message);
				
				if($res==true)
				{
				$this->session->set_flashdata('success',PASSWORD_RESET_EMAIL);
				return redirect('safelogin/login/forget_password');	
				}
				else
				{
				$this->session->set_flashdata('error',MSG_ERROR);
				return redirect('safelogin/login/forget_password');		
				}
			   }
			    else
				{
				$this->session->set_flashdata('error',MSG_EMAIL_NOT_EXIST);
				return redirect('safelogin/login/forget_password');		
				}
   }
	public function update_user_password($email,$new_password)
	{
		//echo $new_password;die;
		$query = $this->db->get_where('aauth_users', ['email'    =>  $email]);
        $result = $query->row();
		  $user_id=$result->id;
		  //echo $user_id.$new_password;die;
		 $res=$this->aauth->update_user($user_id, false, $new_password, false);
		 if($res==true)
		 {
		 $this->session->set_flashdata('success', PASSWORD.' ' . MSG_UPDATED);
		 return redirect('safelogin/login');
		 }
		 else
		 {
		 $this->session->set_flashdata('error',MSG_ERROR );
		 return redirect('safelogin/login');
		 }
	}
}
