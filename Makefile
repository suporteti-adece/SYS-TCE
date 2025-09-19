. PHONY: up down stop container_php install_dependencies migrate_orm reset-deep style compile_frontend reset setup install_frontend

guard-not-prod:
ifeq ($(APP_ENV),prod)
	$(error Este comando não pode ser executado em produção)
endif

# Inicia os serviços Docker em modo detached (em segundo plano)
up:
	docker compose up -d

# Para e remove os serviços Docker
down:
	docker compose --profile '*' down

# Para os serviços Docker
stop:
	docker compose stop

# Acessa o contêiner PHP
container_php:
	docker compose exec php bash

# Compila os arquivos do frontend
compile_frontend: reset
	docker compose exec -T php bash -c "php bin/console asset-map:compile"

# Instala dependências do frontend
install_frontend:
	docker compose exec -T php bash -c "php bin/console importmap:install"

# Instala dependências dentro do contêiner PHP
install_dependencies:
	docker compose exec -T php bash -c "composer install --ignore-platform-req=ext-mongodb"

# Executa as migrations no banco de dados relacional
migrate_orm:
	docker compose exec -T php bash -c "php bin/console doctrine:migrations:migrate -n"

# Limpa o cache da aplicação
reset:
	docker compose exec -T php bash -c "php bin/console cache:clear"

# Limpa o cache da aplicação, remove arquivos temporários e reinicia o banco de dados
reset-deep: guard-not-prod
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

# Aplica o estilo de código conforme as regras definidas
style:
	docker compose exec -T -e PHP_CS_FIXER_IGNORE_ENV=1 php bash -c "php bin/console app:code-style"
	docker compose exec -T php bash -c "php vendor/bin/phpcs --config-set installed_paths src/Standards"
	docker compose exec -T php bash -c "php vendor/bin/phpcs"

setup: guard-not-prod up install_dependencies reset-deep migrate_orm install_frontend compile_frontend
