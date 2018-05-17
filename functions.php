<?php
date_default_timezone_set("Europe/Moscow");

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
    if ($days_to_end > 7) {
        $data = date_create($time);
        $time_left = date_format($data, 'd-m-y');
    } elseif ($days_to_end >= 0 and $days_to_end < 1) {
        $hours = floor($secs_to_end / 3600);
        $minutes = floor(($secs_to_end % 3600) / 60);
        $time_left = $hours.' ч '.$minutes.' мин';
    } else {
        $time_left = $days_to_end.' дн.';
    }
    return $time_left;
}

// форматирование цены лота
// function format_price($price) {
//     $price = ceil($price);
//     $price = number_format($price, 0, '.', ' ');
//     return $price.' <b class="rub">р</b>';
// }

// значение цены
function price_value($amount_bet) {
    if ($amount_bet > 0) {
        return 'ставок ' . $amount_bet;
    }
    return 'Стартовая цена';
}

// определение максимальной цены с форматированием цены лота
function max_price($pr_max, $pr_start) {
    $price = ($pr_max != NULL) ? ceil($pr_max) : ceil($pr_start);
    $format_price = number_format($price, 0, '.', ' ');
    return $format_price;
}

// определение минимальной ставки с форматированием
function min_bet($pr_max, $pr_start, $step) {
    $cost_start = ($pr_max != NULL) ? ceil($pr_max) : ceil($pr_start);
    $cost_min = floor($cost_start + $step);
    $cost_min = number_format($cost_min, 0, '.', ' ');
    return $cost_min;
}
