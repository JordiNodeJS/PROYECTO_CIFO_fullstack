
DROP DATABASE IF EXISTS tasktron;
CREATE DATABASE IF NOT EXISTS tasktron DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
USE tasktron;

CREATE TABLE usuarios (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(60),
    UNIQUE (usuario, password)
) ENGINE = InnoDB;
