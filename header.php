<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body>
    <header>
        <div class="header__container">
            <?php the_custom_logo();?>
            <nav>
                <a href="#1">Link 1</a>
                <a href="#2">Link 2</a>
                <a href="#3">Link 3</a>
            </nav>
            <a class="logo_tel" href="tel:<?php the_field('phone_work ');?>"><?php the_field('phone');?></a>
        </div>
    </header>