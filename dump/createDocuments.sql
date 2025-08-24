CREATE TABLE user (
                       id INT(10) AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       name VARCHAR(100) NOT NULL,
                       password VARCHAR(100) NOT NULL,
                       createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       remember_me VARCHAR(255),
                       avatar VARCHAR(255) DEFAULT '/uploads/avatar.png',
                       role INT(10) NOT NULL
);

CREATE TABLE document (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       type VARCHAR(10) NOT NULL,
                       idDoc VARCHAR(10) NOT NULL,
                       mode VARCHAR(10) NOT NULL,
                       createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       userRole INT(10) NOT NULL,
                       fileName VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE image (
                       image_id INT NOT NULL AUTO_INCREMENT,
                       image_url VARCHAR(100) NOT NULL UNIQUE,
                       document_id INT NOT NULL,
                       FOREIGN KEY (document_id) REFERENCES document(id),
                       primary key(image_id, document_id)
);

# create table imageDocuments
# (
#     image_id INT NOT NULL ,
#     document_id INT NOT NULL ,
#     FOREIGN KEY (image_id) REFERENCES image(image_id),
#     FOREIGN KEY (document_id) REFERENCES document(id),
#     primary key(image_id, document_id)
# );

CREATE TABLE message (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          username VARCHAR(255) NOT NULL,
                          message TEXT NOT NULL,
                          timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO homesStaging.user (id, email, name, password, createDate, remember_me, avatar, role) VALUES (1, 'alex250555@bk.ru', 'Саша', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);
INSERT INTO homesStaging.user (id, email, name, password, createDate, remember_me, avatar, role) VALUES (2, 'nkartashove@mail.ru', 'Natalia', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);

INSERT INTO homesStaging.document (id, type, idDoc, mode, createDate, userRole, fileName) VALUES (1, 'invrpt', 'new', 'edit', '2025-08-11 23:31:18', 1, 'invrpt-new-Kramp-250807.json');
INSERT INTO homesStaging.document (id, type, idDoc, mode, createDate, userRole, fileName) VALUES (2, 'invrpt', '1248923', 'edit', '2025-08-11 23:31:18', 1, 'invrpt1248923-edit-Kramp-250811.json');

INSERT INTO homesStaging.image (image_id, image_url, document_id) VALUES (1,  'doc-1-image-1-250824.json',1);
INSERT INTO homesStaging.image (image_id, image_url, document_id) VALUES (2,  'doc-1-image-2-250824.json',1);

# INSERT INTO homesStaging.imageDocuments (image_id, document_id) VALUES (1,  1);
# INSERT INTO homesStaging.imageDocuments (image_id, document_id) VALUES (2,  1);



