<?php
// форматирование цены лота
function format_price($price) {
    $price = ceil($price);
    $price = number_format($price, 0, '.', ' ');
    return $price.' <b class="rub">р</b>';
}

// фильтрация данных от пользователя
function esc($lot) {
    $text = htmlspecialchars($lot);
    return $text;
}

// шаблонизатор
function include_template($file, $data) {
    if(file_exists('templates/'.$file)) {
        extract($data);

        ob_start();
        require_once('templates/'.$file);
        $content = ob_get_clean();
    } else {
        $content = '';
    }
    return $content;
}
