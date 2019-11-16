#!/usr/bin/env bash

# Adding host machine hostname
sudo bash -c 'echo -e "\n# Hostname for gateway" >> /etc/hosts'
sudo bash -c "echo -e \"`/sbin/ip route|awk '/default/ { print $3 }'`\tdocker.host.internal\n\" >> /etc/hosts"

cd /app

composer install --no-progress --no-ansi --no-interaction

php artisan migrate:refresh
php artisan passport:install --force

sudo /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
