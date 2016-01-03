<div class="navbar navbar-default navbar-fixed-top top-navbar">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo site_url('/')?>"><h1 class="logo">CI - Blog</h1></a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">

              <ul class="nav navbar-nav navbar-right">
                <?php echo $main_menus;?>
              </ul>
            </div>
          </div>
      </div>
      <?php if(!empty($page_layout) && $page_layout == 'single'):?>
      <section class="section-header">
        <div class="container">
          <h2><?php echo $post['title'];?></h2>
          <div class="post-meta">
            <ul>
              <li><i class="fa fa-calendar"></i> <?php echo date("d M Y",strtotime($post['published_at']))?></li>
              <li><a href="#"><i class="fa fa-user"></i> <?php echo $post['username']?></a></li>
              <!-- <li><i class="fa fa-bars"></i> <a href="#">Web Design</a>, <a href="#">Bootstrap</a></li> -->
              <!-- <li><a href="#comments"><i class="fa fa-comments"></i> 23 Comments</a></li> -->
            </ul>
          </div>
        </div>
      </section>
      <?php else:?>
       <section class="section-header">
        <div class="container">
          <?php if(!empty($category)):?>
            <h2>Category : <?php echo $category['name']?> </h2>
          <?php endif;?>

          <?php if(!empty($tag)):?>
            <h2>Tag : <?php echo $tag['name']?> </h2>
          <?php endif;?>

          <?php if(empty($category) && empty($tag)):?>
            <h2>Blog</h2>
          <?php endif;?>
        </div>
      </section>
      <?php endif;?>