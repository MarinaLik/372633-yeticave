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

// форматирование цены
function format_price($price) {
    $price = floor($price);
    $price = number_format($price, 0, '.', ' ');
    return $price;
}

// значение цены
function price_value($amount_bet) {
    if ($amount_bet > 0) {
        return 'ставок ' . $amount_bet;
    }
    return 'Стартовая цена';
}

// определение максимальной цены
function max_price($pr_max, $pr_start) {
    $price_max = ($pr_max != NULL) ? $pr_max : $pr_start;
    $price_max = format_price($price_max);
    return $price_max;
}

// определение минимальной ставки
function min_bet($pr_max, $pr_start, $step) {
    $cost_start = ($pr_max != NULL) ? $pr_max : $pr_start;
    $cost_min = $cost_start + $step;
    $cost_min = format_price($cost_min);
    return $cost_min;
}
