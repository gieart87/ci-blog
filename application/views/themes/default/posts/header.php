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
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="<?php echo site_url('signin')?>">Sign In</a></li>
              </ul>
            </div>
          </div>
      </div>
<section class="section-header">
        <div class="container">
          <h2><?php echo $post['title'];?></h2>
          <div class="post-meta">
            <ul>
              <li><i class="fa fa-calendar"></i> <?php echo date("d M Y",strtotime($post['published_at']))?></li>
              <li><a href="#"><i class="fa fa-user"></i> <?php echo $post['username']?></a></li>
              <li><i class="fa fa-bars"></i> <a href="#">Web Design</a>, <a href="#">Bootstrap</a></li>
              <li><a href="#comments"><i class="fa fa-comments"></i> 23 Comments</a></li>
            </ul>
          </div>
        </div>
      </section>