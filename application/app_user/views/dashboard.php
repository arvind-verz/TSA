<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <div class="row">
        <div class="col-md-3">
          <div class="t-header-3"> HI <?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_name']; ?> </div>
          <ul class="menuchild" id="menuchild">
            <li class="active"><a href="<?php echo base_url('dashboard'); ?>">My Particulars</a></li>
            <li><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
          </ul>
        </div>
        <div class="col-md-9 rightpage">
          <h3 class="t-header-cnt"> My Particulars </h3>
          <div class="form-style2">
            <div class="row">
              <label class="col-sm-4 lbl-2">Member ID <span>:</span></label>
              <div class="col-sm-8 info-form-style"> <?php echo $this->session->userdata[USER_LOGIN_PREFIX.'user_name']; ?> </div>
            </div>
            <div class="row">
              <label class="col-sm-4 lbl-2">Company Name <span>:</span></label>
              <div class="col-sm-8 info-form-style"> <?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_name']; ?> </div>
            </div>
            <div class="row">
              <label class="col-sm-4 lbl-2">Business Sector <span>:</span></label>
              <div class="col-sm-8 info-form-style"> <?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_type']; ?> </div>
            </div>
            <div class="row">
              <label class="col-sm-4 lbl-2">Company Email (Primary) <span>:</span></label>
              <div class="col-sm-8 info-form-style"> <a href="mailto:<?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_email']; ?>"><?php echo $this->session->userdata[USER_LOGIN_PREFIX.'company_email']; ?></a> </div>
            </div>
          </div>
          <p class="note-text">Note: To make any changes, please contact the administrator directly</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //page -->

<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?>
</body>
</html>