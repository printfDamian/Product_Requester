DROP DATABASE IF EXISTS requester;

CREATE DATABASE requester CHARACTER SET utf8 COLLATE utf8_general_ci;

USE requester;

DROP TABLE IF EXISTS clients;

CREATE TABLE
    clients(
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        name VARCHAR(50) NULL,
        phone INT(20) NULL,
        email VARCHAR(50) NULL,
        country VARCHAR(50) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        updated_at TIMESTAMP NULL,
        deleted_at TIMESTAMP NULL
    ) ENGINE = InnoDB;
DROP TABLE IF EXISTS products;
CREATE TABLE products(
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        name VARCHAR(50) NULL,
        description VARCHAR(50) NOT NULL,
        votes INT(11) NOT NULL,
        file VARCHAR(50) NOT NULL,
        status_id INT(11) UNSIGNED NOT NULL,
        client_id INT(11) UNSIGNED NOT NULL,
        product_link VARCHAR(50) NOT NULL, /*exemplo (https://www.axiis-ea.com/products/passenger-pegs-ktm-exc-sx-and-xc-2020)*/
        created_at TIMESTAMP NOT NULL,
        updated_at TIMESTAMP NULL,
        deleted_at TIMESTAMP NULL
    ) ENGINE = InnoDB;

DROP TABLE IF EXISTS states;
CREATE TABLE status (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        name VARCHAR(50) NOT NULL,
        created_at TIMESTAMP NOT NULL,
        updated_at TIMESTAMP NULL,
        deleted_at TIMESTAMP NULL
    ) ENGINE = InnoDB;

DROP TABLE IF EXISTS votos;
CREATE TABLE votos (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
        client_id INT(11) UNSIGNED NOT NULL,
        product_id INT(11) UNSIGNED NOT NULL,
        created_at TIMESTAMP NOT NULL,
        updated_at TIMESTAMP NULL,
        deleted_at TIMESTAMP NULL
    ) ENGINE = InnoDB;
