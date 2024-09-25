-- Deletes the database user
DROP USER 'g4rden-user' @'localhost';

-- Delete the database
DROP DATABASE `g4rden-db`;

-- Shows all users
SELECT User FROM mysql.user;

-- Shows all databases
SHOW DATABASES;