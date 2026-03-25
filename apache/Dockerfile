FROM php:8.2-apache

# Activar modo rewrite
RUN a2enmod rewrite

#Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# INSTALAR SERVIDOR SSH
RUN apt-get update && apt-get install -y openssh-server libpng-dev libjpeg-dev libfreetype6-dev

# Activar extensiones
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd mysqli pdo pdo_mysql

# configuracion ssh

RUN mkdir -p /var/run/sshd
RUN echo 'root:root' | chpasswd
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config


# permitir login por password
RUN sed -i 's/#PasswordAuthentication yes/PasswordAuthentication yes/' /etc/ssh/sshd_config

#Exponer puerto ssh??? 22
EXPOSE 22

#INICIAR EL CONTAINER
CMD service ssh start && apache2-foreground
