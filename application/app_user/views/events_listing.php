<?php $this->load->view('include/header_tag'); ?>
<body>
<?php $this->load->view('include/popupmsg'); ?>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a >EVENTS</a></li>
        <li class="active"> SVCA EVENTS</li>
      </ol>
      <h3 class="t-header-cnt">SVCA EVENTS</h3>
      <div class="list-search">
        <form id="frm_display" method="post" action="<?php echo base_url('svca-events'); ?>" >
          <div class="t-header-4"> Search for Specific SVCA Events: </div>
          <div class="group-list">
            <div class="list-search-item-1">
              <label class="lb-1">Event Title:</label>
              <div class="list-search-ipt">
                <input  type="text" class="form-control"  name="FlterData[title]" value="<?php echo $FlterData['title'];?>"/>
              </div>
            </div>
            <div class="list-search-item-2">
              <label class="lb-1">Venue:</label>
              <div class="list-search-ipt">
                <input  type="text" class="form-control" name="FlterData[venue]" value="<?php echo $FlterData['venue'];?>"/>
              </div>
            </div>
          </div>
          <div class="group-list">
            <div class="list-search-item-1">
              <label class="lb-1">Date From:</label>
              <div class="list-search-ipt">
                <div class="form-group">
                  <div class='input-group date' >
                    <input type='text' class="form-control" id='datetimepicker1' name="FlterData[start_date]" value="<?php echo $FlterData['start_date'];?>" />
                    <span class="input-group-addon"> <i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
              </div>
            </div>
            <div class="list-search-item-4">
              <label class="lb-1"><b>To:</b></label>
              <div class="list-search-ipt">
                <div class="form-group">
                  <div class='input-group date'>
                    <input type='text' class="form-control"  id='datetimepicker2' name="FlterData[end_date]" value="<?php echo $FlterData['end_date'];?>" />
                    <span class="input-group-addon"> <i class="fa fa-calendar" aria-hidden="true"></i> </span> </div>
                </div>
              </div>
            </div>
            <div class="list-search-item-5">
              <button class="btn-sb" name="OkFilter" type="submit">FILTER</button>
            </div>
          </div>
        </form>
      </div>
      <div class="paging">
        <nav aria-label="Page navigation"> <?php echo $pagi;?> </nav>
      </div>
      <div class="list-grid2">
        <?php
                            if(count($svca)>0)
							{
								foreach($svca as $val)
								{ 
							?>
        <div class="list-grid2-item">
          <div class="list-grid2-img"> <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>"><img src="<?php echo base_url('assets/upload/svcaevent/listing/'.$val['image_name']); ?>" alt=""></a> </div>
          <div class="list-grid2-info">
            <?php if($val['for_member']=='Y'){?>
            <span class="for-member">Members Only</span>
            <?php } ?>
            <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>"><?php echo $val['title'];?></a>
            <table>
              <tr>
                <td><label>Date:</label>
                  <?php echo date("F d, Y", strtotime($val['start_date']));?></td>
                <td><!--<label>End Date:</label>
                  <?php echo date("F d, Y", strtotime($val['end_date']));?>--><label>Time: </label>
                  <?php echo $val['event_time'];?></td>
              </tr>
              <tr>
                <td><label>Venue: </label>
                  <?php echo $val['venue'];?></td>
                <td></td>
              </tr>
            </table>
            <div class="group-link-list clearfix"> 
              <!--<a href="#" data-toggle="modal" data-target="#myLogin-member">REGISTER NOW</a>-->
              <?php $today = date('Y-m-d');?>
              <?php if($val['registration_date']>=$today){?>
			  <?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'member_id']) && $this->session->userdata[USER_LOGIN_PREFIX.'member_id']!='')	{?>
              <a href="<?php echo base_url('register/'.$val['seo_url']);?>">REGISTER NOW</a>
              <?php }else{?>
              <a href="#" data-toggle="modal" data-target="#<?php echo($val['for_member']=='Y')?"myLogin-member{$val['id']}":"myLogin{$val['id']}";?>" id="listing<?=$val['id']?>">REGISTER NOW</a>
              <?php } ?>
              <a href="<?php echo base_url('event-details/'.$val['seo_url']); ?>">VIEW DETAILS</a> <a href="#" data-toggle="modal" data-target="#myPrice<?=$val['id']?>" class="link-right">VIEW PRICE</a>
              <?php }else{ ?>
              <span class="RegistrationOver">You have missed the last date of Event registration.</span>
              <?php } ?>
               </div>
          </div>
        </div>
        <div class="group-link-list-new"></div>
        <!--=========================================-->
        <div class="modal" id="myPrice<?=$val['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog myPrice-frm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Pricing Details</h4>
              </div>
              <div class="modal-body">
                <div class="tbl-scl">
                  <table class="tbl-modal">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Full Corporate / <br/>
                          LP Member</th>
                        <th>Associate <br/>
                          Corporate</th>
                        <th>Associate <br/>
                          Individual</th>
                        <th>Partner</th>
                        <th>Non-Member</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Fee (1st Registrant) S$</td>
                        <td><?php echo $val['fee_ist_registrant_full'];?></td>
                        <td><?php echo $val['fee_ist_registrant_associate'];?></td>
                        <td><?php echo $val['fee_ist_registrant_individual'];?></td>
                        <td><?php echo $val['fee_ist_registrant_partner'];?></td>
                        <td><?php echo $val['fee_ist_registrant_visitor'];?></td>
                      </tr>
                      <tr>
                        <td>Subsequent Registrant S$</td>
                        <td><?php echo $val['fee_subsequent_registrant_full'];?></td>
                        <td><?php echo $val['fee_subsequent_registrant_associate'];?></td>
                        <td><?php echo $val['fee_subsequent_registrant_individual'];?></td>
                        <td><?php echo $val['fee_subsequent_registrant_partner'];?></td>
                        <td><?php echo $val['fee_subsequent_registrant_visitor'];?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- ========================================--> 
        
        <!-- Modal -->
        <div class="modal" id="myLogin<?=$val['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center loginfrom">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
                  <h4 class="modal-title" id="myModalLabel">SVCA Member Login</h4>
                </div>
                <div class="modal-body">
                  <?php if($this->session->flashdata('error_msg4')): ?>
                  <div class="notification msgerror" > <a class="close"></a> <?php echo $this->session->flashdata('error_msg4'); ?> </div>
                  <?php endif; ?>
                  <form name="login" id="login" method="post" action="<?php echo base_url('login'); ?>">
                    <input type="hidden" name="mode" value="listing2">
                    <input type="hidden" name="formid" value="<?=$val['id']?>">
                    <div class="item-login">
                      <label class="lb2">SVCA Member ID <span class="sys">*</span>:</label>
                      <div class="ipt-login">
                        <input type="text" name="username" class='form-control' required>
                      </div>
                    </div>
                    <div class="item-login"> <a class="btn-login" href="<?php echo base_url('register/'.$val['seo_url']);?>">CONTINUE AS NON-MEMBER</a> 
                      <!--<a class="btn-login link-right" href="member-profile.html">LOGIN</a>-->
                      <button class="btn-login link-right" type="submit">LOGIN</button>
                    </div>
                  </form>
                  <p style="color: red; margin-bottom: 0; font-style:italic;  word-wrap:break-word; ">Forgot your Member ID? Please contact your company representative or email info@svca.org.sg with your company email.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        
        <div class="modal" id="myLogin-member<?=$val['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center loginfrom">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
                  <h4 class="modal-title" id="myModalLabel">SVCA Member Login</h4>
                </div>
                <div class="modal-body">
                  <form name="login" id="login" method="post" action="<?php echo base_url('login'); ?>">
                    <input type="hidden" name="mode" value="listing">
                    <input type="hidden" name="formid" value="<?=$val['id']?>">
                    <?php if($this->session->flashdata('error_msg3')): ?>
                    <div class="notification msgerror" > <a class="close"></a> <?php echo $this->session->flashdata('error_msg3'); ?> </div>
                    <?php endif; ?>
                    <div class="item-login">
                      <label class="lb2">SVCA Member ID <span class="sys">*</span>:</label>
                      <div class="ipt-login">
                        <input type="text" name="username" class='form-control' required>
                      </div>
                    </div>
                    <div class="item-login text-right"> 
                      <!--<a class="btn-login" href="member-profile.html">LOGIN</a>-->
                      <button class="btn-login" type="submit">LOGIN</button>
                    </div>
                  </form>
                  <p style="color: red; margin-bottom: 0;">Forgot your Member ID? Please contact your company representative or email info@svca.org.sg with your company email.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }} ?>
      </div>
      <div class="paging paging-bottom">
        <nav aria-label="Page navigation"> <?php echo $pagi;?> </nav>
      </div>
    </div>
  </div>
</div>
<!-- //page -->
<?php $this->load->view('include/footer'); ?>

<!-- <div class="modal" id="myPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
       
          <div class="modal-dialog myPrice-frm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
                <h4 class="modal-title" id="myModalLabel">Pricing Details</h4>
              </div>
              <div class="modal-body">
                    <div class="tbl-scl">
                    	<table class="tbl-modal">
                        <thead>
                             <tr>
                                <th></th>
                                <th>Full Corporate / <br/>LP Member</th>
                                <th>Associate <br/>Corporate</th>
                                <th>Associate <br/> Individual</th>
                                <th>Partner</th>
                                <th>Non-Member</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <tr>
                                <td>Fee (1st Registrant) S$</td>
                                <td>0</td>
                                <td>50</td>
                                <td>50</td>
                                <td>50</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Subsequent Registrant S$</td>
                                <td>0</td>
                                <td>50</td>
                                <td>50</td>
                                <td>50</td>
                                <td>100</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
              </div>
           
          </div>
        </div>
        </div>--> 
<!-- Modal --> 

<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>