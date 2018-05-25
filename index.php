<?php
require_once('functions.php');
require_once('bd_config.php');
require_once('categories.php');

// получаем количество страниц для пагинации из расчета 6 лотов на 1 страницу
$sql = 'SELECT lot_id FROM lots';
$res_count = mysqli_query($link, $sql);
if (!$res_count) {
    $error = mysqli_error($link);
    $page_content = include_template('error.php', ['error' => $error]);
    }
$count_lots = mysqli_num_rows($res_count);
$lots_on_page = 6;
$pages = 1;
if ($count_lots > $lots_on_page) {
    $n = floor($count_lots / $lots_on_page);
    $pages = ($count_lots % $lots_on_page == 0) ? $n : ($n+1);
}
// получаем лоты для заданной страницы
$num_page = 0;
if (isset($_GET['page'])){
    $num_page = intval($_GET['page']) -1;
}
$sql = 'SELECT lot_id, date_start, date_end, title, price_start, image, categories.name, COUNT(bet_id) AS amount_bet, MAX(bets.cost) AS max_price FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE date_end > NOW() GROUP BY lot_id ORDER BY date_start DESC LIMIT '. $lots_on_page .' OFFSET ' . $num_page*$lots_on_page;
$result_lot = mysqli_query($link, $sql);
if (!$result_lot) {
    $error = mysqli_error($link);
    $page_content = include_template('error.php', ['error' => $error]);
    }
else {
    $lots = mysqli_fetch_all($result_lot, MYSQLI_ASSOC);
    $page_content = include_template('index.php', [
    'categories' => $categories,
    'lots' => $lots,
    'pages' => $pages]);
}

$layout_content = include_template('layout.php', [
'content' => $page_content,
'title' => 'YetiCave - Главная страница',
'user' => $user,
'categories' => $categories
]);

print($layout_content);
?>
