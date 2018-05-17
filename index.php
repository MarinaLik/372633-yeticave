<?php
require_once('functions.php');
require_once('bd_config.php');

// временно для пользователя
$user = [
    'is_auth' => (bool) rand(0, 1),
    'user_name' => 'Константин',
    'user_avatar' => 'img/user.jpg'
];

if (!$link){
    print('Ошибка подключения: ' . mysqli_connect_error());
}
else {
    $sql = 'SELECT * FROM categories';
    $result_cat = mysqli_query($link, $sql);

    if (!$result_cat) {
        print('Произошла ошибка: ' . mysqli_error($link));
    }
    else {
        $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
    }
    $sql = 'SELECT lot_id, date_start, date_end, title, price_start, image, categories.name, COUNT(bet_id) AS amount_bet, MAX(bets.cost) AS max_price FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE date_end > NOW() GROUP BY lot_id ORDER BY date_start DESC';
    $result_lot = mysqli_query($link, $sql);
    if (!$result_lot) {
        print('Произошла ошибка: ' . mysqli_error($link));
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
