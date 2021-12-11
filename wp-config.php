<?php

/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'project');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'RiAY`)gd$/lcnn3w]jG|.Xk:A[W<U;aYy%<>!zF@Ge0g3W(TqDSN>C2JJmw>gKR*');
define('SECURE_AUTH_KEY',  'ssT,V5VjkM!H#%!?r95}},O<9J/vKM@Xzk(4OJqknU%wZgP]w?&:ZY?%D7+OY%^5');
define('LOGGED_IN_KEY',    '5FjtJi!#0I#Az-xPVE{{U7g6d2=FqWr3L|1 jKi`3lU3)aH*mqp0$dp/e*q#l#!+');
define('NONCE_KEY',        'A0[<ojg|a->4}zPu1m3k!$Z+CwTU0&r?tfI^xNHKe8TJi#/wEOU9,@:X1C$o6en0');
define('AUTH_SALT',        'JC9WpVD[NL`/PCk0o=6ER3%W|el{hgIGQj<k-M2sBZ}&<-2:;8S %&3iqdG~YH~,');
define('SECURE_AUTH_SALT', 'fwwmv`h}eCsmh]+F,2@<HeFuU]Zx<HX4AP{uvQs}%I3d`L.2F>;4Orh?gR|^*KfF');
define('LOGGED_IN_SALT',   'VW3&/@ryMf%=sp^z&I(xe(b=8(A]E_~)waDw|_t{M;uqHWfkeljvI#($6r1_Iii~');
define('NONCE_SALT',       'RNhqsk>j%eMIBdW/E s-Nzc|)#eGlRA+J-cJ!mX3!;VVcZU#Y)t[#j;~WlOf!^7d');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
