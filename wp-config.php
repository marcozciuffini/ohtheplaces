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

 * @link https://codex.wordpress.org/Editing_wp-config.php

 *

 * @package WordPress

 */


// ** MySQL settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'marcomsd_wpdb' );


/** MySQL database username */

define( 'DB_USER', 'marcomsd_wpdbuser' );


/** MySQL database password */

define( 'DB_PASSWORD', "%,cKH@FG**KJ" );


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

define( 'AUTH_KEY',         '^Je}v!S`I_$ufU9T.PV<Q-JoxQ9TF01|Mx{Llgg^:Pv pvw?6#9RU//4eD=X2fuo' );

define( 'SECURE_AUTH_KEY',  ':<B[OrZ!z({72Lc)J2dxoH,wr5k05Cj#`YV-CM{EP#dnnU/]#K#lZ,D.<6#6;08V' );

define( 'LOGGED_IN_KEY',    '2pHE}tM@{!tIys*gi~__%LwN5FJ9p&.V@I.xXfZW8ad&5h}X+_-<|nMsr(w*bgo1' );

define( 'NONCE_KEY',        'r6<VavCcrgY{x*e3xs{sG(>?jT{X;Dkei5ujahopd6#}!*x0M7M(=!#9_x6IOE}P' );

define( 'AUTH_SALT',        'U|gxgBC449t|z1r{A!$#/ud%U,p9,,-_c/@r&l7yg.jcXepzPQ&NED|,Vc_H=wQK' );

define( 'SECURE_AUTH_SALT', '%+)w[bAqmFhHc(R+DyBy!!l>j:3JK1P;6gYQz,a|d4&c$/Y-nXERG<UYtH9Ut)Vl' );

define( 'LOGGED_IN_SALT',   ';;~pLo)wns1;#|>##V*+p0:,q[YZl7W[#gCpfW;iN6[y`jEg4b6!l56E,Q*]Uza+' );

define( 'NONCE_SALT',       '1AIMwKaQ:wd0sz+hAz7e7$|Fit0e;azTD5cwDoR@* TJWSPdjz-my-FL[RjDykUp' );


/**#@-*/


/**

 * WordPress Database Table prefix.

 *

 * You can have multiple installations in one database if you give each

 * a unique prefix. Only numbers, letters, and underscores please!

 */

$table_prefix = 'sc30_';


/**

 * For developers: WordPress debugging mode.

 *

 * Change this to true to enable the display of notices during development.

 * It is strongly recommended that plugin and theme developers use WP_DEBUG

 * in their development environments.

 *

 * For information on other constants that can be used for debugging,

 * visit the Codex.

 *

 * @link https://codex.wordpress.org/Debugging_in_WordPress

 */

define( 'WP_DEBUG', false );


/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

}


/** Sets up WordPress vars and included files. */

require_once( ABSPATH . 'wp-settings.php' );

