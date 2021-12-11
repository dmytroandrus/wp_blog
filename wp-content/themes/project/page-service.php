<?php get_header() ?>
<!--MAIN HEADER AREA END -->

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-service" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php the_title() ?></h1>
          <p>Мы оказываем весь спектр диджитал услуг</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->


<!--  SERVICE BLOCK2 START  -->
<?php the_content() ?>
<!--  SERVICE BLOCK2 END  -->

<?php get_template_part('template-parts/content', 'service', ['class' => 'service-style-two']) ?>
<?php get_template_part('template-parts/content', 'partners') ?>

<!--  PARTNER START  -->

<!--  PARTNER END  -->

<!--  FOOTER AREA START  -->
<?php get_footer() ?>
<!--  FOOTER AREA END  -->