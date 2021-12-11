<?php

if (!function_exists('project_setup')) {
  function project_setup()
  {
    // пользовательский логотип
    add_theme_support('custom-logo', [
      'height'      => 50,
      'width'       => 130,
      'flex-width'  => false,
      'flex-height' => false,
      'header-text' => '',
      'unlink-homepage-logo' => false, // WP 5.5
    ]);
    // динамический тег title
    add_theme_support('title-tag');
    // изображения к записи
    add_theme_support('post-thumbnails');
    // html 5 tags
    add_theme_support('html5', array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
      'script',
      'style',
    ));
  }
  add_action('after_setup_theme', 'project_setup');
}

/* 
Подключение стилей и скриптов
*/
add_action('wp_enqueue_scripts', 'project_scripts');

function project_scripts()
{
  wp_enqueue_style('main', get_stylesheet_uri());
  //bootstrap.min css
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array('main'), null);
  //icofont Css
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array('main'), null);
  // animate.css
  wp_enqueue_style('animate-css', get_template_directory_uri() . '/plugins/animate-css/animate.css', array('main'), null);
  // icofont
  wp_enqueue_style('icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array('main'), null);

  wp_enqueue_style('project', get_template_directory_uri() . '/css/style.css', array('icofont'), null);

  // Footer
  // переподключаем jquery
  // wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
  wp_enqueue_script('jquery');

  // popper
  wp_enqueue_script('popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js');
  // bootstrap
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js');
  // woow animtaion
  wp_enqueue_script('wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js');
  wp_enqueue_script('easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js');
  // counterup
  wp_enqueue_script('waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js');
  wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js');
  // Google Map
  wp_enqueue_script('gmap3', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js');
  // Contact Form
  wp_enqueue_script('contact', get_template_directory_uri() . '/plugins/form/contact.js');
  wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js');
}

// регистрируем области меню
function project_menus()
{
  $locations = array(
    'header' => __('Header Menu', 'project'),
    'footer-left' => __('Footer Left Menu', 'project'),
    'footer-right' => __('Footer Right Menu', 'project'),
  );
  register_nav_menus($locations);
}

add_action('after_setup_theme', 'project_menus');

class bootstrap_4_walker_nav_menu extends Walker_Nav_menu
{

  function start_lvl(&$output, $depth = 0, $args = NULL)
  { // ul
    $indent = str_repeat("\t", $depth); // indents the outputted HTML
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  { // li a span

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $attributes .= ($args->walker->has_children) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

    $item_output = $args->before;
    $item_output .= ($depth > 0) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// widget
add_action('widgets_init', 'register_projects_widgets');
function register_projects_widgets()
{
  register_sidebar(array(
    'name'          => sprintf(__('Сайдбар блога'), 'project'),
    'id'            => "sidebar-blog",
    'description'   => '',
    'class'         => '',
    'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
    'after_widget'  => "</section>\n",
    'before_title'  => '<h5 class="widget-title mb-3">',
    'after_title'   => "</h5>\n",
    'before_sidebar' => '', // WP 5.6
    'after_sidebar'  => '', // WP 5.6
  ));
  register_sidebar(array(
    'name'          => sprintf(__('Сайдбар в подвале'), 'project'),
    'id'            => "sidebar-footer-text",
    'before_widget' => '<div class="footer-widget footer-link %2$s">',
    'after_widget'  => "</div>\n",
    'before_title'  => '<h4 class="widget-title mb-3">',
    'after_title'   => "</h4>\n",
    'before_sidebar' => '', // WP 5.6
    'after_sidebar'  => '', // WP 5.6
  ));
  // register_sidebar(array(
  //   'name'          => sprintf(__('Контакты в подвале'), 'project'),
  //   'id'            => "sidebar-footer-contacts",
  //   'before_widget' => '<div class="footer-widget footer-text %2$s">',
  //   'after_widget'  => "</div>\n",
  //   'before_title'  => '<h4 class="widget-title mb-3">',
  //   'after_title'   => "</h4>\n",
  //   'before_sidebar' => '', // WP 5.6
  //   'after_sidebar'  => '', // WP 5.6
  // ));
}



/**
 * Добавление нового виджета Download_Widget.
 */
class Download_Widget extends WP_Widget
{

  // Регистрация виджета используя основной класс
  function __construct()
  {
    // вызов конструктора выглядит так:
    // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct(
      'download_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_widget
      'Полезные файлы',
      array('description' => 'Добавьте ссылку на полезный файл', 'classname' => 'download')
    );

    // скрипты/стили виджета, только если он активен
    if (is_active_widget(false, false, $this->id_base) || is_customize_preview()) {
      add_action('wp_enqueue_scripts', array($this, 'add_download_widget_scripts'));
      add_action('wp_head', array($this, 'add_download_widget_style'));
    }
  }

  /**
   * Вывод виджета во Фронт-энде
   *
   * @param array $args     аргументы виджета.
   * @param array $instance сохраненные данные из настроек
   */
  function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $file = $instance['file'];
    $file_name = $instance['file_name'];

    echo $args['before_widget'];
    if (!empty($title)) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<a href="' . $file . '"><i class="fa fa-file-pdf"></i>' . $file_name . '</a>';
    echo $args['after_widget'];
  }

  /**
   * Админ-часть виджета
   *
   * @param array $instance сохраненные данные из настроек
   */
  function form($instance)
  {
    $title = @$instance['title'] ?: 'Файлы для скачивания';
    $file = @$instance['file'] ?: 'URL файла';
    $file_name = @$instance['file_name'] ?: 'Название файла';

?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('file'); ?>"><?php _e('Ссылка на файл:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file'); ?>" name="<?php echo $this->get_field_name('file'); ?>" type="text" value="<?php echo esc_attr($file); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('file_name'); ?>"><?php _e('Название файла:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file_name'); ?>" name="<?php echo $this->get_field_name('file_name'); ?>" type="text" value="<?php echo esc_attr($file_name); ?>">
    </p>
  <?php
  }

  /**
   * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance новые настройки
   * @param array $old_instance предыдущие настройки
   *
   * @return array данные которые будут сохранены
   */
  function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['file'] = (!empty($new_instance['file'])) ? strip_tags($new_instance['file']) : '';
    $instance['file_name'] = (!empty($new_instance['file_name'])) ? strip_tags($new_instance['file_name']) : '';

    return $instance;
  }

  // скрипт виджета
  function add_download_widget_scripts()
  {
    // фильтр чтобы можно было отключить скрипты
    if (!apply_filters('show_download_widget_script', true, $this->id_base))
      return;

    $theme_url = get_stylesheet_directory_uri();

    wp_enqueue_script('download_widget_script', $theme_url . '/js/download_widget_script.js');
  }

  // стили виджета
  function add_download_widget_style()
  {
    // фильтр чтобы можно было отключить стили
    if (!apply_filters('show_download_widget_style', true, $this->id_base))
      return;
  ?>
    <style type="text/css">
      .download_widget a {
        display: inline;
      }
    </style>
  <?php
  }
}
// конец класса Download_Widget

// регистрация Download_Widget в WordPress
function download_widget()
{
  register_widget('Download_Widget');
}
add_action('widgets_init', 'download_widget');


// Шаблон для комментариев
class Bootstrap_Walker_Comment extends Walker
{

  /**
   * What the class handles.
   *
   * @since 2.7.0
   * @var string
   *
   * @see Walker::$tree_type
   */
  public $tree_type = 'comment';

  /**
   * Database fields to use.
   *
   * @since 2.7.0
   * @var array
   *
   * @see Walker::$db_fields
   * @todo Decouple this
   */
  public $db_fields = array(
    'parent' => 'comment_parent',
    'id'     => 'comment_ID',
  );

  /**
   * Starts the list before the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::start_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
   */
  public function start_lvl(&$output, $depth = 0, $args = array())
  {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= '<ol class="children">' . "\n";
        break;
      case 'ul':
      default:
        $output .= '<ul class="children">' . "\n";
        break;
    }
  }

  /**
   * Ends the list of items after the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::end_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
   *                       Default empty array.
   */
  public function end_lvl(&$output, $depth = 0, $args = array())
  {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= "</ol><!-- .children -->\n";
        break;
      case 'ul':
      default:
        $output .= "</ul><!-- .children -->\n";
        break;
    }
  }

  /**
   * Traverses elements to create list from elements.
   *
   * This function is designed to enhance Walker::display_element() to
   * display children of higher nesting levels than selected inline on
   * the highest depth level displayed. This prevents them being orphaned
   * at the end of the comment list.
   *
   * Example: max_depth = 2, with 5 levels of nested content.
   *     1
   *      1.1
   *        1.1.1
   *        1.1.1.1
   *        1.1.1.1.1
   *        1.1.2
   *        1.1.2.1
   *     2
   *      2.2
   *
   * @since 2.7.0
   *
   * @see Walker::display_element()
   * @see wp_list_comments()
   *
   * @param WP_Comment $element           Comment data object.
   * @param array      $children_elements List of elements to continue traversing. Passed by reference.
   * @param int        $max_depth         Max depth to traverse.
   * @param int        $depth             Depth of the current element.
   * @param array      $args              An array of arguments.
   * @param string     $output            Used to append additional content. Passed by reference.
   */
  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];
    $id       = $element->$id_field;

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

    /*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
    if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
      foreach ($children_elements[$id] as $child) {
        $this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);
      }

      unset($children_elements[$id]);
    }
  }

  /**
   * Starts the element output.
   *
   * @since 2.7.0
   *
   * @see Walker::start_el()
   * @see wp_list_comments()
   * @global int        $comment_depth
   * @global WP_Comment $comment       Global comment object.
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment Comment data object.
   * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   * @param int        $id      Optional. ID of the current comment. Default 0 (unused).
   */
  public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
  {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment']       = $comment;

    if (!empty($args['callback'])) {
      ob_start();
      call_user_func($args['callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }

    if ('comment' === $comment->comment_type) {
      add_filter('comment_text', array($this, 'filter_comment_text'), 40, 2);
    }

    if (('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) && $args['short_ping']) {
      ob_start();
      $this->ping($comment, $depth, $args);
      $output .= ob_get_clean();
    } elseif ('html5' === $args['format']) {
      ob_start();
      $this->html5_comment($comment, $depth, $args);
      $output .= ob_get_clean();
    } else {
      ob_start();
      $this->comment($comment, $depth, $args);
      $output .= ob_get_clean();
    }

    if ('comment' === $comment->comment_type) {
      remove_filter('comment_text', array($this, 'filter_comment_text'), 40);
    }
  }

  /**
   * Ends the element output, if needed.
   *
   * @since 2.7.0
   *
   * @see Walker::end_el()
   * @see wp_list_comments()
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment The current comment object. Default current comment.
   * @param int        $depth   Optional. Depth of the current comment. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   */
  public function end_el(&$output, $comment, $depth = 0, $args = array())
  {
    if (!empty($args['end-callback'])) {
      ob_start();
      call_user_func($args['end-callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }
    if ('div' === $args['style']) {
      $output .= "</div><!-- #comment-## -->\n";
    } else {
      $output .= "</li><!-- #comment-## -->\n";
    }
  }

  /**
   * Outputs a pingback comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment The comment object.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function ping($comment, $depth, $args)
  {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
  ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('', $comment); ?>>
      <div class="comment-body">
        <?php _e('Pingback:'); ?> <?php comment_author_link($comment); ?> <?php edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>'); ?>
      </div>
    <?php
  }

  /**
   * Filters the comment text.
   *
   * Removes links from the pending comment's text if the commenter did not consent
   * to the comment cookies.
   *
   * @since 5.4.2
   *
   * @param string          $comment_text Text of the current comment.
   * @param WP_Comment|null $comment      The comment object. Null if not found.
   * @return string Filtered text of the current comment.
   */
  public function filter_comment_text($comment_text, $comment)
  {
    $commenter          = wp_get_current_commenter();
    $show_pending_links = !empty($commenter['comment_author']);

    if ($comment && '0' == $comment->comment_approved && !$show_pending_links) {
      $comment_text = wp_kses($comment_text, array());
    }

    return $comment_text;
  }

  /**
   * Outputs a single comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment Comment to display.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function comment($comment, $depth, $args)
  {
    if ('div' === $args['style']) {
      $tag       = 'div';
      $add_below = 'comment';
    } else {
      $tag       = 'li';
      $add_below = 'div-comment';
    }

    $commenter          = wp_get_current_commenter();
    $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

    if ($commenter['comment_author_email']) {
      $moderation_note = __('Your comment is awaiting moderation.');
    } else {
      $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.');
    }
    ?>
      <<?php echo $tag; ?> <?php comment_class($this->has_children ? 'parent' : '', $comment); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ('div' !== $args['style']) : ?>
          <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
          <?php endif; ?>
          <div class="comment-author vcard">
            <?php
            if (0 != $args['avatar_size']) {
              echo get_avatar($comment, $args['avatar_size']);
            }
            ?>
            <?php
            $comment_author = get_comment_author_link($comment);

            if ('0' == $comment->comment_approved && !$show_pending_links) {
              $comment_author = get_comment_author($comment);
            }

            printf(
              /* translators: %s: Comment author link. */
              __('%s <span class="says">says:</span>'),
              sprintf('<cite class="fn">%s</cite>', $comment_author)
            );
            ?>
          </div>
          <?php if ('0' == $comment->comment_approved) : ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <br />
          <?php endif; ?>

          <div class="comment-meta commentmetadata">
            <?php
            printf(
              '<a href="%s">%s</a>',
              esc_url(get_comment_link($comment, $args)),
              sprintf(
                /* translators: 1: Comment date, 2: Comment time. */
                __('%1$s at %2$s'),
                get_comment_date('', $comment),
                get_comment_time()
              )
            );

            edit_comment_link(__('(Edit)'), ' &nbsp;&nbsp;', '');
            ?>
          </div>

          <?php
          comment_text(
            $comment,
            array_merge(
              $args,
              array(
                'add_below' => $add_below,
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
              )
            )
          );
          ?>

          <?php
          comment_reply_link(
            array_merge(
              $args,
              array(
                'add_below' => $add_below,
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<div class="reply">',
                'after'     => '</div>',
              )
            )
          );
          ?>

          <?php if ('div' !== $args['style']) : ?>
          </div>
        <?php endif; ?>
      <?php
    }

    /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args)
    {
      $tag = ('div' === $args['style']) ? 'div' : 'li';

      $commenter          = wp_get_current_commenter();
      $show_pending_links = !empty($commenter['comment_author']);

      if ($commenter['comment_author_email']) {
        $moderation_note = __('Ваш комментарий в процессе модерации.');
      } else {
        $moderation_note = __('Ваш комментарий в процессе модерации. Это превью; Ваш комментарий опубликуется после проверки');
      }
      ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
          <article id="div-comment-<?php comment_ID(); ?>" class="media mb-4">
            <?php
            if (0 != $args['avatar_size']) {
              echo get_avatar($comment, $args['avatar_size'], 'mystery', '', array('class' => 'img-fluid d-flex mr-4 rounded',));
            }
            ?>
            <footer class="comment-meta">

              <?php
              $comment_author = get_comment_author_link($comment);

              if ('0' == $comment->comment_approved && !$show_pending_links) {
                $comment_author = get_comment_author($comment);
              }

              printf(
                /* translators: %s: Comment author link. */
                __('%s'),
                sprintf('<h5>%s</h5>', $comment_author)
              );
              ?>

              <div class="comment-metadata">
                <?php
                printf(
                  '<a href="%s" class="text-muted"><time datetime="%s">%s</time></a>',
                  esc_url(get_comment_link($comment, $args)),
                  get_comment_time(''),
                  sprintf(
                    /* translators: 1: Comment date, 2: Comment time. */
                    __('%1$s at %2$s'),
                    get_comment_date('j F Y', $comment),
                    get_comment_time()
                  )
                );

                edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>');
                ?>
              </div><!-- .comment-metadata -->

              <?php if ('0' == $comment->comment_approved) : ?>
                <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
              <?php endif; ?>
              <div class="mt-2">
                <?php comment_text(); ?>
              </div><!-- .mt-2 -->
              <?php
              if ('1' == $comment->comment_approved || $show_pending_links) {
                comment_reply_link(
                  array_merge(
                    $args,
                    array(
                      'add_below' => 'div-comment',
                      'depth'     => $depth,
                      'max_depth' => $args['max_depth'],
                      'before'    => '<div class="reply">',
                      'after'     => '</div>',
                    )
                  )
                );
              }
              ?>
            </footer><!-- .comment-meta -->


          </article><!-- .comment-body -->
      <?php
    }
  }

  // Регистрируем тип записи - услуги
  add_action('init', 'register_post_services');
  function register_post_services()
  {
    register_post_type('service', [
      'label'  => null,
      'labels' => [
        'name'               => __('Услуги'), // основное название для типа записи
        'singular_name'      => __('Услуга'), // название для одной записи этого типа
        'add_new'            => __('Добавить новую'), // для добавления новой записи
        'add_new_item'       => __('Добавление услуги'), // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => __('Редактирование услуги'), // для редактирования типа записи
        'new_item'           => __('Новая услуга'), // текст новой записи
        'view_item'          => __('Смотреть услугу'), // для просмотра записи этого типа.
        'search_items'       => __('Искать услугу'), // для поиска по этим типам записи
        'not_found'          => __('Услуг не найдено'), // если в результате поиска ничего не было найдено
        'not_found_in_trash' => __('Услуг не найдено в корзине'), // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => __('Услуги'), // название меню
      ],

      'public'              => true,
      'publicly_queryable'  => true, // зависит от public
      'show_ui'             => true, // зависит от public
      'show_in_menu'        => true, // показывать ли в меню адмнки
      'show_in_rest'        => null, // добавить в REST API. C WP 4.7
      'rest_base'           => null, // $post_type. C WP 4.7
      'menu_position'       => 5,
      'menu_icon'           => 'dashicons-admin-tools',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => ['title', 'editor', 'author', 'thumbnail', 'excerpt'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
      'taxonomies'          => [],
      'has_archive'         => true,
      'rewrite'             => true,
      'query_var'           => true,
    ]);
  }

  // Регистрируем тип записи - партнеры
  add_action('init', 'register_post_partners');
  function register_post_partners()
  {
    register_post_type('partners', [
      'label'  => null,
      'labels' =>
      [
        'name'               => __('Партнеры'), // основное название для типа записи
        'singular_name'      => __('Партнер'), // название для одной записи этого типа
        'add_new'            => __('Добавить партнера'), // для добавления новой записи
        'add_new_item'       => __('Добавление партнера'), // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => __('Редактирование партнера'), // для редактирования типа записи
        'new_item'           => __('Новый партнер'), // текст новой записи
        'view_item'          => __('Смотреть партнера'), // для просмотра записи этого типа.
        'search_items'       => __('Искать партнера'), // для поиска по этим типам записи
        'not_found'          => __('Партнеров не найдено'), // если в результате поиска ничего не было найдено
        'not_found_in_trash' => __('Партнеров не найдено в корзине'), // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => __('Партнеры'), // название меню
      ],
      'public'              => true,
      'publicly_queryable'  => true, // зависит от public
      'show_ui'             => true, // зависит от public
      'show_in_menu'        => true, // показывать ли в меню адмнки
      'show_in_rest'        => null, // добавить в REST API. C WP 4.7
      'rest_base'           => null, // $post_type. C WP 4.7
      'menu_position'       => 6,
      'menu_icon'           => 'dashicons-businessperson',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => ['title', 'editor', 'author', 'thumbnail', 'excerpt'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
      'taxonomies'          => [],
      'has_archive'         => true,
      'rewrite'             => true,
      'query_var'           => true,
    ]);
  }

  // Регистрируем тип записи - тарифы
  add_action('init', 'register_post_rates');
  function register_post_rates()
  {
    register_post_type('rates', [
      'label'  => null,
      'labels' =>
      [
        'name'               => __('Тарифы'), // основное название для типа записи
        'singular_name'      => __('Тариф'), // название для одной записи этого типа
        'add_new'            => __('Добавить тариф'), // для добавления новой записи
        'add_new_item'       => __('Добавление тарифа'), // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => __('Редактирование тарифа'), // для редактирования типа записи
        'new_item'           => __('Новый тариф'), // текст новой записи
        'view_item'          => __('Смотреть тариф'), // для просмотра записи этого типа.
        'search_items'       => __('Искать тариф'), // для поиска по этим типам записи
        'not_found'          => __('Тарифов не найдено'), // если в результате поиска ничего не было найдено
        'not_found_in_trash' => __('Тарифов не найдено в корзине'), // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => __('Тарифы'), // название меню
      ],
      'public'              => true,
      'publicly_queryable'  => true, // зависит от public
      'show_ui'             => true, // зависит от public
      'show_in_menu'        => true, // показывать ли в меню адмнки
      'show_in_rest'        => null, // добавить в REST API. C WP 4.7
      'rest_base'           => null, // $post_type. C WP 4.7
      'menu_position'       => 7,
      'menu_icon'           => 'dashicons-money-alt',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
      'taxonomies'          => [],
      'has_archive'         => true,
      'rewrite'             => true,
      'query_var'           => true,
    ]);
  }

  // Регистрируем тип записи - отзывы
  add_action('init', 'register_post_testimonial');
  function register_post_testimonial()
  {
    register_post_type('testimonial', [
      'label'  => null,
      'labels' =>
      [
        'name'               => __('Отзывы'), // основное название для типа записи
        'singular_name'      => __('Отзыв'), // название для одной записи этого типа
        'add_new'            => __('Добавить отзыв'), // для добавления новой записи
        'add_new_item'       => __('Добавление отзыва'), // заголовка у вновь создаваемой записи в админ-панели.
        'edit_item'          => __('Редактирование отзыва'), // для редактирования типа записи
        'new_item'           => __('Новый отзыв'), // текст новой записи
        'view_item'          => __('Смотреть отзыв'), // для просмотра записи этого типа.
        'search_items'       => __('Искать отзыв'), // для поиска по этим типам записи
        'not_found'          => __('Отзывов не найдено'), // если в результате поиска ничего не было найдено
        'not_found_in_trash' => __('Отзывов не найдено в корзине'), // если не было найдено в корзине
        'parent_item_colon'  => '', // для родителей (у древовидных типов)
        'menu_name'          => __('Отзывы'), // название меню
      ],
      'public'              => true,
      'publicly_queryable'  => true, // зависит от public
      'show_ui'             => true, // зависит от public
      'show_in_menu'        => true, // показывать ли в меню адмнки
      'show_in_rest'        => null, // добавить в REST API. C WP 4.7
      'rest_base'           => null, // $post_type. C WP 4.7
      'menu_position'       => 8,
      'menu_icon'           => 'dashicons-testimonial',
      'capability_type'     => 'post',
      'hierarchical'        => false,
      'supports'            => ['title', 'thumbnail', 'excerpt', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
      'taxonomies'          => [],
      'has_archive'         => true,
      'rewrite'             => true,
      'query_var'           => true,
    ]);
  }

  // add_action('wp_ajax_my_action', 'my_action_callback');
  // add_action('wp_ajax_nopriv_my_action', 'my_action_callback');

  // function my_action_callback()
  // {

  //   if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //     // email администратора
  //     $mail_to = get_option('admin_email');

  //     // данные из формы
  //     $phone = trim($_POST["phone"]);
  //     $name = (trim($_POST["name"]));
  //     $email = (trim($_POST["email"]));
  //     $message = trim($_POST["message"]);

  //     if (empty($name) or !filter_var($email, FILTER_VALIDATE_EMAIL) or empty($phone) or empty($message)) {
  //       // Ошибка 400
  //       http_response_code(400);
  //       echo "Пожалуйста, заполните все поля";
  //       exit;
  //     }

  //     // содержимое письма
  //     $subject = 'Заявка с сайта ' /*. bloginfo('name')*/;
  //     $content = "Имя: $name\n";
  //     $content .= "Email: $email\n\n";
  //     $content .= "Сообщение:\n$message\n";

  //     // заголовки письма
  //     $headers = "From: $name <$email>";

  //     // отправка письма
  //     $success = mail($mail_to, $subject, $content, $headers);
  //     if ($success) {
  //       # Set a 200 (okay) response code.
  //       http_response_code(200);
  //       echo "<script>alert('Ваше сообщение успешно отправлено');
  //       window.location.replace('" . get_template_directory_uri() . "');
  //       </script>";
  //       // header('Location:' . get_template_directory_uri());
  //     } else {
  //       # Set a 500 (internal server error) response code.
  //       http_response_code(500);
  //       echo "Упс! Что-то пошло не так, не получилось отправить сообщение";
  //     }
  //   } else {
  //     # Not a POST request, set a 403 (forbidden) response code.
  //     http_response_code(403);
  //     echo "Не получилось отправить, попробуйте позже";
  //   }
  //   // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
  //   wp_die();
  // }
      ?>