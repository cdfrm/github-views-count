start:
	cp ./htdocs/ghvc/.env.sample ./htdocs/ghvc/.env
	docker-compose up -d --build
	docker exec -it php sudo composer install
stop:
	docker-compose down