
if [[ -z $1 ]]; then
  echo "you need to pass the tarball path"
  exit 1
fi

TAR_PATH="$1"
APP_RELEASE_PATH=$(echo $TAR_PATH | sed 's/visahack_//' | sed 's/.tar.gz//')

tar xzf "$TAR_PATH"
chmod -R 775 app
sudo chown -R www-data:www-data app
mv app $APP_RELEASE_PATH

# remove hot file
rm $APP_RELEASE_PATH/public/hot

ln -sfn /var/www/visahack-releases/${APP_RELEASE_PATH} /var/www/visahack
