. PHONY: up down stop container_php install_dependencies migrate_orm

up:
	docker compose up -d

down:
	docker compose --profile '*' down

stop:
	docker compose stop

container_php:
	docker compose exec php bash

install_dependencies:
	docker compose exec -T php bash -c "composer install --ignore-platform-req=ext-mongodb"

migrate_orm:
	docker compose exec -T php bash -c "php bin/console doctrine:migrations:migrate -n"

reset-deep:
	rm -rf var/storage
	rm -rf assets/uploads
	rm -rf assets/vendor
	rm -rf public/assets
	rm -rf var/cache
	rm -rf var/log
	docker compose exec -T php bash -c "php bin/console cache:clear"
	docker compose exec -T php bash -c "php bin/console d:d:d -f"
	docker compose exec -T php bash -c "php bin/console d:d:c"
	make migrate_orm
	docker compose exec -T php bash -c "php bin/console importmap:install"
	docker compose exec -T php bash -c "php bin/console asset-map:compile"

style:
	docker compose exec -T -e PHP_CS_FIXER_IGNORE_ENV=1 php bash -c "php bin/console app:code-style"
	docker compose exec -T php bash -c "php vendor/bin/phpcs --config-set installed_paths src/Standards"
	docker compose exec -T php bash -c "php vendor/bin/phpcs"

