<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'host1587880_nplgroup');

/** Имя пользователя MySQL */
define('DB_USER', 'host1587880');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '64587c1e');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '-P_`+4(jKjX21>_%Ryf2g.E|-=)6#xNk(2QjoCB2ZaQBRjGU;YEQ0#|0:iVqX+:R');
define('SECURE_AUTH_KEY',  'eGhLEgQc6cp`gcXrL}l(A[nt;-{WS$kerN=|mOkW%rncG&|2;`+0i}+omby9liu.');
define('LOGGED_IN_KEY',    'P*WcD=wWOBBGl0!m$*N3L{+_/fH&TZf^Y0te+rK!]B;8v1*jz rrp#8Hxry7ZPZb');
define('NONCE_KEY',        '>=emrT?yR-yRZynS%H3[+~H@*mXY@k#QGJQ~QhWO0-F?[;es:]KbL? )9T^w:AxA');
define('AUTH_SALT',        'acy8j 6ss+d0tEW;h8,AS9YZZ,4rQ!$^LMc:$~0<ImY718fjf[Ee[ll65uKzvAY`');
define('SECURE_AUTH_SALT', 'qA?9[KC,Vy0-([]Im_rF67vp5ie%P@-MT*I-$YRQ*q-O;5D:CyGM!(?Ec||N5/A*');
define('LOGGED_IN_SALT',   ']2c<i,GBd;iF@}S%wln!x*n{Aay+q>PZg&)^Iq*W!-5Y[!K):!6Qn+/Q4WOlKW9L');
define('NONCE_SALT',       'h1v=Wk$e!|bi18K9=>npIlWP Ux|e0LQTZYE0w$jB+i{NYS$Ro{2/f LSxg)-*-M');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');