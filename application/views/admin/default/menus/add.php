<div class="row">
    <div class="col-md-12">
         <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">New Menu</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/menus/add')?>" method="post">
                <div class="box-body">
                    <?php echo message_box(validation_errors(),'danger'); ?>
                    <div class="form-group">
                        <label for="category_name">Name</label>
                        <?php echo form_input(array('name' => 'name','class' => 'form-control', 'value' => set_value('name'))); ?>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <?php
                            echo form_dropdown('url',$all_post_urls,null,array('class' => 'select2-tags form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control" name="parent_id">
                            <option value="" selected=""> -- Choose Parent -- </option>
                            <?php echo $this->general->multilevel_select($menus);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_status">Status</label>
                        <?php
                            echo form_dropdown('status',$category_status,null,array('class' => 'form-control'));
                        ?>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <button type="button" class="btn btn-default" onclick="javascript:history.back()">Back</button>
                </div>
            </form>
        </div><!-- /.box -->
    </div>
</div>