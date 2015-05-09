<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress 
define ('WPLANG', 'vi_VN');
*/
define('WP_HOME','http://localhost/bietthunhadep.vn/public_html');
define('WP_SITEURL','http://localhost/bietthunhadep.vn/public_html');

define('DB_NAME', 'bietthunhadep');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

//define('DB_NAME', 'goodhope_btvn');
//
///** MySQL database username */
//define('DB_USER', 'goodhope_btvn');
//
///** MySQL database password */
//define('DB_PASSWORD', 'ZEgGUF36');

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
define('AUTH_KEY',         '_o+Uj5c1WJ#n-Q~Mp~+Za.EoS&WP&b_y{cZSy ~F{k>OT:+iKrZVJ 9rdzz/yh7O');
define('SECURE_AUTH_KEY',  '+)hi@&Ux:G:{o{W1A>uLVZ1&GKfm)+m(+CxH%eH0jt Q5ovn0rmG8n~*|!^4K-|7');
define('LOGGED_IN_KEY',    '+7%UvooNX?x=T^8p@PN4#$!}65{}>S6& 2o!LYrL7mehY,J6?q7,$_84%M%oqa-F');
define('NONCE_KEY',        '1*e~$Pi4I;1o4Z1}J)2 riY{m]?@k-w%$E~15y%BF7as>y%F5JFI2F]6:SD!pi|J');
define('AUTH_SALT',        ']c;EZcQ(%3jbpH})W3A|`|?8.XJv+N.M$M@55X@z+oH:{QmCuR88n53wJpQgd-<5');
define('SECURE_AUTH_SALT', 'NwWA:rU,uKcA9|,id{9C[mlpsV~wU@`w%MsOS8xQD$k$P@<-BJy+xzRqyb<lz[0:');
define('LOGGED_IN_SALT',   'Z5c#-,QDlM&$V4Fn|LBiIg<t3(+4|^[MEUYvR0+yJT|eH|vni{DOLi-a#W6ar ]]');
define('NONCE_SALT',       'd3 CQ6<;+TWMFn5%=`d_uzMCQg+`t7#%yX+qHA+d|G1(!)yH393+&j+H_695]4|)');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
