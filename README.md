# Fight Food Waste - Collects and deliveries

## Installation

```sh
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh
php artisan db:seed
```

Add a cron entry for the [scheduler](https://laravel.com/docs/5.8/scheduling#introduction), only used for Telescope as of now.

## IDE Helper

Provides accurate autocompletion.

See [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper).

```sh
php artisan clear-compiled
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta
```

## API Usage

See available routes in `routes/api.php`.

You can login by sending a POST request to `/api/login` with your email + password. You will get a token back.

To authenticate yourself for other requests, add a `Authorization` header containing `Bearer <token>`
