
              <div class="widget default">
                <div class="widget-title">
                  <h3>Recent Posts</h3>
                </div>
                <div class="list-group">
                  <?php if(!empty($this->general->getRecentPosts())):?>
                    <?php foreach ($this->general->getRecentPosts() as $post):?>
                      <div class="list-group-item">
                        <?php if(!empty($post['featured_image'])):?>
                        <div class="row-picture">
                            <img class="circle" src="<?php echo BASE_URI.$post['featured_image']?>" alt="icon">
                        </div>
                        <?php endif;?>
                        <div class="row-content">
                            <h4><a href="<?php echo site_url('read/'.$post['slug']) ?>"><?php echo $post['title'] ?></a></h4>
                        </div>
                      </div>
                      <div class="list-group-separator"></div>
                    <?php endforeach;?>
                  <?php endif;?>
                </div>
              </div>
              <div class="widget">
                <div class="widget-title">
                  <h3>Categories</h3>
                </div>
                <div class="widget-content list-menus">
                  <ul>
                    <?php if(!empty($this->general->getCategories())):?>
                        <?php foreach($this->general->getCategories() as $category):?>
                          <li><a href="<?php echo site_url('category/'.$category['slug'])?>"><?php echo $category['name']?></a></li>
                        <?php endforeach;?>
                      <?php endif;?>
                  </ul>
                </div>
              </div>
              <!-- <div class="widget">
                <div class="widget-title">
                  <h3>Archives</h3>
                </div>
                <div class="widget-content list-menus">
                  <ul>
                    <li><a href="#">March, 2015</a></li>
                    <li><a href="#">April, 2015</a></li>
                    <li><a href="#">May, 2015</a></li> 
                    <li><a href="#">June, 2015</a></li>
                  </ul>
                </div>
              </div> -->
              <div class="widget">
                <div class="widget-title">
                  <h3>Tags</h3>
                </div>
                <div class="widget-content list-menus">
                  <?php if(!empty($this->general->getTags())):?>
                    <?php foreach($this->general->getTags() as $tag):?>
                        <a class="tags" href="<?php echo site_url('tag/'.$tag['slug'])?>"><?php echo ucwords($tag['name'])?></a>
                    <?php endforeach;?>
                  <?php endif;?>
                </div>
              </div>