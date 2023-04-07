.RECIPEPREFIX +=

setup:
	git checkout -b develop || git checkout develop
	cp .env.example .env
	docker compose build
	docker compose up -d
	docker compose exec -u ubuntu app /bin/bash -c "composer install && php artisan key:generate && php artisan db:seed && npm install && npm run watch"

teardown:
	docker compose down
	docker compose rm -f
	rm -f .env

down:
	docker compose down

shell:
	docker compose exec -u ubuntu optix /bin/bash

