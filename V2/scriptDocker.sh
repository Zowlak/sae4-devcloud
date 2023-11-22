docker stop V2Web
docker stop V2BDD
docker rm V2Web
docker rm V2BDD
docker rmi image_web
docker rmi image_bdd
cd web
docker build -t image_web .
docker run -dit --name V2Web -p 8000:80 image_web
cd ../bdd 
docker build -t image_bdd .
docker run -dit --name V2BDD image_bdd 
