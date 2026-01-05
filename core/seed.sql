CREATE DATABASE polovni_automobili_db;
use polovni_automobili_db;

CREATE TABLE users
(
    id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name     VARCHAR(100) NOT NULL,
    email    VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role     ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE car_brands
(
    id   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE car_models
(
    id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    brand_id INT UNSIGNED NOT NULL,
    name     VARCHAR(50) NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES car_brands (id)
);

INSERT INTO car_brands (name)
VALUES ('Audi'),
       ('BMW'),
       ('Mercedes-Benz'),
       ('Volkswagen'),
       ('Opel'),
       ('Ford'),
       ('Toyota'),
       ('Peugeot'),
       ('Renault'),
       ('Škoda');

INSERT INTO car_models (brand_id, name)
VALUES (1, 'A3'),
       (1, 'A4'),
       (1, 'A6'),
       (1, 'A8'),
       (1, 'Q3'),
       (1, 'Q5'),
       (1, 'Q7');
INSERT INTO car_models (brand_id, name)
VALUES (2, 'Series 1'),
       (2, 'Series 3'),
       (2, 'Series 5'),
       (2, 'X1'),
       (2, 'X3'),
       (2, 'X5'),
       (2, 'X6');
INSERT INTO car_models (brand_id, name)
VALUES (3, 'A-Class'),
       (3, 'C-Class'),
       (3, 'E-Class'),
       (3, 'S-Class'),
       (3, 'GLA'),
       (3, 'GLC'),
       (3, 'GLE');
INSERT INTO car_models (brand_id, name)
VALUES (4, 'Golf'),
       (4, 'Passat'),
       (4, 'Polo'),
       (4, 'Tiguan'),
       (4, 'Touareg'),
       (4, 'Touran');
INSERT INTO car_models (brand_id, name)
VALUES (5, 'Astra'),
       (5, 'Corsa'),
       (5, 'Insignia'),
       (5, 'Zafira'),
       (5, 'Vectra');
INSERT INTO car_models (brand_id, name)
VALUES (6, 'Fiesta'),
       (6, 'Focus'),
       (6, 'Mondeo'),
       (6, 'Kuga'),
       (6, 'Galaxy');
INSERT INTO car_models (brand_id, name)
VALUES (7, 'Yaris'),
       (7, 'Corolla'),
       (7, 'Avensis'),
       (7, 'RAV4'),
       (7, 'Land Cruiser');
INSERT INTO car_models (brand_id, name)
VALUES (8, '208'),
       (8, '308'),
       (8, '508'),
       (8, '2008'),
       (8, '3008');
INSERT INTO car_models (brand_id, name)
VALUES (9, 'Clio'),
       (9, 'Megane'),
       (9, 'Laguna'),
       (9, 'Kadjar'),
       (9, 'Captur');
INSERT INTO car_models (brand_id, name)
VALUES (10, 'Fabia'),
       (10, 'Octavia'),
       (10, 'Superb'),
       (10, 'Kodiaq'),
       (10, 'Karoq');

create table ads
(
    id          int unsigned auto_increment primary key,

    user_id     int unsigned not null,
    brand_id    int unsigned not null,
    model_id    int unsigned not null,

    price       int unsigned not null,
    year        int unsigned not null,
    mileage     int unsigned not null,
    location    varchar(100) not null,
    description text         not null,

    foreign key (user_id) references users (id),
    foreign key (brand_id) references car_brands (id),
    foreign key (model_id) references car_models (id)
);

create table ad_images
(
    id    int unsigned auto_increment primary key,
    ad_id int unsigned not null,
    path  varchar(255) not null,

    foreign key (ad_id) references ads (id)
)