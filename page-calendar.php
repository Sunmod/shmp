<?php
// Template Name: Календарь
?>
<?php get_header(); ?>

<div class="container">

    <br>
    <?php echo get_user_fio() ?> <span style="font-size:11px">(имя выведено из базы с объеденением нескольких значений)</span> 
    <div class="events__block">
        <div class="events__block-list">
            <h1>Календарь мероприятий</h1>
<!-- 1. Вывести запись по одной дате -->
<!-- 2. Вывести записи по двум и более датам -->
<!-- 3. Вывести записи в диапазоне двух дат -->
<!-- 4. Сделать кнопку, которая меняет диапазон двух дат -->
<!-- 5. Получать текущий диапазон дат из fullcalendar (как то же название месяца выводится?) -->
<!-- Тест 6 2023-11-13 -->
<hr>
<!-- SELECT * FROM Product_sales  -->
<!-- WHERE NOT (From_date > @RangeTill OR To_date < @RangeFrom) -->

            <?php 
                // global $wpdb;
                // $event_metadate = array();
                // $arrayEventId = array();
                // $event_id = $wpdb->get_results("AND SELECT id FROM {$wpdb->prefix}posts WHERE post_type = 'calendar_event' AND post_status = 'publish'", ARRAY_N);
                // for( $i = 0; $i < count($event_id); $i++ ) {
                //     array_push($arrayEventId, $event_id[$i][0]);
                // }
                // foreach ($arrayEventId as $value) {

                //     $event_in_range = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}postmeta WHERE post_id = $value AND (meta_value * (meta_key = 'event_start')) BETWEEN  20231107 AND 20231112", ARRAY_N);
                //     array_push($event_metadate, $event_in_range[0][1]);
                // }
                // $args = array(
                //     'post_type' => 'calendar_event',
                //     'posts_per_page' => '-1',
                //     'meta_query' => array(
                //         array(
                //             'key' => 'event_start',
                //             'value' => array('20201113','20241212'),
                //             'compare' => 'BETWEEN'
                //         )
                //     )
                // );


                // $true_args = array(
                //     'meta_query' => array(
                //         array(
                //             'key' => 'event_start',
                //             'value' => array(20201112,20231212),
                //             'type' => 'numeric',
                //             'compare' => 'BETWEEN'
                //         )
                //     )
                // );
                // $true_query = new WP_Query( $args );
                                
            ?>

            <?php
                global $post;

                $myposts = get_posts([ 
                    'numberposts' => -1,
                    'post_type'   => 'calendar_event',
                    'order'       => 'date'
                ]);

                if( $myposts ){
                    foreach( $myposts as $post ){
                        $date_start = (int)get_post_meta($post->ID, 'event_start', true);
                        $date_end = (int)get_post_meta($post->ID, 'event_end', true);
                        if ($date_start >= 20231108 && $date_start <= 20231112) {
                            setup_postdata( $post );
                        
            ?>
                <div>
                    <?php the_title(); ?>
                    <?php the_field('event_start'); ?>
                    <?php the_field('event_end'); ?>
                    <?php the_field('event_url'); ?>
                </div>
            <?php 
                   } else {
                            
                   }     }
                } else {
                    
                }
                wp_reset_postdata();
            ?>
            <pre>
            
            </pre>
            <div class="events__list"></div>
            
        </div>
        
        <!-- <div id="calendar"></div> -->
        <?php echo Calendar::getMonth(date('n'), date('Y'), $events); ?>
        
    </div>
</div>

<script>
    var events = <?php echo get_calendar_events() ?>;
</script>
    
<?php get_footer(); ?>