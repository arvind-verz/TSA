<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class News extends MY_Controller {



    function __construct() {

        parent::__construct();

        $this->load->model('Cms_model', '', TRUE);   

		$this->load->model('Banner_model', '', TRUE); 

		//$this->load->model('Brands_model', '', TRUE);

		$this->load->model('News_model', '', TRUE);

    }

		

	public function latest_news_all() {



        $data_msg = array(); 

		$data_msg['meta_title'] = "Latest News | ".$this->all_function->get_site_options('site_name');

				

		$data_msg['page'] = $page = $this->Cms_model->get_page('latest-news');

				

		$data_msg['url'] = 'latest-news';

		

		$data_msg['menu_id'] = $page[0]['menu_id'];

		

		$data_msg['url_name'] = 'latest-news';



       $news_per_page = $this->all_function->get_site_options('latest_news_per_page');

	    //$news_per_page = 1;

	   	

		$current_page = (int) $this->input->get('page');

		

		$current_page = $current_page > 0 ? $current_page : 1;

		$limit_from = ($current_page - 1) * $news_per_page;

		

		$total_items = $this->News_model->count_all_news();

	

		$data_msg['total_items'] = $total_items;		

		$current_items = ($current_page * $news_per_page);

		

		if($current_items>$total_items){

			if($current_page==1){

				$data_msg['current_items'] = 1;

				$data_msg['display_item'] = $total_items;

			}else{

				$data_msg['current_items'] = (($current_page * $news_per_page) - $news_per_page + 1);

				$data_msg['display_item'] = ($total_items - $data_msg['current_items'] + 1);

			}

		

		}else{			

			$data_msg['current_items'] = (($current_page * $news_per_page) - $news_per_page + 1);

		}

		if($news_per_page>$total_items){			

			$news_per_page = $total_items;

		}

		if($news_per_page==0){			

			$news_per_page = 3;

		}

		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $news_per_page, $current_page, 3, base_url('latest-news'));		

		$data_msg['news_list'] = $this->News_model->get_all_news($news_per_page, $limit_from);

		

		

		    $data_msg['start_date'] = $this->News_model->get_news_start_date();		

			$data_msg['end_date'] = $this->News_model->get_news_end_date();			

			$data_msg['year'] = 0;

			$data_msg['month'] = 0;

		

		$this->view('latest_news_listing',$data_msg);

		

		

		

    } //Complete

	

	public function news_list($month,$year) {



        $data_msg = array();

		$data_msg['meta_title'] = "News | ".$this->all_function->get_site_options('site_name');

				

		$data_msg['page'] = $page = $this->Cms_model->get_page('latest-news');

		

		$data_msg['menu_id'] = $page[0]['menu_id'];

				

		$data_msg['url'] = 'latest-news';

		

		$data_msg['url_name'] = 'latest-news';

		

		$products_per_page = $this->all_function->get_site_options('latest_news_per_page');

		//$products_per_page = 1;

		$current_page = (int) $this->input->get('page');			

		$current_page = $current_page > 0 ? $current_page : 1;	

		$limit_from = ($current_page - 1) * $products_per_page;

					

		$total_items = $this->News_model->count_get_news_list($month,$year);

		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $products_per_page, $current_page, 3,base_url('latest-news/'.$month.'/'.$year));			

		$data_msg['news_list'] = $this->News_model->get_news_list($month,$year, $products_per_page, $limit_from);

		//print_r($data_msg['news_list']);exit;

		if(count($page)>0){

		

			$data_msg['start_date'] = $this->News_model->get_news_start_date();

			

			$data_msg['end_date'] = $this->News_model->get_news_end_date();

			

			$data_msg['year'] = $year;

			

			$data_msg['month'] = $month;

			

			$this->view('news_list',$data_msg);

		

		}else{

			redirect(base_url("page-not-found")); 	

		}

		

    } //Complete

	

	public function news_details($seo_url) {



        $data_msg = array();

		$data_msg['meta_title'] = "News | ".$this->all_function->get_site_options('site_name');

				

		$data_msg['page'] = $page = $this->News_model->get_news_details($seo_url);

		

		if(count($page)>0){

		

			$menu = $this->Cms_model->get_page('latest-news');

			$data_msg['page1']=$menu;

			$data_msg['menu_id'] = $menu[0]['menu_id'];

			$data_msg['pagemain'] =  $this->Cms_model->get_page('latest-news');

			$data_msg['url'] = 'latest-news';

			

			$data_msg['url_name'] = 'latest-news';

			

			$data_msg['start_date'] = $this->News_model->get_news_start_date();

			

			$data_msg['end_date'] = $this->News_model->get_news_end_date();

			

			$data_msg['year'] = date("Y", strtotime($data_msg['page'][0]['post_date']));

			

			$data_msg['month'] = date("m", strtotime($data_msg['page'][0]['post_date']));

					

			$this->view('news_details',$data_msg);

		}else{

			redirect(base_url("page-not-found")); 	

		}

		

    }

	

################################

public function newsletter_all() {



        $data_msg = array(); 

		$data_msg['meta_title'] = "News | ".$this->all_function->get_site_options('site_name');

				

		$data_msg['page'] = $page = $this->Cms_model->get_page('newsletter');

				

		$data_msg['url'] = 'newsletter';

		

		$data_msg['menu_id'] = $page[0]['menu_id'];

		

		$data_msg['url_name'] = 'newsletter';



        $news_per_page = $this->all_function->get_site_options('newsletter_per_page');

		$current_page = (int) $this->input->get('page');

		$current_page = $current_page > 0 ? $current_page : 1;

		$limit_from = ($current_page - 1) * $news_per_page;

		

		$total_items = $this->News_model->count_all_newsletter();

	

		$data_msg['total_items'] = $total_items;		

		$current_items = ($current_page * $news_per_page);

		

		if($current_items>$total_items){

			if($current_page==1){

				$data_msg['current_items'] = 1;

				$data_msg['display_item'] = $total_items;

			}else{

				$data_msg['current_items'] = (($current_page * $news_per_page) - $news_per_page + 1);

				$data_msg['display_item'] = ($total_items - $data_msg['current_items'] + 1);

			}

		

		}else{			

			$data_msg['current_items'] = (($current_page * $news_per_page) - $news_per_page + 1);

		}

		if($news_per_page>$total_items){			

			$news_per_page = $total_items;

		}

		if($news_per_page==0){			

			$news_per_page = 3;

		}

		$data_msg['pagi'] = $this->admin_pagination->ajaxpagination($total_items, $news_per_page, $current_page, 3, base_url('newsletter'));		

		$data_msg['newsletter'] = $this->News_model->get_all_newsletter($news_per_page, $limit_from);

		

		

		    $data_msg['start_date'] = $this->News_model->get_news_start_date();		

			$data_msg['end_date'] = $this->News_model->get_news_end_date();			

			$data_msg['year'] = 0;

			$data_msg['month'] = 0;

		

		$this->view('newsletter_listing',$data_msg);

		

		

		

    }

	

	

	

	public function newsletter_details($seo_url) {



        $data_msg = array();

		$data_msg['meta_title'] = "Newsletter | ".$this->all_function->get_site_options('site_name');

				

		$data_msg['page'] = $page = $this->News_model->get_newsletter_details($seo_url);

		

		if(count($page)>0){

		

			$menu = $this->Cms_model->get_page('newsletter');

			$data_msg['pagemain'] =  $data_msg['page1']=$menu;

			$data_msg['menu_id'] = $menu[0]['menu_id'];

					

			$data_msg['url'] = 'newsletter';

			

			$data_msg['url_name'] = 'newsletter';

			

			

			$data_msg['start_date'] = $this->News_model->get_news_start_date();		

			$data_msg['end_date'] = $this->News_model->get_news_end_date();			

			$data_msg['year'] = 0;

			$data_msg['month'] = 0;

			

			

					

			$this->view('newsletter_details',$data_msg);

		}else{

			redirect(base_url("page-not-found")); 	

		}

		

    }	

	

	 

	

}