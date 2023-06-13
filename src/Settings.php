<?php declare(strict_types=1);
namespace Kingsoft\Utils;

if( !defined( SETTINGS ) ) {
  if( !defined( 'SETTINGS_FILE' ) ) {
    define( 'SETTINGS_FILE', $_SERVER[ 'DOCUMENT_ROOT' ] . '/settings.ini' );
  }
  class Settings
  {
    public static function getSettings(): array
    {
      return parse_ini_file( SETTINGS_FILE, true );
    }
  }

  define( 'SETTINGS', Settings::getSettings() );
}
