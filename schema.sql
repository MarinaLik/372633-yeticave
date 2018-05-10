CREATE DATABASE yeticave DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE yeticave;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
email CHAR(128),
password CHAR(64),
name CHAR(128),
date_log DATETIME,
avatar CHAR(255),
contact TEXT
);

CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
name CHAR(128)
);

CREATE TABLE lots (
id INT AUTO_INCREMENT PRIMARY KEY,
category_id INT,
title CHAR(255),
description TEXT,
image CHAR(255),
date_start DATETIME,
date_end DATE,
price_start INT,
rate_step INT,
author_id INT,
victor_id INT
);

CREATE TABLE rates (
id INT AUTO_INCREMENT PRIMARY KEY,
date_add DATETIME,
cost INT,
user_id INT,
lot_id INT
);

CREATE UNIQUE INDEX email ON users(email);
CREATE INDEX u_lots ON lots(author_id);
CREATE INDEX u_rates ON rates(user_id);
CREATE INDEX lot_cat ON lots(category_id);
CREATE INDEX lot_tit ON lots(title);
CREATE INDEX lot_start ON lots(date_start);
CREATE INDEX lot_price ON lots(price_start);
CREATE INDEX lot_rates ON rates(lot_id, cost);
