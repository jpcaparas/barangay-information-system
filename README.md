Barangay Information System
==========================

_Powered by [Symfony](http://symfony.com/)_

_Application-specific features authored by: JP Caparas <jp@jpcaparas.com>_.

Overview
-------
The Barangay Information System (BIS) is a local government project that aims to streamline resident processing services.

Features
-------
* A resident information repository
* Clearance printing
* Barangay ID printing (w/ barcode support)

Requirements
------------
* [Composer](https://getcomposer.org/doc/00-intro.md)
* PHP ^5.6 || ^7
* MySQL >= 5.5
* Apache, NGINX, or PHP's built-in web server.
* A Unix terminal (Bash) or A Unix-like terminal (e.g. Cygwin, Git Bash) if using Windows

Installation
------------
1. Clone the repository:
    ```
    git clone git@bitbucket.org:jpcaparas/bis.git
    ```
2. Run `composer install` on the terminal to install dependencies.
3. Create a `parameters.yml` file on the `app/config` folder (you can use the `parameters.yml.dist` template), specifying your database and SMTP transport parameters, among others.
4. Dump the asset files:
    ```
    php bin/console assetic:dump --env=prod --no-debug
    ```
5. Create the schema and run migrations. You can follow [this guide][2].
6. Run the application:
    ```
    php app/console server:run
    ```

[1]: http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[2]: http://symfony.com/doc/2.3/book/doctrine.html

To-do
-----
1. Create a more comprehensive documentation.
2. Upgrade the application to Symfony3.
3. Use the [Sonata Admin Bundle](https://sonata-project.org/bundles/admin/3-x/doc/index.html) for the back-end.
4. Create a public API.
5. Integrate a remote repository for storing images and uploads.
6. Create 404 checker daemons that notify the administrator of any broken links (e.g. asset files).
7. Set up `.env` file to accompany the `parameters.yml` file.
