<?php
$db = [
    'host' => 'localhost',
    'user' => 'irmida',
    'password' => 'qwerty',
    'database' => 'yeticave'
];
// временно для пользователя
$user = [
    'is_auth' => (bool) rand(0, 1),
    'user_name' => 'Константин',
    'user_avatar' => 'img/user.jpg'
];

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");

if (!$link){
    $error = mysqli_connect_error();
    $layout_content = include_template('error.php', ['error' => $error]);
    exit();
}
?>
