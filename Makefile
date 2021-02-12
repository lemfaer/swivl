help:  ## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

mysql: ## Run mysql cli from docker container using root.
	@sudo mysql -h 127.0.0.1 -P 33061 -u root

exec:  ## Run composer using php from docker container.
	@sudo docker-compose exec php sh

up:    ## Builds, (re)creates, starts, and attaches to containers for a service (in the background)
	@sudo docker-compose up -d

down:  ## Stops containers and removes containers, networks, volumes, and images created by up
	@sudo docker-compose down

start: ## Starts existing containers for a service.
	@sudo docker-compose start

stop:  ## Stops running containers without removing them.
	@sudo docker-compose stop

list:  ## List containers
	@sudo docker ps -a
