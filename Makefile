#!make

default: build up

php_container = TwinklTestServer

help:
	@echo ""
	@echo "usage: make COMMAND"
	@echo ""
	@echo "Commands:"
	@echo "  help                     List of all commands in make file"
	@echo "  build                    Build images"
	@echo "  up                       Run docker compose"
	@echo "  install                  Run basic configurations"
	@echo "  test                     Run tests"
	@echo "  php                      Bash to php container"
	@echo "  stop                     Stop docker compose"
	@echo "  down                     Stop and removes containers, networks, volumes & images"

build:
	docker-compose build

up:
	docker-compose up -d

install:
    # php commands
	docker-compose up -d
	docker exec -it --user=www-data $(php_container) composer install
	docker exec -it --user=www-data $(php_container) php artisan migrate

test:
	docker exec -it --user=www-data $(php_container) php artisan test

php:
	docker exec -it $(php_container) bash

stop:
	docker-compose stop

down:
	docker-compose down --volumes --rmi local --remove-orphans || true
