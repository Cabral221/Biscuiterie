.PHONY: seed dev stan test

dev:
	composer install
	npm install
	npm run dev 
	php artisan serve

seed:
	php artisan migrate:refresh && php artisan db:seed

test:
	php artisan test

stan:
	./vendor/bin/phpstan analyse --memory-limit=2G --xdebug
