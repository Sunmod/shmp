<?php
/*
TempLate Name: Главная страница
*/
?>

<?php get_header(); ?>
    <section class="banner__container">
         <img class="banner" src="<?php the_field('banner_image'); ?>" alt="">
      </section>

      <section class="container__block">
         <p class="bold orange center" style="margin-bottom: 20px;">
            <?php the_field('sub_banner_text1'); ?>
        </p>
         <p class="bold center">
            <?php the_field('sub_banner_text2'); ?>
        </p>
      </section>

      <section class="container__block">
         <h2 class="title">
            <?php the_field('title1'); ?>
        </h2>
         <div class="calendar__list">
            <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => -1,
                    'category'    => 2
                ]);

                if( $myposts ){
                    foreach( $myposts as $post ){
                setup_postdata( $post );
            ?>
            <div class="calendar__item <?php the_field('event')?>">
               <div class="calendar__item-box">
                  <span><?php the_field('day_number') ?></span>
                  <span><?php the_field('month_name') ?></span>
               </div>
               <p class="calendar__item-description"><?php the_field('short_description') ?></p>
            </div>
            <?php 
                    }
                } else {
                    // Постов не найдено
                }

                wp_reset_postdata(); // Сбрасываем $post
            ?>
         </div>
      </section>

      <section class="container__block">
         <div class="condition__button-container">
            <a class="condition__button" href="<?php the_field('button_download_link'); ?>" download><?php the_field('button_name'); ?></a>
         </div>
      </section>

      <section class="container__block">
         <h2 class="title">
            <?php the_field('title2'); ?>
        </h2>
         <div class="steps__list">
         <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => -1,
                    'category'    => 3
                ]);

                if( $myposts ){
                    foreach( $myposts as $post ){
                setup_postdata( $post );
            ?>
            <div class="step__item">
                <p class="step__item-number"><?php the_title();?></p>
                <?php the_content();?>
            </div>
            <?php 
                        }
                } else {
                    // Постов не найдено
                }

                wp_reset_postdata(); // Сбрасываем $post
            ?>
            <div class="step__item">
                <p class="step__item-description orange">
                    <?php the_field('information_text1'); ?> 
                </p>
                <p class="step__item-description bold"><span class="orange bold">ВАЖНО:ㅤ</span>
                    <?php the_field('information_text2'); ?>
                </p>
            </div>
         </div>
      </section>
<?php get_footer() ?>