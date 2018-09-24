<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/blog_cat_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"> <a href="<?php echo base_url('/'); ?>" class="home"></a><a href="<?php echo base_url('blog'); ?>">Blog</a><a class="diable"><?php echo $page[0]['cat_name'];?></a> </div>
        <div class="listing_wrap">
          <div class="col_left">
            <h2>blog category</h2>
            <div class="left_menu2">
              <ul>
                <?php foreach ($blog_cat as $key => $val):?>
                <li><a href="<?php echo base_url('blog/'.$val['seo_url']); ?>" <?php if($val['bcat_id']==$bcat_id){echo 'class="Select"';}?>><?php echo $val['cat_name'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <h2>recent posts</h2>
            <div class="left_menu2">
              <ul>
                <?php foreach ($resent_blog as $key => $val):?>
                <li><a href="<?php echo base_url('blog-details/'.$val['seo_url']); ?>"><?php echo $val['title'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="col_right">
            <h1 class="page_title"><?php echo $page[0]['cat_name'];?></h1>
            <?php if(count($blog)>0){?>
            <?php foreach ($blog as $key => $val): ?>
            <section class="blog_row">
              <h2 class="post_title"><a href="<?php echo base_url('blog-details/'.$val['seo_url']); ?>"><?php echo $val['title'];?></a></h2>
              <span class="post_date"><a><?php echo date("dS M, Y", strtotime($val['post_date']));?></a></span> <span class="auther"><a><?php echo $author_name = $this->all_function->get_author_name($val['author']);?></a></span> <span class="post_comment"><a><?php echo $comments_no = $this->all_function->get_comments_no($val['id']);?></a></span>
              <article>
                <?php if(strlen($val['description'])>450){
	echo substr($val['description'],0,450).'...';
}else{
	echo $val['description'];
}
?>
              </article>
              <a href="<?php echo base_url('blog-details/'.$val['seo_url']); ?>" class="readmore">Read More</a> </section>
            <?php endforeach; ?>
            <?php }else{?>
            <section class="blog_row">
              <h2 class="post_title">There is no post found.</h2>
            </section>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('include/footer'); ?>
</div>
</body>
</html>