# Use the official PHP image
FROM php:8.2-apache

# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Set Apache document root to the public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Add DirectoryIndex directive and permissions to Apache configuration
RUN echo '<Directory /var/www/html/public>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n    DirectoryIndex index.php\n</Directory>' >> /etc/apache2/apache2.conf

# Ensure permissions for the public folder
RUN chmod -R 755 /var/www/html/public

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port
EXPOSE 80