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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/Users/antonandreyev/Development/htdocs/wp-api-example/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'wp-api-example' );

/** MySQL database username */
define( 'DB_USER', 'wp-api-example' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wp-api-example' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'N[)XT@E [L1YY+p.qU48>{eB%g3hf<kl0 xL+9va1?VhH<~C:5fk&m9M%IBNVqQ0' );
define( 'SECURE_AUTH_KEY',  'Bc%Mt#}i]K5ysu_KtY!OyYj$9?=%-HFmwr*;|TW5+N#{S4lHv( P$ %0])T;F7v3' );
define( 'LOGGED_IN_KEY',    ';[IhfL)_fU&VNF`%(3o]z`m%[qF<K [s!2$reLVRU)3 1*1P4aZ~R1@}.@+vD`Ra' );
define( 'NONCE_KEY',        'X#O31#Ax<oN8a4} SKPZ:;xhEX>]tFD@G)v`4V+h}D`uAe)Q`RW1$wJqOI}wU0}q' );
define( 'AUTH_SALT',        'xhe0d^Nw!QkdxBY+H{i26>b7YVD:`&Y5G[c}u a9.PEeLSg%pkRhtx^dT_` Uu8c' );
define( 'SECURE_AUTH_SALT', 'mt,yK}Oi=4$xaT+p)-%/BsL*4GAj3B_3_pKTdegN&6C]M0@>GL9nmO-4l9oG`S=%' );
define( 'LOGGED_IN_SALT',   'Ms`/|H]W/Z}*,#cl?]]fosGK*m.&u:kc$Cg2.b38I,RYAVXmxyBGJ.Q&]+|@l}13' );
define( 'NONCE_SALT',       'J4s/Q~F#u[`S_^W_)=)0K6~uEB>21bI(I{=3U-mI/7X0?$gfr6B$6t9Iy3R9(DO9' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
