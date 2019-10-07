FROM mysql:5.7
EXPOSE 3306

ARG MYSQL_ROOT_PASSWORD
ARG MYSQL_DATABASE
ARG MYSQL_USER
ARG MYSQL_PASSWORD

COPY .my.cnf /root/
COPY init.sql /data/application/init.sql

# Set up the init file for MySQL
RUN sed -i "s/\${MYSQL_ROOT_PASSWORD}/${MYSQL_ROOT_PASSWORD}/" /data/application/init.sql
RUN sed -i "s/\${MYSQL_DATABASE}/${MYSQL_DATABASE}/" /data/application/init.sql
RUN sed -i "s/\${MYSQL_USER}/${MYSQL_USER}/" /data/application/init.sql
RUN sed -i "s/\${MYSQL_PASSWORD}/${MYSQL_PASSWORD}/" /data/application/init.sql

# Set up the local MySQL configuration for the current user (root)
RUN sed -i "s/\${MYSQL_ROOT_PASSWORD}/${MYSQL_ROOT_PASSWORD}/" /root/.my.cnf
