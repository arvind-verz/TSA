<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Cms_model extends CI_Model
{

    public function get_page($url_name)
    {

        $this->db->select('cp.*, m.menu_title, m.id as menu_id')
            ->from(TBL_CMS . ' as `cp`')
            ->join(TBL_MENU . ' as `m`', 'm.page_id = cp.id')
            ->where('cp.url_name', $url_name)
            ->where('cp.status', 'Y');
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $query;

    }

    public function get_assign_class()
    {
        $student_id = $this->session->userdata('student_credentials');
        $this->db->select('*');
        $this->db->from(DB_STUDENT);
        $this->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
        $this->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
        $this->db->where('student.id', $student_id['id']);
        $this->db->where('student_to_class.status', 3);
        $this->db->order_by(DB_CLASSES . '.created_at', 'DESC');
        $query  = $this->db->get();
        $result = $query->result();
        return $result;

    }

    public function get_page_others($url_name)
    {

        $this->db->select('cp.*')
            ->from(TBL_CMS . ' as `cp`')
            ->where('cp.url_name', $url_name)
            ->where('cp.status', 'Y');
        $query = $this->db->get()->result_array();

        return $query;

    }

    public function get_subjects_name($ids)
    {

        $this->db->select('s.id,s.subject_name')
            ->from(DB_SUBJECT . ' as `s`')
            ->where('s.is_archive', 0)
            ->where_in('s.id', $ids);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $query;

    }

    public function get_book($id)
    {

        $this->db->select('m.book_name')
            ->from(DB_MATERIAL . ' as `m`')
            ->where('m.is_archive', 0)
            ->like('m.subject', $id);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();
        if (count($query)) {
            return $query[0];
        } else {
            return false;
        }

    }

    public function get_testimonials()
    {
        $this->db->select('*')
            ->from(DB_TESTIMONIAL)
			->where('featured', 1)
			->where('status', 1)
			->order_by('id', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_attendance($student_id = false)
    {
        $this->db->select('*')
            ->from(DB_ATTENDANCE)
            ->where('student_id', $student_id);
        $query = $this->db->get();
        if ($student_id) {
            $result = $query->row();
        } else {
            $result = $query->result();
        }
        return $result;
    }

    public function get_subjects()
    {
        $this->db->select('*')
            ->from(DB_SUBJECT . ' as `s`')
            ->join(TBL_CMS . ' as `c`', 's.subject_id = c.subject_id')
        ;
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_cms_subjects($subject_id)
    {
        $this->db->select('*')
            ->from(TBL_CMS)
            ->where('subject_id', $subject_id);
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_gallery()
    {
        $this->db->select('*')
            ->from(DB_GALLERY);

        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_members_cms()
    {
        $this->db->select('cp.*')
            ->from(TBL_JOIN_US_MEMBER . ' as `cp`')
            ->where('cp.id', 1);
        //->where('cp.status', 'Y');
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function get_faq()
    {

        $this->db->select('*')
            ->from(TBL_FAQ)
            ->where('status', 'Y')
            ->order_by('sort_order', 'ASC');
        $query = $this->db->get()->result_array();

        return $query;

    }

    public function batch_email($to, $from, $formname, $recipients, $subject, $message)
    {
        $config = array(
            'protocol'  => $this->get_site_options('protocol'),
            'smtp_host' => $this->get_site_options('smtp_host'),
            'smtp_port' => $this->get_site_options('smtp_port'),
            'smtp_user' => $this->get_site_options('smtp_user'),
            'smtp_pass' => $this->get_site_options('smtp_pass'),
            'mailtype'  => $this->get_site_options('mailtype'),
            'charset'   => $this->get_site_options('charset'),
        );
        $this->load->library('email', $config);
        $this->email->clear(true);
        $this->email->from($from, $formname);
        $this->email->to($to);
        $this->email->bcc($recipients);
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();

        //echo $this->email->print_debugger(); die();
        return true;

    }

    public function batch_email_attach($to, $from, $formname, $recipients, $subject, $message, $attachFile)
    {
        $config = array(
            'protocol'  => $this->get_site_options('protocol'),
            'smtp_host' => $this->get_site_options('smtp_host'),
            'smtp_port' => $this->get_site_options('smtp_port'),
            'smtp_user' => $this->get_site_options('smtp_user'),
            'smtp_pass' => $this->get_site_options('smtp_pass'),
            'mailtype'  => $this->get_site_options('mailtype'),
            'charset'   => $this->get_site_options('charset'),
        );
        $this->load->library('email', $config);
        $this->email->clear(true);
        $this->email->from($from, $formname);
        $this->email->to($to);
        $this->email->bcc($recipients);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attachFile);

        $this->email->send();
        //echo $this->email->print_debugger(); die();
        return true;

    }

    public function get_menu_pid_Mposition($pid, $Mposition)
    {
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id, m.external_url, m.link_type, m.link_target')
            ->from(TBL_MENU . ' as m')
            ->join(TBL_CMS . ' as cms', 'cms.id = m.page_id', 'LEFT')
            ->where('m.parent_id', $pid)
            ->where('m.position', $Mposition)
            ->order_by('m.sort_order', 'ASC')
            ->order_by('m.menu_position', 'ASC');
        $query = $this->db->get()->result_array();
        return $query;
    }
    public function get_selected_menu_id($current_menu_id, $menu_id, $Mposition)
    {
        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
            ->from(TBL_MENU . ' as m')
            ->join(TBL_CMS . ' as cms', 'cms.id = m.page_id', 'LEFT')
            ->where('m.id', $current_menu_id)
            ->where('m.position', $Mposition)
            ->where('cms.status', 'Y')
            ->order_by('m.menu_position', 'ASC')
            ->order_by('m.sort_order', 'ASC');
        $query = $this->db->get()->row_array();
        if ($query['id'] == $menu_id) {
            return 'Y';
        } elseif ($query['id'] != $menu_id && $query['parent_id'] == 0) {
            return 'N';
        } else {
            return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);
        }
    }
    public function get_parent_selected_menu_id($parent_id, $menu_id, $Mposition)
    {

        $this->db->select('cms.*, m.menu_title, cms.url_name, m.id, m.parent_id')
            ->from(TBL_MENU . ' as m')
            ->join(TBL_CMS . ' as cms', 'cms.id = m.page_id', 'LEFT')
            ->where('m.id', $parent_id)
            ->where('m.position', $Mposition)
            ->order_by('m.menu_position', 'ASC')
            ->order_by('m.sort_order', 'ASC');

        $query = $this->db->get()->row_array();

        if ($query['id'] == $menu_id) {

            return 'Y';

        } elseif ($query['id'] != $menu_id && $query['parent_id'] == 0) {

            return 'N';

        } else {

            return $this->get_parent_selected_menu_id($query['parent_id'], $menu_id, $Mposition);

        }

    }

    public function contact_us_form()
    {
    	$fname = $_POST['fname'];
    	$email_id = $_POST['email_id'];
    	$phone_no = $_POST['phone'];
    	$subject = $_POST['subject'];
    	$message = $_POST['message'];
    	$create_date = date('Y-m-d H:i:s');
        $recaptcha = $_POST['g-recaptcha-response'];
        $query = $this->db->get_where('aauth_users', ['id' => 1]);
        $result   = $query->row();

        $to_email = get_system_settings()->inquiry_email;
        $message_template = $this->getEnquiryMessage($fname, $email_id, $phone_no, $subject, $message);


        if(empty($recaptcha))
        {
            $this->session->set_flashdata('error', $this->lang->line('aauth_error_recaptcha_not_correct'));
            return redirect("contact-us");
        }
        $data       = array(
            'name'         => $fname,
            'email'        => $email_id,
            'phone_no'     => $phone_no,
            'enquiry_type' => $subject,
            'message'      => $message,
            'create_date'  => $create_date,
        );


        $this->db->insert(DB_CONTACT, $data);
        $var = send_mail_contact($email_id, $to_email, $subject, $message_template);
        //print_r($var);  exit;
        return redirect("thank-you");
    }

    public function quick_enquiry_form()
    {
    	$fname = $_POST['fname'];
    	$email_id = $_POST['email_id'];
    	$phone_no = $_POST['phone'];
		$message = $_POST['message'];
		$subject = "Quick Enquiry";
    	$create_date = date('Y-m-d H:i:s');
        $recaptcha = $_POST['g-recaptcha-response'];
        $query = $this->db->get_where('aauth_users', ['id' => 1]);
        $result   = $query->row();
        $to_email = 'contactus@thesciacdm.com';

        $message_template = $this->getEnquiryMessage($fname, $email_id, $phone_no, $message);

        if(empty($recaptcha))
        {
            $this->session->set_flashdata('error', $this->lang->line('aauth_error_recaptcha_not_correct'));
            return redirect("contact-us");
        }
        $data       = array(
            'name'         => $fname,
            'email'        => $email_id,
            'phone_no'     => $phone_no,
            'message'      => $message,
            'create_date'  => $create_date,
        );

	    $this->db->insert(DB_ENQUIRY, $data);
	    send_mail_contact($email_id, $to_email, $subject, $message_template, $fname);

        return redirect("thank-you");
    }
    
    public function getEnquiryMessage($fname, $email_id, $phone_no, $subject = null, $message)
    {
        $subject_content = '';
        if($subject) {
            $subject_content = '<p>Subject: <strong> '.$subject.' </strong></p>';
		}
        return '<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Enquiry - The Science Academy</title>
    <!-- 
    The style block is collapsed on page load to save you some scrolling.
    Postmark automatically inlines all CSS properties for maximum email client 
    compatibility. You can just update styles here, and Postmark does the rest.
    -->
    <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    
    *:not(br):not(tr):not(html) {
      box-sizing: border-box;
    }
    
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      line-height: 1.4;
      background-color: #F2F4F6;
      color: #74787E;
      -webkit-text-size-adjust: none;
    }
    
    p,
    ul,
    ol,
    blockquote {
      line-height: 1.4;
      text-align: left;
    }
    
    a {
      color: #3869D4;
    }
    
    a img {
      border: none;
    }
    
    td {
      word-break: break-word;
    }
    /* Layout ------------------------------ */
    
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F2F4F6;
    }
    
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    /* Masthead ----------------------- */
    
    .email-masthead {
      padding: 25px 0;
      text-align: center;
    }
    
    .email-masthead_logo {
      width: 94px;
    }
    
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #bbbfc3;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }
    /* Body ------------------------------ */
    
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      border-top: 1px solid #EDEFF2;
      border-bottom: 1px solid #EDEFF2;
      background-color: #FFFFFF;
    }
    
    .email-body_inner {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #FFFFFF;
    }
    
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .email-footer p {
      color: #AEAEAE;
    }
    
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #EDEFF2;
    }
    
    .content-cell {
      padding: 35px;
    }
    
    .preheader {
      display: none !important;
      visibility: hidden;
      mso-hide: all;
      font-size: 1px;
      line-height: 1px;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
    }
    /* Attribute list ------------------------------ */
    
    .attributes {
      margin: 0 0 21px;
    }
    
    .attributes_content {
      background-color: #EDEFF2;
      padding: 16px;
    }
    
    .attributes_item {
      padding: 0;
    }
    /* Related Items ------------------------------ */
    
    .related {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .related_item {
      padding: 10px 0;
      color: #74787E;
      font-size: 15px;
      line-height: 18px;
    }
    
    .related_item-title {
      display: block;
      margin: .5em 0 0;
    }
    
    .related_item-thumb {
      display: block;
      padding-bottom: 10px;
    }
    
    .related_heading {
      border-top: 1px solid #EDEFF2;
      text-align: center;
      padding: 25px 0 10px;
    }
    /* Discount Code ------------------------------ */
    
    .discount {
      width: 100%;
      margin: 0;
      padding: 24px;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #EDEFF2;
      border: 2px dashed #9BA2AB;
    }
    
    .discount_heading {
      text-align: center;
    }
    
    .discount_body {
      text-align: center;
      font-size: 15px;
    }
    /* Social Icons ------------------------------ */
    
    .social {
      width: auto;
    }
    
    .social td {
      padding: 0;
      width: auto;
    }
    
    .social_icon {
      height: 20px;
      margin: 0 8px 10px 8px;
      padding: 0;
    }
    /* Data table ------------------------------ */
    
    .purchase {
      width: 100%;
      margin: 0;
      padding: 35px 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_content {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_item {
      padding: 10px 0;
      color: #74787E;
      font-size: 15px;
      line-height: 18px;
    }
    
    .purchase_heading {
      padding-bottom: 8px;
      border-bottom: 1px solid #EDEFF2;
    }
    
    .purchase_heading p {
      margin: 0;
      color: #9BA2AB;
      font-size: 12px;
    }
    
    .purchase_footer {
      padding-top: 15px;
      border-top: 1px solid #EDEFF2;
    }
    
    .purchase_total {
      margin: 0;
      text-align: right;
      font-weight: bold;
      color: #2F3133;
    }
    
    .purchase_total--label {
      padding: 0 15px 0 0;
    }
    /* Utilities ------------------------------ */
    
    .align-right {
      text-align: right;
    }
    
    .align-left {
      text-align: left;
    }
    
    .align-center {
      text-align: center;
    }
    /*Media Queries ------------------------------ */
    
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
    /* Buttons ------------------------------ */
    
    .button {
      background-color: #3869D4;
      border-top: 10px solid #3869D4;
      border-right: 18px solid #3869D4;
      border-bottom: 10px solid #3869D4;
      border-left: 18px solid #3869D4;
      display: inline-block;
      color: #FFF;
      text-decoration: none;
      border-radius: 3px;
      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
      -webkit-text-size-adjust: none;
    }
    
    .button--green {
      background-color: #22BC66;
      border-top: 10px solid #22BC66;
      border-right: 18px solid #22BC66;
      border-bottom: 10px solid #22BC66;
      border-left: 18px solid #22BC66;
    }
    
    .button--red {
      background-color: #FF6136;
      border-top: 10px solid #FF6136;
      border-right: 18px solid #FF6136;
      border-bottom: 10px solid #FF6136;
      border-left: 18px solid #FF6136;
    }
    /* Type ------------------------------ */
    
    h1 {
      margin-top: 0;
      color: #2F3133;
      font-size: 19px;
      font-weight: bold;
      text-align: left;
    }
    
    h2 {
      margin-top: 0;
      color: #2F3133;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    
    h3 {
      margin-top: 0;
      color: #2F3133;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    
    p {
      margin-top: 0;
      color: #74787E;
      font-size: 16px;
      line-height: 1.5em;
      text-align: left;
    }
    
    p.sub {
      font-size: 12px;
    }
    
    p.center {
      text-align: center;
    }
    </style>
  </head>
  <body>
    <span class="preheader">Enquiry - The Science Academy</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td align="center">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
            <tbody><tr>
              <td class="email-masthead">
                <a href="https://www.thescienceacademy.sg/" class="email-masthead_name">Enquiry - The Science Academy</a>
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                  <!-- Body content -->
                  <tbody><tr>
                    <td class="content-cell">
                      <p>Enquiry Details specified below:</p>
                      <p>Name: <strong> '.$fname.' </strong></p>
					  <p>Email: <strong> '.$email.' </strong></p>
					  <p>Phone No: <strong> '.$phone_no.' </strong></p>
					  '.$subject_content.'
					  <p>Message: <strong> '.$message.' </strong></p>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
            
          </tbody></table>
        </td>
      </tr>
    </tbody></table>
  
</body></html>';
    }

}
