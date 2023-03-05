# api-commerce
This project using laravel 10

## Table Of contents
-   [Requirement](#requirement)
-   [How to configure on your local machine](#how-to-configure-on-your-local-machine)
-   [How to run using Docker](#how-to-run-using-docker)

## Requirement
1. PHP 8.1^
2. PostgerSQL

## How to configure on your local machine
1. Clone this repostory to your local.
   ```bash
   $ git clone https://https://github.com/aririfani/api-commerce
   ```

2. Change working directory to `api-commerce` folder.
   ```bash
   $ cd api-commerce
   ```

3. Install dependencies
   ```bash
   $ composer install
   ```

4. Create env file
   ```bash
   $ cp .env.example .env
   ```

5. Edit database configuration values in `.env` according to your setting.
   ```bash
   DB_CONNECTION=pgsql
   DB_HOST=localhost
   DB_PORT=5432
   DB_DATABASE=databasename
   DB_USERNAME=databaseusername
   DB_PASSWORD=databasepassword
   ```

6. Run Key generate `key:generate`
   ```bash
   $ php artisan key:generate
   ```

7. Run migration
   ```bash
   $ php artisan migrate
   ```

8. Run database seeder
   ```bash
   $ php artisan db:seeder
   ```

9. Run Test
   ```bash
   $ php artisan test
   ```

## How to run using Docker
1. Clone this repostory to your local.
   ```bash
   $ git clone https://https://github.com/aririfani/api-commerce
   ```

2. Change working directory to `api-commerce` folder.
   ```bash
   $ cd api-commerce
   ```

3. Run docker-compose up
   ```bash
   $ docker-compose up -d
   ```

4. Run docker-compose exec app bash
   ```bash
   $ docker-compose exec app bash
   ```

5. Install dependencies
   ```bash
   $ php composer.phar install
   ```

6. Create env file
   ```bash
   $ cp .env.example .env
   ```

5. Edit database configuration values in `.env` using this setting.
   ```bash
    DB_CONNECTION=pgsql
    DB_HOST=db
    DB_PORT=5432
    DB_DATABASE=devdb
    DB_USERNAME=devuser
    DB_PASSWORD=devsecret
   ```

6. Run Key generate `key:generate`
   ```bash
   $ php artisan key:generate
   ```

7. Run migration
   ```bash
   $ php artisan migrate
   ```

8. Run database seeder
   ```bash
   $ php artisan db:seeder
   ```

9. Run Test
   ```bash
   $ php artisan test
   ```