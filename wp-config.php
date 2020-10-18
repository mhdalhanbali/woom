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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mohamaddb' );

/** MySQL database username */
define( 'DB_USER', 'mohamad' );

/** MySQL database password */
define( 'DB_PASSWORD', 'mysql' );

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
define( 'AUTH_KEY',         '#&Y qSNQ[{IDY}MHR,9oU6W.6WoEP~yM,F3<wBTf=&tHD{HRyjidSO]S7RTG41z.' );
define( 'SECURE_AUTH_KEY',  'n!^g66g3Gp,jSp,pv&/~!!DmP$gG(WPmxc;( C+c<oQ*pnv>&(dWnnlkH_bS(6e<' );
define( 'LOGGED_IN_KEY',    'Z83pPS;WEp}tHD#GV]HgRg<:8R|$(N]Ed4mN!Yr=a#tP=#(On7?y{II{H|bLWY=[' );
define( 'NONCE_KEY',        '!r<s2s/X_l6/IbWAXOy:*3{2?gr9?=<x 4z^iB`8#PALod44F_outIl})q$ z,vu' );
define( 'AUTH_SALT',        '8<[^Sr{impAeMnA<6Q)_e>v+*@@9FZ#S^az{8%4>^zFB]g~neIk<`#s 5T51$4c]' );
define( 'SECURE_AUTH_SALT', '>IL1H_KxnTCW%,A|I:P_C(>6X81k)c~Ulule0{HiTJ)_=*mH.;$2Yd+{+:~e{R~(' );
define( 'LOGGED_IN_SALT',   '}|x:DhIFi*jFk5`x(VTw0Eps#o78 MK.U((5.W9w0WQ4fOu7F3$doTOhwmQO30wp' );
define( 'NONCE_SALT',       '#= D)ON!o1yc1tgW@Fn-=564=,;*7VXyTc5Uh5y@-`XxOJY(v3{+H<^x=M[JgxG_' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
