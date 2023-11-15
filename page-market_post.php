<?php
// Template Name: Биржа пост
// Template Post Type: project, pages
?>
<?php get_header(); ?>
<section class="post">
    <div class="post__header">
        <?php the_post_thumbnail('full', array('class' => 'market__item-img')); ?>
        <div>
            <?php the_title('<h2 class="title">', '</h2>'); ?>
            <?php the_content(); ?>
        </div>
    </div>

    <div class="post__body">
        <h2><?php the_field('project_title'); ?></h2>

        <?php the_field('project_description'); ?>
    </div>

    <div class="post__footer">
        Категория:<i> <?php the_field('project_industry'); ?></i>
    </div>

    <?php if( get_field('is_vk_live')): ?>
        <iframe src="<?php the_field('vk_live_link') ?>"
            width="853"
            height="480"
            allow="autoplay; encrypted-media; fullscreen; picture-in-picture;"
            frameborder="0"
            allowfullscreen>
        </iframe>
    <?php endif; ?>

</section>
<?php get_footer() ?>