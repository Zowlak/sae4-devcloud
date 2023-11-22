# Projet de la SAÉ4-DevCloud - Développer et déployer un microservice dans un environnement virtualisé

Technologies / Langages utilisés dans la projet :

- PHP
- Docker
- SQLIte
- PostgreSQL
- Python
- FastAPI

## Version 1 - PHP & SQLite

> • 1 - Se mettre dans le dossier "V1" :

```bash
cd V1
```

> • 2 - Construire l'image Docker :

```bash
docker build -t version1
```

> • 3 - Déploier l'image Docker :

```bash
docker run -dit --name V1 -v CheminAuDossierV1/app/bdd/:/var/www/html/bdd -p 8000:80 version1
```

> • 4 - Se rendre sur le site :

```bash
Adresse : http://localhost:8000/
```

## Version 2 - PHP & PostgreSQL

> • 1 - Se mettre dans le dossier "V2" :

```bash
cd V2
```

> • 2 - Construire & lancer le containeur pour le site web :

```bash
cd web
docker build -t image_web .
docker run -dit --name V2Web -p 8000:80 image_web
```

> • 3 - Puis construire & lancer le containeur pour la base de données PostgreSQL :

```bash
cd ../bdd
docker build -t image_bdd .
docker run -dit --name V2BDD image_bdd
```

> • 4 - Se rendre sur le site :

```bash
Adresse : http://localhost:8000/
```

## Version 3 - PHP & PostgreSQL & API Python

> • 1 - Se mettre dans le dossier "V3" :

```bash
cd V3
```

> • 2 - Construire & lancer les containeurs avec Docker Compose :

```bash
docker compose up --build
```

> • 3 - Se rendre sur le(s) site(s) :

```bash
Adresse Serveur Web : http://localhost:9000/
Adresse FastAPI : http://localhost:8000/docs
```
