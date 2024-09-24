<?php
/**
//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'Z5Mxwpn5Kfb76EnhqF3Xch1406T800U2Vtm5jL6hwqs21mwvy1JN4EKvk9orOGwP');
//END Really Simple Security key
**/
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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wp_user' );

/** Database password */
define( 'DB_PASSWORD', 'wp_password' );

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
define( 'AUTH_KEY',         'wV/RTB}U#%:E|/os9%~fW?$k!ZbVWBe4e k)g4{WYMB]pZ}bzm/^(b@2m+8CzaZs' );
define( 'SECURE_AUTH_KEY',  'J@-ZD9*-J[j5iuI1>0%ZnahUf73qB0TjlX+drMPhP%S3pDn=,6dC+^-^&F>L(=Qj' );
define( 'LOGGED_IN_KEY',    'opDde zr3dyFZQSO8rQZvFnZ]LD]OfLN]W1^efgMT.vf5nT< .*b[s4D]~ofO5#)' );
define( 'NONCE_KEY',        '[TayFc 7@O;OPX@2Gb<vlyEQ-JURGm<1id;_DM^BK8dVId0WAb*%j%kNGV$:d8Vt' );
define( 'AUTH_SALT',        '4Y16z;~~]G$f;3cL&&f+P$>Ea0esjoR+X![OMn>jBb Cyc~D~+1~E#SQA9|nGv$o' );
define( 'SECURE_AUTH_SALT', 'to;S.1r31w ,jnPqrw*y#uK[D>^^}Fah{SxBWl5q^0N!F}z=?F^WC+e wzdHPTnK' );
define( 'LOGGED_IN_SALT',   ';N3-&oe8%|__zp^< O$yYVnZ*.{c6J!q6p`Fhb8oa5~PLJ8,I@LCY8I(f3/W|V!P' );
define( 'NONCE_SALT',       'JynvH|#d,%,G])!E7[>&*y@@$[b>70UU~ErK`lI#<Hf%NC;t#Fk^$HWq4}.N`[;v' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_project';

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
define( 'CONCATENATE_SCRIPTS', false );
define( 'SCRIPT_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define('WP_HOME','http://test.sumit.com' );
define('WP_SITEURL','http://test.sumit.com' );
