<?php $this->load->view('include/header_tag'); ?>
<body>
<div class="Over_flow">
  <?php $this->load->view('include/header'); ?>
  <?php $this->load->view('include/blog_banner'); ?>
  <div class="body_wrap">
    <div class="center"> <img src="<?php echo image('shado_left.png'); ?>" class="shodo_left"> <img src="<?php echo image('shado_right.png'); ?>" class="shodo_right">
      <div class="body">
        <div class="bred_camb"> <a href="<?php echo base_url('/'); ?>" class="home"></a><a href="<?php echo base_url('blog'); ?>" class="diable">Blog</a><a><?php echo $page[0]['title'];?></a> </div>
        <div class="listing_wrap">
          <div class="col_left">
            <h2>blog category</h2>
            <div class="left_menu2">
              <ul>
                <?php foreach ($blog_cat as $key => $val):?>
                <li><a href="<?php echo base_url('blog/'.$val['seo_url']); ?>" <?php if($val['bcat_id']==$page[0]['bcat_id']){echo 'class="Select"';}?>><?php echo $val['cat_name'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <h2>recent posts</h2>
            <div class="left_menu2">
              <ul>
                <?php foreach ($resent_blog as $key => $val):?>
                <li><a href="<?php echo base_url('blog-details/'.$val['seo_url']); ?>" <?php if($val['id']==$page[0]['id']){echo 'class="Select"';}?>><?php echo $val['title'];?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <div class="col_right">
            <h1 class="page_title"><?php echo $page[0]['title'];?></h1>
            <section class="blog_row"> <span class="post_date"> <a><?php echo date("dS M, Y", strtotime($page[0]['post_date']));?></a></span> <span class="auther"><a><?php echo $author_name = $this->all_function->get_author_name($page[0]['author']);?></a></span> <span class="post_comment"><a><?php echo $comments_no = $this->all_function->get_comments_no($page[0]['id']);?></a></span>
              <article> <?php echo $page[0]['description'];?> </article>
            </section>
            <?php if(count($comments)>0){?>
            <div class="comment_wrap">
              <h3>Comments</h3>
              <?php foreach ($comments as $key => $val): ?>
              <section class="comment_row">
                <article>
                  <p><?php echo $val['comments'];?></p>
                </article>
                <div class="auther_name"> <?php echo $val['name'];?><img src="<?php echo image('auther.jpg'); ?>" alt=""> </div>
              </section>
              <?php endforeach; ?>
            </div>
            <?php }?>
            <?php if($success==''){?>
            <div class="comment_form_wrap">
              <h3>Add a comment</h3>
              <div class="comment_form">
                <form action="" method="post" name="blogcomments">
                  <div class="form"> <span class="field_name">Name <span class="req">*</span></span>
                    <input type="text" name="name" required id="name" value="<?php echo set_value('name'); ?>" >
                  </div>
                  <div class="error"><?php echo form_error('name'); ?></div>
                  <div class="form"> <span class="field_name">Email <span class="req">*</span></span>
                    <input type="email" name="email" required id="email" value="<?php echo set_value('email'); ?>" >
                  </div>
                  <div class="error"><?php echo form_error('email'); ?></div>
                  <div class="form"> <span class="field_name">Website</span>
                    <input type="text" name="website" id="website" value="<?php echo set_value('website'); ?>">
                  </div>
                  <div class="form"> <span class="field_name">Your comment <span class="req">*</span></span>
                    <textarea name="comments" required id="comments"><?php echo set_value('comments'); ?></textarea>
                  </div>
                  <div class="error"><?php echo form_error('comments'); ?></div>
                  <div class="form"> <span class="field_name">Captcha <span class="req">*</span></span>
                    <div class="captcha"><?php echo $widget;?><?php echo $script;?></div>
                  </div>
                  <button type="submit">add comment</button>
                </form>
              </div>
            </div>
            <?php }else{?>
            <div class="success">
              <?php $this->load->view('include/message'); ?>
            </div>
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