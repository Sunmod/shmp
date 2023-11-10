<?php
// Это файл вызова и подключения скриптов и функций. Интересно обозвали "Файл управления полетами"

// Добавление хука, который вызывает функцию script_styles и запускает подключение стилей
add_action('wp_enqueue_scripts' , 'script_styles');
function script_styles() {
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css' );
    wp_enqueue_style('calendar', get_template_directory_uri() . '/assets/css/calendar.css' );

    wp_enqueue_script( 'calendar1', get_template_directory_uri() . '/assets/js/script.js',  array(), '1' );
    wp_enqueue_script( 'calendar2', get_template_directory_uri() . '/assets/js/index.global.js',  array(), '1' ); 
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js',  array(), '1' ); 
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
            'end' => get_post_meta($value, 'event_end', true) ? date('Y-m-d', strtotime(get_post_meta($value, 'event_end', true))) : '',
            'url' => get_post_meta($value, 'event_url', true),
            'title' => get_post_meta($value, 'event_title', true)
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

$events = array(
    '16'    => 'Заплатить ипотеку',
    '08.11' => 'Международный женский день',
    '30.11.2023' => 'Новый год'
);


class Calendar 
{
	/**
	 * Вывод календаря на один месяц.
	 */
	public static function  getMonth($month, $year, $events = array())
    // задаем массив с месяцами
	{
		$months = array(
			1  => 'Январь',
			2  => 'Февраль',
			3  => 'Март',
			4  => 'Апрель',
			5  => 'Май',
			6  => 'Июнь',
			7  => 'Июль',
			8  => 'Август',
			9  => 'Сентябрь',
			10 => 'Октябрь',
			11 => 'Ноябрь',
			12 => 'Декабрь'
		);

        $prevBtn = 'Назад';
        $nextBtn = 'Вперед';
        $todayBtn = 'Сегодня';

    // передаем массив ивентам
    // TODO изменить массив, где индекс низачто не отвечает, в его значениях уже передавать дату начала и окончания, а так же остальные данные, такие как текст, ссылка и т.д
 
        // не понимаю
		$month = intval($month);

        // создается рисовка шапки календаря
		$out = '
		<div class="calendar-item">
			<div style="display: flex; justify-content: space-between">
                <div>
                    <button>' . $prevBtn . '</button>
                    <button>' . $nextBtn . '</button>
                </div>
                <div class="calendar-head">' . $months[$month] . ' ' . $year . '</div>
                <div>
                    <button>' . $todayBtn . '</button>
                </div>
            </div>
			<table>
				<tr>
					<th>Пн</th>
					<th>Вт</th>
					<th>Ср</th>
					<th>Чт</th>
					<th>Пт</th>
					<th>Сб</th>
					<th>Вс</th>
				</tr>';
        
		$day_week = 
        // https://otus.ru/nest/post/1720/ (Буква N означает формат вывода даты)
        // 'N' порядковый номер дня недели от 1 (понедельник) до 7 (воскресенье) в соответствии со стандартом ISO-8601, (добавлен в версии РНР 5.1.0)
            date('N', mktime(0, 0, 0, $month, 1, $year));
        // mktime( час, минут, секунда, месяц, день, год )


        // пока не понимаю для чего day_week--
		$day_week--;
 
		$out.= '<tr>';
        // цикл рисовки дней недели 
		for ($x = 0; $x < $day_week; $x++) {
			$out.= '<td></td>';
		}
 
		$days_counter = 0;
        // 't' число дней в указанном месяце (от 28 до 31)	
		$days_month = date('t', mktime(0, 0, 0, $month, 1, $year));
	
        // день = 1, число дня должно меньше, чем что определила переменная days_month, если так, добавляем один день
		for ($day = 1; $day <= $days_month; $day++) {
            // если сегодняшний день, то добавляем класс today
			if (date('j.n.Y') == $day . '.' . $month . '.' . $year) {
				$class = 'today';
			} 
            // если день не относится к текущему месяцу, то добавляем класс last
            elseif (time() > strtotime($day . '.' . $month . '.' . $year)) {
				$class = 'last';
			} 
            // если день не сегодня и он подходит в наш месяц, никакого класса не рисуем
            else {
				$class = '';
			}
			// переменная включает отображение дней, где есть событие. Если будет true - все дни станут подсвечиваться, как еслибы там было событие
			$event_show = false;
            // переменная задает текст для событий
			$event_text = array();

            // если события есть
			if (!empty($events)) {
                // запускаем цикл
				foreach ($events as $date => $text) {

                    // преобразует из целых чисел (16) и сдвоенных числе (23.11) и строенных чисел (30.11.2023)
                    // в строка [string 16] и [string 23, string 11] и [string 30, string 11, string 2023]
					$date = explode('.', $date);
                    
                    // если есть день, месяц и год
					if (count($date) == 3) {
                        // получает какой год
						$y = explode(' ', $date[2]);
						if (count($y) == 2) {
							$date[2] = $y[0];  
                            // не понимаю что тут происходит 
                            // var_dump($date);
						}
 
                        // так как есть что-то в этот день в массиве - делает событие
						if ($day == intval($date[0]) && $month == intval($date[1]) && $year == $date[2]) {
							$event_show = true;
							$event_text[] = $text;
						}
					} elseif (count($date) == 2) {
                        // так как есть что-то в этот день в массиве - делает событие
						if ($day == intval($date[0]) && $month == intval($date[1])) {
							$event_show = true;
                            // преобразует значение в массиве в текст и выводит. Например в данном случае вывело "международный женский день"
							$event_text[] = $text;
                            // вывело 8 11 и 23 11 (выводит события, которые только в течении этого месяца?)
						}
                        // так как есть что-то в этот день в массиве - делает событие
					} elseif ($day == intval($date[0])) {
						$event_show = true;
						$event_text[] = $text;
                        // вывело 16 число (может быть ежемесячные события так выводятся?)
					}				
				}
			}
			
            // если этот день явсляется событием
			if ($event_show) {
                // $class - css, $day - отрисовка числа дня в календаре
				$out.= '<td class="calendar-day ' . $class . ' event">' . $day;
                // если есть текст в массиве
				if (!empty($event_text)) {
                    // выводит текст
					$out.= '<div class="calendar-popup">' . implode('<br>', $event_text) . ' TEXT ' . '</div>';
				}
				$out.= '</td>';
			} 
            // если этот день не  является событием
            else {
				$out.= '<td class="calendar-day ' . $class . '">' . $day . '</td>';
			}
 
            // конструирует недели в календаре (после воскресенья делает перенос)
			if ($day_week == 6) {
				$out.= '</tr>';
				if (($days_counter + 1) != $days_month) {
					$out.= '<tr>';
				}
				$day_week = -1;
			}
 
			$day_week++; 
			$days_counter++;
		}
 
		$out .= '</tr></table></div>';
		return $out;
	}
	
	/**
	 * Вывод календаря на несколько месяцев.
	 */
	public static function  getInterval($start, $end, $events = array())
	{
		$curent = explode('.', $start);
		$curent[0] = intval($curent[0]);
		
		$end = explode('.', $end);
		$end[0] = intval($end[0]);
 
		$begin = true;
		$out = '<div class="calendar-wrp">';
		do {
			$out .= self::getMonth($curent[0], $curent[1], $events);
 
			if ($curent[0] == $end[0] && $curent[1] == $end[1]) {
				$begin = false;
			}		
 
			$curent[0]++;
			if ($curent[0] == 13) {
				$curent[0] = 1;
				$curent[1]++;
			}
		} while ($begin == true);	
		
		$out .= '</div>';
		return $out;
	}
}