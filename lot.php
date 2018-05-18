<?php
require_once('functions.php');
require_once('bd_config.php');

// временно для пользователя
$user = [
    'is_auth' => (bool) rand(0, 1),
    'user_name' => 'Константин',
    'user_avatar' => 'img/user.jpg'
];

if (!$link) {
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

    if (isset($_GET['id'])) {
        $num_lot = intval($_GET['id']);

        $sql = 'SELECT categories.name, title, description, image, date_start, date_end, price_start, rate_step, MAX(bets.cost) AS max_price FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE lot_id = ' . $num_lot;
        $result_lot = mysqli_query($link, $sql);
        if (!$result_lot) {
            print('Произошла ошибка: ' . mysqli_error($link));
            }
        else {
            $lot = mysqli_fetch_assoc($result_lot);
            $page_content = include_template('lot.php', [
            'categories' => $categories,
            'lot' => $lot]);
        }
        if ($lot['title'] == NULL) {
            http_response_code(404);
            $page_content = 'Лот не найден';
        }

    }
    else {
        header("Location: /index.php");
    }

}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => $lot['title'],
    'user' => $user,
    'categories' => $categories
]);

print($layout_content);
?>
