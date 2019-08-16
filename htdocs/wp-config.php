<?php
#Load composer libraries
require_once(dirname(__DIR__) . '/vendor/autoload.php');

$root_dir = dirname(__DIR__);
$webroot_dir = $root_dir . '/htdocs';

/**
 * DB settings
 */
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_HOST', getenv('DB_HOST') ? getenv('DB_HOST') : 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix = getenv('DB_PREFIX') ? getenv('DB_PREFIX') : 'wp_';

/**
 * WordPress Localized Language
 */
define('WPLANG', 'fi');

/**
 * Content Directory is moved out of the wp-core.
 */
define('CONTENT_DIR', '/wp-content');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', CONTENT_DIR);

/**
 * Authentication Unique Keys and Salts
 */
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

/**
 * SSL Admin
 */
define('FORCE_SSL_ADMIN', true);
#Prevent redirect loop because we are behind reverse proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
      $_SERVER['HTTPS']='on';
#Seravo https-domain-alias plugin
if (getenv('HTTPS_DOMAIN_ALIAS'))
  define('HTTPS_DOMAIN_ALIAS', getenv('HTTPS_DOMAIN_ALIAS'));

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', true);
define('DISALLOW_FILE_EDIT', true);

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

//Log error data but don't show it in the frontend.
ini_set('log_errors', 'On');
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
ini_set('error_log', '/data/log/php-error.log');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
  define('ABSPATH', $webroot_dir . '/wordpress/');
}

require_once(ABSPATH . 'wp-settings.php');
