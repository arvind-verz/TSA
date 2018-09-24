<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="childpage">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/top_banner'); ?>
  <div class="mainchild">
    <div class="container maincontent">
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
        <li class="active">CONTACT US</li>
      </ol>
      <h3 class="t-header-cnt">Contact Us</h3>
      <div class="row">
        <div class="col-md-6 infocontact">
          <p><strong><?php echo $this->all_function->get_site_options('site_name')?></strong><br/>
            <?php echo $this->all_function->get_site_options('site_address1')?><br/>
            <?php echo $this->all_function->get_site_options('site_address2')?><br/>
            <?php echo $this->all_function->get_site_options('site_address3')?><br/>
            <strong>Tel:</strong> <?php echo $this->all_function->get_site_options('cantact_no')?><br/>
            <strong>Fax:</strong> <?php echo $this->all_function->get_site_options('cantact_fax')?><br/>
            <strong>Email:</strong> <a href="mailto:<?php echo $this->all_function->get_site_options('contact_email')?>"><?php echo $this->all_function->get_site_options('contact_email')?></a> </p>
          <p>Open from Monday to Friday<br/>
            Except Public Holidays</p>
          <div id="map_canvas" style="height:460px"></div>
        </div>
        <div class="col-md-6">
          <div class="form-style4">
            <?php $this->load->view('include/message'); ?>
            <form name="contact" id="contact" method="post" action="<?php echo base_url('contact-us'); ?>">
              <h4>Fill out the form:</h4>
              <div class="item-style4">
                <label class="lb4">Salutation:</label>
                <div class="ipt-style4">
                  <div class="group-salu">
                    <select class="selectpicker"  name="salutation" required >
                      <option value="">Select One</option>
                      <option value="Mr." <?php if(set_value('salutation')=='Mr.'){echo 'selected';} ?>>Mr.</option>
                      <option value="Mrs." <?php if(set_value('salutation')=='Mrs.'){echo 'selected';} ?>>Mrs.</option>
                      <option value="Ms." <?php if(set_value('salutation')=='Ms.'){echo 'selected';} ?>>Ms.</option>
                      <option value="Mdm." <?php if(set_value('salutation')=='Mdm.'){echo 'selected';} ?>>Mdm.</option>
                      <option value="Dr." <?php if(set_value('salutation')=='Dr.'){echo 'selected';} ?>>Dr.</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Name <span class="sys">*</span>:</label>
                <div class="ipt-style4">
                  <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" required/>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Email <span class="sys">*</span>:</label>
                <div class="ipt-style4">
                  <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" required/>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Company :</label>
                <div class="ipt-style4">
                  <input type="text" class="form-control" name="company" value="<?php echo set_value('company'); ?>" />
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Contact Number :</label>
                <div class="ipt-style4">
                  <input type="tel" pattern="[0-9]{8,12}" title="Only numerical values are accepted" class="form-control"  name="phone_no" value="<?php echo set_value('phone_no'); ?>"/>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Type of Enquiry <span class="sys">*</span>:</label>
                <div class="ipt-style4">
                  <select class="selectpicker"  name="enquiry_type" required>
                    <option value="">Select One</option>
                    <option value="Membership Related" <?php if(set_value('enquiry_type')=='Membership Related'){echo 'selected';} ?>>Membership Related</option>
                    <option value="Others" <?php if(set_value('enquiry_type')=='Others'){echo 'selected';} ?>>Others</option>
                  </select>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4">Enquiry Details <span class="sys">*</span>:</label>
                <div class="ipt-style4">
                  <textarea class="form-control"  name="message" required><?php echo set_value('message'); ?></textarea>
                </div>
              </div>
              <div class="item-style4">
                <label class="lb4"></label>
                <div class="ipt-style4"> <?php echo $widget;?><?php echo $script;?> </div>
              </div>
              <div class="item-style4 text-right"> 
                <!--<a class="btn-sb" href="thank-you.html">SUBMIT</a>-->
                <button type="submit" class="btn-sb">SUBMIT</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="box-info-cnt">
        <div class="box-des-cnt">
          <h4>Singapore Venture Capital & Private Equity Association <br/>
           complies with <strong>Personal Data Protection Act 2012 (PDPA)</strong> of Singapore</h4>
          <p>For requests/ enquiries concerning Personal Data Protection or Privacy Policy please write to the PDPA Officer at <a href="mailto:info@svca.org.sg">info@svca.org.sg</a>.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- //page -->

<?php $this->load->view('include/footer'); ?>
<?php echo js('jquery.min'); ?> <?php echo js('plugin'); ?> <?php echo js('main'); ?> 
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBBepZmkogMsEeXh-XIr8a2JvmEAw4NiZg"></script>
<?php //echo js('map'); ?>
<script>
		function initialize() {
		 var myLatlng = new google.maps.LatLng(<?php echo $this->all_function->get_site_options('site_lat')?>,<?php echo $this->all_function->get_site_options('site_long')?>);<!--1.282199, 103.850796-->
			var myOptions = {
			  zoom: 18,
			  center: myLatlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			}
	
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var contentString = '<div id="content">'+
		'<h1>Singapore Venture Capital & <br/>Private Equity Association</h1>'+
		'<div>'+
		'<p><?php echo $this->all_function->get_site_options('site_address1')?><br/><?php echo $this->all_function->get_site_options('site_address2')?><br/><?php echo $this->all_function->get_site_options('site_address3')?> </p>'+
		'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 400
	});
	
	var companyImage = new google.maps.MarkerImage('<?php echo image('pin.png')?>',
		new google.maps.Size(66,78),
		new google.maps.Point(0,0)
	);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		icon: companyImage,
		title: 'Singapore Venture Capital & Private Equity Association'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});

  }
	
 initialize();     
		</script>
</body>
</html>