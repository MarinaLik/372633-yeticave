CREATE DATABASE yeticave DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE users (
user_id INT AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(128),
password VARCHAR(64),
name VARCHAR(128),
date_log DATETIME,
avatar VARCHAR(255),
contact TEXT
);

CREATE TABLE categories (
category_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(128)
);

CREATE TABLE lots (
lot_id INT AUTO_INCREMENT PRIMARY KEY,
category_id INT,
title VARCHAR(255),
description TEXT,
image VARCHAR(255),
date_start DATETIME,
date_end DATE,
price_start INT,
rate_step INT,
user_id INT,
victor_id INT,
FOREIGN KEY (category_id) REFERENCES categories(category_id),
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (victor_id) REFERENCES users(user_id)
);

CREATE TABLE bets (
bet_id INT AUTO_INCREMENT PRIMARY KEY,
date_add DATETIME,
cost INT,
user_id INT,
lot_id INT,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (lot_id) REFERENCES lots(lot_id)
);

CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX lot_tit ON lots(title);
CREATE INDEX lot_bets ON bets(lot_id, cost);
