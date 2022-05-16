## Test request app

#### Clone repository:
```sh
git clone https://github.com/Boris1979509/test-request-app.git
```
#### Mysql:
```sh
CREATE DATABASE `test_request`
```
#### API:
```sh
$ composer install
```
```sh
$ php artisan migrate --seed
```
```sh
$ php artisan serve
```