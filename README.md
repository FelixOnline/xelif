Xelif
=====

**Xelif** is the decommissioned content management system (CMS) that powered the 
[_Felix_ website](https://felixonline.co.uk) from October 2020 to 
October 2024.

> [!TIP]
> Take a look at [a snapshot of the website](https://felixonline.co.uk/content/files/2024/11/felixonline.co.uk-snapshot-2024-10-03.html) on its last day of being powered by Xelif.

It is a custom-built solution based on
[Twill](https://twill.io), which is itself based on Laravel.
Designed for the traditional LAMP stack and later migrated to Docker, it
is largely written in PHP and uses a MySQL database to store articles
and other site data.

It supersedes the [previous edition of the website](https://github.com/FelixOnline/v2), which was statically
generated using Hugo.

## File layout

`/app`: “Backend” logic, like models (`/app/Models`) and controllers
(`/app/Http/Controllers`). Controllers for pages in the admin dashboard
are under `/app/Http/Controllers/Admin`. Controllers for user-visible
pages are directly under `/app/Http/Controllers`

`/resources/views`: Frontend view templates, written in
[Blade](https://laravel.com/docs/8.x/blade)

`/resources/views/layouts`: Whole webpages

`/resources/views/blocks`: How
[blocks](https://twill.io/docs/#rendering-blocks) are rendered, each
should correspond to a block form in the editor.

`/resource/views/components`: Components that may appear multiple time
in multiple pages, such as the byline.

`/resource/views/admin`: Form definitions for the admin backend. You
should also put [fully custom admin
pages](https://twill.io/docs/#custom-cms-pages) here.

`/public`: Static files visible to the public. Don't put any secrets
here!

`/public/assets/pub/css/main.css`: The one stylesheet for the entire
site. Though isolated CSS for specific compon ents should be put in
`*.blade.php` instead (utilising [`@once` with
`@push`](https://laravel.com/docs/8.x/blade#the-once-directive))

`/routes/web.php`: User-facing routes, directing URL patterns to a
method (usually called `show`) of a controller.

`/routes/admin.php`: Admin backend routes. They also need to be defined
in `/config/twill-navigation.php` to show up on the toolbar.

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

### Database configuration

If recreating the database, open up MySQL CLI, then

``` sql
CREATE USER xelif@localhost IDENTIFIED BY '[password]';
CREATE SCHEMA laravel DEFAULT CHARACTER SET utf8;
GRANT ALL PRIVILEGES ON laravel.* TO xelif@localhost;
```

### Log rotation

Laravel will write all its logs to `storage/logs/laravel.log`. You
should check this file whenever you need to debug a server error.

However this file will get larger and larger. We should setup a
`logrotate` rule to manage it.

`sudoedit /etc/logrotate.d/xelif`

    /var/www/felixonline.co.uk/storage/logs/laravel.log {
            daily
            missingok
            rotate 14
            compress
            delaycompress
            notifempty
            create 0644 www-data www-data
            postrotate
                    systemctl reload apache2
            endscript
    }
