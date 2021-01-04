.PHONY: seed dev stan

dev:
	php artisan serve

seed:
	php artisan migrate:refresh && php artisan db:seed

stan:
	./vendor/bin/phpstan analyse --memory-limit=2G
