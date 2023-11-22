#On importe l'image "postgres"
FROM postgres
#On définie ses variables d'environnement pour la BDD
ENV POSTGRES_PASSWORD 'lannion'
ENV POSTGRES_USER 'dockerpg'
ENV POSTGRES_DB 'lebonmanga'
ENV PGDATA /var/lib/postgresql/data 
#On expose le container sur le port 5432
EXPOSE 5432
#On copie nos fichiers vers le point d'entrée
COPY initData/ docker-entrypoint-initdb.d 
#Et on lance la bDD
CMD ["docker-entrypoint.sh", "postgres"]