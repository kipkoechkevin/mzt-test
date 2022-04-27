# MyZenTeam code test solution

https://kevinkoech.co.ke

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/kipkoechkevin/mzt-test.git
composer install
cp .env.example .env
```

Then create the necessary database.

```
php artisan db 
create database mzt
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```

## Further Description

This project built in laravel and vue js covers the basic understanding of the laravel features such as eloquent,
email handling asn the use of vue js as a frontend framework plus common logic in programming.
