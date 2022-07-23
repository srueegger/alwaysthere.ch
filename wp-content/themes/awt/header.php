<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header id="siteheader" class="container">
      <div class="grid">
        <div class="g-col-12">
          <?php dynamic_sidebar( 'header' ); ?>
        </div>
      </div>
    </header>
