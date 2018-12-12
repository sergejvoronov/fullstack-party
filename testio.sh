#!/usr/bin/env bash

if [[ ! -f .env.local ]]; then
    cat .env | sed "s/LOCAL_USER_ID=1000/LOCAL_USER_ID=$(id -u)/" | sed "s/LOCAL_GROUP_ID=1000/LOCAL_GROUP_ID=$(id -g)/" > .env.local
fi

if [[ $1 == 'up' ]]; then
    provision () {
        docker-compose exec php.symfony composer install --prefer-dist -n
        docker-compose run --rm frontend.symfony bash -c "npm install --no-save && yarn run encore dev"
    }
else
    echo "Usage: ./testio.sh up"
    exit
fi

docker-compose up -d
provision
