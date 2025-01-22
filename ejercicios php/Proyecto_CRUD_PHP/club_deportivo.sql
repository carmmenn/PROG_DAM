DROP DATABASE IF EXISTS club_deportivo;
CREATE DATABASE club_deportivo;
USE club_deportivo;

-- Tabla socios
CREATE TABLE socios (
  id_socio INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  telefono VARCHAR(15),
  fecha_nacimiento DATE
);

-- Tabla eventos
CREATE TABLE eventos (
  id_evento INT AUTO_INCREMENT PRIMARY KEY,
  nombre_evento VARCHAR(100) NOT NULL,
  fecha DATE NOT NULL,
  lugar VARCHAR(100) NOT NULL
);

-- Tabla inscripciones
CREATE TABLE inscripciones (
  id_inscripcion INT AUTO_INCREMENT PRIMARY KEY,
  id_socio INT,
  id_evento INT,
  fecha_inscripcion DATE,
  FOREIGN KEY (id_socio) REFERENCES socios(id_socio),
  FOREIGN KEY (id_evento) REFERENCES eventos(id_evento)
);
