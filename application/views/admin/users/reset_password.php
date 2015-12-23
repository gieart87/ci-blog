<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_title?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo $base_assets_url;?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo $base_assets_url;?>css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo $base_assets_url;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><?php echo lang('reset_password_heading');?></div>
            
            <?php echo form_open('users/reset_password/' . $code);?>
                <div class="body bg-gray">
            		<?php echo $message;?>
                    <div class="form-group">
                    	<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label>
                        <?php echo form_input($new_password,null,array('class' => 'form-control'));?>
                    </div>
                    <div class="form-group">
                    	<label for="new_password"><?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?></label>
                        <?php echo form_input($new_password_confirm,null,array('class' => 'form-control'));?>
                    </div>
                </div>
                <?php echo form_input($user_id);?>
				<?php echo form_hidden($csrf); ?>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block"><?php echo lang('reset_password_submit_btn');?> </button>  
                     <p><a href="<?php echo site_url('signin')?>">Back to Sign In</a></p>
                </div>

            <?php echo form_close();?>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $base_assets_url;?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>