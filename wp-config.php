<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sulekha' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '0?hE^b}^zv&IR=3iI)!|}KK.#hcn;S.r{%:W0lan%d#l;#1`F;twI(SE;G:`vD>|' );
define( 'SECURE_AUTH_KEY',  'j]/~XPY+srB|6*y1e&Wn+S45/NeRs:6oFkZL;{jlBkuj[PM`8(|9p;K(kXh7qg*g' );
define( 'LOGGED_IN_KEY',    'sp;tfU>UwsUS_i^aRW?Zc93q9;u(q3ORMc[>x WQeFHMKlFO^uOh.&YQ>ckg9R+1' );
define( 'NONCE_KEY',        '!tqIRc>xXb]K| nBvUU1];#t,H0Ob!gogMnI1[[<lFKq WLN^1aLe]<<UZ-w`d@C' );
define( 'AUTH_SALT',        'B{xRi;5W~%nm;@xekUo!RC]{kkqS#$u8>X3NT0*&.[K`mZR;wz#yp9aiZsB`ZSjP' );
define( 'SECURE_AUTH_SALT', '(MD;oQDWw_TK>!;eY1_]qXU qr1]1~$bE&v`LH,muPxA asq^rqjfn7_qL`u1YJp' );
define( 'LOGGED_IN_SALT',   '>n4GM3L,Bo4QU/vNSqQ;-Mc+B.#O>B,`m`nU/RM|>BQ{KPE8:0g2L4Gcx4R}VXG;' );
define( 'NONCE_SALT',       'kg-dAe-?7BOy#rIi;;HAX B6z?UXjeS&VtYdx+P;d^|=k]Ol9/L=on/*tb*2^r2o' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
