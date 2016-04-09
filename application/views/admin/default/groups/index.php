<div class="row">
	<div class="col-md-12">
		<div class="box">
            <div class="box-header">
                <h3 class="box-title">Groups</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
            	<?php echo $this->session->flashdata('message');?>
            	<p><a class="btn btn-default" href="<?php echo site_url('admin/groups/add')?>">New Group</a></p>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 100px">Action</th>
                    </tr>
                    <?php if(!empty($groups)):?>
                    	<?php foreach($groups as $group):?>
		                    <tr>
		                        <td><?php echo $group['id']?></td>
		                        <td><?php echo $group['name']?></td>
		                        <td><?php echo $group['description']?></td>
		                        <td>
		                        	<a href="<?php echo site_url('admin/groups/edit/'.$group['id'])?>"><span class="badge bg-green">edit</span></a>
		                        	<!-- <a href="<?php //echo site_url('admin/groups/delete/'.$group['id'])?>" onclick="return confirm('Are you sure?')"><span class="badge bg-red">delete</span></a> -->
		                        </td>
		                    </tr>
                    	<?php endforeach;?>
                	<?php else:?>
                		<tr><td colspan="5">No record found</td></tr>
                	<?php endif;?>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php echo $pagination ?>
            </div>
        </div><!-- /.box -->
	</div>
</div>