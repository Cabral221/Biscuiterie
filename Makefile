
# Development
# ------------------
.PHONY: dev
dev: vendor nodemodules
	php artisan serve

.PHONY: seed
seed:
	php artisan migrate:refresh && php artisan db:seed

.PHONY: test
test:
	php artisan test

.PHONY: stan
stan:
	./vendor/bin/phpstan analyse --memory-limit=2G --xdebug

# Required
# ------------------
vendor:
	composer install

node_modules:
	npm install && npm run dev