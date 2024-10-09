FROM php:8.0.9-apache

# Instala las extensiones de PHP necesarias, incluyendo pdo_mysql
RUN docker-php-ext-install pdo pdo_mysql

# Instalar GD y otras extensiones necesarias
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilita mod_rewrite si es necesario
RUN a2enmod rewrite

# Copia todo el contenido de tu proyecto al directorio raíz de Apache
COPY . /var/www/html/

# Establece permisos adecuados (opcional pero recomendado)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Establecer el propietario correcto de la carpeta de caché (si es necesario)
RUN mkdir -p /var/www/html/storage && \
    chown -R www-data:www-data /var/www/html/storage

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]
