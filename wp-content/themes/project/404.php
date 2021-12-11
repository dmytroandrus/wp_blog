<?php get_header(); ?>
<!--MAIN BANNER AREA START -->
<div class="banner-area banner-3">
  <div class="overlay dark-overlay"></div>
  <div class="d-table">
    <div class="d-table-cell">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
            <div class="banner-content content-padding">
              <h5 class="bg-danger">Ошибка 404</h5>
              <h1 class="banner-title">Такой страницы не&nbsp;существует</h1>
              <p>
                Вы пытаетесь зайти на несуществующую страницу. Возможно она была перемещена или удалена. Попробуйте найти нужную информацию в поиске.
              </p>
              <?php the_widget('WP_Widget_Search'); ?>
              <a href="/" class="btn btn-white btn-circled">Перейти на главную</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<?php get_footer(); ?>