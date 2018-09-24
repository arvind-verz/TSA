<?php $this->load->view('include/header_tag'); ?>
<body>
<?php $this->load->view('include/popupmsg'); ?>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_event_banner'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li><a href="<?php echo base_url('svca-events'); ?>">SVCA EVENTS</a></li>
        <li class="active"><?php echo $page[0]['title'];?></li>
      </ol>
      <h3 class="t-header-cnt"><?php echo $page[0]['title'];?></h3>
      <div class="list-grid3 clearfix">
        <div class="list-grid3-img"> <img src="<?php echo base_url('assets/upload/svcaevent/detail/'.$page[0]['image_name']); ?>" alt=""> </div>
        <div class="list-grid3-info">
          <table>
          	<tr><td colspan="2" style="color:#F00; font-weight:bold;"><?php echo $this->session->flashdata('err_msg');?></td></tr>
            <tr>
              <td><label>Start Date:</label>
                <?php echo date("F d, Y", strtotime($page[0]['start_date']));?></td>
              <td><label>End Date:</label>
                <?php echo date("F d, Y", strtotime($page[0]['end_date']));?></td>
            </tr>
            <tr>
              <td><label>Time: </label>
                <?php echo $page[0]['event_time'];?></td>
              <td><label>Venue: </label>
                <?php echo $page[0]['venue'];?></td>
            </tr>
          </table>
          <div class="group-link-list group-link-list-new group-list-grid3 ">
            <div class="clearfix">
              <?php $today = date('Y-m-d');?>
              <?php if($page[0]['registration_date']>=$today){?>
			  <?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'member_id']) && $this->session->userdata[USER_LOGIN_PREFIX.'member_id']!='')	{?>
              <a href="<?php echo base_url('resgister/'.$page[0]['seo_url']);?>">REGISTER NOW</a>
              <?php }else{?>
              <a href="#" data-toggle="modal" data-target="#<?php echo($page[0]['for_member']=='Y')?"myLogin-member":"myLogin2";?>" id="details">REGISTER NOW</a>
              <?php } ?>
              <a href="#" data-toggle="modal" data-target="#myPrice" class="link-right">VIEW PRICE</a>
              <?php }else{ ?>
              <span>You have missed the last date of Event registration.</span>
              <?php } ?>
               </div>
            <?php if($page[0]['for_member']=='Y'){?>
            <span class="for-member">Members Only</span>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="list-grid5 clearfix"> <a href="#" class="btn-nav">Navigation</a>
        <div class="mb-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab1" aria-controls="DESCRIPTION" role="tab" data-toggle="tab">DESCRIPTION</a></li>
            <?php if(isset($page[0]['programme']) && !empty($page[0]['programme'])){?>
            <li role="presentation"><a href="#tab2" aria-controls="PROGRAMME" role="tab" data-toggle="tab">GALLERY</a></li>
            <?php }?>
             <?php if(isset($page[0]['contact']) && !empty($page[0]['contact'])){?>
            <li role="presentation"><a href="#tab3" aria-controls="CONTACT" role="tab" data-toggle="tab">CONTACT</a></li>
            <?php }?>
            <?php if(count($pdf)>0){?>
            <li role="presentation"><a href="#tab4" aria-controls="MORE INFO" role="tab" data-toggle="tab">MORE INFO</a></li>
            <?php }?>
          </ul>
        </div>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="tab1">
            <div class="document"> <?php echo $page[0]['description'];?> </div>
          </div>
          <?php if(isset($page[0]['programme']) && !empty($page[0]['programme'])){?>
          <div role="tabpanel" class="tab-pane" id="tab2">
            <div class="document"> <?php echo $page[0]['programme'];?> </div>
          </div>
          <?php }?>
          <?php if(isset($page[0]['contact']) && !empty($page[0]['contact'])){?>
          <div role="tabpanel" class="tab-pane" id="tab3">
            <div class="document"> <?php echo $page[0]['contact'];?> </div>
          </div>
          <?php }?>
          <div role="tabpanel" class="tab-pane" id="tab4">
            <div class="document">
              <ul>
                <?php if(count($pdf)>0){
                                                foreach($pdf as $val)	
                                                {	
                                                ?>
                <li> <a href="<?php echo base_url('assets/upload/svcaevent/pdf/'.$val['pdf_name']); ?>" target="_blank" download><?php echo $val['title'];?></a></li>
                <?php }}?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="link-list-grid5 clearfix"> <a href="<?php echo base_url('svca-events'); ?>">VIEW OTHER EVENTS</a>
      
        <?php if($page[0]['registration_date']>=$today){?>
        
        <?php if(isset($this->session->userdata[USER_LOGIN_PREFIX.'member_id']) && $this->session->userdata[USER_LOGIN_PREFIX.'member_id']!='')	{?>
        <a href="<?php echo base_url('resgister/'.$page[0]['seo_url']);?>" class="link-right">REGISTER NOW</a>
        <?php }else{?>
        <a href="#" data-toggle="modal" data-target="#<?php echo($page[0]['for_member']=='Y')?"myLogin-member":"myLogin2";?>"  class="link-right">REGISTER NOW</a>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<!-- //page -->

<?php $this->load->view('include/footer'); ?>

<!-- Modal -->
<div class="modal" id="myLogin2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center loginfrom">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
          <h4 class="modal-title" id="myModalLabel">SVCA Member Login</h4>
        </div>
        <div class="modal-body">
          <?php if($this->session->flashdata('error_msg5')): ?>
          <div class="notification msgerror" > <a class="close"></a> <?php echo $this->session->flashdata('error_msg5'); ?> </div>
          <?php endif; ?>
          <form name="login" id="login" method="post" action="<?php echo base_url('login'); ?>">
            <input type="hidden" name="mode" value="detail">
            <input type="hidden" name="seo_url" value="<?=$page[0]['seo_url']?>">
            <input type="hidden" name="formid" value="<?=$page[0]['id']?>">
            <div class="item-login">
              <label class="lb2">SVCA Member ID <span class="sys">*</span>:</label>
              <div class="ipt-login">
                <input type="text" name="username" class='form-control' required>
              </div>
            </div>
            <div class="item-login"><!--text-right--> 
              <a class="btn-login" href="<?php echo base_url('resgister/'.$page[0]['seo_url']);?>">CONTINUE AS NON-MEMBER</a> 
              <!-- <a class="btn-login" href="member-profile.html">LOGIN</a>-->
              <button class="btn-login link-right" type="submit">LOGIN</button>
            </div>
          </form>
          <p style="color: red; margin-bottom: 0;font-style:italic;">Forgot your Member ID? Please contact your company representative or email info@svca.org.sg with your company email.</p> 
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="myLogin-member" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center loginfrom">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
          <h4 class="modal-title" id="myModalLabel">SVCA Member Login</h4>
        </div>
        <div class="modal-body">
          <form name="login" id="login" method="post" action="<?php echo base_url('login'); ?>">
            <input type="hidden" name="mode" value="detail">
            <input type="hidden" name="seo_url" value="<?=$page[0]['seo_url']?>">
            <input type="hidden" name="formid" value="<?=$page[0]['id']?>">
            <?php if($this->session->flashdata('error_msg5')): ?>
            <div class="notification msgerror" > <a class="close"></a> <?php echo $this->session->flashdata('error_msg5'); ?> </div>
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

<!-- Modal -->
<div class="modal" id="myPrice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <td><?php echo $page[0]['fee_ist_registrant_full'] ?></td>
                <td><?php echo $page[0]['fee_ist_registrant_associate'] ?></td>
                <td><?php echo $page[0]['fee_ist_registrant_individual'] ?></td>
                <td><?php echo $page[0]['fee_ist_registrant_partner'] ?></td>
                <td><?php echo $page[0]['fee_ist_registrant_visitor'] ?></td>
              </tr>
              <tr>
                <td>Subsequent Registrant S$</td>
                <td><?php echo $page[0]['fee_subsequent_registrant_full'] ?></td>
                <td><?php echo $page[0]['fee_subsequent_registrant_associate'] ?></td>
                <td><?php echo $page[0]['fee_subsequent_registrant_individual'] ?></td>
                <td><?php echo $page[0]['fee_subsequent_registrant_partner'] ?></td>
                <td><?php echo $page[0]['fee_subsequent_registrant_visitor'] ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>