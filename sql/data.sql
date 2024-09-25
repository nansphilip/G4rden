
-- Inserts users
INSERT INTO `user` (`username`, `password`, `user_type`) VALUES
('Alice', 'passwordAlice', 'USER'),
('Bob', 'passwordBob', 'USER'),
('Charlie', 'passwordCharlie', 'USER'),
('Diana', 'passwordDiana', 'USER'),
('AdminUser', 'adminPass', 'ADMIN');

-- Inserts messages
INSERT INTO `message` (`content`, `date`, `user_id`) VALUES
('Salut tout le monde, comment ça va ?', '2023-10-01 09:00:00', 1), -- Alice
('Ça va bien, merci Alice. Et toi ?', '2023-10-01 09:15:00', 2), -- Bob
('Salut Alice et Bob, moi aussi ça va.', '2023-10-01 09:30:00', 3), -- Charlie
('Bonjour à tous, bon début de semaine !', '2023-10-01 10:00:00', 4), -- Diana
('Salut tout le monde, n\'oubliez pas la réunion cet après-midi à 14h.', '2023-10-01 10:15:00', 5), -- AdminUser
('Merci de le rappeler. À plus tard !', '2023-10-01 11:00:00', 1), -- Alice
('Oui, merci AdminUser. J\'ai des trucs à préparer avant la réunion.', '2023-10-01 11:15:00', 2), -- Bob
('Je vais préparer quelques notes pour la réunion.', '2023-10-01 12:00:00', 3), -- Charlie
('Quelqu\'un veut déjeuner ensemble avant la réunion ?', '2023-10-01 12:30:00', 4), -- Diana
('Je suis partante, où est-ce qu’on se retrouve ?', '2023-10-01 12:45:00', 1), -- Alice
('Pourquoi pas le café d\'en face ?', '2023-10-01 13:00:00', 2), -- Bob
('Ça me va. À tout à l\'heure.', '2023-10-01 13:15:00', 4), -- Diana
('On se rejoint là-bas à 12h45.', '2023-10-01 13:30:00', 3), -- Charlie
('Re-bonjour, la réunion est dans 30 minutes.', '2023-10-01 13:45:00', 5), -- AdminUser
('On est prêt ! À tout de suite.', '2023-10-01 14:00:00', 1), -- Alice
('Merci Alice. J\'ai hâte de voir ce que tout le monde a préparé.', '2023-10-02 09:00:00', 2), -- Bob
('La réunion était productive, merci à tous.', '2023-10-02 10:00:00', 5), -- AdminUser
('Oui, c\'était une bonne session.', '2023-10-02 11:00:00', 3), -- Charlie
('On continue sur notre lancée !', '2023-10-02 12:00:00', 4), -- Diana
('Bonne journée à tous !', '2023-10-02 13:00:00', 1), -- Alice
('Bon travail tout le monde.', '2023-10-03 09:00:00', 5); -- AdminUser