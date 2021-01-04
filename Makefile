.PHONY: seed dev

dev: 
	php artisan serve

seed:
	php artisan migrate:refresh && php artisan db:seed