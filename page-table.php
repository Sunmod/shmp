<?php
// Template Name: Таблица
?>

<?php get_header(); ?>

<h1>Это анимация текста
    <span class=type>
        <span>ПЕЧАТНОЙ МАШИНКИ </span>
    </span>
</h1>

<div class="container">
    <div class="table__results">
        <div class="table__results-head">
            <div>Место</div>
            <div>Компания</div>
            <div><strong>Баллы</strong></div>
        </div>
        <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => -1,
                    'post_type'   => 'table',
                    'order'       => 'ASC'
                ]);

                if( $myposts ){
                    foreach( $myposts as $post ){
                setup_postdata( $post );
            ?>
                <div class="table__results-item">
                    <div><?php the_field('place'); ?></div>
                    <div><?php the_title(); ?></div>
                    <div><?php the_field('balls'); ?></div>
                </div> 
                <?php 
                        }
                } else {
                    
                }
                wp_reset_postdata();
            ?>
    </div>
</div>
<div class="container">
    <?php the_content(); ?>
</div>
<div class="container">

</div>

<?php get_footer(); ?>