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

## Done

* Category CRUD
* Tag CRUD
* Authentication

## Todo

* list tasks for each category
* list tasks for each tag
* list day tasks (week, month)
* calendar
* categories color
* Assign task to user
* Sort tasks
* User CRUD
* REST API