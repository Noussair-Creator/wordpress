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
define('DB_NAME', 'utmsearch_w');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY', '2[{CuBMaN}Y?AqccK|gvH?/=-cR4%4JDZM{>>lr!] $OD{FME7v#O=m*Crv)xlBT');
define('SECURE_AUTH_KEY', '@.U!dlx`lb2;vCUE^ER^6YO6 ,L]QF+d+)K$uXG_85kpO}Df[&6`ky8r?6MC-<uL');
define('LOGGED_IN_KEY', 'I&RV/9N%)WMs&:7`qv/T~$Twl5M&RJfk(pJL~f((YbHTxuk~W9Rqk3X3kJU_;Nr<');
define('NONCE_KEY', 'w7OHpstTX`*vJ+8%51c@Uo4+~>G@(>ZgIu?4Km_u2iB/q? [tmx9(]Rw0Y$(*C4N');
define('AUTH_SALT', 'l4n6R)Qq /9D.9:fa5_SI#&0{(f>-)3T>o_wZP&+mkIo1V4w8|s5p8S`BDQ!c]YV');
define('SECURE_AUTH_SALT', '@Q9}3nmW; +8Bj^(dC4RS[:r6)qdT%U KJ*MjcbQe((69*m1$|?!06e~/UU}zeE0');
define('LOGGED_IN_SALT', '|3cZ7!GFRYaTLD{1>6}VGETgAwqbqVl0KE^<Xk[KvB[uMBhZ>%)~q<E,L$g1w%~y');
define('NONCE_SALT', '}>9j-<,E o=!.rL2irN9,R)TuS*26n0$AS[6_PuY^H%z#TsoQTM/RF^%X=2vd1Ux');

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
$table_prefix = 'utm_';

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
define('WP_DEBUG', false);


define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false); //r ne pas afficher les erreurs à l'écran
@ini_set('display_errors', 0);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';