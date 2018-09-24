<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Thank_you extends MY_Controller {



    function __construct() {

        parent::__construct();

        $this->load->model('Cms_model', '', TRUE);   

    }

	

	function index()

	{

		$data_msg = array();

		$data_msg['menu_id'] = 0;

		$data_msg['meta_title'] = "Thank You";

		

		$data_msg['url_name'] = 'thank-you';

		

		$data_msg['url'] = 'thank-you';

		

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('thank-you');

		

		$data_msg['top_parent_id'] = 0;

		$data_msg['heading'] = "Request for Quotation";

		

		

		//$data_msg['bcampf'] = "Request for Quotation";

		//$data_msg['bcamp'] = "Thank You";

		

		$this->view('thank_you',$data_msg);

		

	}

	function reg_thank_you()

	{

		$data_msg = array();

		$data_msg['menu_id'] = 0;

		$data_msg['meta_title'] = "Thank You";

		

		$data_msg['url_name'] = 'reg-thank-you';

		

		$data_msg['url'] = 'reg-thank-you';

		

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('reg-thank-you');

		

		$data_msg['top_parent_id'] = 0;

		$data_msg['heading'] = "Registration";

		

		

		//$data_msg['bcampf'] = "Request for Quotation";

		//$data_msg['bcamp'] = "Thank You";

		

		$this->view('thank_you',$data_msg);

		

	}

	

	

	

	

	

	function contact()

	{

		$data_msg = array();

		

		$data_msg['menu_id'] = 0;

		

		

		

		$data_msg['meta_title'] = "Thank You";

		

		$data_msg['url_name'] = 'thank-you';

		

		$data_msg['url'] = 'thank-you';

		

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('thank-you');

		

		$data_msg['menu_id'] = 0;

		

		//$data_msg['heading'] = "Contact Us";

		//$data_msg['bcampf'] = "<a href=".base_url('contact-us').">Contact Us</a>";

		//$data_msg['bcamp'] = "Thank You";

		

		$this->view('thank_you',$data_msg);

		

	}

	

	function registration()

	{

		$data_msg = array();

		$data_msg['cat_id'] = 0;

		$data_msg['meta_title'] = "Thank You";

		

		$data_msg['url_name'] = 'thank-you';

		

		$data_msg['url'] = 'thank-you';

		

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('thank-you');

		

		$data_msg['menu_id'] = 0;

		$data_msg['cat_id'] = 0;

		$data_msg['top_parent_id'] = 0;

		$data_msg['heading'] = "Request for Quotation";

		

		

		//$data_msg['bcampf'] = "Request for Quotation";

		//$data_msg['bcamp'] = "Thank You";

		

		$this->view('thank_you',$data_msg);

		

	}

	

	

	function product()

	{

		$data_msg = array();

		$data_msg['cat_id'] = 0;

		$data_msg['meta_title'] = "Thank You";

		

		$data_msg['url_name'] = 'thank-you';

		

		$data_msg['url'] = 'thank-you';

		

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('thank-you');

		

		$data_msg['menu_id'] = 0;

		$data_msg['cat_id'] = 0;

		$data_msg['top_parent_id'] = 0;

		$data_msg['heading'] = "Request for Quotation";

		

		

		//$data_msg['bcampf'] = "Request for Quotation";

		//$data_msg['bcamp'] = "Thank You";

		

		$this->view('thank_you',$data_msg);

		

	}

	

	

	

	

}