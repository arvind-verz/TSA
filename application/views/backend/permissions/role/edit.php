

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
        <?php echo '<pre>'; print_r($user); echo '</pre>';?>
    </section>
    <?php 
	$this->load->view('backend/include/messages');	?>
    <!-- Main content -->
    <section class="content">
    
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    

<?php echo form_open('admin/role/update/'); ?>

                        <div class="box-body">
                        <div class="form-group">
                                <label class="col-sm-2 control-label">Role Type</label>

                                <div class="col-sm-10">

                                    <select class="form-control select2 select2-hidden-accessible" data-placeholder="" name="role_type_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="">Select Role Type</option>
                                        <?php foreach($permissions as $permission):?>
                                        <option <?php if($permission->id==$user->role_type_id) echo 'selected="selected"';?> value="<?php echo $permission->id;?>"><?php echo $permission->name;?></option>
                                        <?php endforeach;?>                                                                                          								

                                                                                                                        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="full_name" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $user->first_name;?>" class="form-control" placeholder="" name="first_name" id="first_name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="full_name" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $user->last_name;?>" class="form-control" placeholder="" name="last_name" id="last_name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo $user->email;?>" class="form-control" placeholder="" name="email" id="email" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="" name="password" id="password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="col-sm-2 control-label">Confirm password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" placeholder="" name="password_confirmation" id="password_confirmation" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                <div class="col-sm-2">
                                <label class="radio-inline">
                                     <input name="is_active" <?php if($user->is_active==1) echo 'checked="checked"';?> value="1" type="radio" >Active
                                 </label>
                                </div>
                                <div class="col-sm-2">
                                 <label class="radio-inline">
                                      <input name="is_active" <?php if($user->is_active==0) echo 'checked="checked"';?> value="0" type="radio">Inactive
                                 </label>
                                </div>
                                </div>
                           </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            

                            <button type="submit" class="btn btn-info pull-right"><i class="fa  fa-check"></i> Add
                            </button>

                        </div>
                        <!-- /.box-footer -->
                        <?php echo form_close(); ?> 
                    
                </div>
            </div>
        </div>
    </section>
</div>
