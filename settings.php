<?php declare(strict_types=1);

if( !defined( 'SETTINGS_FILE' ) ) {
  define( 'SETTINGS_FILE', $_SERVER['DOCUMENT_ROOT'] . '/settings.ini' );
}

if( !defined( 'SETTINGS' ) ) {
  define( 'SETTINGS', parse_ini_file( SETTINGS_FILE, true ) );
}