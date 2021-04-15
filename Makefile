
# Development
# ------------------
.PHONY: dev
dev: vendor node_modules dev_assets
	php artisan serve

.PHONY: seed
seed:
	php artisan migrate:refresh && php artisan db:seed

.PHONY: test
test: vendor
	php artisan test

.PHONY: stan
stan:
	./vendor/bin/phpstan analyse --memory-limit=2G --xdebug

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