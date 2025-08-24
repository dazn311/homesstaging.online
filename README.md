# homeStaging

//add auto load classes;
composer dump-autoload

//install deps;
1. composer update
2. docker-compose down
3. docker-compose build
4. docker-compose up -d

docker-compose exec php php -i | grep mysql
docker exec -it  php-uikit sh

docker-compose exec app php /app/bin/mysql_create.php
docker-compose exec app php /app/bin/registration.php

docker-compose exec php php /var/www/homesstaging.online/bin/mysql_create_tables.php
docker-compose exec php php /var/www/homesstaging.online/bin/registration.php

docker exec -it a98c02ccf8ac nginx -s reload
docker exec -it nginx-uikit nginx -s reload

========================
https://selectel.ru/blog/docker-compose/
==========================
install;
composer require predis/predis
composer require vlucas/phpdotenv
===
docker images
docker container ls
$ docker-compose exec [service name] [command]
docker-compose exec mysql-uikit ls
docker-compose logs nginx

docker exec -it e3f51d3d6e30 /bin/bash

=============
certificat

docker exec -it  nginx-uikit sh
cd /etc/nginx/certs
nginx -t
nginx -s reload

1. openssl genrsa -out key.pem 2048
2. openssl req -new -key key.pem -out csr.pem
3. openssl x509 -req -in csr.pem -signkey key.pem -out cert.pem -days 365
3.2 openssl req -newkey rsa:2048 -nodes -keyout server.key -x509 -days 365 -out server.crt
3.3 openssl req -newkey rsa:2048 -nodes -keyout server2.key -x509 -days 365 -out server2.crt
3.3 openssl req -newkey rsa:2048 -nodes -keyout server3.key -x509 -days 365 -out server3.crt

3.4 openssl req -x509 -nodes -new -sha256 -days 390 -newkey rsa:2048 -keyout "server4.key" -out "server4.pem" -subj "/C=RU/CN=localhost.local"
    openssl x509 -outform pem -in "server4.pem" -out "server4.crt"

Country Name (2 letter code) [AU]:RU
State or Province Name (full name) [Some-State]:Moscow
Locality Name (eg, city) []:Moscow
Organization Name (eg, company) [Internet Widgits Pty Ltd]:Private Persone
Organizational Unit Name (eg, section) []:IT
Common Name (e.g. server FQDN or YOUR name) []:localhost.local
Email Address []:alex2505@bk.ru

docker cp nginx-uikit:/etc/nginx/certs/server.key /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/server.crt /Users/dazn311/Project/uikit-220704-back/nginx/certs

docker cp nginx-uikit:/server2.key /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/server2.crt /Users/dazn311/Project/uikit-220704-back/nginx/certs

docker cp nginx-uikit:/server3.key /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/server3.crt /Users/dazn311/Project/uikit-220704-back/nginx/certs

docker cp nginx-uikit:/server4.key /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/server4.crt /Users/dazn311/Project/uikit-220704-back/nginx/certs

docker cp nginx-uikit:/cert.pem /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/csr.pem /Users/dazn311/Project/uikit-220704-back/nginx/certs
docker cp nginx-uikit:/key.pem /Users/dazn311/Project/uikit-220704-back/nginx/certs


SELECT
    Orders.OrderID,
    Customers.CustomerName,
    Orders.OrderDate
FROM
    Orders
INNER JOIN
    Customers ON Orders.CustomerID = Customers.CustomerID
WHERE
    Customers.City = 'London'
    AND Orders.OrderDate > '2024-01-01';
