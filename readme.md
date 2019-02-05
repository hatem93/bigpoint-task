# BigPoint Task - PHP Payment Position

This Repo is the implementation for the following task for php payment postion
The requirements where to implement the following in php.

  - as a customer, I want to add an item into the basket
  - as a customer, I want to view all my item in my basket

#  Features!

  - Login API
  - Add Item API with JWT Auth
  - View All Items API with JWT AUth



# Design

> I have used the DDD architecture pattern to implement this in Laravel 5.3 framework. 
> This mainly dividies it into two domains Account and Item domains
> 
> App folder structure will contain Application layer which contain all the services and DTOs
> And the Domain Model Layer which contains the main repository interfaces and the all the Entities.
> And the Infrustrure which contains all the repositories.
> 
>Considering the database design i have created three tables.
>users table (id,username,password,address,etc...) for the users.
>items table (id,name,description,price,etc...) for all the items.
>user_items table (id,user_id,item_id) for all the user items "user basket".

### Tech

This task uses a number of open source projects to work properly:

* [Laravel] - Framework for developing php web applications
* [Analogue] - ORM for laravel that works in DDD design pattern
* [Faker] - Library that generates fake data.
* [JWTAuth] - JSON Web Token Authentication for Laravel


### Installation

This Task requires [PHP] v5.6.4+ to run.

Install the dependencies and start the server.

```sh
git clone https://github.com/hatem93/bigpoint-task
composer update
php artisan serve
```
Navigate to this url to check that everything is running correctly you should see laravel logo.

```sh
127.0.0.1:8000
```

These are my database variables in the env file.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bigpoint
DB_USERNAME=root
DB_PASSWORD=
```

Create a database with name bigpoint and run this command to migrate and run seeders, i have seeded 2 users and 100 items

```sh
php artisan migrate:refresh --seed
```

### APIs

These are all the apis that have been implemented.

| API | Type | Inputs | Desctiption |
| ------ | ------ | ------ | ------ |
| 127.0.0.1:8000/login | POST | username,password | login with username and password
| 127.0.0.1:8000/user/add | POST | token,itemId| add item to basket
| 127.0.0.1:8000/user/items | GET | token |  see all items in basket
| 127.0.0.1:8000/user/notaddeditems | GET | token | see all items not in basket

### Login API Credentials

These are 2 users that have been seeded into the database for login use them to get the JWT for Authentication.

| Username | Password |
| ------ | ------ |
| patrick | 123456 |
| alex | 123456 |

You will find the token in Object.token.token in the JSON result.

### Testing
I have implemented 4 test cases with 5 assertions , use the following command to run the tests
```sh
vendor\bin\phpunit
```
### Todos

 - Implement the Register Api .
 - Add Pagination for the see items in basket and the see items not in basket APIs.
 - Add more test cases to cover for full coverage

License
----

MIT




   [JWTAuth]: <https://github.com/tymondesigns/jwt-auth>
   [Faker]: <https://github.com/fzaninotto/Faker>
   [Laravel]: <https://laravel.com/docs/5.3>
   [Analogue]: <https://github.com/hatem93/analogue>
   [PHP]: <http://php.net/>
   [PhpMyAdmin]: <http://www.phpmyadmin.co>
