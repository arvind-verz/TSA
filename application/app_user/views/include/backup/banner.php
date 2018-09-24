<div class="banner-wrap">
<div class="flexslider">
<ul class="slides">
<?php foreach ($home_banner as $key => $val): ?>
<li>
<div class="banner-caption">
<div class="container">
<article>
<?php echo $val['content'] ?>
</article>

</div>
</div>
<img src="<?php echo base_url('assets/upload/banner/original/'.$val['image_name']); ?>" alt="">

</li>

<?php endforeach; ?>
<!--
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-01.jpg" alt="">

</li>
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-02.jpg" alt="">

</li>
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-03.jpg" alt="">

</li>
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-04.jpg" alt="">

</li>
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-05.jpg" alt="">

</li>
<li>
<div class="banner-caption">
<div class="container">
<article>
<h2><span>The World’s Most Trusted</span></h2>
<h3><span>Vibration Monitors</span></h3>
</article>

</div>
</div>
<img src="images/slide-06.jpg" alt="">

</li>-->



</ul>
</div>
<div class="click-wrap">
<div class="container">
<a href="#Top" class="click-down"><img src="<?php echo image('down.png'); ?>" alt=""></a>
</div>
</div>
</div>
