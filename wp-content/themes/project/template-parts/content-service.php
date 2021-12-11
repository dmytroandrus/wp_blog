<!--  SERVICE PARTNER START  -->
<section id="service-head" class="<?php if (!empty($args['class'])) {
                                    echo $args['class'];
                                  } else {
                                    echo 'service-style-two';
                                  } ?>">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-sm-12 m-auto">
        <div class="heading text-white text-center">
          <h4 class="section-title text-white">Диджитал полного цикла</h4>
          <p>
            Это означает, что мы сможем выполнить любую цифровую задачу: <br />
            видео, маркетинг, реклама, разработка или дизайн.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  SERVICE PARTNER END  -->
<!--  SERVICE AREA START  -->
<section id="service">
  <div class="container">
    <div class="row">
      <?php
      // задаем нужные нам критерии выборки данных из БД
      $query = new WP_Query([
        'posts_per_page' => 6,
        'post_type'      => 'service'
      ]);

      // Цикл
      global $post;

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
      ?>
          <div class="col-lg-4 col-sm-6 col-md-6">
            <div class="service-box">
              <div class="service-img-icon">
                <img src="<?php echo the_post_thumbnail_url() ?>" alt="service-icon" class="img-fluid" />
              </div>
              <div class="service-inner">
                <h4><?php the_title() ?></h4>
                <p>
                  <?php the_excerpt() ?>
                </p>
              </div>
            </div>
          </div>
        <?php
        }
      } else { ?>
        <p>Услуг не найдено</p>
      <?php }

      wp_reset_postdata(); // Сбрасываем $post. Возвращаем оригинальные данные
      ?>
    </div>
  </div>
</section>
<!--  SERVICE AREA END  -->