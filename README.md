Xelif
=====

Welcome to Felix website N+1. Enjoy your stay.

## Setup
### Requirements
- PHP
- Composer
- MySQL

### Setting up a development environment
1. In MySQL, create a database schema called `laravel` by ``CREATE SCHEMA `laravel` DEFAULT CHARACTER SET utf8``
2. Run `composer install` under repository root
3. Copy `.env.example` into a new file called `.env`
4. Run `php artisan key:generate`
5. In `.env`, set `DB_USERNAME` and `DB_PASSWORD` to the credentials of the MySQL account
6. Run `php artisan twill:install` and set up the admin account
7. Run `php artisan storage:link` to set up local media storage
8. Make sections called `News`, `About` (TODO: automate this part)
9. Start up a development server via `php artisan serve`

### Required PHP extensions (incomplete)
(On Windows, uncomment `extension_dir = "ext"`)
- mbstring
- pdo_mysql (or pdo_pgsql if using postgres)
- fileinfo