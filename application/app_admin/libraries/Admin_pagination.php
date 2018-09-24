<?php


  if(!defined('BASEPATH'))
          exit('No direct script access allowed');

  class Admin_pagination {


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
                          $pagination .= "<div class=\"pagination pgright\">";
                          if($page > 1)
                          {
                                  $pagination .= "<a class=\"first\" href=\"{$url}?page=1\"> &laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<a class=\"prev\" href=\"{$url}?page={$prev}\">&lt; " . lang('buttons.previous') . "</a>";
                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"enable\" onclick=\"load_result_list('".$prev."','".$type."','".$search_txt."')\">&laquo; previous</span>";
                          }
                          else
                          {
                                  $pagination .= "<a class=\"first disabled\" href=\"javascript:void(0)\">&laquo " . lang('buttons.first') . "</a>";
                                  $pagination .="<a class=\"prev disabled\" href=\"javascript:void(0)\">&lt; " . lang('buttons.previous') . "</a>";
                          }
                          //$pagination.= "<span style=\"cursor:pointer\" class=\"disabled\">&laquo; previous</span>";
                          //pages
                          if($lastpage < 7 + ($adjacents * 2))
                          { //not enough pages to bother breaking it up
                                  for ($counter = 1; $counter <= $lastpage; $counter++)
                                  {
                                          if($counter == $page)
                                                  $pagination.= "<a href=\"{$url}?page={$counter}\" class=\"current\" >{$counter}</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" class=\"current\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                          else
                                                  $pagination.= "<a href=\"{$url}?page={$counter}\" >{$counter}</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
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
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" class=\"current\" >{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"current\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                                  else
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" >{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<a href=\"{$url}?page={$lpm1}\" >{$lpm1}</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $lpm1 . "','" . $type . "','" . $search_txt . "')\">$lpm1</span>";
                                          $pagination.= "<a href=\"{$url}?page={$lastpage}\" >{$lastpage}</a>";
                                          //$pagination.= "<span onclick=\"load_result_list('" . $lastpage . "','" . $type . "','" . $search_txt . "')\">$lastpage</span>";
                                  }
                                  //in middle; hide some front and some back
                                  elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                  {
                                          $pagination.= "<a href=\"{$url}?page=1\" >1</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('1" . "\',\'" . $type . "\')'>1</span>";
                                          $pagination.= "<a href=\"{$url}?page=2\" >2</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('2" . "','" . $type . "','" . $search_txt . "')\">2</span>";
                                          $pagination.= "...";
                                          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" class=\"current\">{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"current\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                                  else
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" >{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                          }
                                          $pagination.= "...";
                                          $pagination.= "<a href=\"{$url}?page={$lpm1}\" >{$lpm1}</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $lpm1 . "','" . $type . "','" . $search_txt . "')\">$lpm1</span>";
                                          $pagination.= "<a href=\"{$url}?page={$lastpage}\" >{$lastpage}</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $lastpage . "','" . $type . "','" . $search_txt . "')\">$lastpage</span>";
                                  }
                                  //close to end; only hide early pages
                                  else
                                  {
                                          $pagination.= "<a href=\"{$url}?page=1\" >1</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('1" . "','" . $type . "','" . $search_txt . "')\">1</span>";
                                          $pagination.= "<a href=\"{$url}?page=2\" >2</a>";
                                          //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('2" . "','" . $type . "','" . $search_txt . "')\">2</span>";
                                          $pagination.= "...";
                                          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                          {
                                                  if($counter == $page)
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" class=\"current\">{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"current\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                                  else
                                                          $pagination.= "<a href=\"{$url}?page={$counter}\" >{$counter}</a>";
                                                  //$pagination.= "<span style=\"cursor:pointer\" onclick=\"load_result_list('" . $counter . "','" . $type . "','" . $search_txt . "')\">$counter</span>";
                                          }
                                  }
                          }

                          //next button
                          if($page < $counter - 1)
                          {
                                  $pagination .= "<a href=\"{$url}?page={$next}\" class=\"next\">" . lang('buttons.next') . " &gt;</a>";
                                  $pagination .= "<a class=\"last\" href=\"{$url}?page={$lastpage}\">" . lang('buttons.last') . " &raquo</a>";
                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"enable\" onclick=\"load_result_list('" . $next . "','" . $type . "','" . $search_txt . "')\">next &raquo;</span>";
                          }
                          else
                          {
                                  $pagination .= "<a href=\"javascript:void(0)\" class=\"next disabled\">" . lang('buttons.next') . " &gt;</a>";
                                  $pagination .= "<a class=\"last disabled\" href=\"javascript:void(0)\">" . lang('buttons.last') . " &raquo</a>";

                                  //$pagination.= "<span style=\"cursor:pointer\" class=\"disabled\">next &raquo;</span>";
                          }
                          $pagination.= "</div>\n";
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
                          //$page2=explode("&",$query_str[1]);
                          //print_r($page2);

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


                  /*
                    $paging=$prev_display.'<input name="page" type="text" maxlength="4" value="'.$current_page.'" class="pin" />
                    av '.$total_page.' '.$next_display;

                   */

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
                  //$page_name=$_SERVER['REQUEST_URI'];
                  //$page_name=basename($page_name);
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

                          //$array['limit']=$limit;
                          //$array['sort']=$sort;
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
                          //$page_display=$page_name."?limit=".$limit."&sort=".$sort."&page=".$post_page;
                          $page_display = $page1[0] . "?page=" . $post_page;
                  }

                  //$full_path=base_url().$page_display;
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