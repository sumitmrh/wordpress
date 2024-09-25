#!/bin/bash
set -euo pipefail

# Wait for MySQL to be available
while ! mysqladmin ping -h "db" --silent; do
    sleep 1
done

# Install WordPress if not already installed
if ! wp core is-installed --path="/var/www/html"; then
    wp core download --path="/var/www/html"
    wp config create --dbname=wordpress --dbuser=wordpress --dbpass=wordpress --dbhost=db:3306 --path="/var/www/html"
    wp core install --url="http://test.sumit.com:8000" --title="test.sumit.com" --admin_user="sumit" --admin_password="Maharjan" --admin_email="admin@test.sumit.com" --path="/var/www/html"
fi

exec "$@"
