<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Publications extends MY_Controller {



    function __construct() {

        parent::__construct();

        $this->load->model('Cms_model', '', TRUE);   

		$this->load->model('Publications_model', '', TRUE); 

		$this->load->model('All_function_model', '', TRUE);

    }

	

	function index()

	{

		$data_msg = array();

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('publications');

		if(count($page)>0){

			$data_msg['menu_id'] = 0;

			$data_msg['url'] = 'resource';

			$data_msg['url_name'] = 'publications123';

			$data_msg['url_name2'] = 'publications';

			$data_msg['publication'] = $this->Publications_model->get_publications();

			

			$rdirectory = $this->All_function_model->get_resource_directory();

		    $data_msg['rdirectory'] = $rdirectory;

		    $pub = $this->All_function_model->get_resource_publication();

		    $data_msg['pub'] = $pub;

			

		}else{

			

			redirect(base_url("page-not-found"));

			

			exit;  	

		}

		

		$this->view('publication_listing',$data_msg);

	}

	

	public function publications_details($seo_url) {



        $data_msg = array();

		$page = $this->Publications_model->get_publications_details($seo_url);

		//print_r($page);

		if(count($page)>0){	

		$data_msg['page'] = $page;

		$data_msg['menu_id'] = 0;
		$data_msg['pagemain'] =  $this->Cms_model->get_page_others('publications');

		$data_msg['url'] = 'resource';

		$data_msg['url_name'] = $seo_url;

		$data_msg['url_name2'] = 'publications';

		

		$rdirectory = $this->All_function_model->get_resource_directory();

		$data_msg['rdirectory'] = $rdirectory;

		$pub = $this->All_function_model->get_resource_publication();

		$data_msg['pub'] = $pub;

		

		

		}else{

			

			redirect(base_url("page-not-found"));

			

			exit;  	

		}

		

		

        $this->view('publication_details',$data_msg);

		

    } 

	

	

	function our_network()

	{

		

		$data_msg = array();

				

		$data_msg['page'] = $page = $this->Cms_model->get_page_others('our-network');

		$data_msg['menu_id'] = 0;

		$data_msg['url'] = 'resource';

		$data_msg['url_name'] = 'our-network';

		//$data_msg['url_name2'] = 'publications';

		

		$rdirectory = $this->All_function_model->get_resource_directory();

		$data_msg['rdirectory'] = $rdirectory;

		$pub = $this->All_function_model->get_resource_publication();

		$data_msg['pub'] = $pub;

		

		$data_msg['our_network'] = $this->Publications_model->get_our_network_cms();

		

		

        $this->view('our_network_cms',$data_msg);

		

		

	}

	

	

}