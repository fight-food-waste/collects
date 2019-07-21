# Fight Food Waste - Collects and deliveries

## Installation

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migreate:fresh
php artisan db:seed
```

Add a cron entry for the [scheduler](https://laravel.com/docs/5.8/scheduling#introduction), only used for Telescope as of now.