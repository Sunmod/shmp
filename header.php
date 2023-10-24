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
            <a class="phone" href="tel:<?php the_field('phone_number'); ?>"><?php the_field('phone_page'); ?></a>
         </div>
         <div class="bottom">

            <div class="burger">
               <span></span>
            </div>
   
            <nav class="navigation">
               <a class="link" href="">Главная</a>
               <a class="link" href="">Расписание</a>
               <a class="link" href="">Монитор</a>
               <a class="link" href="">Дополнительные материалы</a>
               <a class="link" href="">Поддержка</a>
            </nav>

            <nav class="navigation mobile">
               <a class="link" href="">Главная</a>
               <a class="link" href="">Расписание</a>
               <a class="link" href="">Монитор</a>
               <a class="link" href="">Дополнительные материалы</a>
               <a class="link" href="">Поддержка</a>
               <a class="manual--mobile" href="<?php the_field('button_head_link'); ?>"><?php the_field('button_head_text'); ?></a>
            </nav>
            <a class="manual mobile" href="<?php the_field('button_head_link'); ?>"><?php the_field('button_head_text'); ?></a>
            <a class="manual" href="<?php the_field('button_head_link'); ?>"><?php the_field('button_head_text'); ?></a>
         </div>
      </header>