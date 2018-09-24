<?php $this->load->view('include/header_tag'); ?>
<?php echo js('jquery.infieldlabel.min'); ?>
<script type="text/javascript">
       $(function(){ $("label").inFieldLabels(); });
</script>
<body>
<div class="Over_flow">
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/top_banner'); ?>
<div class="wrap-bred-camb">
<div class="container">
<div class="bred-camb"><a href="<?php echo base_url('/'); ?>">Home</a><span class="seprster fa fa-angle-double-right"></span>Enquiry Cart</div>
</div>
</div> 
<div class="body-inner">
<div class="container">
<h2 class="page-title">Enquiry Cart</h2>

<?php $cart_item = $this->session->userdata('cart'); 
        $data ='';  
        if(!empty($cart_item)){
                foreach ($cart_item as $key => $val){ 
                 $products_id = $val['products_id'];
				 $timeID = $val['timeID'];
				 $product = $this->all_function->get_cart_product($products_id);
				 if($product[0]['product_name']){
                 $data .= '<div class="cart-itemt" id="cart_'.$timeID.'"><div class="cart-row clear_fix"><article class="Enquiry">';
				 $data .= '<figure><a href="'.base_url('product/'.$product[0]['seo_url']).'"> <img src="'.base_url('assets/upload/products/thumb/'.$product[0]['image_name']).'" alt=""> </figure></a>';
                 $data .= '<div class="cart-info-wrap">';
				 //$data .= "'".$timeID."');";
				 $data .= '<h2 class="item"><a href="'.base_url('product/'.$product[0]['seo_url']).'">'.$product[0]['product_name'].'</a></h2>';
                 $i = 0;
				 $data .= '<div class="cart-top">';
                 foreach ($val['options'] as $key => $val){
                    $data .= '<span class="part-number"><strong>'.$val['products_options'].': </strong>'.$val['products_options_values'].'</span>';                    
                 }
				 $data .='</div>';
				 $data .= '<div class="cart-info">'.$product[0]['product_description'].'</div>';
				 
				 $data .= '<span class="delete"><a class="close"  onclick="remove_item(';
				 $data .="'".$timeID."');";
				 $data .='"><i class="fa fa-close"></i></a></span>';
				 
                 $data .='</div></article></div></div>';
				 }
            }
            echo $data;  ?>



<div class="wrap-cart-form">
<div class="form clear-fix">
<?php $this->load->view('include/message'); ?>
<form name="cart" id="cart" method="post" action="<?php echo base_url('cart-enquiry');?>">
<h2>Enquire Now</h2>
<div class="clear"></div>
<div class="col-input">
<label for="Name">Full Name <span>*</span></label>
<input type="text" class="input-02" id="Name" name="name" required value="<?php echo set_value('name'); ?>">
</div>
<div class="col-input">
<label for="Email">Email Address <span>*</span></label>
<input type="email"  class="input-02" id="Email" name="email" required value="<?php echo set_value('email'); ?>">
</div>
<div class="clear"></div>
<div class="col-input">
<label for="Contact">Contact No. <span>*</span></label>
<input type="tel" class="input-02" id="Contact" name="telephone" required value="<?php echo set_value('telephone'); ?>">
</div>
<div class="col-input">
<label for="company">Company/Organization</label>
<input type="text"  class="input-02" id="company" name="company" value="<?php echo set_value('company'); ?>">
</div>
<div class="clear"></div>
<div class="bound-text">
<label for="comment">Comments/Feedback</label>
<textarea class="textarea-2" id="comment" name="message" required><?php echo set_value('message'); ?></textarea>
</div>
<span class="cout">Fields marked with <span>*</span> are mandatory fields.</span>
<div class="form-bottom clear-fix">
<div class="captcha-02">
<?php echo $widget;?><?php echo $script;?>
</div>
<button type="submit" class="input-btn">Submit</button>

</div>
</form>
</div>
</div>



</div>

<?php }else{?>
          <div class='cart-itemt'> Cart is empty. </div>
          <?php }?>

</div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
<?php echo css('left-menu'); ?>
    <script>
$("#accordion > li > span").click(function(){

	if(false == $(this).next().is(':visible')) {
		$('#accordion ul').slideUp(300);
	}
	$(this).next().slideToggle(300);
});

$(".click").click(function(){
	$(".menu").slideToggle(300);
});


//$('#accordion ul:eq(0)').show();

</script>
<?php echo js('jquery.flexslider'); ?>
<?php echo js('plugins'); ?>
</html>