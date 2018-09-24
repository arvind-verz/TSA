<footer class="footer">
        	<div class="warp-footer">
            	<div class="container">
                	<div class="footer-1">
                    	<h4>Quick Links</h4>
                        <?php $FooterMenu = $this->All_function_model->get_menu_pid_Mposition(0,'footerBottom');
      							 if(count($FooterMenu)>0){         
                            ?>
                        <ul>
                        	<!--<li class="active"><a href="index.html">Home</a></li>
                            <li><a href="whyjoinus.html">Membership Types</a></li>
                            <li><a href="events.html">Upcoming Events</a></li>-->
                            <?php foreach ($FooterMenu as $key => $val){ 
  								$selectMenu = $this->All_function_model->get_selected_menu_id($menu_id, $val['id'],'footerBottom'); ?>
                            	
                            <li <?php if($selectMenu=='Y'){echo 'class="active"';}elseif($url==$val['url_name']){echo 'class="active"';}?>>
                            <?php if($val['link_type']=='external'){?>
                            <a href="<?php echo $val['external_url'];?>" <?php if($selectMenu=='Y'){echo 'class="Select"';}elseif($url==$val['url_name']){echo 'class="Select"';}?> <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>>
                            <?php echo $val['menu_title'];?></a>
                            <?php }elseif($val['link_type']=='internal'){?>
                            <a href="<?php echo base_url($val['url_name']);?>" class="<?php if($selectMenu=='Y'){echo 'active';}elseif($url==$val['url_name']){echo 'active';}?>" <?php if($val['link_target']=='new_tab'){echo 'target="_blank"';}?>>
                            <?php echo $val['menu_title'];?></a>
                            <?php }?>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                    <div class="footer-2">
                    	<h4>Contact Information</h4>
                        <table>
                        	<tr>
                            	<td>
                                	<p><i class="fa fa-map-marker" aria-hidden="true">phone</i> <?php echo $this->all_function->get_site_options('site_address1')?><br/> <?php echo $this->all_function->get_site_options('site_address2')?> <br/> <?php echo $this->all_function->get_site_options('site_address3')?></p>
                                </td>
                                <td>
                                	<p><i class="fa fa-phone" aria-hidden="true">phone</i> <?php echo $this->all_function->get_site_options('cantact_no')?></p>
                                    <p><i class="fa fa-fax" aria-hidden="true">phone</i> <?php echo $this->all_function->get_site_options('cantact_fax')?></p>
                                    <p><i class="fa fa-envelope-o" aria-hidden="true">phone</i> <a href="mailto:<?php echo $this->all_function->get_site_options('contact_email')?>"><?php echo $this->all_function->get_site_options('contact_email')?></a></p>
                                     
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="footer-3">
                    	<img src="<?php echo base_url('assets/upload/logo/original/'.$this->all_function->get_site_options('footer_logo'));?>" alt=""/> 
                    </div>
                </div>
            </div>
            <div class="copyright">
            	<div class="container">
                	Copyright © <?php echo date('Y');?> <?php echo $this->all_function->get_site_options('site_name');?>. <span>All rights reserved. Web Excellence by <strong>Verz</strong> <img src="<?php echo image('logoverzdesign.png');?>" alt="logoverzdesign"/></span>
                </div>
            </div>
</footer>
<!--==============================-->
        <div class="fixed-bottom">
        	<div class="zompin"><?php echo $this->all_function->get_site_options('zopim');?></div>
            <a  href="#" class="scroll-up" style="margin-bottom:31px;"></a>
        </div>
        
         <!-- Modal -->
        <div class="modal" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
         <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center loginfrom">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></button>
                    <h4 class="modal-title" id="myModalLabel">SVCA Member Login</h4>
                  </div>
                  <div class="modal-body">
                  <?php if($this->session->flashdata('error_msg2')): ?>
                    <div class="notification msgerror" > <a class="close"></a>
                    <?php echo $this->session->flashdata('error_msg2'); ?>
                    </div>
                    <?php endif; ?>
                    <form name="login" id="login" method="post" action="<?php echo base_url('login'); ?>">
                        <div class="item-login"> 
                            <label class="lb2">SVCA Member ID <span class="sys">*</span>:</label>
                            <div class="ipt-login">
                                <input type="text" name="username" class='form-control' required="required">
                            </div>
                        </div>
                        <div class="item-login text-right" >
                            <!--<a class="btn-login" href="register-1.html">CONTINUE AS NON-MEMBER</a>-->
                            <!--<a class="btn-login link-right" href="member-profile.html">LOGIN</a>-->
                             <button class="btn-login " type="submit">LOGIN</button>
                        </div>

                        </form>
                        <p style="color: red; margin-bottom: 0; font-style:italic;  word-wrap:break-word; ">Forgot your Member ID? Please contact your company representative or email info@svca.org.sg with your company email.</p>
                  </div>
                 
                </div>
              </div>
            </div>
		</div>
        
<?php if(isset($error_status) && $error_status==2){ ?>
<script type="text/javascript">
    jQuery(document).ready(function() {

    	jQuery("#login").trigger('click');

    });

    </script>
<?php }?>


<?php if(isset($error_status) && $error_status==3){ ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
    	jQuery("#listing"+<?=$this->session->flashdata('formid')?>).trigger('click');

    });

    </script>
<?php }?>


<?php if(isset($error_status) && $error_status==4){ ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
    	jQuery("#listing"+<?=$this->session->flashdata('formid')?>).trigger('click');

    });

    </script>
<?php }?>

<?php if(isset($error_status) && $error_status==5){ ?>
<script type="text/javascript">
    jQuery(document).ready(function() {

    	jQuery("#details").trigger('click');

    });

    </script>
<?php }?>

<script type="text/javascript">

jQuery(function($) { 

 $("a.close").click(function() {

  $('div.notification').hide();

 }); 

}); 

</script>