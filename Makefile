.RECIPEPREFIX +=

help: ## Print help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

setup: modify_permission build up ## setup project

kill_composer: ## remove composer container
	@docker compose rm composer

	
modify_permission: ##change file entrypoint permissions
	chmod +x docker-files/composer/entrypoint.sh
	chmod +x docker-files/node/entrypoint.sh
	chmod +x docker-files/horizon/entrypoint.sh

create-env: ## Copy .env.example to .env
	@if [ ! -f ".env" ]; then \
		echo "Creating .env file."; \
		cp .env.example .env; \
	fi

up: ## start containers in detatched mode
	@docker compose up -d

build: create-env ## Build defined images.
	@docker compose build --no-cache

force_start: ## force a restart of defined services
	@docker-compose up -d --force-recreate

fresh: modify_permission build force_start ## a fresh recreate of all containers

ps: ## show containers
	@docker compose ps

teardown:
	docker compose down
	docker compose rm -f
	rm -f .env

down:
	docker compose down

shell:
	docker exec -it -u ubuntu optix /bin/bash

migrate:
	docker-compose exec app php /var/www/optix/artisan migrate

seed:
	php artisan db:seed
	docker-compose exec app php /var/www/optix/artisan migrate