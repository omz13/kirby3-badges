<?php

// phpcs:disable Squiz.Commenting.ClassComment.Missing
// phpcs:disable Squiz.Commenting.VariableComment.Missing
// phpcs:disable Squiz.Commenting.FunctionComment.Missing

namespace omz13;

use const BADGES_VERSION;

use function define;
use function kirby;

define( 'BADGES_VERSION', '0.0.0' );

class Badges
{
  public static $version = BADGES_VERSION;

  public static function ping() : string {
      return static::class . ' pong ' . static::$version;
  }//end ping()

  public static function getConfigurationForKey( string $key, ?string $default = null ) : string {
    $o = kirby()->option( 'omz13.badges.' . $key );

    if ( isset( $o ) == true ) {
      return $o;
    }

    return $default;
  }//end getConfigurationForKey()

  public static function isEnabled() : bool {
    return static::getConfigurationForKey( 'disable', false ) != true;
  }//end isEnabled()
}//end class
