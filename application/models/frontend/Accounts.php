<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends CI_Model
{
    public function is_logged_in()
    {
        if (!($this->session->has_userdata('student_credentials'))) {
            return $this->logout();
        }
        return true;
    }

    public function process()
    {
        $username       = isset($_POST['username']) ? $_POST['username'] : '';
        $password    = isset($_POST['password']) ? $_POST['password'] : '';
        $remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;
        /*$recaptcha = $_POST['g-recaptcha-response'];
        if(empty($recaptcha))
        {
            $this->session->set_flashdata('error', $this->lang->line('aauth_error_recaptcha_not_correct'));
            return redirect("login");
        }*/
        $query = $this->db->get_where(DB_STUDENT, ['username' => $username, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
        if ($query->num_rows() > 0) {
            $result = $query->row();
            if (password_verify($password, $result->password)) {
                if ($remember_me) {
                    $cookie_email = [
                        'name'   => '_cusername',
                        'value'  => $username,
                        'domain' => '',
                        'path'   => '/',
                        'expire' => 36500,
                    ];
                    set_cookie($cookie_email);
                    $cookie_password = [
                        'name'   => '_cpassword',
                        'value'  => $password,
                        'domain' => '',
                        'path'   => '/',
                        'expire' => 36500,
                    ];
                    set_cookie($cookie_password);
                } else {
                    $cookie_email = [
                        'name'   => '_cemail',
                        'domain' => '',
                        'path'   => '/',
                    ];
                    delete_cookie($cookie_email);
                    $cookie_password = [
                        'name'   => '_cpassword',
                        'domain' => '',
                        'path'   => '/',
                    ];
                    delete_cookie($cookie_password);
                }

                $student_data = array(
                    'email'  => $result->email,
                    'username'     => $result->username,
                    'id'        => $result->id,
                    'logged_in' => true,
                );

                $this->session->set_userdata('student_credentials', $student_data);
                return redirect('student-profile');
            } else {
                $this->session->set_flashdata('error', $this->lang->line('aauth_error_login_failed_name'));
                return redirect("login");
            }
        } else {
            $this->session->set_flashdata('error', $this->lang->line('aauth_error_login_failed_name'));
            return redirect("login");
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('student_credentials');
        return redirect('home');
    }

    public function reset_password_process()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : '';

        if ($email) {
            $query  = $this->db->get_where(DB_STUDENT, ['email' => $email]);
            $result = $query->row();
            if ($query->num_rows() > 0) {
                $reset_link = site_url('login/reset-password/new-password/' . $result->student_id);
                $name = $result->name;
                $emailto    = $result->email;
                $subject    = "Reset Password";
                $message    = password_reset_template($reset_link, $name);
                $mail       = send_mail($emailto, false, false, false, false, $subject, $message);
                if ($mail) {
                    $this->session->set_flashdata('success', 'Password reset link has been sent to email.');
                    return redirect('reset-password');
                }

            }
            return false;
        }
        $this->session->set_flashdata('error', 'Enter email to reset password.');
        return redirect('reset-password');
    }

    public function reset_new_password_process($student_id)
    {
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        if ($student_id && $password) {
            $query  = $this->db->get_where(DB_STUDENT, ['student_id' => $student_id]);
            $result = $query->row();
            if ($query->num_rows() > 0) {
                $data = [
                    'password'         => password_hash($password, PASSWORD_BCRYPT),
                    'password_updates' => date('Y-m-d H:i:s'),
                ];
                $this->db->where(['student_id' => $student_id]);
                $this->db->update(DB_STUDENT, $data);
                $this->session->set_flashdata('success', 'Password has been changed successfully!');
                return redirect('login');
            }
        }
        return false;
    }
}
