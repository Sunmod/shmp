<?php
// Это файл вызова и подключения скриптов и функций. Интересно обозвали "Файл управления полетами"

// Добавление хука, который вызывает функцию script_styles и запускает подключение стилей
add_action('wp_enqueue_scripts' , 'script_styles');
function script_styles() {
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style('calendar', get_template_directory_uri() . '/assets/css/calendar.css' );

    // wp_enqueue_script( 'calendar1', get_template_directory_uri() . '/assets/js/script.js',  array(), '1' );
    // wp_enqueue_script( 'calendar2', get_template_directory_uri() . '/assets/js/index.global.js',  array(), '1' ); 

    wp_enqueue_script( 'webpack', get_template_directory_uri() . '/dist/scripts.js',  array(), '1' ); 
}

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support( 'menus' );

// скрипт добавляет возможность загружать свг логотипы в WP
add_filter('upload_mimes','svg_upload_allow');

function svg_upload_allow($mimes){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('wp_check_filetype_and_ext','fix_svg_mime_type',10,5);
function fix_svg_mime_type($data,$file,$filename,$mimes,$real_mime=''){
    if(version_compare($GLOBALs['wp_version'],'5.1.0','>='))
        $dosvg = in_array($real_mime,['image/svg','image/svg+xml']);
    else
        $dosvg = ('.svg'===strtolower(substr($filename,-4)));

    if($dosvg){
        if(current_user_can('manage_options')) {
            $data['ext'] = 'svg';
            $data['type'] = 'image/svg+xml';
        }
    }
    else {
        $data['ext'] = $type_text_ext['type'] = false;
    }
    return $data;
}

add_filter( 'show_admin_bar', '__return_true' );

function get_user_fio() {
    $current_user = wp_get_current_user();
    $fio = $current_user->last_name . ' ' . $current_user->first_name . ' ' . $current_user->surname;
    return $fio;
}

function get_calendar_events() {

    global $wpdb;

    $event_metadate = array();
    $arrayEventId = array();
    $event_id = $wpdb->get_results("SELECT id FROM {$wpdb->prefix}posts WHERE post_type = 'calendar_event' AND post_status = 'publish'", ARRAY_N);
    for( $i = 0; $i < count($event_id); $i++ ) {
        array_push($arrayEventId, $event_id[$i][0]);
    }

    foreach ($arrayEventId as $value) {

        $item = array(
            'start' => date('Y-m-d', strtotime(get_post_meta($value, 'event_start', true))),
            'end' => date('Y-m-d', strtotime(get_post_meta($value, 'event_end', true))),
            'url' => get_post_meta($value, 'event_title', true),
            'title' => get_post_meta($value, 'event_url', true)
        );

        array_push($event_metadate, $item);
    }
    return $events = json_encode($event_metadate);
}

add_filter( 'single_template', function ( $single_template ) {
 
    $parent     = '51'; //Здесь вставляем id категории(рубрики) для которой хотите изменить шаблон у детальной страницы записи
    $categories = get_categories( 'child_of=' . $parent );
    $cat_names  = wp_list_pluck( $categories, 'name' );
 
    if ( has_category( 'movies' ) || has_category( $cat_names ) ) {
        $single_template = dirname( __FILE__ ) . '/page-market_post.php'; // название файла шаблона
    }
    return $single_template;
}, PHP_INT_MAX, 2 );