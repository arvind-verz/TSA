<!-- Content Containers -->
<div class="main-container">
    <!-- Section -->
    <div class="bg"><img src="<?php echo base_url('assets/images/bg1.png'); ?>" alt="" class="responsive"></div>
    <div class="fullcontainer bg-color1">
        <div class="container">
            <div class="inner-container-md">
                <div class="animatedParent" data-sequence="300">
                    <?=$page[0]['page_content']?>
                </div>
                <div class="cont-sm">
                    <?php echo form_open('login/reset-password/process'); ?>
                    <div class="form-holder pt50">
                        <?php $this->load->view('backend/include/messages')?>
        <?php if (validation_errors()) {?>
        <div class="col-lg-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo validation_errors(); ?>
            </div>
        </div>
        <?php }?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Email</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <div class="text-center pt30">
                                        <button class="button" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Section END -->
    <!-- BanSectionner -->
    <div class="fullcontainer bottom background parallax" style="background-image:url(<?php echo base_url('assets/images/bottom-bg.jpg');?>);" data-img-width="1400" data-img-height="400" data-diff="100">
        <div class="container">
            <div class="inner-container-md animatedParent">
                <div class="title3 text-center txt-white pcentered pb0 mb0 animated growIn">The Science Academy complies with the<br>
                Personal Data Protection Act 2012 (PDPA) of Singapore</div>
            </div>
        </div>
    </div>
    <!-- Section END -->
</div>
<!-- Content Containers END -->