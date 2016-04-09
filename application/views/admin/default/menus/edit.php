<div class="row">
    <div class="col-md-12">
         <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Menu</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/menus/edit')?>" method="post">
            <?php echo form_hidden('id', $menu['id']) ?>
                <div class="box-body">
                    <?php echo message_box(validation_errors(),'danger'); ?>
                    <div class="form-group">
                        <label for="category_name">Name</label>
                        <?php echo form_input(array('name' => 'name','class' => 'form-control', 'value' => set_value('name', isset($menu['name']) ? $menu['name'] : ''))); ?>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <?php
                            echo form_dropdown('url',merge_urls($all_post_urls,$menu['url']),$menu['url'],array('class' => 'select2-tags form-control'));
                        ?>
                    </div>

                    <?php
                    $no_parent_selected = '';
                    if (empty($menu['parent_id'])):
                        $menu['parent_id'] = 0;
                        $no_parent_selected = 'selected';
                    endif;

                    ?>
                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control" name="parent_id">
                            <option value="" <?php echo $no_parent_selected;?>> -- Choose Parent -- </option>
                            <?php echo $this->general->multilevel_select($menus,0,array(),$menu['parent_id']);?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_status">Status</label>
                        <?php echo form_dropdown('status', $status, $menu['status'],array('class' => 'form-control')); ?>
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