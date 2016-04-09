<div class="row">
    <div class="col-md-12">
         <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Create User</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo site_url('admin/users/add')?>" method="post">
                <div class="box-body">
                    <?php echo $this->session->flashdata('message');?>
                    <?php echo message_box(validation_errors(),'danger'); ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"  name="username" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('username') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text"  name="email" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('email') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">New Password</label>
                        <input type="password" name="password" class="form-control" id="username" placeholder="New Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="username">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="username" placeholder="Confirm Password" value="">
                    </div>
                    <div class="form-group">
                        <label for="username">First  Name</label>
                        <input type="text" name="first_name" class="form-control" id="username" placeholder="First name" value="<?php echo set_value('first_name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="username" placeholder="Last name" value="<?php echo set_value('last_name') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Company</label>
                        <input type="text" name="company" class="form-control" id="username" placeholder="Company" value="<?php echo set_value('company') ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Phone</label>
                        <input type="text" name="phone" class="form-control" id="username" placeholder="Phone" value="<?php echo set_value('phone') ?>">
                    </div>
                    <div class="form-group">
                        <label for="category_active">Groups</label>
                        <?php
                            echo form_dropdown('groups[]',$groups, null,array('class' => 'form-control','multiple' => true));
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