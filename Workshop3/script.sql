CREATE DATABASE workshop3;
USE workshop3;

CREATE TABLE provincias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

INSERT INTO provincias (nombre) VALUES
('San José'), 
('Alajuela'), 
('Cartago'),
('Heredia'), 
('Guanacaste'), 
('Puntarenas'), 
('Limón');

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    provincia_id INT NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (provincia_id) REFERENCES provincias(id)
);