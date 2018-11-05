<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends CI_Model
{
    public function is_logged_in()
    {
        if(!($this->session->has_userdata('student_credentials'))) {
            $this->logout();
        }
    }

    public function process()
    {
        $email       = isset($_POST['email']) ? $_POST['email'] : '';
        $password    = isset($_POST['password']) ? $_POST['password'] : '';
        $remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;

        $cookie = [
            'name'   => 'remember_me_token',
            'domain' => '',
            'path'   => '/',
        ];
        delete_cookie($cookie);

        $query = $this->db->get_where(DB_STUDENT, ['email' => $email]);
        if ($query->num_rows() > 0) {
            $result = $query->row();
            if (password_verify($password, $result->password)) {
                if ($remember_me) {
                    $cookie = [
                        'name'   => 'remember_me_token',
                        'value'  => $remember_me,
                        'domain' => '',
                        'path'   => '/',
                    ];
                }

                $student_data = array(
                    'username'  => $result->username,
                    'email'     => $result->email,
                    'id'        => $result->id,
                    'logged_in' => true,
                );

                $this->session->set_userdata('student_credentials', $student_data);
                return redirect('student-profile');
            } else {
                $this->session->set_flashdata('error', $this->lang->line('aauth_error_login_failed_email'));
                return redirect("login");
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('aauth_error_login_failed_email'));
            return redirect("login");
        }
    }

    public function logout() {
        $this->session->unset_userdata('student_credentials');
        return redirect('home');
    }
}
