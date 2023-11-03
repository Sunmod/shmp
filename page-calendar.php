<?php
// Template Name: Календарь
?>
<?php get_header(); ?>

<div class="container">

    <br>
    <?php echo get_user_fio() ?> <span style="font-size:11px">(запись слева выведена из базы с объеденением нескольких значений)</span>
    <hr>

    <hr>
    <?php echo get_calendar_events()?>

    </div>
        <div class="page-header">
            <h1>Календарь мероприятий</h1>

            <div id='calendar'></div>
        </div>
    </div>
</div>

<script>
    var events = <?php echo get_calendar_events() ?>;

    console.log(events);
</script>
    
<?php get_footer(); ?>