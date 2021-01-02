.PHONY: seed

seed:
	php artisan migrate:refresh && php artisan db:seed