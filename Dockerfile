FROM wordpress:latest

# Install the MySQL client
RUN apt-get update && apt-get install -y default-mysql-client && rm -rf /var/lib/apt/lists/*

COPY wp-init.sh /usr/local/bin/wp-init.sh
RUN chmod +x /usr/local/bin/wp-init.sh

ENTRYPOINT ["wp-init.sh"]
CMD ["apache2-foreground"]
