# 1. Use a imagem oficial do PHP 8.4 com FPM (FastCGI Process Manager)
FROM php:8.4-fpm-alpine

# 2. Instala extensões necessárias para o Laravel e MySQL # Usamos o script 'php-extension-installer' para manter o Dockerfile limpo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Dê permissão de execução ao script e instale as extensões necessárias para o Laravel
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql bcmath gd zip intl

# 3. Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Define o diretório de trabalho
WORKDIR /var/www

# 5. Ajusta permissões para o usuário padrão do PHP-FPM # Isso evita problemas de escrita nas pastas 'storage' e 'bootstrap/cache'
RUN chown -R www-data:www-data /var/www

# 6. Expõe a porta do PHP-FPM
EXPOSE 9000

# 7. Comando para iniciar o PHP-FPM
CMD ["php-fpm"]
