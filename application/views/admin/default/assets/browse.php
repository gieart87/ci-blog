<?php if(!empty($assets)):?>
	<?php foreach($assets as $asset):?>
<li class="span6 col-xs-12 col-sm-6 col-md-3 col-lg-3">
<a class="thumbnail" href="javascript:void(0)"  onclick="chooseImage('<?php echo BASE_URI.$asset['path']?>')" >
<img style="height:100px;width:130px;" src="<?php echo BASE_URI.$asset['path']?>">
</a>
</li>
	<?php endforeach;?>
<li class="col-md-12">
<?php if($current_page > 1):?>
<a href="javascript:browseImage(<?php echo $current_page-1?>)" class="pull-left btn btn-default">Prev</a>
<?php endif;?>
<?php if($current_page < $total_pages):?>
<a href="javascript:browseImage(<?php echo $current_page+1?>)" class="pull-right btn btn-default">Next</a>
<?php endif;?>
</li>
<?php endif;?>