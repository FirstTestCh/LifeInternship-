echo "Composer install..."
call composer install
echo "Running php artisan migrate:fresh --seed"
call php artisan migrate:fresh --seed
echo "Generating keys..."
call php artisan key:generate