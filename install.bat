echo "Composer install...";
composer install;
echo "Generating keys...";
php artisan key:generate;
echo "Running php artisan migrate:fresh --seed";
php artisan migrate:fresh --seed;