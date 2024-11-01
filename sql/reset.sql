-- Deletes the database user
DROP USER 'g4rden-user'@'localhost';

-- Delete the database
DROP DATABASE `g4rden-db`;

-- Shows users privileges
SHOW GRANTS FOR 'g4rden-user'@'localhost';
-- or for server
SHOW GRANTS FOR 'g4rden-user'@'%';

-- Shows all tables for the database
SHOW TABLES FROM `g4rden-db`;

-- Shows all users
SELECT User FROM mysql.user;

-- Shows all databases
SHOW DATABASES;