<?php
$db = [
    'host' => 'localhost',
    'user' => 'irmida',
    'password' => 'qwerty',
    'database' => 'yeticave'
];

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");
?>
