<div class="row">
	<div class="col-md-12">
		 <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Group</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/groups/edit')?>" method="post">
                <input type="hidden" name="id" value="<?php echo $group['id']?>">
                <div class="box-body">
                    <?php echo $this->session->flashdata('message');?>
                    <?php echo validation_errors(); ?>
                    <div class="form-group">
                        <label for="category_name">Group Name</label>
                        <input type="text" name="name" readonly="readonly" class="form-control" id="category_name" placeholder="Name" value="<?php echo set_value('name', isset($group['name']) ? $group['name'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="category_name">Description</label>
                        <input type="text" name="description" class="form-control" id="category_name" placeholder="Description" value="<?php echo set_value('description', isset($group['description']) ? $group['description'] : '') ?>">
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