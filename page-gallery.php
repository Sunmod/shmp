<?php
// Template Name: Галерея
?>
<?php get_header(); ?>

<?php the_content(); ?>
<span style="display: block; height: 2px; background-color: red; width: 100%"></span>

<?php if( function_exists('photo_gallery') ) { photo_gallery(5); } ?>

<span style="display: block; height: 2px; background-color: red; width: 100%"></span>

<?php if( function_exists('photo_gallery') ) { photo_gallery(6); } ?>

<?php get_footer(); ?>