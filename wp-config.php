<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );

	// Database Config
	include( dirname( __FILE__ ) . '/local-config.php' );

	// WP Sent Mail - Airplane Mode
	define( 'WPSM_AIRPLANE_MODE', true );

	// Enable JetPack development mode
	define( 'JETPACK_DEV_DEBUG', true );
} else {
	define( 'WP_LOCAL_DEV', false );

	// Database Config
	define( 'DB_NAME', 'DB_NAME_PROD' );
	define( 'DB_USER', 'DB_USER_PROD' );
	define( 'DB_PASSWORD', 'DB_PASSWORD_PROD' );
	define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

	// Disable file editor, plugin install, plugin delete
	define('DISALLOW_FILE_MODS',true);
}

// ========================
// Composer Vendor Autoload
// ========================
require_once dirname( __FILE__ ) . '/wp-content/vendor/autoload.php';

// ========================
// Custom Content Directory
// ========================
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', $protocol . $_SERVER['HTTP_HOST'] . '/wp-content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
# Security Salts, Keys, Etc
define( 'AUTH_KEY',         'hey there developer. you should update these using the url above' );
define( 'SECURE_AUTH_KEY',  'hey there developer. you should update these using the url above' );
define( 'LOGGED_IN_KEY',    'hey there developer. you should update these using the url above' );
define( 'NONCE_KEY',        'hey there developer. you should update these using the url above' );
define( 'AUTH_SALT',        'hey there developer. you should update these using the url above' );
define( 'SECURE_AUTH_SALT', 'hey there developer. you should update these using the url above' );
define( 'LOGGED_IN_SALT',   'hey there developer. you should update these using the url above' );
define( 'NONCE_SALT',       'hey there developer. you should update these using the url above' );

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );
// define( 'WP_DEBUG_LOG', true );
// define( 'SCRIPT_DEBUG', true );

// =================================================================
// WP Stack CDN
// =================================================================
//define( 'WP_STACK_CDN_DOMAIN', 'cdn.lead2feed.org' );

if ( defined('WP_LOCAL_DEV') && WP_LOCAL_DEV ) {
	define( 'WP_STAGE','staging' );
} else {
	define( 'WP_STAGE','production' );
}

// =================================================================
// Memory Limits
// =================================================================
define('WP_MEMORY_LIMIT', '512M');
define('WP_MAX_MEMORY_LIMIT', '512M');


// =================================================================
// Redis Caching
// =================================================================
//$redis_server = array( 'host' => '127.0.0.1', 'port' => 6379, );
//define( 'WP_CACHE_KEY_SALT', 'l2f_' . WP_STAGE . '_' );

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );
