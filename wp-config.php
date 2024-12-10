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
define( 'DB_NAME', 'u469285490_SJR0Q' );

/** Database username */
define( 'DB_USER', 'u469285490_VsOCZ' );

/** Database password */
define( 'DB_PASSWORD', 'emLSswigiP' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '!$x0/tUNcf(S0YaQBZXdHe[3$v_,iuiDR2S!%ibB#mSuq/QuiV!=9%Y5O,]Qm;PO' );
define( 'SECURE_AUTH_KEY',   'ZOA%xLN|J{hui&>:&fZ*{VgFp-KrjP*[._a=wNg!J.SK?2OXQ>Q8N<Q8v%(,DGMv' );
define( 'LOGGED_IN_KEY',     'H1l_3u>Y%e$pFymR_bqgmZ|qd}*2+uf<JCx>[Sp^*S+xp T]-EID+Q1}X4;++c_R' );
define( 'NONCE_KEY',         '|kQ&#kWg,6g;#wIrt_b;zwd!Q>.{Mv<jCYV.X>CI{>57K7nl@vb@|=5mRQQYgo>S' );
define( 'AUTH_SALT',         'R%}cN9,_Uu=E(8-Nr#`-nZd@;~R[]-!u{!Y0~2X0<6wGYPk0Xy3<FVRAX}ZMwA/j' );
define( 'SECURE_AUTH_SALT',  'xZwNSgp;RK0~Yv[!X(X2%/%TJM[t#=cf<N2ih/g1LqHAG. WX~vW!CEggK2!2vde' );
define( 'LOGGED_IN_SALT',    'UVi,+3wbE+4:yAaG~veE,dd)0=Z=A@7Sb=Uix~1+ %[wE*.6Hv8Ak5gX=:q$l$*o' );
define( 'NONCE_SALT',        '02KrQOfkSgbVQe^1;d9Dbb/i.H2#HAdwRk&U}DwzlQ~oWj$wqQ@uS7>s8/86ks F' );
define( 'WP_CACHE_KEY_SALT', '6tpXuP20`gMKN>[{N26mQm([(h+~6sIi{A}wXndTWuQ~Q80)a(xcf^ O ntfLg_[' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '8461f9b344552be654de591e05746ec3' );
define( 'WP_AUTO_UPDATE_CORE', false );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
