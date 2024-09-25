-- Creates the database
CREATE DATABASE `g4rden-db`;

-- Selects the database
USE `g4rden-db`;

-- Creates the user and password
CREATE USER 'g4rden-user' @'localhost' IDENTIFIED BY 'g4rden-password';

-- Gives to the user all privileges on the database
GRANT ALL PRIVILEGES ON `g4rden-db`.* TO 'g4rden-user'@'localhost';