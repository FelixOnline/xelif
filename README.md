Xelif
=====

Welcome to Felix website N+1. Enjoy your stay.

## Setup
### Requirements
- PHP
- Composer
- MySQL

The repo include a VSCode development container config with all of this preinstall, so you may wish to use this. (note: always use localhost to access the website; VSCode defaults to 127.0.0.1 when opening the site browser when it detects it is running, which does not work)

### Setting up a development environment
1. In MySQL, create a database schema called `laravel` by ``CREATE SCHEMA `laravel` DEFAULT CHARACTER SET utf8``
2. Run `composer install` under repository root
3. Copy `.env.example` into a new file called `.env`
4. Run `php artisan key:generate`
5. In `.env`, set `DB_USERNAME` and `DB_PASSWORD` to the credentials of the MySQL account
6. Run `php artisan twill:install` and set up the admin account
7. Run `php artisan db:seed --class=SeedInDev` to populate the DB with default settings, "News" and "About" sections, plus an empty issue so you can see the homepage (NOTE: settings are as of 21/12/22, they may change since they include website styling so don't use these to recreate production!)
8. Run `php artisan storage:link` to set up local media storage
9. Start up a development server via `php artisan serve`

### Required PHP extensions (incomplete)
(On Windows, uncomment `extension_dir = "ext"`)
- mbstring
- pdo_mysql (or pdo_pgsql if using postgres)
- fileinfo