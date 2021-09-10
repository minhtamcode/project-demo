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
define( 'DB_NAME', 'wp_minhtam' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'JIey!)oy-9]Kz59wd]GO`qdhzYIa Yf3jR3d3X]y@BIA]9]M.MrC}oG@9>K7T7;9' );
define( 'SECURE_AUTH_KEY',  '%gYSr>_Db{y0esVpgDw7@.]DAj3nV6MCuZL%Nik^R>V7M]PuhJQO|7/ZA7-`r2y`' );
define( 'LOGGED_IN_KEY',    '%1zBS*Ka &BE9aSB4_LB*F@Z.(f0KF=eQZA gB&6;QB`LnyLd~`[g7*cs(s4xyY)' );
define( 'NONCE_KEY',        'i`-?B*|vWH&2H%m9wOXY8f(kECgrrxI*]6@W/Sn]5JGfiNCswc00sc8UKWZ1{K(6' );
define( 'AUTH_SALT',        'THG>?o%O-wKu-#np:J^:ZB&nAcUS8$I~U87P<{P-8d/ ,7+Am{PVr-eub!H?t?Vy' );
define( 'SECURE_AUTH_SALT', 'ZwbvVbz0CyDF,%+*@D= p!OxD#BG3T%auq|J1{<m:CZ~P=/!)s-yL^CehdI. L;z' );
define( 'LOGGED_IN_SALT',   '*5F;bP_+8(FD!wTXTcgfF*~O5(j2(:Nd62yNDrPGN}ksCkGu<rXa,<dJk=D5<fwF' );
define( 'NONCE_SALT',       'C=B Y3)xmOt,cP1$;[}p^v*O8+jcj@|3EXUo4G&4zeiCB5s[L?NH=o5**!jYNSA2' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
