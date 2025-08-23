CREATE TABLE users (
                       id INT(10) AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       name VARCHAR(100) NOT NULL,
                       password VARCHAR(100) NOT NULL,
                       createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       remember_me VARCHAR(255),
                       avatar VARCHAR(255) DEFAULT '/uploads/avatar.png',
                       role INT(10) NOT NULL
);

CREATE TABLE documents (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       type VARCHAR(10) NOT NULL,
                       idDoc VARCHAR(10) NOT NULL,
                       mode VARCHAR(10) NOT NULL,
                       createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       userRole INT(10) NOT NULL,
                       fileName VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE messages (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          username VARCHAR(255) NOT NULL,
                          message TEXT NOT NULL,
                          timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO homesStaging.users (id, email, name, password, createDate, remember_me, avatar, role) VALUES (1, 'daz@gmail.com', 'Dazn311', '12345', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 0);
INSERT INTO homesStaging.users (id, email, name, password, createDate, remember_me, avatar, role) VALUES (2, 'alex250555@bk.ru', 'Саша', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);
INSERT INTO homesStaging.users (id, email, name, password, createDate, remember_me, avatar, role) VALUES (3, 'alex2505@bk.ru', 'Alexander', '$2y$10$mKa0eFlj229qrIRURXznj.m6fjQC5w.HZu.HRjmB5Q5m/t1xDWLhK', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);
INSERT INTO homesStaging.users (id, email, name, password, createDate, remember_me, avatar, role) VALUES (4, 'nk@mail.ru', 'Natalia', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);

INSERT INTO homesStaging.documents (id, type, idDoc, mode, createDate, userRole, fileName) VALUES (1, 'invrpt', 'new', 'edit', '2025-08-11 23:31:18', 1, 'invrpt-new-Kramp-250807.json');
INSERT INTO homesStaging.documents (id, type, idDoc, mode, createDate, userRole, fileName) VALUES (2, 'invrpt', '1248923', 'edit', '2025-08-11 23:31:18', 1, 'invrpt1248923-edit-Kramp-250811.json');
INSERT INTO homesStaging.documents (id, type, idDoc, mode, createDate, userRole, fileName) VALUES (3, 'desadv', '1248304', 'edit', '2025-08-11 23:31:18', 1, 'desadv1248304-edit-Kramp-250804.json');



