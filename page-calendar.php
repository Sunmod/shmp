<?php
// Template Name: Календарь
?>
<?php get_header(); ?>

<div class="container">

    <br>
    <?php echo get_user_fio() ?> <span style="font-size:11px">(запись слева выведена из базы с объеденением нескольких значений)</span>
    <hr>

        <div class="page-header">
            <h1>Календарь мероприятий</h1>

            <div id='calendar'></div>
        </div>
    </div>
</div>


<?php get_footer(); ?>