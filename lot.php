<?php
require_once('functions.php');
require_once('bd_config.php');
require_once('categories.php');

// проверка на наличие запроса по id лота
if (!isset($_GET['id'])){
    http_response_code(404);
    header("Location: /index.php");
}
$num_lot = intval($_GET['id']);

$sql = 'SELECT categories.name, title, description, image, date_start, date_end, price_start, rate_step FROM lots JOIN categories USING (category_id) WHERE  lot_id = ' . $num_lot . ' AND date_end > NOW()';
$result_lot = mysqli_query($link, $sql);

if (!$result_lot) {
    $error = mysqli_error($link);
    $page_content = include_template('error.php', ['error' => $error]);
    }
elseif (mysqli_num_rows($result_lot) < 1) {
    http_response_code(404);
    $error = 'Лот не найден';
    header("Location: /index.php");
}
$lot = mysqli_fetch_assoc($result_lot);
// получение ставок по лоту
$sql = 'SELECT date_add, cost, users.name FROM bets JOIN users USING (user_id) WHERE lot_id = '. $num_lot .' ORDER BY date_add DESC';
$res_bets = mysqli_query($link, $sql);

if (!$res_bets) {
    $error = mysqli_error($link);
    $page_content = include_template('error.php', ['error' => $error]);
}
else {
    $bets = mysqli_fetch_all($res_bets, MYSQLI_ASSOC);

    $page_content = include_template('lot.php', [
    'categories' => $categories,
    'lot' => $lot,
    'bets' => $bets]);
}
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'title' => $lot['title'],
    'user' => $user,
    'categories' => $categories
]);

print($layout_content);
?>
