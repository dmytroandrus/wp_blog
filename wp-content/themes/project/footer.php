<section id="footer" class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-sm-8 col-md-8">
        <?php if (!dynamic_sidebar('sidebar-footer-text')) : dynamic_sidebar('sidebar-footer-text');
        endif; ?>
      </div>
      <div class="col-lg-2 col-sm-4 col-md-4">
        <?php
        if (has_nav_menu('footer-left')) {
          wp_nav_menu(
            [
              'theme-location'  => 'footer-left',
              'menu'            => 'footer-left',
              'container'       => 'div',
              'container_class' => 'footer-widget footer-link',
              'menu_class'      => '',
              'menu_id'         => false,
              'echo'            => true,
              'items_wrap'      => '<h4>Информация</h4><ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth'           => 2,
            ]
          );
        } ?>
      </div>

      <div class="col-lg-2 col-sm-6 col-md-6">
        <?php
        if (has_nav_menu('footer-right')) {
          wp_nav_menu(
            [
              'theme-location'  => 'footer-right',
              'menu'            => 'footer-right',
              'container'       => 'div',
              'container_class' => 'footer-widget footer-link',
              'menu_class'      => '',
              'menu_id'         => false,
              'echo'            => true,
              'items_wrap'      => '<h4>Ссылки</h4><ul id="%1$s" class="%2$s">%3$s</ul>',
              'depth'           => 2,
            ]
          );
        } ?>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="footer-widget footer-text">
          <h4>Наши контакты</h4>
          <p class="mail"><span>Email:</span> <?php the_field('email'); ?></p>
          <p><span>Телефон :</span><?php the_field('phone') ?></p>
          <p><span>Адрес:</span> <?php the_field('adress') ?></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="footer-copy">© <?= date('Y ');
                                    echo get_bloginfo('name'); ?> inc. Все права защищены.</div>
      </div>
    </div>
  </div>
</section>