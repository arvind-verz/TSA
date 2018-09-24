<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



// ------------------------------------------------------------------------

if(!function_exists('create_breadcrumb')){

		function create_breadcrumb($id){

			$ci = &get_instance();

			$i=1;

			$uri = $ci->uri->segment($i); 

			$link = '<ul class="breadcrumb">';			

			$link .= '<li class="home"><a href="'.BASE_URL.'">Home</a> &gt; </li>';

			$tl1 = $ci->uri->segment(1);

			$tl2 = $ci->uri->segment(2);

			

			$menu = $ci->all_function->get_breadcrumb_menu($id);
			
			if(count($menu)>0){

				if($menu[0]['parent_id']!=0){
					
					$parent_menu = $ci->all_function->get_breadcrumb_parent_menu($menu[0]['parent_id']);
					if(count($parent_menu)>0){

						if($parent_menu[0]['parent_id']!=0){

							$parent_top_menu = $ci->all_function->get_breadcrumb_parent_menu($parent_menu[0]['parent_id']);

							if(count($parent_top_menu)>0){

								$link.='<li><a href="'.BASE_URL.$parent_top_menu[0]['url_name'].'">'.$parent_top_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li>'.$menu[0]['menu_title'].'</li>';

							}else{

								$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li>'.$menu[0]['menu_title'].'</li>';

							}

						}else{

							$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

							$link.='<li>'.$menu[0]['menu_title'].'</li>';

						}

					}

				}else{
					$link.='<li>'.$menu[0]['menu_title'].'</li>';

				}

			}

			$uri = $ci->uri->segment($i);	

			$link .= '</ul>'; 	

			return $link;

		}

	} 

	

if(!function_exists('create_breadcrumb_new')){

		function create_breadcrumb_new($id,$title){

			$ci = &get_instance();

			$i=1;

			$uri = $ci->uri->segment($i); 

			$link = '<ul class="breadcrumb">';			

			$link .= '<li class="home"><a href="'.BASE_URL.'">Home</a> &gt; </li>';

			$tl1 = $ci->uri->segment(1);

			$tl2 = $ci->uri->segment(2);

			

			$menu = $ci->all_function->get_breadcrumb_menu($id);

			if(count($menu)>0){

				if($menu[0]['parent_id']!=0){

					$parent_menu = $ci->all_function->get_breadcrumb_parent_menu($menu[0]['parent_id']);

					if(count($parent_menu)>0){

						if($parent_menu[0]['parent_id']!=0){

							$parent_top_menu = $ci->all_function->get_breadcrumb_parent_menu($parent_menu[0]['parent_id']);

							if(count($parent_top_menu)>0){

								$link.='<li><a href="'.BASE_URL.$parent_top_menu[0]['url_name'].'">'.$parent_top_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li><a href="'.BASE_URL.$menu[0]['url_name'].'">'.$menu[0]['menu_title'].'</a> &gt; </li>';

							}else{

								$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

								$link.='<li><a href="'.BASE_URL.$menu[0]['url_name'].'">'.$menu[0]['menu_title'].'</a> &gt; </li>';

							}

						}else{

							$link.='<li><a href="'.BASE_URL.$parent_menu[0]['url_name'].'">'.$parent_menu[0]['menu_title'].'</a> &gt; </li>';

							$link.='<li><a href="'.BASE_URL.$menu[0]['url_name'].'">'.$menu[0]['menu_title'].'</a> &gt; </li>';

						}

					}

				}else{

					$link.='<li><a href="'.BASE_URL.$menu[0]['url_name'].'">'.$menu[0]['menu_title'].'</a> &gt; </li>';

				}

			}

			

			$link.='<li>'.$title.'</li>';

					

			$uri = $ci->uri->segment($i);	

			$link .= '</ul>'; 	

			return $link;

		}

	} 

	

if(!function_exists('create_breadcrumb_page')){

		function create_breadcrumb_page($id){

			$ci = &get_instance();

			$i=1;

			$uri = $ci->uri->segment($i); 

			$link = '<ul class="breadcrumb">';			

			$link .= '<li class="home"><a href="'.BASE_URL.'">Home</a> &gt; </li>';

			$tl1 = $ci->uri->segment(1);

			$tl2 = $ci->uri->segment(2);

			

			$menu = $ci->all_function->get_breadcrumb_page($id);

			

			if(count($menu)>0){

				$link.='<li>'.$menu[0]['page_heading'].'</li>';

			}

			

			$uri = $ci->uri->segment($i);	

			$link .= '</ul>'; 	

			return $link;

		}

	} 

	

if(!function_exists('create_breadcrumb_cat')){

		function create_breadcrumb_cat($cat_id){

			$ci = &get_instance();

			$i=1;

			$uri = $ci->uri->segment($i); 

			$link = '<ul class="breadcrumb">';			

			$link .= '<li class="home"><a href="'.BASE_URL.'">Home</a> &gt; </li>';

			$link .= '<li class="home"><a href="'.BASE_URL.'products">Products & Support</a> &gt; </li>';

			$tl1 = $ci->uri->segment(1);

			$tl2 = $ci->uri->segment(2);

			$cat = $ci->all_function->get_breadcrumb_cat($cat_id);

			if(count($cat)>0){

				if($cat[0]['parent_id']!=0){

					$parent_cat = $ci->all_function->get_breadcrumb_parent_cat($cat[0]['parent_id']);

					if(count($parent_cat)>0){

							$link.='<li><a href="'.BASE_URL.'categories/'.$parent_cat[0]['seo_url'].'">'.$parent_cat[0]['cat_name'].'</a> &gt; </li>';

							$link.='<li>'.$cat[0]['cat_name'].'</li>';

					}

				}else{

					$link.='<li>'.$cat[0]['cat_name'].'</li>';

				}

			}

								

			$uri = $ci->uri->segment($i);	

			$link .= '</ul>'; 	

			return $link;

		}

	} 

	

if(!function_exists('create_breadcrumb_product')){

		function create_breadcrumb_product($cat_id,$title){

			$ci = &get_instance();

			$i=1;

			$uri = $ci->uri->segment($i); 

			$link = '<ul class="breadcrumb">';			

			$link .= '<li class="home"><a href="'.BASE_URL.'">Home</a> &gt; </li>';

			$link .= '<li class="home"><a href="'.BASE_URL.'products">Products & Support</a> &gt; </li>';

			$tl1 = $ci->uri->segment(1);

			$tl2 = $ci->uri->segment(2);

			$cat = $ci->all_function->get_breadcrumb_cat($cat_id);

			if(count($cat)>0){

				if($cat[0]['parent_id']!=0){

					$parent_cat = $ci->all_function->get_breadcrumb_parent_cat($cat[0]['parent_id']);

					if(count($parent_cat)>0){

							$link.='<li><a href="'.BASE_URL.'categories/'.$parent_cat[0]['seo_url'].'">'.$parent_cat[0]['cat_name'].'</a> &gt; </li>';

							$link.='<li><a href="'.BASE_URL.'category/'.$cat[0]['seo_url'].'">'.$cat[0]['cat_name'].'</a> &gt; </li>';

					}

				}else{

					$link.='<li><a href="'.BASE_URL.'category/'.$cat[0]['seo_url'].'">'.$cat[0]['cat_name'].'</a> &gt; </li>';

				}

			}

			$link.='<li>'.$title.'</li>';				

			$uri = $ci->uri->segment($i);	

			$link .= '</ul>'; 	

			return $link;

		}

	} 