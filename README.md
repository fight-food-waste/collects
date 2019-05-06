# Laravel app

## Run with Docker

To install dependencies:

```sh
docker run --rm -it --volume $PWD:/app composer install
```

Build PHP docker image:

```sh
docker-compose build
```

Copy `.env.example` to `.env`.

Start server with:

```sh
docker-compose up -d
```

Create key:

```sh
docker-compose exec laravel php artisan key:generate
```

After modifications, run:

```sh
docker-compose exec laravel php artisan cache:clear
```

Restart server:

```sh
docker-compose restart laravel
```

Run migrations:

```sh
docker-compose exec laravel php artisan migrate
```
