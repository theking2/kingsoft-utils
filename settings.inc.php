<?php declare(strict_types=1);

if(!defined('ROOT')) {
  define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
}

if( !defined( 'SETTINGS_FILE' ) ) {
  define( 'SETTINGS_FILE', ROOT. 'settings.ini' );
}

if( !defined( 'SETTINGS' ) ) {
  define( 'SETTINGS', parse_ini_file( SETTINGS_FILE, true ) );
}
/**
 * Are we on development mode?
 */
if( !defined( 'DEBUG' ) ) {
	define( 'DEBUG', strpos( $_SERVER['SERVER_NAME'], 'localhost' ) !== false );
}