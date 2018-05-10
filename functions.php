<?php
date_default_timezone_set("Europe/Moscow");

// форматирование цены лота
function format_price($price) {
    $price = ceil($price);
    $price = number_format($price, 0, '.', ' ');
    return $price.' <b class="rub">р</b>';
}

// шаблонизатор
function include_template($file, $data) {
    $content = '';
    if(file_exists('templates/'.$file)) {
        extract($data);

        ob_start();
        require_once('templates/'.$file);
        $content = ob_get_clean();
    }
    return $content;
}

// расчет времени до конца срока лота
function time_counter($time) {
    $ts_time_end = strtotime($time);
    $secs_to_end = $ts_time_end - time();
    $days_to_end = floor($secs_to_end / 86400);
    $time_left = '';
    if ($secs_to_end <= 0) {
            $time_left = '0 ч 0 мин';
    } elseif ($days_to_end > 7) {
        $data = date_create('@'.$ts_time_end);
        $time_left = date_format($data, 'd-m-y');
    } elseif ($days_to_end < 1) {
        $hours = floor($secs_to_end / 3600);
        $minutes = floor(($secs_to_end % 3600) / 60);
        $time_left = $hours.' ч '.$minutes.' мин';
    } else {
        $time_left = $days_to_end.' дн.';
    }
    return $time_left;
}

