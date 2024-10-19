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
    `userId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` VARCHAR(50) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `passwordHash` VARCHAR(255) NOT NULL,
    `userType` ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
);

-- Creates subject table
CREATE TABLE `Subject` (
    `subjectId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `description` TEXT(3000) NOT NULL,
    `isValidated` BOOLEAN NOT NULL DEFAULT FALSE, -- a subject created by an user must be validated by an admin
    `userId` INT NOT NULL,
    FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE
);

-- Creates message table
CREATE TABLE `Message` (
    `messageId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `content` TEXT(3000) NOT NULL,
    `date` TIMESTAMP NOT NULL,
    `userId` INT NOT NULL,
    `subjectId` INT, -- null is for general chat, not null is for subject chat
    FOREIGN KEY (`userId`) REFERENCES `User` (`userId`) ON DELETE CASCADE,
    FOREIGN KEY (`subjectId`) REFERENCES `Subject` (`subjectId`) ON DELETE CASCADE
);
