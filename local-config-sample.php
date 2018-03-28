<?php
/*
This is a sample local-config.php file
In it, you *must* include the four main database defines

You may include other settings here that you only want enabled on your local development checkouts
*/

define( 'DB_NAME', 'local_db_name' );
define( 'DB_USER', 'local_db_user' );
define( 'DB_PASSWORD', 'local_db_password' );
define( 'DB_HOST', 'localhost' ); // Probably 'localhost'

define( 'SAVEQUERIES', true );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'SCRIPT_DEBUG', true );

define('WP_MEMORY_LIMIT', '4048M');

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	$_SERVER['HTTP_HOST'] = 'example.app';
}