#On importe l'image du serveur PHP 
FROM php:8.1-apache
#On définit le répertoire courant
WORKDIR /var/www/html
#On copie notre projet dans le répertoire courant
copy app/ .
#On créé un volume pour la persistance des données
VOLUME /var/www/html/bdd
#On ajoute les permissions nécessaires pour la sécurité
RUN chown www-data /var/www/html -R
RUN chgrp www-data /var/www/html -R
#On installe les packages nécessaires pour le traitement de la BDD SQLite
RUN apt-get update -y && apt-get upgrade -y
RUN apt-get install sqlite3
#Et on définit le port pour docker
EXPOSE 80