<div class="row">
	<div class="col-md-12">
		 <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Edit Category</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/categories/edit')?>" method="post">
                <input type="hidden" name="id" value="<?php echo $category['id']?>">
                <div class="box-body">
                    <?php echo $this->session->flashdata('message');?>
                    <?php echo validation_errors(); ?>
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="name" class="form-control" id="category_name" placeholder="Name" value="<?php echo set_value('name', isset($category['name']) ? $category['name'] : '') ?>">
                    </div>
                    <div class="form-group">
                        <label for="category_status">Status</label>
                        <?php
                            echo form_dropdown('status',$category_status, isset($category['status']) ? $category['status'] : '',array('class' => 'form-control'));
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