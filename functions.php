<?php
// Это файл вызова и подключения скриптов и функций. Интересно обозвали "Файл управления полетами"

// Добавление хука, который вызывает функцию script_styles и запускает подключение стилей
add_action('wp_enqueue_scripts' , 'script_styles');
function script_styles() {
    //подключение стилей
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style('light_box_min', get_template_directory_uri() . '/assets/css/lightbox.min.css' );
    wp_enqueue_style('light_box', get_template_directory_uri() . '/assets/css/lightbox.css' );

    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/lightbox-plus-jquery.min.js', array('jquery'), 'null', true);
    //подключение jquery проводится по другому, загуглить!
}

// <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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