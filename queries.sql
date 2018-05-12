USE yeticave;
INSERT INTO categories (name) VALUES ('Доски и лыжи'),('Крепления'),('Ботинки'),('Одежда'),('Инструменты'),('Разное');

INSERT INTO users (email, password, name, date_log, contact) VALUES
('kostya@mail.ru', 'kostya123', 'Константин', '2018-02-10 10:05:00', '+79261232233'),
('murz@mail.ru', 'mur123z', 'Мария Зубкова', '2018-04-16 20:15:56', '+79295559900'),
('vano567@mail.ru', 'qwe765van', 'Иван', '2018-05-02 14:30:32', '+79163336789');

INSERT INTO lots (category_id, title, description, image, date_start, date_end, price_start, rate_step, user_id) VALUES
(1, '2014 Rossignol District Snowboard', 'Отличные лыжи', 'img/lot-1.jpg', '2018-03-20 10:05:00', '2018-05-20', 10999, 300, 1),
(2, 'Крепления Union Contact Pro', '2015 года размер L/XL', 'img/lot-3.jpg', '2018-04-20 10:05:00', '2018-06-20', 8000, 200, 2),
(3, 'DC Mutiny Charocal', 'Ботинки для сноуборда', 'img/lot-4.jpg', '2018-05-02 15:05:00', '2018-06-02', 5800, 100, 1),
(1, 'DC Ply Mens', '2016/2017 Snowboard', 'img/lot-2.jpg', '2018-05-10 10:15:00', '2018-06-15', 15900, 500, 2),
(4, 'Mutiny Charocal', 'Куртка для сноуборда', 'img/lot-5.jpg', '2018-05-10 18:05:00', '2018-06-10', 11000, 500, 3);

INSERT INTO bets (date_add, cost, user_id, lot_id) VALUES
('2018-03-21 12:05:00', 11500, 2, 1),
('2018-03-22 18:05:00', 11800, 3, 1);
-- добавлен аватар одному пользователю
UPDATE users SET avatar = 'img/user.jpg' WHERE email = 'kostya@mail.ru';
-- изменен срок окончания лоту 2
UPDATE lots SET date_end = '2018-05-10' WHERE lot_id = 2;

-- получить все категории
SELECT name FROM categories;
-- показать лот по его id c названием категории
SELECT name, title, description, image, date_start, date_end, price_start, rate_step, user_id FROM lots JOIN categories USING (category_id) WHERE lot_id = 1;
-- обновить название лота по его идентификатору
UPDATE lots SET title = 'Union Mens Pro' WHERE lot_id = 2;
-- получить список самых свежих ставок для лота по его идентификатору
SELECT cost FROM bets WHERE lot_id = 1 ORDER BY date_add;
-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT lot_id, date_start, title, price_start, image, name, COUNT(bet_id) AS total_bet, MAX(cost) AS max_price FROM lots JOIN categories USING (category_id) LEFT JOIN bets USING (lot_id) WHERE date_end > NOW() GROUP BY lot_id ORDER BY date_start DESC;
