# Use the official PHP 8 image with Apache
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    vim \
    unzip \
    git \
    curl \
    pkg-config \
    libsqlite3-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions needed
RUN docker-php-ext-install pdo_mysql pdo_sqlite gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configure working directory
WORKDIR /var/www

# Ensure directories exist and set permissions
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache

# Copy project files into the container
COPY . .

# Set permissions recursively (already done above)
 RUN chown -R www-data:www-data /var/www

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

# Copy initialization script into the container
#COPY init.sh /var/www/init.sh

# Make the initialization script executable
#RUN chmod +x /var/www/init.sh

# Run initialization script
#CMD ["/var/www/init.sh"]
