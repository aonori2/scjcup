<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cmnfsqpx_crr0z1z' );

/** Database username */
define( 'DB_USER', 'cmnfsqpx_wp_dywbr' );

/** Database password */
define( 'DB_PASSWORD', 'U^zc3~fd*0xZ^V5V' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY', '#hg3gwsw26O7dqK0*54w4!:6:CH;1y)4%dN0*39Ee2]04:q0]Gl)a[4H7~%Xw14&');
define('SECURE_AUTH_KEY', '2_%RH:V)2@fbw8230xCJ)Gzu9Yr83O;5JHI2]-y0w7e#!5/g*p|jl4y8&0VS7/j9');
define('LOGGED_IN_KEY', '8/A~ed%D/[U2Bgw4V5OOXQpp0Gq(ia6:LM-#V)2(Nby7NlcpoUK0L8&/*3E3V/X0');
define('NONCE_KEY', '!]0_JWCCD&6%3vi0DC-F;2A72-s+#@Wn%A9L+fK9pk(e-0k4g5IC6V%DUQ:z!a@e');
define('AUTH_SALT', '5xC+79Dvc0hbzD@w_!cvEw[_63RR;lobH)W@D)lWMUyB]G1[qllK!PbtUJ49L3[X');
define('SECURE_AUTH_SALT', '1~xu4q1cs/e_04-0n|)+;0)kb9v~|Hj2F(9a#&!1kyo~2wll8PP95/ZQxgZ!!~O6');
define('LOGGED_IN_SALT', '8:Y5I9EFB/MU@9973usevj@4ue7b~k6K-B#S|O/oyVTOtzm/kdwj70*6bCDF7H8X');
define('NONCE_SALT', '+X965b);q~AI8BL(/dvk+Z1|Z7Q53[T;3)09_V1YwJ+(M_)(Q3e3]88d2TY%wvA2');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ZDZkNwxu_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
define('WP_AUTO_UPDATE_CORE', false);

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
	#define( 'WP_DEBUG', true );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
