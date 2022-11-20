SHELL := /bin/bash

##################
### Docker compose commands
##################

up:
	docker-compose up
down:
	docker-compose down
build:
	docker-compose up --build

##################
### Docker containers
##################

blog:
	docker-compose exec php-fpm bash

redis:
	docker-compose exec redis bash

##################
### Static code analysis
##################

deptrac:
	docker exec -it blog-php-fpm ./vendor/bin/deptrac analyze --config-file=deptrac-layers.yaml
	docker exec -it blog-php-fpm ./vendor/bin/deptrac analyze --config-file=deptrac-modules.yaml

cs-fix:
	docker exec -it blog-php-fpm ./vendor/bin/php-cs-fixer fix --allow-risky=yes

psalm:
	docker exec -it blog-php-fpm ./vendor/bin/psalm

##################
### Database
##################

db_migrate:
	docker-compose exec php-fpm bin/console doctrine:migrations:migrate --no-interaction
db_diff:
	docker-compose exec php-fpm bin/console doctrine:migrations:diff --no-interaction

##################
### Tests
##################

func:
	docker exec -it blog-php-fpm ./vendor/bin/phpunit --configuration ./phpunit.xml --testsuite functional
