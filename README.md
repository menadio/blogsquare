# Blogsqure

A technical assignment of a blogging platform. This application was developed using PHP 8.1, Laravel framework, Inertia Vue and Tailwind CSS.

## Project Setup

To setup this project, follow these steps below

-   Clone project repository

```
git clone https://github.com/menadio/blogsquare.git
```

-   Enter project directory

```
cd blogsquare
```

-   Install project dependencies

```
composer install
```

-   In project root, copy `.env.example` to `.env` and set the values for admin name, email, password, mysql and redis credentials as you wish

```
cp .env.example .env
```

-   Generate an application key for the project with the command below

```
php artisan key:generate
```

-   Seed some data into your database

```
php artisan migrate --seed
```

-   Install frontend dependencies

```
npm install
```

## Starting the application

Before starting the application, we will need to monitor our redis queues using `Horizon` and run scheduled task hourly.

-   Start horizon for monitoring queues with the command below

```
php artisan horizon
```

-   Start schedule worker

```
php artisan schedule:work
```

-   Finally start the application with

```
npm run dev
```

## Test Automation

We can test the application by running some test with this command

```
php artisan test
```

## Extra Notes

For quick set up, you can use `Sail` package. All you have to do is run the command

```
php artisan sail:install
```

Then select `mysql' and `redis` from the service list. Once that is done, start the containers with any of the commands below

```
./vendor/bin/sail up

or

docker-compose up -d
```

Remember to install project and node dependencies and serve the application with `npm run dev`
