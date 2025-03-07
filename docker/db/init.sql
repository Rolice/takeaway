SET PASSWORD FOR 'root'@'localhost' = PASSWORD('${MYSQL_ROOT_PASSWORD}');
CREATE USER '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';

CREATE DATABASE IF NOT EXISTS `${MYSQL_DATABASE}`;
GRANT ALL ON `${MYSQL_DATABASE}`.* TO '${MYSQL_USER}'@'%';
