<div class="panel panel-default"><!-- Post -->
    <?php if(!empty($post['featured_image'])):?>
    <div class="panel-img">
     	<img src="<?php echo BASE_URI.$post['featured_image'];?>" alt="" class="img-responsive">
    </div>
    <?php endif;?>
    <div class="panel-body content">
		<?php echo $post['body'];?>
	</div>
	<div class="panel-footer">
        <div class="post-meta">
          <span class="text-left"><a href="#"><i class="fa fa-heart"></i> 23</a></span> 
          <div class="pull-right share-icon"> 
            <ul>
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            </ul>
          </div>
        </div>
     </div>
</div>