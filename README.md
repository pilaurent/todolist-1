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
* Assign task to user
* list tasks for each category
* list day tasks (week, month)
* Repository
* Bootstrap
* list tasks for each tag
* categories color
* Sort tasks

## Todo

* Bug : URL dans les catégories / tags avec la notion de tri
* REST API
* calendar

## 18052016
# symfony
