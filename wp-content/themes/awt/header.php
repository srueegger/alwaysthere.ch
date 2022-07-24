<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/402771fbad.js" crossorigin="anonymous"></script>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header id="siteheader" class="container">
      <div class="grid">
        <div id="topheader" class="g-col-12">
          <?php
          $locations = get_nav_menu_locations();
          $menu_id = $locations['socialmenu'];
          $menu_items = wp_get_nav_menu_items( $menu_id );
          if( !empty( $menu_items ) ) {
            echo '<ul class="list-inline text-center text-lg-end">';
            foreach( $menu_items as $item ) {
              $link_target = $item->target ? $item->target : '_self';
              $icon = get_field( 'icon', $item );
              echo '<li class="list-inline-item"><a class="d-inline-block text-center" title="' . esc_attr( $item->title ) . '" href="' . esc_url( $item->url ) . '" target="' . $link_target . '"><i class="' . esc_attr( $icon ) . ' fa-lg"></i></a></li>';
            }
            echo '</ul>';
          }
          ?>
        </div>
        <div class="g-col-12">
          <?php dynamic_sidebar( 'header' ); ?>
        </div>
      </div>
    </header>
