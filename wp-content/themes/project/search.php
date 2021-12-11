<?php get_header() ?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div>
      <div class="col-lg-6 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php printf(esc_html__('Результат поиска:&nbsp; %s', 'project'), '<span>' . get_search_query() . '</span>'); ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <?php
          // счетчик
          $cnt = 0;
          if (have_posts()) {
            while (have_posts()) {
              the_post();
              $cnt++;
              switch ($cnt) {
                case '3': ?>
                  <div class="col-lg-12">
                    <div class="blog-post">
                      <?php
                      //должно находится внутри цикла
                      if (has_post_thumbnail()) {
                        the_post_thumbnail(
                          'large',
                          array(
                            'class' => 'img-fluid',
                          ),
                        );
                      } else {
                        echo '<img class="img-fluid" src="' . get_template_directory_uri() . '/images/black_friday.jpg"/>';
                      }
                      ?>
                      <div class="mt-4 mb-3 d-flex">
                        <div class="post-author mr-3">
                          <i class="fa fa-user"></i>
                          <span class="h6 text-uppercase"><?php the_author(); ?></span>
                        </div>

                        <div class="post-info">
                          <i class="fa fa-calendar-check"></i>
                          <span><?php the_time('j F Y'); ?></span>
                        </div>
                      </div>
                      <a href="blog-single.html" class="h4 "><?php the_title(); ?></a>
                      <p class="mt-3"><?php the_excerpt(); ?></p>
                      <a href="<?= get_the_permalink() ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                    </div>
                  </div>
                <?php
                  break;
                default: ?>
                  <div class="col-lg-6">
                    <div class="blog-post">
                      <?php
                      //должно находится внутри цикла
                      if (has_post_thumbnail()) {
                        the_post_thumbnail(
                          'medium',
                          array(
                            'class' => 'img-fluid',
                          ),
                        );
                      } else {
                        echo '<img class="img-fluid" src="' . get_template_directory_uri() . '/images/black_friday.jpg"/>';
                      }
                      ?>
                      <div class="mt-4 mb-3 d-flex">
                        <div class="post-author mr-3">
                          <i class="fa fa-user"></i>
                          <span class="h6 text-uppercase"><?php the_author(); ?></span>
                        </div>

                        <div class="post-info">
                          <i class="fa fa-calendar-check"></i>
                          <span><?php the_time('j F Y'); ?></span>
                        </div>
                      </div>
                      <a href="blog-single.html" class="h4 "><?php the_title(); ?></a>
                      <p class="mt-3"><?php the_excerpt(); ?></p>
                      <a href="<?= get_the_permalink() ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                    </div>
                  </div>
              <?php
                  break;
              }
              ?>
          <?php }
          } else {
            echo wpautop('Постов для вывода не найдено.');
          }
          ?>
          <div class="col-lg-12"><?php the_posts_pagination(array(
                                    'prev_text'    => __('<span class="p-2 border">« предыдущая</span>'),
                                    'next_text'    => __('<span class="p-2 border">следующая »</span>'),
                                    'before_page_number' => '<span class="p-2 border">',
                                    'after_page_number'  => '</span>'
                                  )); ?></div>
        </div>

      </div>
      <?php get_sidebar() ?>
    </div>
  </div>
  </div>
</section>
<?php get_footer() ?>