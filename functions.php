<?php
// Это файл вызова и подключения скриптов и функций. Интересно обозвали "Файл управления полетами"

// Добавление хука, который вызывает функцию script_styles и запускает подключение стилей
add_action('wp_enqueue_scripts' , 'script_styles');
function script_styles() {
    //подключение стилей
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css' );

    //поедлючение скриптов (если бы они были). Назвывается script, потому что так называется js файл, делаем это что бы самим не запутаться
    //а вообще название может быть любое
    //array нужен, если скрипт зависим от другого. Представим, что да и я пишу array('some_script'). Тоесть script заработает если заработает some_script
    //там где null - пишется условная версия '1.0.0'
    //true означает, что скрипт выполняется в footer
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('some_script'), 'null', true);
    //подключение jquery проводится по другому, загуглить!
}

// посты поддерживают картинки
add_theme_support('post-thumbnails');
// управление Title tag
add_theme_support('title-tag');
// заменя логотипа
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