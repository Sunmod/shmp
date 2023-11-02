<?php
// Это файл вызова и подключения скриптов и функций. Интересно обозвали "Файл управления полетами"

// Добавление хука, который вызывает функцию script_styles и запускает подключение стилей
add_action('wp_enqueue_scripts' , 'script_styles');
function script_styles() {
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/calendar.css' );

    wp_enqueue_script( 'calendar1', get_template_directory_uri() . '/assets/js/script.js',  array(), '1' );
    wp_enqueue_script( 'calendar2', get_template_directory_uri() . '/assets/js/index.global.js',  array(), '1' ); 
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

// Это код календаря с кубсайнц. Пока не понимаю как его использовать

// function event_date($date){
//     $new_date = getdate(strtotime($date));
//     $my_months=[
//         'January'   => 'Январе',
//         'February'  => 'Феврале',
//         'March'     => 'Марте',
//         'April'     => 'Апреле',
//         'May'       => 'Мае',
//         'June'      => 'Июне',
//         'July'      => 'Июле',
//         'August'    => 'Августе',
//         'September' => 'Сентябре',
//         'October'   => 'Октябре',
//         'November'  => 'Ноябре',
//         'December'  => 'Декабре',
//     ];

//     $new_date['month']= $my_months[$new_date['month']];

//     return $new_date['month'];
// }
// function event_date_single($date){
//     $new_date = getdate(strtotime($date));
//     $my_months=[
//         'January'   => 'Января',
//         'February'  => 'Февраля',
//         'March'     => 'Марта',
//         'April'     => 'Апреля',
//         'May'       => 'Мая',
//         'June'      => 'Июня',
//         'July'      => 'Июля',
//         'August'    => 'Августа',
//         'September' => 'Сентября',
//         'October'   => 'Октября',
//         'November'  => 'Ноября',
//         'December'  => 'Декабря',
//     ];

//     $new_date['month']= $my_months[$new_date['month']];

//     return $new_date['month'];
// }

// function num_decline($number, $titles, $show_number = true)
// {
//     if (is_string($titles)) {
//         $titles = preg_split('/, */', $titles);
//     }
//     if (empty($titles[2])) {
//         $titles[2] = $titles[1];
//     }
//     $cases = [2, 0, 1, 1, 1, 2];
//     $intnum = abs((int)strip_tags($number));
//     $title_index = ($intnum % 100 > 4 && $intnum % 100 < 20)
//         ? 2
//         : $cases[min($intnum % 10, 5)];
//     return ($show_number ? "$number " : '') . $titles[$title_index];
// }

function get_user_fio() {
    $current_user = wp_get_current_user();
    $fio = $current_user->last_name . ' ' . $current_user->first_name . ' ' . $current_user->surname;
    return $fio;
}