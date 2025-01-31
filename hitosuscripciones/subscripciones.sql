DROP DATABASE IF EXISTS subscripciones;
CREATE DATABASE subscripciones;
USE subscripciones;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    age INT NOT NULL,
    base_plan ENUM('Básico', 'Estándar', 'Premium') NOT NULL,
    subscription_duration INT NOT NULL
);

CREATE TABLE user_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package ENUM('Deporte', 'Cine', 'Infantil') NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, age, base_plan, subscription_duration)
VALUES
    ('Juan Pérez', 'juan.perez@email.com', 25, 'Estándar', 1),
    ('Ana Gómez', 'ana.gomez@email.com', 17, 'Básico', 12),
    ('Carlos López', 'carlos.lopez@email.com', 30, 'Premium', 1),
    ('Marta Ruiz', 'marta.ruiz@email.com', 22, 'Estándar', 1),
    ('Luis Martínez', 'luis.martinez@email.com', 15, 'Básico', 12);

INSERT INTO user_packages (user_id, package)
VALUES
    (1, 'Deporte'),
    (1, 'Cine'),
    (2, 'Infantil'),
    (3, 'Cine'),
    (4, 'Deporte'),
    (5, 'Infantil');