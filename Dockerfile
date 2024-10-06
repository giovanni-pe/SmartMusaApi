# Usa PHP 8.1 con FPM
FROM php:8.1-fpm

# Establecer variables de entorno necesarias
ENV APP_ENV=local
ENV APP_DEBUG=true
ENV APP_KEY=base64:7/oGbYPJfRr2UN/xP9I/W79XmdTqIDD9LAWlrBibVjY=
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/composer

# Instalar dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libxslt-dev \
    nginx \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo composer.json y composer.lock primero para aprovechar la cache de Docker
COPY composer.json composer.lock ./

# Instalar dependencias de Composer sin autoload (opcional)
RUN composer install --no-autoloader

# Copiar el resto de los archivos de la aplicación
COPY . .

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Generar autoload de Composer
RUN composer dump-autoload

# Generar clave de aplicación (si no está configurada)
RUN if [ -z "$APP_KEY" ] ; then \
      php artisan key:generate ; \
    fi

# Configurar Nginx
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

# Copiar el archivo de configuración de supervisord
COPY ./supervisord.conf /etc/supervisord.conf

# Exponer el puerto 80 para servir la aplicación
EXPOSE 80



# Ejecutar Nginx y PHP-FPM con Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
