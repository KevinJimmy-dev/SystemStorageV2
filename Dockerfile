FROM ambientum/php:8.0-nginx

RUN echo "xdebug.mode=debug" | sudo tee -a /etc/php8/conf.d/00_xdebug.ini > /dev/null && \
    echo "xdebug.start_with_request=yes" | sudo tee -a /etc/php8/conf.d/00_xdebug.ini > /dev/null && \
    echo "xdebug.client_host=host.docker.internal" | sudo tee -a /etc/php8/conf.d/00_xdebug.ini > /dev/null