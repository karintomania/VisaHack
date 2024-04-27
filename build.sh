
# remove old tars
rm visahack*.tar.gz

# build js
docker-compose up -d
docker exec visahack_web npm run build

# build source
docker build --file build.Dockerfile -t visahack_builder .

# copy the built source
docker run --rm -d --name visahack_builder visahack_builder
DATE=$(date +%Y%m%d-%H%M%S)
TAR_PATH=./visahack_${DATE}.tar.gz
docker cp visahack_builder:/tmp/visahack.tar.gz ${TAR_PATH}
docker stop visahack_builder

# sent the source to the server
scp $TAR_PATH Digitalocean:/var/www/visahack-releases/

