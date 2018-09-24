<header class="header">
            	<div class="container">
                	<div class="logo">
                    	<a href="<?php echo base_url('/'); ?>"><img src="<?php echo base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('logo'));?>" alt=""/></a>
                    </div>
                    <div class="nav-top">
                    	<ul class="link-top">
                        	<li class="<?php echo ($url=='contact-us')?'active':'';?>"><a href="<?php echo base_url('contact-us'); ?>">CONTACT US</a></li>
                            <li class="<?php echo ($url=='faq')?'active':'';?>"><a href="<?php echo base_url('faq'); ?>" >FAQ</a></li>
                        </ul>
                        <div class="search-top">
                        	<form name="search" id="search" method="get" action="<?php echo base_url('search'); ?>">
                        	<input type="text" class="form-control"  placeholder="Search" name="key" required="required"/>
                            <button class="btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <div class="link-member">
                  <?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'member_id']) && $this->session->userdata[USER_LOGIN_PREFIX.'member_id']!='')	{?>
                        	<a href="<?php echo base_url('dashboard');?>">My Particulars</a>
                  <?php }else{?>
                        	<a href="#" data-toggle="modal" data-target="#myLogin" id="login">SVCA Member login</a>
                   <?php } ?>         
                        </div>
                    </div>
                </div>
                <div class="mainmenu">
                	<div class="container">
                    	<div class="share-top">
                        	<span>Connect with us:</span>
                            <a href="<?php echo $this->all_function->get_site_options('facebook_link')?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true">facebook</i></a>
                            <a href="<?php echo $this->all_function->get_site_options('linkedin_link')?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true">linkedin</i></a>
                            <a href="<?php echo $this->all_function->get_site_options('twitter_link')?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true">twitter</i></a>
                        </div>
                    	<!--<div  id="cssmenu">
                        	 <ul class="menu clearfix">
                             	<li class="active"><a href="index.html">HOME </a></li>               
                                <li><a href="aboutus-1.html">ABOUT US</a>
                                	<ul>
                                    	<li><a href="aboutus-1.html">History</a></li>
                                        <li><a href="aboutus.html">Committees</a></li>
                                        <li><a href="aboutus-4.html">Sub Committees </a></li>
                                        <li><a href="aboutus-5.html">Secretariat</a></li>
                                    </ul>
                                </li>            
                                <li><a href="whyjoinus.html">WHY JOIN US</a>
                                	<ul>
                                    	<li><a href="whyjoinus.html">Membership Types</a></li>
                                        <li><a href="whyjoinus-2.html">Benefits</a></li>
                                        <li><a href="whyjoinus-3.html">Members</a></li>
                                    </ul>
                                </li>              
                                <li><a href="events.html">EVENTS</a>
                                	<ul>
                                    	<li><a href="events.html">SVCA Events</a></li>
                                        <li><a href="other-events.html">Other Events</a></li>
                                    </ul>
                                </li>             
                                <li><a href="newsletter.html"> NEWS</a>
                               		<ul>
                                    	 <li><a href="newsletter.html">Newsletter</a></li>
                                		 <li><a href="latest-news.html">Latest News</a></li>
                                    </ul>
                                </li>              
                                <li><a href="resources.html">RESOURCES</a>
                                	<ul>
                                    	 <li><a href="resources.html">Directory</a> 
                                         	<ul>
                                            	<li><a href="resources.html">Singapore Venture Capital and Private Equity Directory 2016</a></li>
                                            </ul>
                                         </li>
                                         <li><a href="resources-toolkit.html">Toolkit</a></li>
                                          <li><a href="resources-publications.html">Publications</a>
                                         	<ul>
                                            	<li><a href="resources-publications-1.html">FORTUNE Magazine</a></li>
                                                <li><a href="resources-publications-2.html">Venture Capital Fund Management – A Comprehensive Approach to Investment Practices and the Entire Operations of a VC Firm</a></li>
                                                <li><a href="resources-publications-3.html">Entrepreneurial Finance: Start-up To IPO</a></li>
                                                <li><a href="resources-publications-4.html">IPEV Reporting Guidelines</a></li>
                                                <li><a href="resources-publications-5.html">Transaction Trail</a></li>
                                            </ul>
                                         
                                         </li>
                                         <li><a href="resources-ournetwork.html">Our Network</a></li>                                        	
                                   
                                    </ul>
                                </li>
                             </ul>
                        </div>-->
                    	<?php $this->load->view('include/menu'); ?>
                    </div>
                </div>
     </header>