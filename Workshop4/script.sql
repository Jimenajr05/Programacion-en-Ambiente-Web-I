CREATE DATABASE workshop4;

USE  workshop4;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    usuario VARCHAR(50) UNIQUE,
    clave VARCHAR(255),
    rol VARCHAR(10),
    activo TINYINT(1) DEFAULT 1
);

INSERT INTO usuarios (nombre, usuario, clave, rol)
VALUES ('Administrador', 'admin', MD5('1234'), 'admin');