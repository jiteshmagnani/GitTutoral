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
define( 'DB_NAME', 'clothstore_3' );

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
define( 'AUTH_KEY',         'c]JG6o@l3OBd#yPJS)rgt,gg+H!&1:^rX==$BDv_oE41&!VY ?ax`!E@~Z/4U4M1' );
define( 'SECURE_AUTH_KEY',  '`v{rPstGlEe^7[E]>S$)}^7+QYwmSw_PtkXQ}H9TbM2li9`C627tBQ>V%+iOu`[p' );
define( 'LOGGED_IN_KEY',    'Ti-[Ox!n_a`8:wH|GQ,<g~$FMr^fOpB<2,*jzsiP9Cat>%?KK#Yp) ZlOt(b>Tg!' );
define( 'NONCE_KEY',        'Vygp $LZ5K{9pv~2cm|`ugi,)/dNoVe82^mN^m_+H}hR15H9I~ti^0RVB$BRt>%|' );
define( 'AUTH_SALT',        'lAZQWSnFee.N-*vw/-0I2NJnfka{)imi-4DickM6h3|X(Ae?MYwDuS#wik{fXB]2' );
define( 'SECURE_AUTH_SALT', '}8_Bz* h54ia4R<us[nd#2^P?iu`ebuaZ_G.aX^gLxhHF{Z} Y[,!pE^L{g!SEsK' );
define( 'LOGGED_IN_SALT',   'MzZ.82o77J-Mdqsu)okb{y9Q H/U7]5:oR3 acW,8Bq g6vc1IN]!<2nw7&w /L-' );
define( 'NONCE_SALT',       '^Q_=`SJ: EyHJ*|T6j4z1/Kb @!Yij.G*5{{aZX09$NJWK*u`Rzz}*2.J9=zNbp$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cs_';

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

define( 'DISALLOW_FILE_EDIT', true );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
