<?php $this->load->view('include/header_tag'); ?>
    
    <body>
    
        <div class="childpage">        	
        	<?php $this->load->view('include/header'); ?>
            <?php $this->load->view('include/top_banner'); ?>
           
            <div class="mainchild">
               	
               
                		 <div class="container maincontent">
                         
                            <div class="row">
                                <!--<div class="col-md-3">
                                	<div class="t-header-3">
                                    	RESOURCES
                                    </div>
                                    
                                    	 <ul class="menuchild" id='menuchild'>
                                    	 <li class="has-sub"><a href="resources-publications.html">Directory <span class="icon-menu"></span></a>
                                         	<ul>
                                            	<li><a href="resources.html">Singapore Venture Capital And Private Equity Directory 2016<span class="icon-menu"></span></a></li>
                                            </ul>
                                         </li>
                                         
                                         <li><a href="resources-toolkit.html">Toolkit<span class="icon-menu"></span></a></li>
                                         <li class="has-sub active"><a href="resources-publications.html">Publications<span class="icon-menu"></span></a>
                                         	<ul>
                                            	<li><a href="resources-publications-1.html">FORTUNE Magazine</a></li>
                                                <li><a href="resources-publications-2.html">Venture Capital Fund Management – A Comprehensive Approach to Investment Practices and the Entire Operations of a VC Firm</a></li>
                                                <li><a href="resources-publications-3.html">Entrepreneurial Finance: Start-up To IPO</a></li>
                                                <li><a href="resources-publications-4.html">IPEV Reporting Guidelines</a></li>
                                                <li><a href="resources-publications-5.html">Transaction Trail</a></li>
                                            </ul>
                                         
                                         </li>
                                         <li><a href="resources-ournetwork.html">Our Network<span class="icon-menu"></span></a></li>                                        	
                                    </ul>
                                   
                                   
                                </div>-->
                                <div class="col-md-12 rightpage1">
                                	<ol class="breadcrumb">
                                          <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                                          <li class="active">Search Result</li>
                                         
                                    </ol>
                                    <h3 class="t-header-cnt">
                                    	Search Result : <?php echo $key;?>
                                    </h3>
                                    
                                     <div class="list-news ">
                                       <?php 
										if(count($event_pages)>0){
											foreach ($event_pages as $key => $val){ ?>
                                            
                                            <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/svcaevent/listing/'.$val['image_name']); ?>" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="t-header-6"><?php echo $val['title'];?></a>
                                                <p><?php 	echo substr(strip_tags($val['description']),0,200).'...'; ?></p>
                                                <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                            
                                            
                                            
                                     <?php }}else{ ?>
                                          <h2>No Record Found</h2>
                                     <?php } ?>
                                     <!--
                                     	 <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="resources-publications-1.html"><img src="img/tempt/img23.jpg" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="resources-publications-1.html" class="t-header-6">FORTUNE Magazine</a>
                                                <p>FORTUNE keeps you abreast of the insightful, in-depth analysis on today’s key business issues and events. With unparalleled access to the most influential business leaders of our time,<br/> FORTUNE shares with you the successes of top corporations in Asia and around the world.<br/>
FORTUNE All Access at 20 issues + 4 free (24 issues in all) at S$144 in total.<br/>
For FORTUNE Subscription, visit: <a href="https://www.timeasiasubs.com/SVCAF16" target="_blank">https://www.timeasiasubs.com/SVCAF16</a></p>
                                                <a href="resources-publications-1.html" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                        <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="resources-publications-2.html"><img src="img/tempt/img24.jpg" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="resources-publications-2.html" class="t-header-6">Venture Capital Fund Management – A Comprehensive Approach to Investment Practices and the Entire Operations of a VC Firm</a>
                                                <p>Arguably the most comprehensive coverage of the entire professional practice of a VC firm, this 496-page reference book is published by Aspatore Books, Boston, USA. In addition to offering in-depth explanations of concepts, practical advice on methodologies, and suggestions of best practices, it provides readers with crucial information surrounding issues that commonly affect venture capital firms...</p>
                                                <a href="resources-publications-2.html" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                         <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="resources-publications-3.html"><img src="img/tempt/img25.jpg" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="resources-publications-3.html" class="t-header-6">Entrepreneurial Finance: Start-up To IPO</a>
                                                <p>Written by Mr. Eugene Wong, a venture capitalist and business consultant who has been investing in business ventures and helping entrepreneurs grow their business for many years, this book seeks to answer many questions that entrepreneurs face:</p>
                                                <a href="resources-publications-3.html" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                         <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="resources-publications-4.html"><img src="img/tempt/img26.jpg" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="resources-publications-4.html" class="t-header-6">IPEV Reporting Guidelines</a>
                                                <p><a href="pdf/IPEV-Valuation-Guidelines_Ed_December-2012.pdf" target="_blank">Click here to download</a> Dec 2012 Edition<br>
                                      <a href="pdf/121025_IPEV_IRG-Reporting-Guidelines1.pdf" target="_blank">Click here to download</a> Oct 2012 Edition</p>
                                                <a href="resources-publications-4.html" class="v-all">READ MORE</a>
                                            </div>
                                        </div>
                                         <div class="item-news">
                                            <div class="img-news other-news">
                                                <a href="resources-publications-5.html"><img src="img/tempt/img27.jpg" alt=""></a>
                                            </div>
                                            <div class="info-news">
                                                <a href="resources-publications-5.html" class="t-header-6">Transaction Trail</a>
                                                <p><a href="http://bit.ly/2a48osV" target="_blank">Click here to download</a> Half Yearly report, 2016<br/>
                                        <a href="pdf/transaction-trail-annual-issue-2015-final.pdf" target="_blank">Click here to download</a> Annual Issue 2015<br/>
                                        <a href="http://www.american-appraisal.sg/SG/AmericanAppraisal/News/Transaction-Trail.htm" target="_blank">Click here to download&nbsp;</a> Annual Issue, 2014<br/>
                                        
<a href="http://www.american-appraisal.sg/SG/AmericanAppraisal/News/Transaction-Trail.htm" target="_blank">Click here to download</a>  Annual Issue, 2013   <br/>             
<a href="pdf/AmericanAppraisalTransactionTr4.pdf" target="_blank">Click here to download</a>  3rd Quarter Issue, 2013 <br/>
<a href="pdf/AmericanAppraisalTransactionTr3.pdf" target="_blank">Click here to download</a>  Half Yearly Issue, 2013 
                                        </p>
                                                <a href="resources-publications-5.html" class="v-all">READ MORE</a>
                                            </div>
                                        </div>-->
                                     </div>
                                  
                                   
                                    
                                  
                                    
                                </div>
                               
                            </div>
                    </div>
                
               
            </div>
            
        </div><!-- //page -->
       <?php $this->load->view('include/footer'); ?>
      
        <?php echo js('jquery.min'); ?>
        <?php echo js('plugin'); ?>
        <?php echo js('main'); ?>
        
    </body>
</html>