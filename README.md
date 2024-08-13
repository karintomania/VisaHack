# VisaHack


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
