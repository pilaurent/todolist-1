# todolist

## Development env

```
git clone https://github.com/nicosomb/todolist.git
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:update --force 
bin/console server:run
```

## Test env

```
bin/console doctrine:database:create --env=test
bin/console doctrine:schema:update --env=test --force 
bin/phpunit
```

## Todo

* Category CRUD
* Tag CRUD
* User CRUD
* Authentication : OK
* REST API