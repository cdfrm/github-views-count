FROM mysql:8.0

ADD ./ghvc.sql /docker-entrypoint-initdb.d