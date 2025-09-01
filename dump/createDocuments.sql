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
                       type VARCHAR(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL, #Евродвушка
                       mode VARCHAR(10) NOT NULL, # edit|end|start|create
                       project_key VARCHAR(255) NOT NULL, # mitino1|mitinskii38Бк1|kronstadskii222 - for create url;
                       createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       userRole INT(10) NOT NULL,
                       fileName VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE description (
                             id INT AUTO_INCREMENT,
                             title VARCHAR(20) NOT NULL, #Евродвушка
                             category VARCHAR(50) NOT NULL, # Комплектация "под ключ"
                             price VARCHAR(10) NOT NULL, # 988 000₽
                             project_url VARCHAR(100) NOT NULL, # https://t.me/homeupakovka
                             project_des VARCHAR(100) NOT NULL, #  мой канал Telegram
                             createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                             end_date TIMESTAMP DEFAULT NULL,
                             document_id INT NOT NULL,
                             FOREIGN KEY (document_id) REFERENCES document(id),
                             primary key(id, document_id)
);

CREATE TABLE worksPerformed (
                                id INT AUTO_INCREMENT ,
                                title_work VARCHAR(255) NOT NULL, # красили стены, устанавливали панели;
                                document_id INT NOT NULL,
                                FOREIGN KEY (document_id) REFERENCES document(id),
                                primary key(id, document_id)
);

CREATE TABLE addressBook (
                             address_id INT AUTO_INCREMENT ,
                             code VARCHAR(7) NOT NULL ,# 125222
                             street VARCHAR(100) NOT NULL ,# ул. Муравская
                             apartment VARCHAR(50) NOT NULL ,# 38Бк1
                             document_id INT NOT NULL,
                             FOREIGN KEY (document_id) REFERENCES document(id),
                             primary key(address_id, document_id)
);

CREATE TABLE breadcrumbs (
                breadcrumbs_id INT NOT NULL AUTO_INCREMENT,
                project_title VARCHAR(100) NOT NULL,# ЖК Митинский лес
                document_id INT NOT NULL,
                FOREIGN KEY (document_id) REFERENCES document(id),
                primary key(breadcrumbs_id, document_id)
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

INSERT INTO user (id, email, name, password, createDate, remember_me, avatar, role) VALUES (1, 'alex250555@bk.ru', 'Саша', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);
INSERT INTO user (id, email, name, password, createDate, remember_me, avatar, role) VALUES (2, 'nkartashove@mail.ru', 'Natalia', '$2y$10$0tUwDA0PeoKDK2y.83XM3.68sCRxb8ACvfEjvZoJ3Wm9zmCKSxn9u', '2025-08-13 01:30:12', '1', '/uploads/avatars/2025/01/01/avatar-0.png', 1);


INSERT INTO document (id, type,  mode, project_key, createDate, userRole, fileName)
VALUES (1, 'Евродвушка', 'end', 'kronstadskii1', '2025-05-11 23:31:18', 1, 'kronstadskii1-Nata-250811.xlsx');

INSERT INTO document (id, type, mode, project_key, createDate, userRole, fileName)
VALUES (2, 'Евродвушка', 'end', 'mitino1', '2025-06-11 23:31:18', 1, 'mitino1-Nata-250807.xlsx');

INSERT INTO document (id, type, mode, project_key, createDate, userRole, fileName)
VALUES (3, 'Евродвушка', 'end', 'mitino2', '2025-06-12 23:31:18', 1, 'mitino2-Nata-250612.xlsx');

INSERT INTO document (id, type, mode, project_key, createDate, userRole, fileName)
VALUES (4, 'Евродвушка', 'new', 'ilyinskie1', '2025-08-22 23:31:18', 1, 'ilyinskie1-Nata-250822.xlsx');


INSERT INTO addressBook (address_id, code, street, apartment, document_id)
VALUES (3, '125222', 'Кронштадтский бул.', '8к2', 1);

INSERT INTO addressBook (address_id, code, street, apartment, document_id)
VALUES (1, '125222', 'ул. Муравская', '38Бк1', 2);

INSERT INTO addressBook (address_id, code, street, apartment, document_id)
VALUES (2, '125222', 'ул. Муравская', '32к1', 3);

INSERT INTO addressBook (address_id, code, street, apartment, document_id)
VALUES (3, '125222', 'проект', '2', 4);


INSERT INTO description (id, title, category,price,project_url,project_des,createDate,end_date,document_id)
VALUES (1, 'Евродвушка' ,'Комплектация "под ключ"' ,'988 000' ,'https://t.me/homeupakovka' ,'мой канал Telegram' ,NULL,NULL,2);

INSERT INTO worksPerformed (id, title_work, document_id)
VALUES (1, 'красили стены, устанавливали панели;' ,2);
INSERT INTO worksPerformed (id, title_work, document_id)
VALUES (2, 'меняли двери, в т.ч. входную, регулировали окна и меняли откосы;' ,2);
INSERT INTO worksPerformed (id, title_work, document_id)
VALUES (3, 'в ванной меняли унитаз, красили швы, меняли душевую стойку и раковину;' ,2);
INSERT INTO worksPerformed (id, title_work, document_id)
VALUES (4, 'бытовая техника Weissgauff, фартук на кухне демонтировали и сделали из керамогранита;' ,2);
INSERT INTO worksPerformed (id, title_work, document_id)
VALUES (5, 'Установка сплит системы.' ,2);

INSERT INTO breadcrumbs (breadcrumbs_id, project_title, document_id) VALUES (1,  'ЖК Кронштадтский',1);
INSERT INTO breadcrumbs (breadcrumbs_id, project_title, document_id) VALUES (2,  'ЖК Митинский лес',2);
INSERT INTO breadcrumbs (breadcrumbs_id, project_title, document_id) VALUES (3,  'ЖК Митинский лес',3);
INSERT INTO breadcrumbs (breadcrumbs_id, project_title, document_id) VALUES (4,  'ЖК Ильинские луга',4);

INSERT INTO image (image_id, image_url, document_id) VALUES (1,  'assets/img/flats/Mitinskii-les/38/2.png',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (2,  'assets/img/flats/Mitinskii-les/38/4.jpg',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (3,  'assets/img/flats/Mitinskii-les/38/5.jpg',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (4,  'assets/img/flats/Mitinskii-les/38/6.jpg',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (5,  'assets/img/flats/Mitinskii-les/38/7.jpg',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (6,  'assets/img/flats/Mitinskii-les/38/8.jpg',2);
INSERT INTO image (image_id, image_url, document_id) VALUES (7,  'assets/img/flats/Mitinskii-les/38/9.png',2);

# INSERT INTO imageDocuments (image_id, document_id) VALUES (1,  1);
# INSERT INTO imageDocuments (image_id, document_id) VALUES (2,  1);



