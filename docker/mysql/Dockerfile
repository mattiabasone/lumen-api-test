ARG MYSQL_VERSION
FROM mysql:${MYSQL_VERSION}

ARG HOST_USER_UID

RUN usermod mysql -u ${HOST_USER_UID}
RUN groupmod mysql -g ${HOST_USER_UID}
RUN mkdir -p /var/run/mysqld
RUN chown mysql:mysql /var/run/mysqld

VOLUME /var/lib/mysql

EXPOSE 3306
