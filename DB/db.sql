-- Eliminar la base de datos si existe
DROP DATABASE IF EXISTS netflix;

-- Crear la base de datos
CREATE DATABASE netflix;

-- Usar la base de datos
USE netflix;

-- Crear la tabla de roles
CREATE TABLE tbl_rol (
    id_rol INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_rol VARCHAR(20) NOT NULL
);

-- Crear la tabla de usuarios
CREATE TABLE tbl_users (
    id_user INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pwd VARCHAR(100) NOT NULL,
    rol INT(3) NULL,
    activo INT(3) NOT NULL,
    FOREIGN KEY (rol) REFERENCES tbl_rol(id_rol)
);

-- Crear la tabla de genero
CREATE TABLE tbl_genero (
    id_gen INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_gen VARCHAR(50) NOT NULL
);

-- Crear la tabla de contenido
CREATE TABLE tbl_contenido (
    id_cont INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    desc_cont VARCHAR(100) NOT NULL,
    url_video VARCHAR(200) NULL,
    fecha_estreno DATE NULL,
    genero int(3) NOT NULL,
    portada VARCHAR(200) NULL,
    FOREIGN KEY (genero) REFERENCES tbl_genero(id_gen)
);


-- Crear la tabla de likes
CREATE TABLE tbl_likes (
    id_like INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user_like INT(3) NOT NULL,
    id_cont_like INT(3) NOT NULL,
    FOREIGN KEY (id_user_like) REFERENCES tbl_users(id_user),
    FOREIGN KEY (id_cont_like) REFERENCES tbl_contenido(id_cont)
);

INSERT INTO tbl_rol (nom_rol) VALUES
    ('ADMIN'),
    ('USER');

INSERT INTO tbl_users (nom,email,pwd,rol,activo) VALUES
    ('Admin','admin@gmail.com','$2y$10$uoZ8C408y3ACdNkzMiTBQepW6PRRP/SA19bJSpGGMAej14f6brPgK',1,1),
    ('Julio','julio@gmail.com','$2y$10$uoZ8C408y3ACdNkzMiTBQepW6PRRP/SA19bJSpGGMAej14f6brPgK',2,0);

INSERT INTO tbl_genero (nom_gen) VALUES
    ('Acción'),
    ('Comedia'),
    ('Drama'),
    ('Aventura'),
    ('Ciencia ficción'),
    ('Romance');

INSERT INTO tbl_contenido (titulo, desc_cont, url_video, fecha_estreno, Genero, portada) VALUES
    ('The Matrix', 'Ciencia ficción y acción', 'matrix.mp4', '1999-03-31', 1,'matrix.jpg'),
    ('The Shawshank Redemption', 'Drama carcelario', 'https://example.com/shawshank', '1994-09-23', 3,'The_Shawshank_Redemption.jpg'),
    ('Inception', 'Ciencia ficción y thriller', 'https://example.com/inception', '2010-07-16', 1,'Inception.jpg'),
    ('The Godfather', 'Drama criminal', 'https://example.com/godfather', '1972-03-24', 3,'The_Godfather.jpg'),
    ('Pulp Fiction', 'Drama criminal', 'https://example.com/pulpfiction', '1994-10-14', 3,'Pulp_Fiction.jpg'),
    ('The Dark Knight', 'Acción y crimen', 'https://example.com/darkknight', '2008-07-18', 1,'The_Dark_Knight.jpg'),
    ('Forrest Gump', 'Drama y comedia', 'https://example.com/forrestgump', '1994-07-06', 3,'Forrest_Gump.jpg'),
    ('The Dark Knight Rises', 'Acción y crimen', 'https://example.com/darkknightrises', '2012-07-20', 1,'The_Dark_Knight_Rises.jpg'),
    ('Schindler''s List', 'Drama histórico', 'https://example.com/schindlerslist', '1993-12-15', 3,'Schindlers_List.jpg'),
    ('The Silence of the Lambs', 'Thriller y horror', 'https://example.com/silenceofthelambs', '1991-02-14', 2,'The_Silence_of_the_Lambs.jpg'),
    ('Fight Club', 'Drama y psicológico', 'https://example.com/fightclub', '1999-10-15', 3,'Fight_Club.jpg'),
    ('The Lord of the Rings: The Fellowship of the Ring', 'Fantasía y aventura', 'https://example.com/lotr_fellowship', '2001-12-19', 4,'LOTR_The_Fellowship_of_the_Ring.jpg'),
    ('The Godfather: Part II', 'Drama criminal', 'https://example.com/godfather2', '1974-12-20', 3,'The_Godfather_Part_II.jpg'),
    ('Casablanca', 'Romance y drama', 'https://example.com/casablanca', '1942-01-23', 6,'Casablanca.jpg'),
    ('Blade Runner', 'Ciencia ficción y neo-noir', 'https://example.com/bladerunner', '1982-06-25', 5,'Blade_Runner.jpg'),
    ('The Grand Budapest Hotel', 'Comedia y drama', 'https://example.com/grandbudapesthotel', '2014-03-28', 2,'The_Grand_Budapest_Hotel.jpg');


