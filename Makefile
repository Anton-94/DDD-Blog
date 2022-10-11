SHELL := /bin/bash

# Docker commands
up:
	docker-compose up
down:
	docker-compose down
build:
	docker-compose up --build

#Docker containers
blog:
	docker-compose exec php-fpm bash

cs-fix:
	docker exec -it blog-php-fpm ./vendor/bin/php-cs-fixer fix --allow-risky=yes

psalm:
	docker exec -it blog-php-fpm ./vendor/bin/psalm