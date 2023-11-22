#On importe l'image du serveur PHP 
FROM php:8.1-apache
#On définit le répertoire courant
WORKDIR /var/www/html
#On met à jour le serveur et ses paquets
RUN apt-get update -y && apt-get upgrade -y
#On installe les packages nécessaires pour le traitement de la BDD Postgre
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
#On copie notre projet dans le répertoire courant
COPY app/ .
#On ajoute les permissions nécessaires pour la sécurité
RUN chown www-data /var/www/html -R
RUN chgrp www-data /var/www/html -R
#Et on définit le port pour docker
EXPOSE 80