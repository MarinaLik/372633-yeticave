<?php
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

// расчет времени до полуночи
function time_counter() {
    date_default_timezone_set("Europe/Moscow");
    $ts_midnight = strtotime('tomorrow');
    $secs_to_midnight = $ts_midnight - time();
    $hours = floor($secs_to_midnight / 3600);
    $minutes = floor(($secs_to_midnight % 3600) / 60);
    return $hours.':'.$minutes;
}

