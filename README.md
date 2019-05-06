# Laravel app

## Install

```sh
docker run --rm -it --volume $PWD:/app composer install
```

Build PHP docker image:

```sh
docker-compose build
```

## Config

Create key:

```sh
docker-compose exec laravel php artisan key:generate
```

Copy `.env.example` to `.env`.

After modifications, run:

```sh
docker-compose exec laravel php artisan cache:clear
```

## Usage

Run migrations:

```sh
docker-compose exec laravel php artisan migrate
```

Start server with:

```sh
docker-compose up -d
```
