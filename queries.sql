USE yeticave;
INSERT INTO categories (name, bg_view) VALUES ('Доски и лыжи', 'boards'),('Крепления', 'attachment'),('Ботинки', 'boots'),('Одежда', 'clothing'),('Инструменты', 'tools'),('Разное', 'other');

INSERT INTO users (email, password, name, date_log, contact) VALUES
('kostya@mail.ru', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Константин', '2018-02-10 10:05:00', '+79261232233'),
('murz@mail.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Мария Зубкова', '2018-04-16 20:15:56', '+79295559900'),
('vano567@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Иван', '2018-05-02 14:30:32', '+79163336789');

INSERT INTO lots (category_id, title, description, image, date_start, date_end, price_start, rate_step, user_id) VALUES
(1, '2014 Rossignol District Snowboard', 'Отличные лыжи', 'img/lot-1.jpg', '2018-04-15 00:00:00', '2018-05-25', 10999, 300, 1),
(2, 'Union Mens Pro', '2015 года размер L/XL', 'img/lot-3.jpg', '2018-04-20 10:05:00', '2018-05-29', 8000, 200, 2),
(3, 'Ботинки DC Mutiny Charocal', 'Крутые ботинки для сноуборда', 'img/lot-4.jpg', '2018-05-02 15:05:00', '2018-05-27', 10999, 300, 1),
(1, 'DC Ply Mens 2016/2017 Snowboard', '2016/2017 Snowboard новый, не использовался', 'img/lot-2.jpg', '2018-05-04 10:15:00', '2018-06-04', 15999, 500, 2),
(4, 'Куртка DC Mutiny Charocal', 'Куртка теплая и убодная', 'img/lot-5.jpg', '2018-05-09 18:05:00', '2018-06-09', 7500, 500, 3),
(6, 'Маска Oakley Canopy', '2015 года размер L/XL', 'img/lot-6.jpg', '2018-05-10 12:25:00', '2018-05-30', 5400, 200, 2);

INSERT INTO bets (date_add, cost, user_id, lot_id) VALUES
('2018-03-21 12:05:00', 11500, 2, 1),
('2018-03-22 18:05:00', 11800, 3, 1);

-- добавлен аватар одному пользователю
UPDATE users SET avatar = 'img/user.jpg' WHERE email = 'kostya@mail.ru';

-- получить все категории
SELECT name FROM categories;
-- показать лот по его id c названием категории
SELECT categories.name, title, description, image, date_start, date_end, price_start, rate_step, user_id FROM lots JOIN categories USING (category_id) WHERE lot_id = 1;
-- обновить название лота по его идентификатору
UPDATE lots SET title = 'Крепления Union Contact Pro 2015' WHERE lot_id = 2;
-- получить список самых свежих ставок для лота по его идентификатору
SELECT cost FROM bets WHERE lot_id = 1 ORDER BY date_add;
-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT lot_id, date_start, title, price_start, image, categories.name, COUNT(bet_id) AS amount_bet, MAX(bets.cost) AS max_price FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE date_end > NOW() GROUP BY lot_id ORDER BY date_start DESC;
-- добавлен новый лот
INSERT INTO lots (category_id, title, description, image, date_start, date_end, price_start, rate_step, user_id) VALUES
(2, 'Union Contact Black 2016', 'размер M/L', 'img/lot-3.jpg', NOW(), '2018-06-10', 8000, 200, 2);
