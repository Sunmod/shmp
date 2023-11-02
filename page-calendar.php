<?php
// Template Name: Календарь
?>
<?php get_header(); ?>

<div class="container">

    <br>
    <?php echo get_user_fio() ?> <span style="font-size:11px">(запись слева выведена из базы с объеденением нескольких значений)</span>
    <hr>

    <?php 
    global $wpdb;

    $event_metadate = array();
    $arrayEventId = array();
    $event_id = $wpdb->get_results("SELECT id FROM {$wpdb->prefix}posts WHERE post_type = 'calendar_event' AND post_status = 'publish'", ARRAY_N);
    for( $i = 0; $i < count($event_id); $i++ ) {
        array_push($arrayEventId, $event_id[$i][0]);
    }

    foreach ($arrayEventId as $value) {
        $array = $wpdb->get_results("SELECT meta_value FROM {$wpdb->prefix}postmeta WHERE post_id = $value", ARRAY_N);
        
        $item = array(



            'start' => implode('', intval(date('Y-m-d', $array[2]))),
            'end' => implode('', $array[4]),
            'url' => implode('', $array[6])
        );
        array_push($event_metadate, $item);
    
    }  
    ?>

    <?php  echo json_encode($event_metadate);?>

    <hr>
    <br>
    <hr>



    </div>

        <div class="page-header">
            <h1>Календарь мероприятий</h1>

            <div id='calendar'></div>
        </div>
    </div>
</div>


<?php get_footer(); ?>