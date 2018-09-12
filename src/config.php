<?php

Kirby::plugin(
    'omz13/badges',
    [
      'root'    => dirname( __FILE__, 2 ),
      'options' => [
        'class' => '',
        'color' => '428F7E',
        'style' => 'flat',
      ],
      'tags'    => [
        'badge' => [
          'attr' => [
            'style',
            'class',
          ],
          'html' => function ( $tag ) : string {
            return omz13\Badges::runTagsBadge( $tag );
          },
        ],
      ],
    ]
);

require_once __DIR__ . '/badges.php';
