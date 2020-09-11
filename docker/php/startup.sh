cd /code

composer install
#npm install
php artisan key:generate

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# webpackのビルドモード、適宜変更
#npm run dev
#npm run prod

php artisan passport:install

# public disc
php artisan storage:link

# database mingrate
php artisan migrate

# database seed
#php artisan migrate --seed

#パーミッションまわり
chmod -R 777 /code
#chmod -R 755 /code
#chmod -R 777 /code/storage
#chmod -R 766 /code/bootstrap/cache


echo "starting php-fpm"
exec $@
