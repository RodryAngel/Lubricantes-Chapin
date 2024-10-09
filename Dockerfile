# Utiliza la imagen oficial de PHP con Apache
FROM php:8.0-apache

# Instala las extensiones necesarias para conectar con MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Cambia el puerto de Apache a 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf

# Establecer permisos correctos para Apache en el directorio de la aplicación
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Asegúrate de que AllowOverride esté habilitado en el servidor Apache
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf && \
    echo "<Directory /var/www/html>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>" >> /etc/apache2/apache2.conf

# Expone el puerto 8080
EXPOSE 8080

# Comando para ejecutar Apache en primer plano
CMD ["apache2-foreground"]
