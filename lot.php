<?php
require_once('functions.php');
require_once('bd_config.php');
require_once('data.php');

if (!$link){
    $error = mysqli_connect_error();
    $layout_content = include_template('error.php', ['error' => $error]);
}
else {
    $sql = 'SELECT * FROM categories';
    $result_cat = mysqli_query($link, $sql);

    if (!$result_cat) {
        print('Произошла ошибка: ' . mysqli_error($link));
    }
    $categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);

    if (isset($_GET['id'])) {
        $num_lot = intval($_GET['id']);

        $sql = 'SELECT categories.name, title, description, image, date_start, date_end, price_start, rate_step FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE lot_id = ' . $num_lot;
        $result_lot = mysqli_query($link, $sql);

        if (!$result_lot) {
            $error = mysqli_error($link);
            $page_content = include_template('error.php', ['error' => $error]);
            }
        elseif (mysqli_num_rows($result_lot) < 1) {
            http_response_code(404);
            $error = 'Лот не найден';
            $page_content = include_template('error.php', ['error' => $error]);
        }
        else {
            $lot = mysqli_fetch_assoc($result_lot);
            $page_content = include_template('lot.php', [
            'categories' => $categories,
            'lot' => $lot,
            'bets' => $bets]);
        }
    }
    else {
        http_response_code(404);
        header("Location: /index.php");
    }
    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'title' => $lot['title'],
        'user' => $user,
        'categories' => $categories
    ]);
}

print($layout_content);
?>
