<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'pass');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'vA/P(q3db#rK6@MY4i.<|O-^@|[;PRN0Ljzy=~f^yG/Xd]}qHho+cn/Q=4j|X]@/');
define('SECURE_AUTH_KEY',  'R6xz+_F;$ Hi%OLUijEiK3]9puh d. h$IVc:{(T~VQnTKz|luYh&t/5J +)MsJ]');
define('LOGGED_IN_KEY',    'tRi1rs1#[GR)M%8,)+uQ|]5VQ:GZy/meDKk!S0J,d%@Z*jVN*V&T|i9ng+[3b]o{');
define('NONCE_KEY',        'B{yfm/;}B|rCU5+mLh(WnCq.,marC_Wc0H#w`e*%pNh~%uLP~ZC-p)rHfajxb`9u');
define('AUTH_SALT',        '((3[B/x[?6U?y!c:j28x<xX--qeS:yDawY{c5Fbp*{CDx[J7r>Nx2v RvL0g5?nt');
define('SECURE_AUTH_SALT', 'ur,2m:$U*Q]1{)e1#f,aRJfIBMR*<mH>[csR+cTK:(4DzAT-|p--q]un_~1F-!WN');
define('LOGGED_IN_SALT',   'G~AInR;jw2&aM0n.>%mG$C_*]Q_ z&Lc+y3axM3mal-f]!.y?[T|ReHtQ_zjQ&81');
define('NONCE_SALT',       'Wo`%_y^HxEeE<-C_}P2j*W<F*=6s D`HL1H9*z3}s]e2Xqq:DdD]W;W92CoJJ55@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
