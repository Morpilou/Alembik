<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo get_the_title(); ?> | <?php echo get_bloginfo('name'); ?> </title>

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>

        <header>
          <div class="logo">
            <?php
            if (function_exists('the_custom_logo')) {
              the_custom_logo();
            }
            ?>
          </div>
          <div class="nav">
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
          </div>
     
        </header>