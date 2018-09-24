<div class="slider-home">
<?php foreach ($home_banner as $key => $val): ?>
<div>
                	<img src="<?php echo base_url('assets/upload/banner/original/'.$val['image_name']); ?>" alt=""/>
                    <?php if(!empty($val['content'])){?>
                    	<div class="container">
                        	<div class="tpl-banner">
                            	<div class="caption-banner">
                                	<div class="des-banner">
                                    	<?php echo $val['content'] ?>
                                        <div class="link-banner">
                                        <?php if(!empty($val['url'])){?>
                                        	<a href="<?php echo $val['url'] ?>">LEARN MORE</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
<?php endforeach; ?>
</div>