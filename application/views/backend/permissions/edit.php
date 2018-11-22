<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php print_r($page_title);?>
        </h1>
    <?php //echo '<pre>'; print_r($name); echo '</pre>';?>
</section>
<?php
$this->load->view('backend/include/messages');  ?>
<!-- Main content -->
<section class="content">
    
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-info" href="<?php echo site_url('admin/permission/create') ?>">
                        <i aria-hidden="true" class="fa fa-plus-circle">
                        </i> <?php echo CREATE . ' ' . PERMISSION ?>
                    </a>
                    <a class="btn btn-info" href="<?php echo site_url('admin/permission/archived') ?>">
                        <i aria-hidden="true" class="fa fa-archive">
                        </i> <?php echo ARCHIVED . ' ' . PERMISSION ?>
                    </a>
                </div>
                <?php echo form_open('admin/permission/update/'.$id); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="<?php echo $name->name;?>" placeholder="" name="title" id="title" type="text">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="modules" class="col-sm-2 control-label">Modules</label>
                        <div class="col-sm-10">
                            <?php
                            foreach($permission as $permi):
                            $detail=$this->permission->get_modules_name($permi->module_id);
                            //print_r($detail);
                            ?>
                            <table class="table row border">
                                <tbody><tr>
                                    <th colspan="2" style="border:0;"><?php echo $detail->label;?></th></tr>
                                    <tr>
                                        <td>View
                                        </td>
                                        <td>
                                            <input name="module[<?php echo $permi->module_id;?>][view][]" value="1" <?php if($permi->view==1) echo ' checked="checked"';?>  type="radio">Yes
                                            <input name="module[<?php echo $permi->module_id;?>][view][]" value="0" <?php if($permi->view==0) echo ' checked="checked"';?> type="radio">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Create</td>
                                        <td>
                                            <input <?php if($permi->create==1) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][create][]" value="1" checked="" type="radio">Yes
                                            <input <?php if($permi->create==0) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][create][]" value="0" type="radio">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edit</td>
                                        <td>
                                            <input <?php if($permi->edit==1) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][edit][]" value="1" checked="" type="radio">Yes
                                            <input <?php if($permi->edit==0) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][edit][]" value="0" type="radio">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Delete
                                        </td>
                                        <td>
                                            <input <?php if($permi->delete==1) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][delete][]" value="1" checked="" type="radio">Yes
                                            <input <?php if($permi->delete==0) echo ' checked="checked"';?> name="module[<?php echo $permi->module_id;?>][delete][]" value="0" type="radio">No
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right"><i class="fa  fa-check"></i> Edit
                    </button>
                </div>
                <!-- /.box-footer -->
                <?php echo form_close(); ?>
                
            </div>
        </div>
    </div>
</section>
</div>