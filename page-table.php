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
<h1 class="machine__title">Coding is <span id="machine_text"></span></h1>
<div class="container">
    <?php the_content(); ?>
</div>




<script>
const dynamicText = document.querySelector("#machine_text");
const words = ["Love", "like Art", "the Future", "Everything"];

// Variables to track the position and deletion status of the word
let wordIndex = 0;
let charIndex = 0;
let isDeleting = false;

const typeEffect = () => {
    const currentWord = words[wordIndex];
    const currentChar = currentWord.substring(0, charIndex);
    dynamicText.textContent = currentChar;
    dynamicText.classList.add("stop-blinking");

    if (!isDeleting && charIndex < currentWord.length) {
        // If condition is true, type the next character
        charIndex++;
        setTimeout(typeEffect, 200);
    } else if (isDeleting && charIndex > 0) {
        // If condition is true, remove the previous character
        charIndex--;
        setTimeout(typeEffect, 100);
    } else {
        // If word is deleted then switch to the next word
        isDeleting = !isDeleting;
        dynamicText.classList.remove("stop-blinking");
        wordIndex = !isDeleting ? (wordIndex + 1) % words.length : wordIndex;
        setTimeout(typeEffect, 1200);
    }
}

typeEffect();
</script>

<?php get_footer(); ?>