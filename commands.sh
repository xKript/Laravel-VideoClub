php artisan make:model Movie
php artisan migrate:install
php artisan make:migration create_movies_table --create=movies
php artisan make:migration create_users_table --create=users
composer require laravel/ui --dev
php artisan ui vue --auth


composer require illuminate/support