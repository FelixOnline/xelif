Xelif
=====

Welcome to Felix website N+1. Enjoy your stay.

## Setup
### Requirements
- PHP
- Composer
- MySQL

### Setting up a development environment
1. In your `php.ini` uncomment lines `extension=pdo_mysql` and `extension=fileinfo` if that wasn't the case already
2. In MySQL, create a database schema called `laravel` by ``CREATE SCHEMA `laravel` DEFAULT CHARACTER SET utf8``
3. Run `composer install` under repository root
4. Copy `.env.example` into a new file called `.env`
5. Run `php artisan key:generate`
6. In `.env`, set `DB_USERNAME` and `DB_PASSWORD` to the credentials of the MySQL account
7. In `.env`, set `ADMIN_APP_PATH` to `edit`
8. Run `php artisan twill:install` and set up the admin account
9. Make sections called `News`, `About` (TODO: automate this part)
10. Start up a development server via `php artisan serve`
