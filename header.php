<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head();?>
</head>
<body>
    <div class="container">
      <header class="header">
         <div class="top">
            <?php the_custom_logo();?>
            <div class="partners">
                <img class="banner" src="<?php bloginfo('template_url'); ?>/assets/images/partners.png" alt="">
            </div>
            <?php wp_nav_menu( ['menu' => '5', 'container' => 'false', 'menu_class' => 'menu-wp',]);?>
         </div>
         <div class="bottom">

            <div class="burger">
               <span></span>
            </div>
            <?php wp_nav_menu( ['menu' => '6', 'container_class' => 'navigation', 'menu_class' => 'menu-wp',]);?>

           <nav class="navigation mobile">
               <?php wp_nav_menu( ['menu' => '6', 'menu_class' => 'menu-wp-mobile',]);?>
               <?php wp_nav_menu( ['menu' => '9', 'menu_class' => 'menu-wp-button']);?>
           </nav>

           <?php wp_nav_menu( ['menu' => '7', 'menu_class' => 'menu-wp-button']);?>
           <?php wp_nav_menu( ['menu' => '8', 'menu_class' => 'menu-wp-button', 'container_id' => 'MM1']);?>
           
         </div>
      </header>