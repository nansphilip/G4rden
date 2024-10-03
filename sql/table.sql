-- SQLBook: Code
-- Creates user table
CREATE TABLE `User` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
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