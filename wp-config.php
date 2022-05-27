<?php

/**
 * Composer Autoloader
 */
if (file_exists(__DIR__ . '/../vendor/autoload.php')) :
    $loader = require __DIR__ . '/../vendor/autoload.php';
endif;

/**
 * PHP Dotenv
 */
if (class_exists('Dotenv\\Dotenv')) :
    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
    $dotenv->load();
endif;


/**
 * Custom WP Defines
 */
// define('ALLOW_UNFILTERED_UPLOADS', true); // For uploading SVGs
// define('WP_POST_REVISIONS', 5);
// define('DISABLE_WP_CRON', false);
// define('IS_LOCALHOST', ($_ENV['ENVIRONMENT'] === 'local'));
// const JETPACK_DEV_DEBUG = IS_LOCALHOST;

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */
define('DB_NAME', $_ENV['MYSQL_NAME']);

/** MySQL database username */
define('DB_USER', $_ENV['MYSQL_USER']);

/** MySQL database password */
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD']);

/** MySQL hostname */
define('DB_HOST', $_ENV['MYSQL_HOST']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', $_ENV['MYSQL_CHARSET']);

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         $_ENV['AUTH_KEY']);
define('SECURE_AUTH_KEY',  $_ENV['SECURE_AUTH_KEY']);
define('LOGGED_IN_KEY',    $_ENV['LOGGED_IN_KEY']);
define('NONCE_KEY',        $_ENV['NONCE_KEY']);
define('AUTH_SALT',        $_ENV['AUTH_SALT']);
define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
define('LOGGED_IN_SALT',   $_ENV['LOGGED_IN_SALT']);
define('NONCE_SALT',       $_ENV['NONCE_SALT']);

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

$table_prefix  = $_ENV['MYSQL_PREFIX'];

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

// WP-Debugging
if($_ENV['ENVIRONMENT'] !== 'production') {
    // DEVELOPMENT
    @ini_set('display_errors', 1);
    error_reporting(E_ALL);
    define('WP_DEBUG', false);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', true);
    define('SCRIPT_DEBUG', true);
    define('SAVEQUERIES', true);
    define('FS_METHOD', 'direct');
    define('WP_MEMORY_LIMIT', '256M' );
} else {
    // PRODUCTION
    @ini_set('display_errors', 0);
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
}


/**
 * Define custom wordpress path structure
 */
define('WP_SITEURL', $_ENV['SITEURL']);
define('WP_HOME', $_ENV['HOMEURL']);

// Contend Dir & Url
define('WP_CONTENT_DIR', __DIR__ . '/app');
define('WP_CONTENT_URL', WP_HOME . '/app');

// Plugins Dir
define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
define('WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins');

// MU Plugins Dir
define('WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/common');
define('WPMU_PLUGIN_URL', WP_CONTENT_URL . '/common');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . 'cms/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
