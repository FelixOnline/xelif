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
6. In `.env`, set `ADMIN_APP_PATH` to `edit`
7. Run `php artisan twill:install` and set up the admin account
8. Run `php artisan storage:link` to set up local media storage
9. Make sections called `News`, `About` (TODO: automate this part)
10. Start up a development server via `php artisan serve`
