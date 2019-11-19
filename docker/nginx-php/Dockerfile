FROM ubuntu:18.04

ARG HOST_USER_UID=1000

ENV DEBIAN_FRONTEND noninteractive

USER root

RUN apt-get update && \
    apt-get install --no-install-recommends -y aptitude apt-utils software-properties-common \
    curl git gpg-agent iproute2 nginx sudo supervisor unzip vim && \
    rm -rf /var/lib/apt/lists/*

# Adding PHP Ondrej repos
RUN add-apt-repository -y ppa:nginx/stable && \
    LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php && \
    apt-get update && \
    # PHP73
    apt-get install --no-install-recommends -y php7.3 php7.3-calendar php7.3-ctype php7.3-curl php7.3-dom php7.3-exif \
    php7.3-fileinfo php7.3-ftp php7.3-gd php7.3-gettext php7.3-iconv php7.3-intl php7.3-json \
	php7.3-mbstring php7.3-mysql php7.3-mysqli php7.3-mysqlnd \
   	php7.3-PDO php7.3-Phar php7.3-posix php7.3-readline php7.3-shmop \
   	php7.3-SimpleXML php7.3-sockets php7.3-sysvmsg php7.3-sysvsem php7.3-sysvshm \
   	php7.3-tokenizer php7.3-wddx php7.3-xml php7.3-xmlreader php7.3-xmlwriter \
   	php7.3-xsl php7.3-opcache php7.3-zip php7.3-fpm php7.3-bcmath && \
   	apt-get install -y php-memcached php-redis php-imagick php-mongo php-xdebug && \
   	rm -rf /var/lib/apt/lists/*

# Adding phpcanister user
RUN mkdir -p /home/app_user
RUN useradd app_user -u ${HOST_USER_UID} -d /home/app_user -s /bin/bash
RUN groupmod app_user -g ${HOST_USER_UID}
RUN chown -R app_user:app_user /home/app_user
RUN echo "app_user ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/app_user

# Installing composer
RUN curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php; php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer

# nginx configuration
COPY nginx/nginx.conf /etc/nginx/
COPY nginx/conf.d/*.conf /etc/nginx/conf.d/

# Copying FPM pools configuration
COPY fpm/7.3.conf /etc/php/7.3/fpm/pool.d/www.conf

# Copying supervisor configuiration
COPY supervisor/* /etc/supervisor/conf.d/

# Creating dir for php-fpm sockets
RUN mkdir /run/php/
RUN chown app_user:root /run/php/

RUN mkdir -p /app
RUN chown -R app_user:app_user /app

VOLUME "/app"

USER app_user
WORKDIR /app

ADD ./startup.sh /startup.sh
CMD ["/bin/bash", "/startup.sh"]

EXPOSE 80
