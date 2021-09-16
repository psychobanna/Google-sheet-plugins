<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

@ini_set( 'upload_max_filesize' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );
 

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'den' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LI,7eNm|Rb=iNIE`BPR-phwgr%|PN*lEi6B8W+oY}v.P&v6s#qycS:gWBc6u/G21' );
define( 'SECURE_AUTH_KEY',  'i%)D}pgR! VeN_]z.Tnvx?T(kaN!O6Jm~~=,Hb~FWZU6G5@7Z:8T1}^o{Ube4C!r' );
define( 'LOGGED_IN_KEY',    '1dn/MMig256]sFsmZls*S?eO=|es&]vi4`g]1+tKeN=e=X;Hj{$p~Y`{s*;}TX5#' );
define( 'NONCE_KEY',        '[u3q^]*L`{FBF.ht &t8s=-;tV(g]<7I&S^<<@3/hB~F<3ZM9lw)J#2)s4HP3w!:' );
define( 'AUTH_SALT',        'qyI<6Y#h_e+K!Mt!MXS^[JJ5Wj~PgTxV 8^s[Ds4d&W-jIViHG{9!9XfrG5$)t;,' );
define( 'SECURE_AUTH_SALT', 'K0j&)_)lJMdk_decYy<*Mi=DY3u&?9EHyX2c.88HSC{MNp=xRK8o`Hrmb4B<2`Z_' );
define( 'LOGGED_IN_SALT',   '4.Oj)eN=)~Bm &^ L(WgKHA^L4hk%2-`p~uS3=lx?<n*GrQt$1y_0usQ$VHwyy$?' );
define( 'NONCE_SALT',       '{_JR9iBI1<ffz$E9kp8%&RLkc+f(E;:u3evYq{_0GJboghf1qq|oa*GE;z};W{Sx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', true );

define('FS_METHOD', 'direct');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
