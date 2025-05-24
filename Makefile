ifneq (,$(wildcard .env.local))
    include .env.local
    export
endif

create:
	make init
	make up

init:
	@composer install

up:
	@cd ${DOCKER_DIR} && docker compose up --build -d && \
	if [ $$? -eq 0 ]; then \
	    echo 'System is running at http://app.${PROJECT_NAME}.local'; \
	    echo 'Database is running at http://adminer.${PROJECT_NAME}.local'; \
	else \
	    echo 'Failed to start system. Check Docker logs for details.'; \
	fi

down:
	@cd ${DOCKER_DIR} && docker compose down

in:
	@cd ${DOCKER_DIR} && docker exec -it project-php bash

cc:
	@cd ${DOCKER_DIR} && docker exec -it project-php php bin/console c:c

asset:
	@cd ${DOCKER_DIR} && docker exec -it project-php php bin/console asset-map:compile

migrate:
	@cd ${DOCKER_DIR} && docker exec -it project-php php bin/console d:m:m

pull:
	@echo 'Pulling from Github ...';
	@git pull $(REPO_URL)

phpcs:
	@cd ${DOCKER_DIR} && docker exec -it project-php vendor/bin/phpcs src/

phpcs-fix:
	@cd ${DOCKER_DIR} && docker exec -it project-php vendor/bin/phpcbf src/

php-stan:
	@cd ${DOCKER_DIR} && docker exec -it project-php vendor/bin/phpstan analyse src/ --level=${PHP_STAN_LEVEL}

messenger:
	@cd ${DOCKER_DIR} && docker exec -it project-php php bin/console messenger:consume async -vv