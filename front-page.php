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
            <!-- Вывод постов, функции цикла: the_title() и т.д. -->
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
            <div class="step__item">
               <p class="step__item-number">1</p>
               <p class="step__item-description">Короткую информацию о Вас, как о предпринимателе, и понятное описание проекта (в чем его суть, что является продуктом (товар, работа, услуга), какую проблему или потребность закрывает Ваш продукт для клиента (30–40 сек)*.</p>
            </div>
            <div class="step__item">
               <p class="step__item-number">2</p>
               <p class="step__item-description">Описание текущего этапа развития проекта: что сделано на сегодняшний день, кто ключевые клиенты, какие достигнуты результаты (тесты, продажи, оборот и т. д. (любые показатели, которые считаете значимыми)) (30 сек)*</p>
            </div>
            <div class="step__item">
               <p class="step__item-number">3</p>
               <p class="step__item-description">Информация о сделанных инвестициях (если есть), о планируемых инвестициях (необходимый объем финансирования). Цели, на которые планируете потратить инвестиции. Если инвестиции не требуются, коротко опишите почему. (20 сек)*</p>
            </div>
            <div class="step__item">
               <p class="step__item-number">4</p>
               <p class="step__item-description">Опишите Ваши первые шаги, которые начнете делать «уже завтра», что по Вашему мнению нужно делать именно сейчас для достижения успеха. (30 сек)*</p>
            </div>
            <div class="step__item">
               <p class="step__item-number">5</p>
               <p class="step__item-description">Одним предложением опишите, чем в наибольшей степени Вам помог Проект «Школа молодого предпринимателя. Бизнес молодых» (10 сек)*</p>
            </div>
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