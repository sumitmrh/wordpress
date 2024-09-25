FROM wordpress:latest

COPY wp-init.sh /usr/local/bin/wp-init.sh
RUN chmod +x /usr/local/bin/wp-init.sh

ENTRYPOINT ["wp-init.sh"]
CMD ["apache2-foreground"]
