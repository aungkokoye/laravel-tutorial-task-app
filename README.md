## About Laravel Tutorial Task App

 PHP 8.4 | Laravel 11.x | MySQL 8.0 | Docker Compose 3.8 
 
 Composer 2.8 | Node 22.21.1 | NPM 10.9.4

#### how to start docker
````
cd docker
docker-compose up -d --build
````
#### how to stop docker
````
cd docker
docker-compose down
````
#### Inside app web container
````
docker exec -it laravel_app bash
````
#### Set Up

*Before running these commands make sure you have created a database named `laravel_task` in your MySQL server.*

````
- composer install 
- npm install && npm run dev
- php artisan key:generate
- php artisan  migrate:fresh --seed
````
#### PHPStorm IDE
DB settings
````
host: 127.0.0.1
port: 3506
user: root
password: root
database: laravel_task
````
#### Schickling MailCatcher Documentation:

MailCatcher is configured by setting the environment variable in your `.env` file:

For testing email functionality, we are using the Schickling MailCatcher.
It is accessible at `http://localhost:2080`.
This allows you to view emails sent by the application without needing a real email server.

#### ID Plugin settings  (used composer package "barryvdh/laravel-ide-helper")
````
php artisan ide-helper:generate
php artisan ide-helper:models --nowrite
````

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

### Learning Laravel
Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.
