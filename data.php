<?php
$user = [
    'is_auth' => (bool) rand(0, 1),
    'user_name' => 'Константин',
    'user_avatar' => 'img/user.jpg'
];

$categories = [
    ['name' => 'Доски и лыжи', 'bg-view' => 'boards'],
    ['name' => 'Крепления', 'bg-view' => 'attachment'],
    ['name' => 'Ботинки', 'bg-view' => 'boots'],
    ['name' => 'Одежда', 'bg-view' => 'clothing'],
    ['name' => 'Инструменты', 'bg-view' => 'tools'],
    ['name' => 'Разное', 'bg-view' => 'other']
];

$lots = [
    ['title' => '2014 Rossignol District Snowboard',
    'category' => 'Доски и лыжи',
    'price' => '10999',
    'img' => 'img/lot-1.jpg',
    'time_end' => '20 May 2018'
    ],
    ['title' => 'DC Ply Mens 2016/2017 Snowboard',
    'category' => 'Доски и лыжи',
    'price' => '159999',
    'img' => 'img/lot-2.jpg',
    'time_end' => '10 May 2018'
    ],
    ['title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
    'category' => 'Крепления',
    'price' => '8000',
    'img' => 'img/lot-3.jpg',
    'time_end' => '11 May 2018'
    ],
    ['title' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'category' => 'Ботинки',
    'price' => '10999',
    'img' => 'img/lot-4.jpg',
    'time_end' => '12 May 2018'
    ],
    ['title' => 'Куртка для сноуборда DC Mutiny Charocal',
    'category' => 'Одежда',
    'price' => '7500',
    'img' => 'img/lot-5.jpg',
    'time_end' => '14 May 2018'
    ],
    ['title' => 'Маска Oakley Canopy',
    'category' => 'Разное',
    'price' => '5400',
    'img' => 'img/lot-6.jpg',
    'time_end' => '22 May 2018'
    ]
];

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];
