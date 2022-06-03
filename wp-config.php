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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shilapatra_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '`W9oK56y7rQSs{%BX?745c4C5X,*q@|>FBc=~V~ _p{hFj6LTWBa,$-L*!Fiq?lH' );
define( 'SECURE_AUTH_KEY',  'e;l[7N-7acL`rpYom.L4eP)&j{6]60G]qj1ff4sKUr$B7rv}IJV^~l?F8cSd;L[4' );
define( 'LOGGED_IN_KEY',    '5g%KWBMqh5`g!0WsP&kc,I!J%-J4K~R%Q8~3z$_55u2+d.0m:X5SF*dR?t DqSp>' );
define( 'NONCE_KEY',        'A#r-I#mX2ztZ<?C`Lq%DxV}7W*G1wY5e&LyitC:}lbB*A=.{9`xO|Z:grRDH>  =' );
define( 'AUTH_SALT',        'gx~.^A0?Ph 0K-.flwsO2b.C:),Pg+Z6dw#Ywl6?&RS19$~&A8!O..xJ3avo^mL|' );
define( 'SECURE_AUTH_SALT', 'v{T%6{a3wvH(RyhMG#)#-b$+p*2wr%geZ*;db*`pCj;.;*Ox5j]/PKW6_[S^7)0d' );
define( 'LOGGED_IN_SALT',   'sp%j<.HA0hN>C{S_{!44Z:LP={SjV},QoIxuUM.w1EKIBLCkBxu=ONw!3)G<eauQ' );
define( 'NONCE_SALT',       'tJA7e2K*g&,3 ZQ|6h:CiZT+H/r^rnn!ch^0=SW@O:AnwX~yc:YJ~KTr@Yf1nwQD' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sp_';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
