-- Creates user table
CREATE TABLE `user` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `user_type` ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'
);

-- Creates message table
CREATE TABLE `message` (
    `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `content` TEXT(3000) NOT NULL,
    `date` datetime NOT NULL,
    `user_id` int NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);