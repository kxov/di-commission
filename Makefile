up:
	docker-compose up -d
stop:
	docker-compose down --remove-orphans

composer-install:
	docker-compose run --rm php-cli composer install

run:
	docker-compose run --rm php-cli php src/app.php

test:
	docker-compose run --rm php-cli php vendor/bin/phpunit --testsuite=unit