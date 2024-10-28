# VisaHack

# Dev
dup
docker compose exec web bash -c 'npm run dev'
dsh visahack_web

tar czf visahack.tar.gz visahack

ln -sfn /var/www/visahack-releases/20240422 /var/www/visahack

# How to deploy
Run the shell script to build a deployable source.

```
$ sh build.sh
```

Run deploy script on the server.
```
 $ sh deploy.sh
```
