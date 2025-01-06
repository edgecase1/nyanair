

docker run -ti --rm \
    -v $PWD/test:/test \
    --network container:checkin-nyanair \
    alpine \
    sh -c "apk update && apk add curl && sh test/requests.sh"
