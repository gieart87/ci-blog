<div class="panel panel-default"><!-- Post -->
    <div class="panel-img">
     	<?php echo isset($post['featured_image'])? '<img src="'.BASE_URI.$post['featured_image'].'" class="img-responsive"/>' : '';?>
    </div>
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