<?php
//define('WP_HOME','http://WWW.DOMAIN.COM');
//define('WP_SITEURL','http://WWW.DOMAIN.COM');
define('UPLOADS', 'assets'); // Define website URL assets folder
define('DISALLOW_FILE_EDIT', true);

/* Define FTP connection info */
/*
define('FTP_HOST', '');
define('FTP_USER', '');
define('FTP_PASS', '!');
define('FTP_METHOD', 'ftpext');
*/



// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
 define('AUTH_KEY',         '/|uZbM5uN}d5t:).lL+9t4CB$=-SrMuUP?-uTO/D[g&%D[k#>z`agp.8m,a-9bG7');
 define('SECURE_AUTH_KEY',  'G`=@++]B r&8Vgd|M=IXhr6D (0`cwH6 B6%:,rftlpu<F+-T+=C>Qh$I)Tr!8`t');
 define('LOGGED_IN_KEY',    '.!++j:tCJa1oU1un?I?_WV=i+*o23A(sw>FC+W&b5t.-wbd#GDu}p_7Tr+iHz+ff');
 define('NONCE_KEY',        'E-k%iH&p+`b9Za}%xwj[4=BI{AuFaKnUo:WOii:2/4>o*+2=ioeN|Fj[tXW)-4oV');
 define('AUTH_SALT',        ',_rjxZ%0I+U:O.4~k+YK7BCAO)mNu8`1@f!>900x(+KB*_^R`RFJ6Im<2/2+-!=x');
 define('SECURE_AUTH_SALT', 'rrkHd6X;5#kZi99_6g~/,`G-n&N|wdi~~Cnw(VeB![#]k#;+QZy!m;US-ks=8=%G');
 define('LOGGED_IN_SALT',   'r<_Q+PY4u8u}Mp<Kom.udDG=JO(;t<W-@Bds#f<n*goCM:fs4Oq(3a_O: -se Ft');
 define('NONCE_SALT',       'A?,Qp.ok/+SW {F~9Pfr(,p-dg-J++.dn(Rg3)w,m4r2++!&N]nd90>h!SgFJmV ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
/**
 *  If possible, change this to a prefix similar to below
 *  $table_prefix  = 'uppa_';
*/

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

if(isset($_GET['debug'])){
   define('WP_DEBUG', true);
}else{
   define('WP_DEBUG', false);
}

/* REVISION SETTINGS */
define('WP_POST_REVISIONS', 5);
define('WP_POST_REVISIONS', false );
define('AUTOSAVE_INTERVAL', 160 );


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
