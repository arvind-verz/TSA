<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('frontend/Cms_model', '', true);
        $this->load->model('frontend/accounts', 'accounts');
        //$this->load->model('Banner_model', '', TRUE);
        
    }
    public function index()
    {

        $data_msg                 = array();
        $url                      = "home";
        $data_msg['page']         = $page         = $this->Cms_model->get_page($url);
        $data_msg['menu_id']      = $page[0]['menu_id'];
        $data_msg['url']          = $url;
        $data_msg['testimonials'] = $this->Cms_model->get_testimonials();
        $data_msg['gallery']      = $this->Cms_model->get_gallery();

        $this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/home');
        $this->load->view('frontend/include/footer');
    }
    public function student_profile()
    {
        $this->accounts->is_logged_in();
        $data                    = array();
        $url                     = "home";
        $data['page']            = $page            = $this->Cms_model->get_page($url);
        $data['menu_id']         = $page[0]['menu_id'];
        $data['url']             = 'student-profile';
        $data['testimonials']    = $this->Cms_model->get_testimonials();
        $data['student_profile'] = get_student_profile();
        $data['title']           = STUDENT . ' | Profile';
        $data['page_title']      = STUDENT . ' | Profile';
        $this->load->view('frontend/include/header', $data);
        $this->load->view('frontend/student-profile');
        $this->load->view('frontend/include/footer');
    }
    public function student_invoices()
    {
        $this->accounts->is_logged_in();
        $data                     = array();
        $url                      = "home";
        $data['page']             = $page             = $this->Cms_model->get_page($url);
        $data['menu_id']          = $page[0]['menu_id'];
        $data['url']              = 'student-invoices';
        $data['testimonials']     = $this->Cms_model->get_testimonials();
        $data['student_invoices'] = get_student_invoices();
        $data['student_profile']  = get_student_profile();
        $data['title']            = STUDENT . ' | Invoices';
        $data['page_title']       = STUDENT . ' | Invoices';
        $this->load->view('frontend/include/header', $data);
        $this->load->view('frontend/student-invoices');
        $this->load->view('frontend/include/footer');
    }

    public function student_classes()
    {
        $this->accounts->is_logged_in();
        $data                    = array();
        $url                     = "home";
        $data['page']            = $page            = $this->Cms_model->get_page($url);
        $data['classes']         = $this->Cms_model->get_assign_class();
        $data['student_profile'] = get_student_profile();
        $data['menu_id']         = $page[0]['menu_id'];
        $data['url']             = 'student-classes';
        $data['title']           = STUDENT . ' | Classes';
        $data['page_title']      = STUDENT . ' | Classes';
        $this->load->view('frontend/include/header', $data);
        $this->load->view('frontend/student-classes');
        $this->load->view('frontend/include/footer');
    }

    public function inner_pages($url)
    {
        //echo $url;die;
        $data_msg = array();
        $page     = $this->Cms_model->get_page($url);
        $page1    = $this->Cms_model->get_page_others($url);

        if (count($page) > 0) {

            $data_msg['page']      = $page;
            $data_msg['menu_id']   = $page[0]['menu_id'];
            $data_msg['page_id']   = $page[0]['id'];
            $data_msg['url_name']  = $url;
            $data_msg['url']       = $url;
            $data_msg['url_name2'] = $url;
        } elseif (count($page1) > 0) {
            $page                  = $page1;
            $data_msg['page']      = $page;
            $data_msg['menu_id']   = 0;
            $data_msg['page_id']   = $page[0]['id'];
            $data_msg['url_name']  = $url;
            $data_msg['url']       = $url;
            $data_msg['url_name2'] = $url;
        } else {

            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('404 Page', '404 Page');
            $data_msg['menu_id']     = 0;
            $data_msg['url']         = '404 Page';
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();

            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/page-not-found');
            $this->load->view('frontend/include/footer');
            //die('hiiiii');
        }
        if ($url == 'thank-you') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push($page[0]['page_heading'], '#');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/thank-you');
            $this->load->view('frontend/include/footer');
        } else if ($url == 'subjects') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Subjects', 'subjects');
            $data_msg['subjects']    = $this->Cms_model->get_subjects();
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/subjects');
            $this->load->view('frontend/include/footer');

        }
        
        else if ($url == 'testimonials') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Testimonial', 'testimonial');
			$data_msg['testimonials'] = $this->Cms_model->get_all_testimonials();
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/testimonial');
            $this->load->view('frontend/include/footer');

        } 
        else if ($url == 'login') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Login', 'login');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/accounts/login');
            $this->load->view('frontend/include/footer');

        } else if ($url == 'reset-password') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Reset Password', 'home');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/accounts/reset-password');
            $this->load->view('frontend/include/footer');

        } else if (count($page) > 0 && $page[0]['template'] == 'About Us') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('About Us', 'about-us');
            $this->breadcrumbs2->push($page[0]['page_heading'], '#');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/about');
            $this->load->view('frontend/include/footer');
        } else if (count($page) > 0 && $page[0]['template'] == 'Full Width') {
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push($page[0]['page_heading'], '#');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/inner_page');
            $this->load->view('frontend/include/footer');
        }

    }

    public function testimonial()
    {
        $data_msg            = array();
        $data_msg['url']     = $url     = "testimonial";
        $data_msg['page']    = $page    = $this->Cms_model->get_page($url);
        $data_msg['menu_id'] = $page[0]['menu_id'];
        $this->breadcrumbs2->push('Home', 'home');
        $this->breadcrumbs2->push($page[0]['page_heading'], '#');
        $data_msg['breadcrumbs']  = $this->breadcrumbs2->show();
        $data_msg['testimonials'] = $this->Cms_model->get_testimonials();

        $this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/testimonial');
        $this->load->view('frontend/include/footer');
    }

    public function miss_class()
    {
        $this->load->library('form_validation');
        $configForm = array(
            array(
                'field' => 'remark',
                'label' => 'Remark',
                'rules' => 'required',
            ),
            array(
                'field' => 'updated_at',
                'label' => 'Date of Absence',
                'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($configForm);

        if ($_POST) {
            if ($this->form_validation->run() == false) {
                $error_msg             = validation_errors();
                $data_msg['error_msg'] = $error_msg;
                $this->session->set_flashdata('error', $error_msg);
                redirect(site_url("student-classes"));
            } else {
                $post_data = $_POST;
                $status    = array('0', '1', '0', '0', '0', '0');
                $data      = array(
                    'remark'     => $post_data['remark'],
                    'status'     => json_encode($status),
                    'updated_at' => $post_data['updated_at'],
                );

                $this->db->trans_start();
                $this->db->where('student_id', $post_data['student_id']);
                $this->db->update(DB_ATTENDANCE, $data);
                //$this->db->last_query();die;
                $this->db->trans_complete();

                $this->session->set_flashdata('success', 'Successfully added');
                redirect(site_url("student-classes"));

            }
        }
    }

    public function contact_us()
    {
        //mail("arvind.verz@gmail.com", 'Test', 'Test.');die();
        //print_r(send_mail_contact('arvind.verz@gmail.com', 'purohitarvind77@gmail.com', 'Thank you', 'Thank you for your mail.', 'Arvind'));die();
        //print_r(send_autoreply_email('arvind.verz@gmail.com', 'Arvind Purohit'));die();
        $data_msg = array();
        $url      = "contact-us";
        $data_msg['page'] = $page = $this->Cms_model->get_page($url);

        $data_msg['menu_id'] = $page[0]['menu_id'];
        $data_msg['url']     = $url;
        $this->breadcrumbs2->push('Home', 'home');
        $this->breadcrumbs2->push('Contact Us', 'contact-us');
        $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
        $this->load->view('frontend/include/header', $data_msg);
        $this->load->view('frontend/contact-us');
        $this->load->view('frontend/include/footer');

    }

    public function contact_us_form()
    {
        $configForm = array(
            array(
                'field' => 'fname',
                'label' => 'Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'email_id',
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ),
            array(
                'field' => 'phone',
                'label' => 'Contact Number',
                'rules' => 'required',
            ),
            array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'required',
            ),
            array(
                'field' => 'message',
                'label' => 'Comment',
                'rules' => 'required',
            ),
            array(
                'field' => 'g-recaptcha-response',
                'label' => 'Captcha',
                'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($configForm);
        if ($this->form_validation->run() == false) {
            $data_msg = array();
            $url      = "contact-us";
            $data_msg['page'] = $page = $this->Cms_model->get_page($url);

            $data_msg['menu_id'] = $page[0]['menu_id'];
            $data_msg['url']     = $url;
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Contact Us', 'contact-us');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/contact-us');
            $this->load->view('frontend/include/footer');
        }
        else {
            $this->Cms_model->contact_us_form($_POST);
        }
    }

    public function quick_enquiry_form()
    {
        
        $configForm = array(
            array(
                'field' => 'fname',
                'label' => 'Name',
                'rules' => 'required',
            ),
            array(
                'field' => 'email_id',
                'label' => 'Email',
                'rules' => 'required|valid_email',
            ),

            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required',
            ),
            array(
                'field' => 'message',
                'label' => 'Comment',
                'rules' => 'required',
            ),
            array(
                'field' => 'g-recaptcha-response',
                'label' => 'Captcha',
                'rules' => 'required',
            ),
        );
        $this->form_validation->set_rules($configForm);
        if ($this->form_validation->run() == false) {
            $data_msg = array();
            $url      = "contact-us";
            $data_msg['page'] = $page = $this->Cms_model->get_page($url);

            $data_msg['menu_id'] = $page[0]['menu_id'];
            $data_msg['url']     = $url;
            $this->breadcrumbs2->push('Home', 'home');
            $this->breadcrumbs2->push('Contact Us', 'contact-us');
            $data_msg['breadcrumbs'] = $this->breadcrumbs2->show();
            $this->load->view('frontend/include/header', $data_msg);
            $this->load->view('frontend/contact-us');
            $this->load->view('frontend/include/footer');
        }
        else{
            
            $this->Cms_model->quick_enquiry_form($_POST);
        }
    }

    public function members()
    {
        $data_msg = array();

        $data_msg['page'] = $page = $this->Cms_model->get_page('our-members');

        $data_msg['menu_id'] = $page[0]['menu_id'];
        /*
        $data_msg['cat_id'] = 0;
        $data_msg['top_parent_id'] = 0;*/

        $data_msg['url'] = 'our-members';

        $data_msg['url_name']  = 'our-members';
        $data_msg['url_name2'] = 'our-members';
        $data_msg['mc']        = $this->Cms_model->get_members_cms();

        $this->view('members_cms', $data_msg);

    }

    public function success()
    {
        $data_msg             = array();
        $data_msg['page']     = $page     = $this->Cms_model->get_page_others('success');
        $data_msg['menu_id']  = 0;
        $data_msg['url_name'] = 'success';
        $data_msg['url']      = 'success';
        //$this->session->userdata = array();
        $this->view('payment_success', $data_msg);
    }
    public function cancel()
    {
        $data_msg             = array();
        $data_msg['page']     = $page     = $this->Cms_model->get_page_others('cancel');
        $data_msg['menu_id']  = 0;
        $data_msg['url_name'] = 'cancel';
        $data_msg['url']      = 'cancel';
        //$this->session->userdata = array();
        $this->view('payment_cancel', $data_msg);
    }

    public function membership_type()
    {
        $data_msg = array();

        $data_msg['page'] = $page = $this->Cms_model->get_page('membership-types');

        $data_msg['menu_id'] = $page[0]['menu_id'];

        $data_msg['url'] = 'membership-types';

        $data_msg['url_name']  = 'membership-types';
        $data_msg['url_name2'] = 'membership-types';
        $data_msg['mt']        = $this->Cms_model->get_membership_type();

        $this->view('membership_type_cms', $data_msg);

    }
    public function miss_class_request()
    {
        $class_id        = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        $reason          = isset($_GET['reason']) ? $_GET['reason'] : null;
        $date_of_absence = isset($_GET['date_of_absence']) ? $_GET['date_of_absence'] : null;
        print_r(miss_class_request($class_id, $reason, $date_of_absence));
    }

    public function student_classes_search()
    {
        $searchby    = isset($_GET['searchby']) ? $_GET['searchby'] : '';
        $sortby      = isset($_GET['sortby']) ? $_GET['sortby'] : '';
        $searchfield = isset($_GET['searchfield']) ? $_GET['searchfield'] : '';
        print_r(get_student_classes_search_data($searchby, $sortby, $searchfield));
    }
}
