-- SQLBook: Code

-- Inserts users
INSERT INTO `User` (`lastname`, `firstname`, `username`, `passwordHash`, `userType`) VALUES
('Doe', 'John', 'DJohn', 'passwordAlice', 'USER'),
('McDonald', 'Walter', 'WMcDonald', 'passwordBob', 'USER'),
('Smith', 'Alice', 'ASmith', 'passwordCharlie', 'USER'),
('Johnson', 'Diana', 'DJohnson', 'passwordDiana', 'ADMIN');

-- Inserts messages
INSERT INTO `Message` (`content`, `date`, `userId`) VALUES
('Salut tout le monde, comment ça va ?', '2023-10-01 09:00:00', 3), -- Alice
('Ça va bien, merci Alice. Et toi ?', '2023-10-01 09:15:00', 1), -- John
('Salut Alice et John, moi aussi ça va.', '2023-10-01 09:30:00', 2), -- Walter
('Bonjour à tous, bon début de semaine !', '2023-10-01 10:00:00', 4), -- Diana
('Salut tout le monde, n\'oubliez pas la réunion cet après-midi à 14h.', '2023-10-01 10:15:00', 4), -- Diana (Admin)
('Merci de le rappeler. À plus tard !', '2023-10-01 11:00:00', 3), -- Alice
('Oui, merci Diana. J\'ai des trucs à préparer avant la réunion.', '2023-10-01 11:15:00', 1), -- John
('Je vais préparer quelques notes pour la réunion.', '2023-10-01 12:00:00', 2), -- Walter
('Quelqu\'un veut déjeuner ensemble avant la réunion ?', '2023-10-01 12:30:00', 4), -- Diana
('Je suis partante, où est-ce qu\'on se retrouve ?', '2023-10-01 12:45:00', 3), -- Alice
('Pourquoi pas le café d\'en face ?', '2023-10-01 13:00:00', 1), -- John
('Ça me va. À tout à l\'heure.', '2023-10-01 13:15:00', 4), -- Diana
('On se rejoint là-bas à 12h45.', '2023-10-01 13:30:00', 2), -- Walter
('Re-bonjour, la réunion est dans 30 minutes.', '2023-10-01 13:45:00', 4), -- Diana (Admin)
('On est prêt ! À tout de suite.', '2023-10-01 14:00:00', 3), -- Alice
('Merci Alice. J\'ai hâte de voir ce que tout le monde a préparé.', '2023-10-02 09:00:00', 1), -- John
('La réunion était productive, merci à tous.', '2023-10-02 10:00:00', 4), -- Diana (Admin)
('Oui, c\'était une bonne session.', '2023-10-02 11:00:00', 2), -- Walter
('On continue sur notre lancée !', '2023-10-02 12:00:00', 4), -- Diana
('Bonne journée à tous !', '2023-10-02 13:00:00', 3), -- Alice
('Bon travail tout le monde.', '2023-10-03 09:00:00', 4); -- Diana (Admin)
