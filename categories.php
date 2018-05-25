<?php
// получаем категории
$sql = 'SELECT * FROM categories';
$result_cat = mysqli_query($link, $sql);

if (!$result_cat) {
    $error = mysqli_error($link);
    $layout_content = include_template('error.php', ['error' => $error]);
    exit();
}
$categories = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);
