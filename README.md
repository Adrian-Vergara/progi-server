# Progi - Auction Sale

## Description
This project manages vehicle auctions, taking into account dynamic rates to help calculate the total price of a vehicle at an auction.

## What will you find in the project?
- DDD and Onion Architecture.
- Implementation of SOLID principles, some design patterns, and clean code.
APIs documented with Swagger.
- Development of feature tests to ensure the correct functioning of the business logic.

## System Requirements
- PHP 8.2
- Composer 2.6

## Getting Started
- Clone the project.
- Run cp .env.example .env in your terminal.
- Create a database and add the db name, user, and password in the .env file.
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan optimize:clear`
- Run `php artisan migrate --step`
- Run `php artisan db:seed`
- Run `php artisan serve` to start the project on port 8000.
- Run `php artisan l5-swagger:generate` to generate Swagger documentation.
- Navigate to http://localhost:8000/api/documentation to view the API documentation.

## Testing
- In the .env.testing file, configure the connection parameters for the test database (it is suggested to use the same name specified in .env.testing test_db_progi).
- Run `php artisan test --testsuite=Feature`

## Deployment
The project is deployed and can be accessed **[here](https://master--progi-client.netlify.app/)**.

## Contact
#### **[Adrian Vergara](https://www.linkedin.com/in/adrian-vergara-2b8973106/)**
#### adrianvergara22@gmail.com
