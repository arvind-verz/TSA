<?php 
$parent_id  = $page[0]['parent_id'];
$id  = $page[0]['id'];

if($parent_id==0){
	
	$sub_menu = $this->all_function->get_menu($id);
	if(count($sub_menu)>0){
		$parent_menu = $this->all_function->get_parent_menu($id);
		$parent_menu_name = $page[0]['menu_name'];
		?>

<div class="main-l f-left">
  <h3 class="title4"><?php echo $parent_menu_name;?></h3>
  <ul class="menusub">
    <?php foreach ($sub_menu as $key => $val){?>
    <li <?php if($url_name==$val['url_name']){?>class="active"<?php }?>><a href="<?php echo base_url(''.$val['url_name']); ?>" ><?php echo $val['page_heading']; ?></a></li>
    <?php }?>
  </ul>
</div>
<?php
	}
}

else{	
	$menu = $this->all_function->get_menu($parent_id);
	if(count($menu)>0){
	$parent_menu = $this->all_function->get_parent_menu($parent_id); 
	$parent_menu_name = $parent_menu[0]['menu_name'];
	?>
<div class="main-l f-left">
  <h3 class="title4"><?php echo $parent_menu_name;?></h3>
  <ul class="menusub">
    <?php foreach ($menu as $key => $val){?>
    <li <?php if($url_name==$val['url_name']){?>class="active"<?php }?>><a href="<?php echo base_url(''.$val['url_name']); ?>"><?php echo $val['page_heading']; ?></a></li>
    <?php }?>
  </ul>
  <?php if($page[0]['parent_id'] == 6){?>
  <a  class="fancybox l-popup" href="#inline1">Engage Us for your membership</a>
  <div id="inline1" style="width:400px;display: none;">
    <h3 class="title5">Engage us for your membership </h3>
    <form name="membership" id="membership" method="post" action="<?php echo base_url($url_name); ?>">
      <p>
        <input type="text" placeholder="Name" class="ipt2" name="name" id="name"/>
      </p>
      <p>
        <input type="text" placeholder="Email Address" class="ipt2" name="email" id="email"/>
      </p>
      <p>
        <input type="text" placeholder="Contact Number" class="ipt2" name="telephone" id="telephone"/>
      </p>
      <p>
        <input type="text" placeholder="Address" class="ipt2" name="address" id="address"/>
      </p>
      <p>
        <textarea class="txt2" name="message" id="message" placeholder="Message"></textarea>
      </p>
      <div class="f-right">
        <input type="submit" class="btn2" name="submit" value="Submit" onClick="return membership_form_valid();" />
      </div>
    </form>
  </div>
  <?php }?>
</div>
<?php }
}?>
