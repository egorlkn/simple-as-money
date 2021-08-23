#!/bin/bash

docker-compose -f docker/dev/docker-compose.dev.yaml exec php composer install --no-interaction

exit 0
