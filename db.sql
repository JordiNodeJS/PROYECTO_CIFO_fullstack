
DROP DATABASE IF EXISTS bookmarks;
CREATE DATABASE IF NOT EXISTS bookmarks DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
USE bookmarks;

-- ALTER DATABASE 4055208_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE usuarios (
	id INT(11) AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(60),
    UNIQUE (usuario),
    UNIQUE (usuario, password)
) ENGINE = InnoDB;


CREATE TABLE proyectos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(180)
) ENGINE = InnoDB;

CREATE TABLE tareas (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(180),
    estado SMALLINT(1) DEFAULT 0,
    id_proyecto INT(11),
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id)
) ENGINE = InnoDB;




INSERT INTO proyectos (id, nombre) VALUES (1, 'Publicación de una página web');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (1, 'Añadir el logotipo');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (1, 'Implementar las secciones');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (1, 'Desarrollo del contenido');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (1, 'Desarrollo del contenido');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (1, 'Elección de la paleta de colores');

INSERT INTO proyectos (id, nombre) VALUES (2, 'Creación del logotipo');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (2, 'Diseño del logotipo');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (2, 'Elección de la paleta de colores');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (2, 'Creación de una guía de estilos');

INSERT INTO proyectos (id, nombre) VALUES (3, 'Reparar las ventanas');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (3, 'Presupuesto');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (3, 'Buscar un carpintero local');
    INSERT INTO tareas (id_proyecto, nombre) VALUES (3, 'Ferretería');
