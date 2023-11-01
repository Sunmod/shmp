<?php
// Template Name: Календарь
?>
<?php get_header(); ?>
<br>
<?php echo get_user_fio() ?> <span style="font-size:11px">(запись слева выведена из базы с объеденением нескольких значений)</span>
<hr>

<div class="page-header">
    <h1>Календарь мероприятий</h1>
        <?php $month_label = event_date(current_time('j F Y'));
            $year = date('Y');
            $month = date('m');
            $args = array(
                'post_type' => array('project'),
                'post_status' => array('publish'),
                'posts_per_page' => 100,
                'meta_query' =>  array(
                    'relation' => 'AND',
                    array(
                        'key' => 'start_date',
                        'value' => $year.'-'.$month.'-01',
                        'compare' => '>=',
                        'type' => 'DATE'
                    ),
                    array(
                        'key' => 'start_date',
                        'value' => $year.'-'.$month.'-31',
                        'compare' => '<=',
                        'type' => 'DATE'
                    )

                ),
                'orderby' => 'meta_value',
                'meta_key' => 'start_date',
            );
            $posts = query_posts( $args ); ?>
        <div class="amount">
            <span class="title">в <?php echo $month_label ?>:</span>
            <?php echo num_decline( count($posts), ['мероприятиe','мероприятия','мероприятий'] ); ?>
        </div>

        <div class="form-group">
            <div id="datepicker"></div>
        </div>
    </div>

<?php get_footer(); ?>