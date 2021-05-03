
# Development
# ------------------
.PHONY: dev
dev: vendor node_modules
	php artisan serve

.PHONY: asset
asset: node_modules
	npm run watch

.PHONY: seed
seed:
	php artisan migrate:refresh && php artisan db:seed

.PHONY: test
test: vendor
	php artisan test

.PHONY: stan
stan:
	./vendor/bin/phpstan analyse --memory-limit=2G --xdebug

.PHONY: deploy
deploy: prod_assets
	git push heroku master
	heroku run php artisan migrate:refresh --seed

# Required
# ------------------
vendor:
	composer install

node_modules:
	npm install


# Required development
# ------------------
.PHONY: dev_assets
dev_assets:
	npm run dev


# Required Production
# ------------------
.PHONY: prod_assets
prod_assets:
	npm run prod
