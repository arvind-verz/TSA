<?php


  if(!defined('BASEPATH'))
          exit('No direct script access allowed');

  class Admin_pagination {
		  
          public function ajax_pagination($total_items , $item_per_page , $current_page , $adjacents , $url = NULL) {
                  current_url();
                  if($url === NULL)
                  {
                          $url = current_url(); //base_url('seo-details');
                  }
                  // How many adjacent pages should be shown on each side?
                  // $adjacents = $adj;
                  $total_pages = $total_items;
                  $limit = $item_per_page; //how many items to show per page
                  $page = $current_page;              //Access the current page
                  /* Setup page vars for display. */
                  if($page == 0)
                          $page = 1;   //if no page var is given, default to 1.
                  $prev = $page - 1;     //previous page is page - 1
                  $next = $page + 1;     //next page is page + 1
                  $lastpage = ceil($total_pages / $limit); //lastpage is = total pages / items per page, rounded up.
                  $lpm1 = $lastpage - 1;    //last page minus 1

                  /*
                    Now we apply our rules and draw the pagination object.
                    We're actually saving the code to a variable in case we want to draw it more than once.
                   */
                  $pagination = "";
                  if($lastpage > 1)
                  {
                          $pagination .= "<ul class=\"pagination\">";
                          if($page > 1)
                          {
                                  //$pagination .= "<a class=\"first\" href=\"{$url}?page=1\"> &laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<li><a class=\"pre\" onClick=\"add_options_page($(this).attr('id'));\" id=\"{$prev}\">&laquo;</a></li>";
                                 
                          }
                          else
                          {
                                  //$pagination .= "<a class=\"first disabled\" href=\"javascript:void(0)\">&laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<li><a class=\"pre disabled\" href=\"javascript:void(0)\">&laquo;</a></li>";
                          }
                          
                          //pages
                          if($lastpage < 7 + ($adjacents * 2))
                          { //not enough pages to bother breaking it up
                                  for ($counter = 1; $counter <= $lastpage; $counter++)
                                  {
                                          if($counter == $page)
                                                  $pagination.= "<li class=\"active\"><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                          
                                          else
                                                  $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                         
                                  }
                          }
                          elseif($lastpage > 5 + ($adjacents * 2))
                          { //enough pages to hide some
                                  //close to beginning; only hide later pages
                                  if($page <= 1 + ($adjacents * 2))
                                  {
                                          for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li class=\"active\" ><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                 
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$lpm1}\" >{$lpm1}</a></li>";
                                          
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$lastpage}\" >{$lastpage}</a></li>";
                                          
                                  }
                                  //in middle; hide some front and some back
                                  elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                  {
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"1\" >1</a></li>";
                                          
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"2\" >2</a></li>";
                                          
                                          $pagination.= "...";
                                          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li class=\"active\"><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                  
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$lpm1}\" >{$lpm1}</a></li>";
                                         
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$lastpage}\" >{$lastpage}</a></li>";
                                          
                                  }
                                  //close to end; only hide early pages
                                  else
                                  {
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"1\" >1</a></li>";
                                         
                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"2\" >2</a></li>";
                                          
                                          $pagination.= "...";
                                          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li class=\"active\"><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$counter}\" >{$counter}</a></li>";
                                                  
                                          }
                                  }
                          }

                          //next button
                          if($page < $counter - 1)
                          {
                                  $pagination .= "<li><a onClick=\"add_options_page($(this).attr('id'));\" id=\"{$next}\" class=\"next\">&raquo;</a></li>";
                                  //$pagination .= "<a class=\"last\" href=\"{$url}?page={$lastpage}\">" . lang('buttons.last') . " &raquo</a>";
                                  
                          }
                          else
                          {
                                  $pagination .= "<li><a href=\"javascript:void(0)\" class=\"next disabled\">&raquo;</a></li>";
                                  //$pagination .= "<a class=\"last disabled\" href=\"javascript:void(0)\">" . lang('buttons.last') . " &raquo</a>";

                                  
                          }
                          $pagination.= "</ul>\n";
                  }
                  //echo $pagination;exit;
                  return $pagination;
          }
		  
		  public function ajaxpagination($total_items , $item_per_page , $current_page , $adjacents , $url = NULL) {
                  current_url();
                  if($url === NULL)
                  {
                          $url = current_url(); //base_url('seo-details');
                  }
                  // How many adjacent pages should be shown on each side?
                  // $adjacents = $adj;
                  $total_pages = $total_items;
                  $limit = $item_per_page; //how many items to show per page
                  $page = $current_page;              //Access the current page
                  /* Setup page vars for display. */
                  if($page == 0)
                          $page = 1;   //if no page var is given, default to 1.
                  $prev = $page - 1;     //previous page is page - 1
                  $next = $page + 1;     //next page is page + 1
                  $lastpage = ceil($total_pages / $limit); //lastpage is = total pages / items per page, rounded up.
                  $lpm1 = $lastpage - 1;    //last page minus 1

                  /*
                    Now we apply our rules and draw the pagination object.
                    We're actually saving the code to a variable in case we want to draw it more than once.
                   */
                  $pagination = "";
                  if($lastpage > 1)
                  {
                          $pagination .= "<ul class=\"pagination\">";
                          if($page > 1)
                          {
                                  //$pagination .= "<a class=\"first\" href=\"{$url}?page=1\"> &laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<li class=\"first\"><a  href=\"{$url}?page={$prev}\" aria-label=\"Previous\"><span aria-hidden=\"true\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i></span></a></li>";
                                 
                          }
                          else
                          {
                                  //$pagination .= "<a class=\"first disabled\" href=\"javascript:void(0)\">&laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<li class=\"first\"><a class=\"nex disabled\" href=\"javascript:void(0)\" aria-label=\"Previous\"><span aria-hidden=\"true\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i></span></a></li>";
                          }
                          
                          //pages
                          if($lastpage < 7 + ($adjacents * 2))
                          { //not enough pages to bother breaking it up
                                  for ($counter = 1; $counter <= $lastpage; $counter++)
                                  {
                                          if($counter == $page)
                                                  $pagination.= "<li class=\"active\"><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                          
                                          else
                                                  $pagination.= "<li><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                         
                                  }
                          }
                          elseif($lastpage > 5 + ($adjacents * 2))
                          { //enough pages to hide some
                                  //close to beginning; only hide later pages
                                  if($page <= 1 + ($adjacents * 2))
                                  {
                                          for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li class=\"active\" ><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                                 
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<li><a href=\"{$url}?page={$lpm1}\" >{$lpm1}</a></li>";
                                          
                                          $pagination.= "<li><a href=\"{$url}?page={$lastpage}\" >{$lastpage}</a></li>";
                                          
                                  }
                                  //in middle; hide some front and some back
                                  elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                  {
                                          $pagination.= "<li><a href=\"{$url}?page=1\" >1</a></li>";
                                          
                                          $pagination.= "<li><a href=\"{$url}?page=2\" >2</a></li>";
                                          
                                          $pagination.= "...";
                                          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li><a href=\"{$url}?page={$counter}\" class=\"active\">{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                                  
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<li><a href=\"{$url}?page={$lpm1}\" >{$lpm1}</a></li>";
                                         
                                          $pagination.= "<li><a href=\"{$url}?page={$lastpage}\" >{$lastpage}</a></li>";
                                          
                                  }
                                  //close to end; only hide early pages
                                  else
                                  {
                                          $pagination.= "<li><a href=\"{$url}?page=1\" >1</a></li>";
                                         
                                          $pagination.= "<li><a href=\"{$url}?page=2\" >2</a></li>";
                                          
                                          $pagination.= "...";
                                          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<li ><a href=\"{$url}?page={$counter}\" class=\"active\">{$counter}</a></li>";
                                                  
                                                  else
                                                          $pagination.= "<li><a href=\"{$url}?page={$counter}\" >{$counter}</a></li>";
                                                  
                                          }
                                  }
                          }

                          //next button
                          if($page < $counter - 1)
                          {
                                  $pagination .= "<li class=\"last\"><a href=\"{$url}?page={$next}\"  aria-label=\"Next\"><span aria-hidden=\"true\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></span></a></li>";
                                  //$pagination .= "<a class=\"last\" href=\"{$url}?page={$lastpage}\">" . lang('buttons.last') . " &raquo</a>";
                                  
                          }
                          else
                          {
                                  $pagination .= "<li class=\"last\"><a href=\"javascript:void(0)\" class=\"disabled\" aria-label=\"Next\"><span aria-hidden=\"true\"><i class=\"fa fa-angle-right\" aria-hidden=\"true\"></i></span></a></li>";
                                  //$pagination .= "<a class=\"last disabled\" href=\"javascript:void(0)\">" . lang('buttons.last') . " &raquo</a>";

                                  
                          }
                          $pagination.= "</ul>\n";
                  }
                  //echo $pagination;exit;
                  return $pagination;
          }

          public function all_paging($current_page , $total_page , $segments = null) {
                  $prev_page = $current_page - 1;
                  $next_page = $current_page + 1;

                  $page_name = $_SERVER['REQUEST_URI'];
                  $page_name = basename($page_name);

                  //$query_str=$_SERVER['QUERY_STRING'];


                  $page1 = explode("?" , $page_name);
                  if(count($page1) > 1 && $page1[1] != NULL)
                  {
                          //if($query_str!='')
                          $page2 = explode("&" , $page1[1]);
                          

                          $array = array();


                          foreach ($page2 as $v)
                          {
                                  $v = explode("=" , $v);
                                  if(count($v) > 1)
                                  {
                                          $array[$v[0]] = $v[1];
                                  }
                          }

                          $prev_array = $array; // for previous page
                          $next_array = $array; // for next page

                          $prev_array['page'] = $prev_page;
                          $next_array['page'] = $next_page;

                          $prev_page_display = "";
                          foreach ($prev_array as $v => $v1)
                          {
                                  $prev_page_display.=$v . "=" . $v1 . "&";
                          }
                          $prev_page_display = rtrim($prev_page_display , "&");


                          $next_page_display = "";
                          foreach ($next_array as $v => $v1)
                          {
                                  $next_page_display.=$v . "=" . $v1 . "&";
                          }
                          $next_page_display = rtrim($next_page_display , "&");

                          $prev_page_display = base_url() . $segments . $page1[0] . "?" . $prev_page_display;

                          $next_page_display = base_url() . $segments . $page1[0] . "?" . $next_page_display;


                          unset($array);
                          unset($prev_array);
                          unset($next_array);
                  }
                  else
                  {
                          $prev_page_display = base_url() . $segments . $page_name . "?page=" . $prev_page;

                          $next_page_display = base_url() . $segments . $page_name . "?page=" . $next_page;
                  }




                  if($prev_page > 0)
                  {
                          $prev_display = '<a href="' . $prev_page_display . '"><img src="' . base_url() . 'images/previous.png" alt="" height="15" width="15" border="0" /></a>';
                  }
                  else
                  {
                          $prev_display = '<img src="' . base_url() . 'images/previousD.png" alt="" height="15" width="15" border="0" />';
                  }

                  if($next_page <= $total_page)
                  {
                          $next_display = '<a href="' . $next_page_display . '"><img src="' . base_url() . 'images/next.png" alt="" height="15" width="15" border="0"/></a>';
                  }
                  else
                  {
                          $next_display = '<img src="' . base_url() . 'images/nextD.png" alt="" height="15" width="15" border="0"/>';
                  }


                 

                  $paging = '<div class="rgtarr_pagging">' .
                          $next_display . '
                        </div><div class="page_no"> of ' . $total_page . '</div>
                        <div class="txt_pagging"><input name="page" type="text" maxlength="4" class="txt_pageno" value="' . $current_page . '"/>
                      	</div>
                        <div class="rgtarr_pagging">' .
                          $prev_display . '
                        </div>
                        ';
                  return $paging;
          }


          function get_paging_limit($post_page) { // submit the filtering
                  
                  $page_name = $_SERVER['HTTP_REFERER'];


                  $page1 = explode("?" , $page_name);

                  if(count($page1) > 1 && $page1[1] != NULL)
                  {
                          $page2 = explode("&" , $page1[1]);


                          $array = array();


                          foreach ($page2 as $v)
                          {
                                  $v = explode("=" , $v);
                                  $array[$v[0]] = $v[1];
                          }

                         
                          $array['page'] = $post_page;

                          $page_display = "";
                          foreach ($array as $v => $v1)
                          {
                                  $page_display.=$v . "=" . $v1 . "&";
                          }
                          $page_display = rtrim($page_display , "&");
                          $page_display = $page1[0] . "?" . $page_display;

                          unset($array);
                  }
                  else
                  {
                          
                          $page_display = $page1[0] . "?page=" . $post_page;
                  }

                  
                  $full_path = $page_display;
                  return $full_path;
          }


          function display_paging_tot_number($total_number) {
                  $max_number = 10000;

                  if($total_number > $max_number)
                  {
                          $val = $max_number . "+";
                  }
                  else
                  {
                          $val = $total_number;
                  }

                  return $val;
          }


  }

?>