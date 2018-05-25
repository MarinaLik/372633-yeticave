<?php
require_once('functions.php');
require_once('mysql_helper.php');
require_once('bd_config.php');
require_once('categories.php');

$cat_id = [];
foreach ($categories as $category) {
    array_push($cat_id, $category['category_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;
    $required = ['lot-name' => 'Введите наименование лота',
                'message' => 'Напишите описание лота',
                'lot-rate' => 'Введите начальную цену',
                'lot-step' => 'Введите шаг ставки',
                'lot-date' => 'Введите дату завершения торгов'];
    $errors = [];
    foreach ($required as $key => $value) {
        if (empty($_POST[$key])) {
            $errors[$key] = $value;
        }
    }
    if (!in_array(intval($lot['category']), $cat_id)) {
            $errors['category'] = 'Выберите категорию';
        }

    if (!empty($lot['lot-rate']) && !is_digit($lot['lot-rate'])) {
        $errors['lot-rate'] = 'Введите только цифры';
    }
    if (!empty($lot['lot-step']) && !is_digit($lot['lot-step'])) {
        $errors['lot-step'] = 'Введите только цифры';
    }
    if (!empty($lot['lot-date'])) {
        $is_date = strtotime($lot['lot-date']);
        if ($is_date == false) {
            $errors['lot-date'] = 'Введите действительную дату';
        } elseif ($is_date <= time()) {
            $errors['lot-date'] = 'Дата окончания торгов должна быть больше текущей';
        }
    }

    if (empty($_FILES['lot_img']['name'])) {
        $errors['lot_img'] = 'Вы не загрузили файл';
    }
    else {
        $tmp_name = $_FILES['lot_img']['tmp_name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type == 'image/jpeg') {
            $path = uniqid() . '.jpg';
            move_uploaded_file($tmp_name, 'img/'. $path);
            $lot['image'] = 'img/'. $path;
        }
        elseif ($file_type == "image/png") {
            $path = uniqid() . '.png';
            move_uploaded_file($tmp_name, 'img/'. $path);
            $lot['image'] = 'img/'. $path;
        }
        else  {
            $errors['lot_img'] = 'Загрузите картинку в формате jpeg или png';
        }
    }

    if (count($errors) > 0) {
        $page_content = include_template('add.php', ['lot' => $lot, 'categories' => $categories, 'errors' => $errors]);
    }
    else {
        $sql = 'INSERT INTO lots (date_start, title, category_id, description, image, date_end, price_start, rate_step, user_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, 1)';

        $stmt = db_get_prepare_stmt($link, $sql, [$lot['lot-name'], $lot['category'], $lot['message'], $lot['image'], $lot['lot-date'], $lot['lot-rate'], $lot['lot-step']]);
        $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $lot_id = mysqli_insert_id($link);
            header("Location: /lot.php?id=".$lot_id);
        }
    }
}
else {
    $page_content = include_template('add.php', ['categories' => $categories]);
}

$layout_content = include_template('layout.php', [
'content' => $page_content,
'title' => 'Добавление лота',
'user' => $user,
'categories' => $categories
]);

print($layout_content);
?>
