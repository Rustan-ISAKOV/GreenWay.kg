<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'user23602_green');

/** Имя пользователя MySQL */
define('DB_USER', 'user23602_green');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'user23602_green');

/** Имя сервера MySQL */
define('DB_HOST', '176.126.165.135');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '<l~Mq`MNCg*5m#d=gZV_;|3XzNWRkeMCI6u<w).W lP0idy*.GD{B9+,PSD/^v^|');
define('SECURE_AUTH_KEY',  '?=&-^TCG~&fiNJC?GA.ZV5_:kL|Qy=W+!@atbZv-T5}t08.8!W~lXnR5JhJD{gu*');
define('LOGGED_IN_KEY',    'slqhM@lib_FF[~J:S`&C!$*=L)r?:8>g`q1r8/(~s/wMTAxD&+9_@3A[$I/sqsQ0');
define('NONCE_KEY',        '[M)y5OEexr*:>WTj?AQeI8<[{hD;f&d0A8C2Yw#v<F8p]WCP(N_^^iW7]_6!zJ^C');
define('AUTH_SALT',        '=]6+?hv2X]k V3MbI+ZL]^dUV2v9~h3fH?&&v.>)5QUE*Tx0C~^~n5>>?TxH9iim');
define('SECURE_AUTH_SALT', 'hJ#+WZD2t pX&2Us`sE2/3m3S)^4/X*7rWM:eeT}2I}4B=ClQ=ko:@v,Y8%iX3#v');
define('LOGGED_IN_SALT',   'C{_(R|Z~KX9AsERo(6oYfDcXvdb9!n:8.jA48>MVO!L5NE+L:P4jXB.36B+W}<^(');
define('NONCE_SALT',       ',YAHFc#y]q)nGa~P.?W-B`X3)X:x(=7;KSb8z+T0FrDz$sM$Su3g93}r%tp<nP.u');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'gr_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
