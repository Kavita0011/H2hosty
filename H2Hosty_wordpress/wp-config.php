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
define( 'DB_NAME', 'H2Hosty_wordpress' );

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
define( 'AUTH_KEY',         'i` Xpx<T?L@TR015[:M[7Rl8*:elNN?Q#6sks:#XDS FWLSh^>^Dord|!!HSSfC;' );
define( 'SECURE_AUTH_KEY',  '7oav{],Q2d|AmV3;:*4Vo:gPW@H!`[IM.(dn@Ai@QoLm#Y7c6/R|Q@Cak{^t~W7|' );
define( 'LOGGED_IN_KEY',    'xbV^D}MF|SNQ)D@/9lii(x(<6!#Hi-!3g2t+Yoe-xt75#=JwA|`kROv:v1SrO|>*' );
define( 'NONCE_KEY',        'BgljKuV!p4^Skg{<6EHs,ZwQRtwt,9LWqJIY!JE?$Lh5GY>iv{y6U^c&[6.y_C#~' );
define( 'AUTH_SALT',        '*])J=QId-uyO1b1T/)] zB?uU!A0d~EE^u(J(L_3{/N[D.skF?yWRl3=d&%FHTe]' );
define( 'SECURE_AUTH_SALT', 'V1fJ]}Z:7ruSKQL`A%_:x/=JN4;T$X:E;/XuTBK.qh>R-5T#&t+i!S7 <Fv/30FU' );
define( 'LOGGED_IN_SALT',   'E@K*0ROc!e^+,QXEUFEYtK.osb-*6FQFSg7e-E$i=p![w`HPUU*erd152i|T}N>M' );
define( 'NONCE_SALT',       '(s#btXW4]h93N*o<uQ^gKV=;N?HiVm&7*U4>v_uK~=q1=Ih0aTY&$OHVtZ`}S=Oi' );

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
