<?php

use PUGX\Poser\Poser;
use PUGX\Poser\Render\SvgFlatRender;
use PUGX\Poser\Render\SvgRender;

Kirby::plugin(
    'omz13/badges',
    [
      'root'    => dirname( __FILE__, 2 ),
      'options' => ['disable' => false],
      'tags'    => [
        'badge' => [
          'attr' => [
            'left',
            'right',
            'color',
          ],
          'html' => function ( $tag ) {

            $poser = new Poser( [ new SvgFlatRender, new SvgRender ] );

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

            // default
            $badgeLabel = '???';
            $badgeValue = '???';
            $badgeColor = '428F7E';

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
                  $badgeLabel = $trimmed[0];
                }
                break;
            }//end switch

            if ( kirby()->option( 'debug' ) == 'true' ) {
              echo '<!-- badge: ' . $badgeLabel . '; ' . $badgeValue . '; ' . $badgeColor . ' -->';
            }

            $image = $poser->generate( $badgeLabel, $badgeValue, $badgeColor, 'flat' );

            if ( $image != null ) {
              return $image;
            }
            // return '<pre>' . $tag->value . '</pre>';
            throw new LogicException( 'Failed to generate badge' );
          },
        ],
      ],
    ]
);

require_once __DIR__ . '/badges.php';
