#!/usr/bin/env bash

docker_compose_up() {
  if [ ! -f '.env.docker' ]; then
    init_project
  fi
  docker compose --env-file .env.docker up
}

docker_compose_build() {
  if [ ! -f '.env.docker' ]; then
    init_project
  fi
  docker compose --env-file .env.docker build
}

init_project() {
  local user_id
  local group_id
  user_id=$(id -u)
  group_id=$(id -g)
  echo "PROJECTINIT_UID=${user_id}" >> .env.docker
  echo "PROJECTINIT_GID=${group_id}" >> .env.docker
}