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
    
    <!-- <form name="contactForm" method="post" action="">

        <div>
            <label for="formTitle">1</label>
            <input name="formTitle" id="formTitle" type="text" placeholder="1">
        </div>

        <div class="select">
            <div class="select__header">
                <span class="select__current">Value 1</span>
                <div class="select__icon">&times;</div>
            </div>
            <div class="select__body">
                <div class="select__item">Value 1</div>
                <div class="select__item">Value 2</div>
                <div class="select__item">Value 3</div>
            </div>
        </div>

        <div>
            <label for="formText">2</label>
            <input name="formText" id="formText" type="text" placeholder="2">
        </div>

    </form> -->
 
<div id="content">

    <iframe src="https://vk.com/video_ext.php?oid=-214674300&id=456239021&hd=2"
        width="853"
        height="480"
        allow="autoplay; encrypted-media; fullscreen; picture-in-picture;"
        frameborder="0"
        allowfullscreen>
    </iframe>

</div>
        
<div>
    
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

<script>
    select();
</script>

<?php get_footer(); ?>