#!/bin/bash

echo -n "Enter larevel project folder > "
read laradir


echo -n "Enter cpanel username account > "
read username

echo "Directory chmod  777"
find $laradir/ ! -path '*/vendor/*' ! -path '*/node_modules/*' -type d -exec chmod 777 {} \;
find $laradir/ ! -path '*/vendor/*' ! -path '*/node_modules/*' -type d -exec chmod ug+s {} \;
find $laradir/ ! -path '*/vendor/*' ! -path '*/node_modules/*' -type f -exec chmod 775 {} \;

echo "Change The directories' Chmod"
chown -R $username:$username $laradir/
chown -R $username:$username $laradir/
chmod -R 777 $laradir/storage
chmod -R 777 $laradir/bootstrap/cache/
chmod -R 777 $laradir/storage/logs
chmod -R 777 $laradir/storage/framework/sessions
chmod -R 777 $laradir/storage/framework/views
chmod -R 777 $laradir/storage/framework/cache
chmod -R 777 $laradir/storage/framework/testing
chmod -R 777 $laradir/vendor/amadeus4dev/amadeus-php/src/client/cached_token.json
# Function to prompt the user for confirmation
eval "npm install"
eval "npm run build"


current_user=$(whoami)

echo $username
eval whoami
eval "sudo su -l $username -c '
cd public_html
composer install
php artisan generate:react-route'"



if [ -d "./public/storage" ]
then
eval "rm -rf ./public/storage"
fi

eval "php artisan storage:link"

while true; do

read -p "Do you want to run command migrate:frsh --seed? (y/n) " yn

case $yn in 
	[yY] ) echo ok, we will proceed;
    eval "php artisan migrate:fresh --seed"
		break;;
	[nN] ) echo exiting...;
		exit;;
	* ) echo invalid response;;
esac

done

echo "-------End-------"
