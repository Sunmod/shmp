<?php
// Template Name: Биржа пост
// Template Post Type: project, pages
?>
<?php get_header(); ?>
<section>
<?php the_post_thumbnail('thumbnail', array('class' => 'market__item-img')); ?>
<?php the_title(); ?>
<?php the_field('project_industry'); ?>
<?php the_content(); ?>
<?php the_field('project_title'); ?>
<?php the_field('project_description'); ?>
</section>
<?php get_footer() ?>