<section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-center text-lg-left">
        <div class="mb-5">
          <h3 class="mb-2">Эти компании доверяют нам</h3>
          <p>Компании, с которыми мы работаем давно</p>
        </div>
      </div>
    </div>

    <div class="row">
      <?php
      // задаем нужные нам критерии выборки данных из БД
      $query = new WP_Query([
        'posts_per_page' => 4,
        'post_type'      => 'partners'
      ]);

      // Цикл
      global $post;

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post(); ?>
          <div class="col-lg-3 col-sm-6 col-md-3 text-center">
            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="partner" class="img-fluid" />
          </div>
        <?php
        }
      } else { ?>
        <p>Партнеров не найдено</p>
      <?php }

      wp_reset_postdata(); // Сбрасываем $post. Возвращаем оригинальные данные
      ?>
    </div>
  </div>
  </section>