
DROP DATABASE IF EXISTS bookmarks;
CREATE DATABASE IF NOT EXISTS bookmarks DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
USE bookmarks;

CREATE TABLE usuarios (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(60),
    UNIQUE (usuario, password)
) ENGINE = InnoDB;

CREATE TABLE proyectos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(180)
) ENGINE = InnoDB;

CREATE TABLE tareas (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(180),
    estado INT(1),
    id_proyecto INT(11),
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id)
) ENGINE = InnoDB;
