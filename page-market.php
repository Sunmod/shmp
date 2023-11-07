<?php
// Template Name: Биржа
?>
<?php get_header(); ?>
<div class="container">
      <section class="market__header">
         <div class="top">
            <div>
               <h2 class="title">
                  <?php the_field('title1'); ?>
               </h2>
               <button class="button_mix">Перемешать</button>
            </div>
            <button class="button_result">Результаты</button>
         </div>
         <div class="bottom">
            <div class="user__name">
               <?php echo get_user_fio() ?>
            </div>
            <div class="market__stat-block">
               <span>Потрачено баллов:</span>
               <span class="count">17</span>
               <span>из</span>
               <span class="count">100</span>
            </div>
            <div class="market__appreciated">
               <span>Оценено проектов:</span>
               <span class="count">1</span>
            </div>
         </div>
      </section>
      <section>
         <div class="market__list">
            <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => -1,
                    'post_type'   => 'project',
                    'order'       => 'ASC'
                ]);

                if( $myposts ){
                    foreach( $myposts as $post ){
                setup_postdata( $post );
            ?>
               <div class="market__list-item">
               <div class="market__item-content">
                  <a href="<?php echo get_permalink(); ?>">
                     <?php the_post_thumbnail('full', array('class' => 'market__item-img')); ?>
                  </a>
                  <div class="market__item-company"><?php the_title(); ?></div>
                  <div class="market__item-industry"><?php the_field('project_industry'); ?></div>
                  <?php the_content(); ?>
                  <div class="line"></div>
                  <div class="market__item-investment">
                     <div>Проинвестировано:</div><div>300 000 ₽</div>
                  </div>
                  <div class="market__item-need">
                     <div>Требуется инвестиций:</div><div>3 000 000 ₽</div>
                  </div>
               </div>
               <div class="market__doaction-block">
                  <span>Проинвестировать:</span>
                  <input class="market__doaction-input" type="text" placeholder="баллов">
                  <button class="market__doaction-button">ок</button>
               </div>
            </div>
            <?php 
                        }
                } else {
                    
                }

                wp_reset_postdata();
            ?>
         </div>
      </section>
   </div>
<?php get_footer() ?>