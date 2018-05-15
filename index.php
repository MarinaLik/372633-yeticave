<?php
require_once('functions.php');

$user = [
    'is_auth' => (bool) rand(0, 1),
    'user_name' => 'Константин',
    'user_avatar' => 'img/user.jpg'
];

$link = mysqli_connect('localhost', 'irmida', 'qwerty', 'yeticave');
mysqli_set_charset($link, "utf8");

if (!$link){
    print('Ошибка: ' . mysqli_connect_error());
}
else {
    $sql = 'SELECT * FROM categories';
    $result_cat = mysqli_query($link, $sql);

    if (!$result_cat) {
        $page_content = 'Произошла ошибка: ' . mysqli_error($link);
        $categories = '';
    }
    else {
        $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
    }
    $sql = 'SELECT date_start, date_end, title, price_start, image, categories.name FROM lots JOIN categories USING (category_id) WHERE date_end > NOW() ORDER BY date_start DESC';
    $result_lot = mysqli_query($link, $sql);
    if (!$result_lot) {
        $page_content = 'Произошла ошибка: ' . mysqli_error($link);
        }
    else {
        $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
    }
}

$page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => 'YetiCave - Главная страница',
    'user' => $user,
    'categories' => $categories
]);

print($layout_content);
?>
