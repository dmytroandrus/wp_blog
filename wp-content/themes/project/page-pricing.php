<?php get_header() ?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white">Цены на услуги</h1>
          <p>Подберите подходящий тариф</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<!-- PRICE AREA START  -->
<?php get_template_part('template-parts/content', 'pricing') ?>
<!-- PRICE AREA END  -->
<!--  TESTIMONIAL AREA START  -->
<?php get_template_part('template-parts/content', 'testimonial', ['custom_title' => 'Клиенты, которые доверяют нам', 'custom_description' => '']) ?>
<!--  TESTIMONIAL AREA END  -->
<!--  PARTNER START  -->
<?php get_template_part('template-parts/content', 'partners') ?>
<!--  PARTNER END  -->

<?php get_footer() ?>