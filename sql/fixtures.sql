-- Inserts users
INSERT INTO `User` (`lastname`, `firstname`, `username`, `passwordHash`, `userType`) VALUES
('Doe', 'John', 'DJohn', 'passwordAlice', 'USER'),
('McDonald', 'Walter', 'WMcDonald', 'passwordBob', 'USER'),
('Smith', 'Alice', 'ASmith', 'passwordCharlie', 'USER'),
('Johnson', 'Diana', 'DJohnson', 'passwordDiana', 'ADMIN');

-- Inserts messages
INSERT INTO `Message` (`content`, `date`, `userId`) VALUES
('Salut tout le monde, comment ça va ?', '2023-10-01 09:00:00', 3),
('Ça va bien, merci Alice. Et toi ?', '2023-10-01 09:15:00', 1),
('Salut Alice et John, moi aussi ça va.', '2023-10-01 09:30:00', 2),
('Bonjour à tous, bon début de semaine !', '2023-10-01 10:00:00', 4),
('Salut tout le monde, n\'oubliez pas la réunion cet après-midi à 14h.', '2023-10-01 10:15:00', 4),
('Merci de le rappeler. À plus tard !', '2023-10-01 11:00:00', 3),
('Oui, merci Diana. J\'ai des trucs à préparer avant la réunion.', '2023-10-01 11:15:00', 1),
('Je vais préparer quelques notes pour la réunion.', '2023-10-01 12:00:00', 2),
('Quelqu\'un veut déjeuner ensemble avant la réunion ?', '2023-10-01 12:30:00', 4),
('Je suis partante, où est-ce qu\'on se retrouve ?', '2023-10-01 12:45:00', 3),
('Pourquoi pas le café d\'en face ?', '2023-10-01 13:00:00', 1),
('Ça me va. À tout à l\'heure.', '2023-10-01 13:15:00', 4),
('On se rejoint là-bas à 12h45.', '2023-10-01 13:30:00', 2),
('Re-bonjour, la réunion est dans 30 minutes.', '2023-10-01 13:45:00', 4),
('On est prêt ! À tout de suite.', '2023-10-01 14:00:00', 3),
('Merci Alice. J\'ai hâte de voir ce que tout le monde a préparé.', '2023-10-02 09:00:00', 1),
('La réunion était productive, merci à tous.', '2023-10-02 10:00:00', 4),
('Oui, c\'était une bonne session.', '2023-10-02 11:00:00', 2),
('On continue sur notre lancée !', '2023-10-02 12:00:00', 4),
('Bonne journée à tous !', '2023-10-02 13:00:00', 3),
('Bon travail tout le monde.', '2023-10-03 09:00:00', 4);
