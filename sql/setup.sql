-- Creates the database
CREATE DATABASE `g4rden-db`;

-- Selects the database
USE `g4rden-db`;

-- Creates the user and password
CREATE USER 'g4rden-user' @'localhost' IDENTIFIED BY 'g4rden-password';

-- Gives to the user all privileges on the database
GRANT ALL PRIVILEGES ON `g4rden-db`.* TO 'g4rden-user'@'localhost';

-- Creates user table
CREATE TABLE `User` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL UNIQUE,
    `passwordHash` varchar(255) NOT NULL,
    `userType` ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
);

-- Creates message table
CREATE TABLE `Message` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `content` TEXT(3000) NOT NULL,
    `date` datetime NOT NULL,
    `userId` int NOT NULL,
    FOREIGN KEY (`userId`) REFERENCES `User` (`id`)
);