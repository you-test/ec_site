CREATE TABLE item (
  `id` SERIAL PRIMARY KEY,
  `name` TEXT ,
  `price` INT,
  `explain` TEXT
);

CREATE TABLE users (
  `id` SERIAL PRIMARY KEY,
  `name` INT NOT NULL,
  `pass` INT NOT NULL
);
