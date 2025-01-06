
NETWORK=php-laravel-nyanair_default

docker run --name checkin-nyanair -p 5000:5000 --rm -ti -v $PWD/src/:/app --env-file env.sh --network $NETWORK checkin-nyanair
