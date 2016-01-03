<?php if(!empty($posts)):?>
  <?php foreach($posts as $post):?>
  <div class="panel panel-default"><!-- Post -->
      <?php if(!empty($post['featured_image'])):?>
      <div class="panel-img">
        <img src="<?php echo BASE_URI.$post['featured_image']?>" alt="<?php echo $post['title'];?>"/>
      </div>
      <?php endif;?>
      <div class="panel-body content">
          <h2><a href="<?php echo site_url('read/'.$post['slug'])?>"><?php echo $post['title']?></a></h2>
          <?php echo word_limiter(strip_tags($post['body'],'<p><br>'),30)?>
      </div>
      <div class="panel-footer">
        <div class="post-meta">
          <span class="text-left"><i class="fa fa-calendar"></i> <?php echo date('d M Y',strtotime($post['published_at']))?> 
          <!-- <i class="fa fa-bars"></i> <a href="#">Web Design</a>, <a href="#">Bootstrap</a></span>  -->
          <!-- <span class="pull-right"><a href="single.html"><i class="fa fa-comments"></i> 23 Comments</a></span> -->
        </div>
      </div>
  </div><!-- End Post -->
  <?php endforeach;?>
  <?php echo $pagination;?>
<?php endif;?>