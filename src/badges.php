<?php

// phpcs:disable Squiz.Commenting.ClassComment.Missing
// phpcs:disable Squiz.Commenting.VariableComment.Missing
// phpcs:disable Squiz.Commenting.FunctionComment.Missing

namespace omz13;

use Kirby\Exception\LogicException;
use Kirby\Text\KirbyTag;
use PUGX\Poser\Poser;
use PUGX\Poser\Render\SvgFlatRender;
use PUGX\Poser\Render\SvgFlatSquareRender;
use PUGX\Poser\Render\SvgRender;

use const BADGES_VERSION;

use function array_map;
use function count;
use function define;
use function explode;
use function in_array;
use function kirby;
use function strstr;

define( 'BADGES_VERSION', '0.1.0' );

class Badges
{
  public static $version = BADGES_VERSION;

  public static function ping() : string {
      return static::class . ' pong ' . static::$version;
  }//end ping()

  /**
  * @SuppressWarnings(PHPMD.CyclomaticComplexity)
  * @SuppressWarnings(PHPMD.NPathComplexity)
   */
  public static function runTagsBadge( KirbyTag $tag ) : string {
    $poser = new Poser( [ new SvgFlatRender, new SvgRender, new SvgFlatSquareRender ] );

    if ( strstr( $tag->value, "," ) != false ) {
      $params = explode( ",", $tag->value );
    } else {
      if ( strstr( $tag->value, ";" ) != false ) {
        $params = explode( ";", $tag->value );
      } else {
          $params = explode( " ", $tag->value );
      }
    }

    $trimmed = array_map( 'trim' , $params );

    // fallback for missing k/v
    $badgeKey   = '???';
    $badgeValue = '???';

    $badgeColor = kirby()->option( 'omz13.badges.color' ); // '428F7E';

    if ( $tag->style != "" && in_array( $tag->style, [ 'flat', 'flat-square', 'plastic' ] ) ) {
      $badgeStyle = $tag->style;
    } else {
      $badgeStyle = kirby()->option( 'omz13.badges.style' );
    }

    if ( $tag->class != "" ) {
      $divClass = $tag->class;
    } else {
      $divClass = kirby()->option( 'omz13.badges.class' );
    }

    // override from (trimmed) params
    switch ( count( $trimmed ) ) {
      case 3:
        $badgeColor = $trimmed[2];
        // fall through
      case 2:
        $badgeValue = $trimmed[1];
        // fall through
      case 1:
        if ( $trimmed[0] != "" ) {
          $badgeKey = $trimmed[0];
        }
        break;
    }//end switch

    $image = $poser->generate( $badgeKey, $badgeValue, $badgeColor, $badgeStyle );

    if ( $image != null ) {
      $divPrefix = '<div';
      if ( $divClass != "" ) {
        $divPrefix .= ' class="' . $divClass . '"';
      }
      $divPrefix .= ">";
      if ( kirby()->option( 'debug' ) == 'true' ) {
        $divPrefix .= '<!-- badge: ' . $badgeKey . '; ' . $badgeValue . '; ' . $badgeColor . '; ' . $badgeStyle . " -->\n";
      }
      return $divPrefix . $image . '</div>';
    }
    // return '<pre>' . $tag->value . '</pre>';
    throw new LogicException( 'Failed to generate badge' );
  }//end runTagsBadge()
}//end class
