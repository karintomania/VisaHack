.PHONY: help
help:
	@cat $(MAKEFILE_LIST)

.PHONY: up
up:
	docker compose up -d
	docker compose exec web bash -c 'npm run dev'

.PHONY: shell
shell:
	docker compose exec web bash

.PHONY: down
down:
	docker compose down

.PHONY: build
build:
	docker compose build --build-arg UID=$(shell id -u) --build-arg GID=$(shell id -g)

.PHONY: composer-install
composer-install:
	docker compose run --rm web bash -c 'composer install'

.PHONY: npm-install
npm-install:
	docker compose run --rm -uroot web bash -c 'npm install'

.PHONY: laravel-init
laravel-init:
	docker compose run --rm web bash -c 'cp .env.example .env'
	docker compose run --rm web bash -c 'php artisan key:generate'

.PHONY: install
install: composer-install npm-install laravel-init

.PHONY: deploy-build
deploy-build:
	sh build.sh

.PHONY: lint-fix
lint-fix:
	docker compose run --rm web bash -c 'php vendor/bin/pint'
	docker compose run --rm web bash -c 'php vendor/bin/rector'


.PHONY: lint
lint:
	docker compose run --rm web bash -c 'php vendor/bin/pint --test'
	docker compose run --rm web bash -c 'php vendor/bin/rector --dry-run'
	docker compose run --rm web bash -c 'vendor/bin/phpstan analyse app tests --level=9 --memory-limit=512M'

